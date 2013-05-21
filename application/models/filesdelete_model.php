<?php

// Initlate files delete class.
class FilesDelete_Model extends Base_Model {

	// Function to delete files.
	public function delete($file)
	{
		// Delete requested file.
		Files::delete_file($file);

		// Return true.
		return true;
	}

}