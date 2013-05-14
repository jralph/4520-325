<?php

class FilesUpload_Model extends Base_Model {

	public function upload()
	{
		if(isset($_FILES)){
			if($_FILES['file']['error'] > 0){
				// File Error
				echo 'error';
			} else {
				$fileName = $_FILES['file']['name'];
				$tmpName = $_FILES['file']['tmp_name'];
				$userID = Authenticate::user('user_id');

				$root = $_SERVER['DOCUMENT_ROOT'];

				$allowedExts = array('gif', 'jpg', 'jpeg', 'png', 'pdf', 'doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx', 'txt');

				if(file_exists($root.'files/'.$userID.'/'.$fileName)){

				} else {
					move_uploaded_file($tmpName, $root.'/files/'.$userID.'/'.$fileName);
					return true;
				}
			}
		}
	}

}