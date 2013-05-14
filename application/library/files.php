<?php

class Files {

	private $files;

	public static function upload($files)
	{
		$upload = new Files;
		$upload->files = $files;

		return $upload;
	}

	public function validate()
	{
		if(isset($this->files)){
			$file = Validate::files($this->files);

			return $file;
		}
	}

	public function save_file($location)
	{
		if(isset($this->files)){
			move_uploaded_file($file['file']['tmp_name'], path('storage').'/'.Authenticate::user('id').'/'.$file['file']['name']);
		}
	}

}