<?php

/**
 * Class: Autoload
 * Description: The autoload class is used to autoload functions and classes.
 * 				this autoload class is only setup to only to autoload controllers
 *				and is used when the loader.php page recieves a request for a controller.
 *
 * @author Joseph Ralph <jralph@arrowvaleacademy.co.uk>
 *
 * Usage:
 * 	<code>
 * 		Autoload::Controller(controller_name);
 * 	</code>
 */
class Autoload {

		/**
		 * Load the requested controller if it exists and return true
		 * else return false.
		 *
		 * @param string $name The name of the requested controller.
		 * @return boolean Indicates if the action was a success or not.
		 */
		public static function Controller($name)
		{
				// Convert the requested controller name to lowercase.
				$name = strtolower($name);

				// Check if the file exists, if so, include it and return true.
				// Else return false.
				if( file_exists(path('app').DS.'controllers'.DS.$name.'.php') )
				{
						require path('app').DS.'controllers'.DS.$name.'.php';

						return true;
				}
					else
				{
						return false;
				}

		}

}