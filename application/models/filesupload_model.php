<?php

class FilesUpload_Model extends Base_Model {

	public function upload()
	{
		// Check that files is set
		if(isset($_FILES)){
			// Check for errors in uploading the file, if so, return error.
			if($_FILES['file']['error'] > 0){
				// File Error
				echo 'error';
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
					// File Exists With Same Name
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

						$file_type = DB::query('
											SELECT * FROM file_types
											WHERE file_type = :type
											LIMIT 1
										')
										->params(array(
											':type' => $fileExt,
										))
										->first();

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

						$type = $file_type->id;

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

						return true;
					} else {
						// File type is not allowed.
						echo 'not allowed!';
					}
				}
			}
		}
	}

}