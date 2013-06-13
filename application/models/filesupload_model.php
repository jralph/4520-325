<?php

class FilesUpload_Model extends Base_Model {

	public function upload()
	{
		// Check that files is set
		if(isset($_FILES)){
			// Check for errors in uploading the file, if so, return error.
			if($_FILES['file']['error'] > 0){
				Error::set('general', 'An error has occurred, please try again or contact support.');
				return true;
			} else {
				// Set variables for the $_FILES and user ID.
				$fileName = $_FILES['file']['name'];
				$tmpName = $_FILES['file']['tmp_name'];
				$fileExt = explode('.', $fileName);
				$fileExt = end($fileExt);
				$userID = Authenticate::user('user_id');

				// The server document root.
				$root = $_SERVER['DOCUMENT_ROOT'];

				// Files that are allowed for uploading.
				$allowedExts = array('gif', 'jpg', 'jpeg', 'png', 'pdf', 'doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx', 'txt', 'csv');

				if(file_exists($root.'storage/'.$userID.'/'.$fileName)){
					Error::set('general', 'File already exists in your area, please rename or delete the file and reupload.');
					return true;
				} else {
					// Check if file is allowed.
					if(in_array($fileExt, $allowedExts)){
						// Directory of user area.
						$dir = $root.'/storage/'.$userID;
						// Check if user area directory exists, if not, create it.
						if(!is_dir($dir)){
							mkdir($dir);
						}
						// More the uploaded file to the users storage area.
						move_uploaded_file($tmpName, $root.'/storage/'.$userID.'/'.$fileName);

						// Check if the file already exists.
						$file_type = DB::query('
											SELECT * FROM file_types
											WHERE file_type = :type
											LIMIT 1
										')
										->params(array(
											':type' => $fileExt,
										))
										->first();
						// If file does not exist, add it to the database.
						if(count($file_type) != 1){
							DB::query('
									INSERT INTO file_types
									(file_type)
									VALUES
									(:type)
								')
								->params(array(
									':type' => $fileExt,
								))
								->execute();

								// Get the file type once added.
								$file_type = DB::query('
												SELECT * FROM file_types
												WHERE file_type = :type
												LIMIT 1
											')
											->params(array(
												':type' => $fileExt,
											))
											->first();
						}

						// Get the file type id.
						$type = $file_type->id;

						// Set file storage location and name.
						$file_location = '/storage/'.$userID.'/'.$fileName;

						// Insert File Info Into Database
						DB::query('
								INSERT INTO files
								(file_name, file_location, is_shared, uploaded_by, file_type)
								VALUES
								(:file_name, :file_location, :is_shared, :uploaded_by, :file_type)
							')
							->params(array(
								':file_name' => $fileName,
								':file_location' => $file_location,
								':is_shared' => "0",
								':uploaded_by' => $userID,
								':file_type' => $type,
							))
							->execute();

						// Return true for success.
						return true;

					} else {
						Error::set('general', 'The file type you have selected is not allowed, please try again.');
						return true;
					}
				}
			}
		}
	}

}