<?php

/**
 * The files class is used to perform any actions related to the file
 * system. This could include actions such as removing files, deleting
 * files and clearing user storage.
 *
 * All functions here are static functions and mostly run database queries.
 *
 * @author Joseph Ralph <jralph@arrowvaleacademy.co.uk>
 *
 */
class Files {

	/**
	 * Function to get the requested uers files based on the provided user id.
	 * Will return the requested files from the DB class as an object.
	 *
	 * @param int $user The ID of the user being requested.
	 * @return object The object of file information returned from the DB.
	 */
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

	/**
	 * Function to get the file type using the ID of the file.
	 * Will return the file type from the database as an object.
	 *
	 * @param int $type_id The ID of the type being requested.
	 * @return string The file type of the file (eg, docx, png, jpg...ect).
	 *
	 */
	public static function get_file_type($type_id)
	{
		// Query to get file type.
		$type = DB::query('
					SELECT * FROM file_types
					WHERE
					id = :type
				')
				->params(array(
					':type' => $type_id
				))
				->first();

		// Return name of file type.
		return $type->file_type;
	}

	/**
	 * Function to delete a file from the dababase based on the requested ID.
	 * Will delete a file from the dababase and from storage on the server.
	 *
	 * @param int $file The ID of the file to be deleted.
	 * @return void
	 */
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

	/**
	 * Function to clear the users storage completly.
	 * Wipes all files related to the current user from storage and
	 * from the databas.
	 *
	 * @return true Returns true when the file is deleted.
	 */
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