<?php

// File controller. Will perform actions to files and retrieve files
// for specified users.
class Files {

	// Get the requested users files. Using user id.
	public static function get_user_files($user)
	{
			// Database query to get files.
			$files = DB::query('
						SELECT * FROM files
						WHERE
						uploaded_by = :user
						ORDER BY
						file_name ASC
					')
					->params(array(
						':user' => $user
					))
					->get();
			// Return the results.
			return $files;
	}

	// Function to get the file type using type id.
	public static function get_file_type($type)
	{
		// Query to get file type.
		$type = DB::query('
					SELECT * FROM file_types
					WHERE
					id = :type
				')
				->params(array(
					':type' => $type
				))
				->first();

		// Return name of file type.
		return $type->file_type;
	}

	// Function to delete file, using file id.
	public static function delete_file($file)
	{
		// Select file to get file name.
		$file_name = DB::query('
						SELECT * FROM files
						WHERE
						id = :file
						LIMIT 1
					')
					->params(array(
						':file' => $file
					))
					->first();
		// Delete file using file id.
		$file = DB::query('
					DELETE FROM files
					WHERE
					id = :file
					LIMIT 1
				')
				->params(array(
					':file' => $file
				))
				->execute();

		// Get document root to find where to delete files from.
		$root = $_SERVER['DOCUMENT_ROOT'];

		// Delete file using $file_name->file_name.
		unlink($root.'/storage/'.Authenticate::user('user_id').'/'.$file_name->file_name);
	}

	// Function to wipe the users storage area.
	public static function clear_storage()
	{
		// Get Document Root.
		$root = $_SERVER['DOCUMENT_ROOT'];

		// Get all files in users storage location.
		$files = glob($root.'/storage/'.Authenticate::user('user_id').'/*');

		// Loop through each file and delete.
		foreach($files as $file){
			// Check if what is to be delete is actually a file.
			if(is_file($file)){
				// If so, delete the file.
				unlink($file);
			}
		}

		// Delete all user files entries from the database.
		DB::query('
				DELETE FROM files
				WHERE
				uploaded_by = :user
			')
			->params(array(
				':user' => Authenticate::user('user_id')
			))
			->execute();

		// Return true for success.
		return true;
	}

}