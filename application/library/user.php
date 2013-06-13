<?php

/**
 * The User class is used to get the user statistics for files.
 *
 * @author Joseph Ralph <jralph@arrowvaleacademy.co.uk>
 */
class User {

	/**
	 * Function to get the total space (formatted according to size) that the
	 * user has used.
	 *
	 * @return string The size used with b, kb, mb, gb or tb attached.
	 */
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

	/**
	 * Function to convert bytes to needed format.
	 * Will convert to nearest format. Eg, will not convert 1024 bytes into
	 * 0.00097 mb, it will convert it into 1 kb. If the size is equal or over
	 * 1mb, it will convert it to mb, and so on.
	 *
	 * @param int $bytes The number of bytes to convert.
	 * @param int $precision The number of decimal places to round to.
	 * @return string The value of the requested bytes, formatted.
	 */
	public static function formatBytes($bytes, $precision = 2) {
		// Units available to be convereted to.
	    $units = array('B', 'KB', 'MB', 'GB', 'TB');

	    // Return bytes if bytes is larger than 0.
	    $bytes = max($bytes, 0);

	    // Get the unit to use.
	    $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
	    $pow = min($pow, count($units) - 1);

	    $bytes /= (1 << (10 * $pow));

	    // Round bytes to nearest with 2 decimal points and add
	    // the unit used at the end of the string.
	    return round($bytes, $precision) . ' ' . $units[$pow];
	}

}