<?php

class Files {

	public static function get_user_files($user)
	{
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

			return $files;
	}

	public static function get_file_type($type)
	{
		$type = DB::query('
					SELECT * FROM file_types
					WHERE
					id = :type
				')
				->params(array(
					':type' => $type
				))
				->first();

		return $type->file_type;
	}

}