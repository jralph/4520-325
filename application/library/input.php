<?php

/**
 * The Input class is a helper class to get data from the $_GET or $_POST variables.
 * The class will always check for values in the $_POST first, then in the $_GET.
 *
 * @author Joseph Ralph <jralph@arrowvaleacademy.co.uk>
 *
 */
class Input {

		/**
		 * Function to check if the $_POST or $_GET contains the requested value name.
		 * Will return the name of the array that the the value exists in, or false if none.
		 *
		 * @param string $input Name of the value to search for.
		 * @return mixed Returns 'post', 'get' or false.
		 */
		public static function has($input)
		{
				if(isset($_POST[$input])){
					return 'post';
				} elseif(isset($_GET[$input])){
					return 'get';
				} else {
					return false;
				}
		}

		/**
		 * Function to get the requested value from $_POST or $_GET.
		 * This function also makes use of the Input::has() to determine if a file is
		 * available in the $_POST or $_GET arrays.
		 *
		 * @param string $input Name of the value to retrieve.
		 * @return mixed Returns the value from $_POST or $_GET, or false.
		 */
		public static function get($input)
		{
				if(self::has($input)){
					if(self::has($input) == 'post'){
						return $_POST[$input];
					} elseif(self::has($input) == 'get'){
						return $_GET[$input];
					} else {
						return false;
					}
				} else {
					return false;
				}
		}

}