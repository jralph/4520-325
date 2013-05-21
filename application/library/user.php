<?php

class User {

	// Function to get total size used by the current user.
	public static function space_used()
	{
		// Get Document Root
		$root = $_SERVER['DOCUMENT_ROOT'];

		// Get All Files
		$files = glob($root.'/storage/'.Authenticate::user('user_id').'/*');

		// Set size used to 0.
		$size_used = 0;

		// Loop through all files and check size.
		foreach($files as $file){
			// Add each files size to the $size_used value.
			$size_used = $size_used + filesize($file);
		}

		// Convert to appropriate format.
		$size_used = static::formatBytes($size_used);

		// Return the value.
		return $size_used;
	}

	// Function to convert bytes to needed format.
	// Will not convert to nearest format. Eg, will not convert 1024 bytes into
	// 0.00097 mb, it will convert it into 1024 kb. If the size is equal or over
	// 1mb, it will convert it to mb, and so on.
	public static function formatBytes($bytes, $precision = 2) {
		// Units available to be convereted to.
	    $units = array('B', 'KB', 'MB', 'GB', 'TB');

	    // Return bytes if bytes is larger than 0.
	    $bytes = max($bytes, 0);

	    $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
	    $pow = min($pow, count($units) - 1);

	    $bytes /= (1 << (10 * $pow));

	    // Round bytes to nearest with 2 decimal points and add
	    // the unit used at the end of the string.
	    return round($bytes, $precision) . ' ' . $units[$pow];
	}

}