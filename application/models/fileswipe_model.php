<?php

// Class for wiping users space.
class FilesWipe_Model extends Base_Model {

	// Delete All Files
	public function wipe()
	{
		// Run the clear storage function.
		Files::clear_storage();

		// Return Success.
		return true;
	}

}