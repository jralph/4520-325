<?php

// Begin the creation of the input class.
// This class will get any data from the $_POST or $_GET arrays, if set.
class Input {

		// A static function to check if the requested input exists within the $_POST or $_GET array.
		// Returns the name of the array it exists in, or false if it does not.
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

		// A static function to return the value of the requested $_POST or $_GET value. Returns
		// false if the value does not exist.
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