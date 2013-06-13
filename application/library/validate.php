<?php

/**
 * A simple validation class to check inputs.
 *
 * @author Joseph Ralph <jralph@arrowvaleacademy.co.uk>
 */
class Validate {

		/**
		 * Easily expandable email checking function.
		 * Will check the input email to see if it contains the @ symbol.
		 *
		 * @param string $email The email address to validate.
		 * @return boolean Will return true if the email is valid, false if invalid.
		 */
		public static function email($email)
		{
				// Check if $email is blank, if so, return false.
				if($email != '' && $email != ' '){
					// Check if email contains @, if so, return true.
					if(strstr($email, '@')){
						return true;
					} else {
						return false;
					}
				} else {
					return false;
				}
		}

		/**
		 * A simple expandable password checking function.
		 * Will check a given password and length and return true or false.
		 *
		 * @param string $password The password to be checked.
		 * @param int $length Optional length of the password, default is 1.
		 * @return boolean Will return true if the password is valid, false if not.
		 */
		public static function password($password, $length = 1)
		{
				// Check the password is not blank, if so, return false.
				if($password != ''){
					// If password is too small, return false.
					if(strlen($password) < $length){
						return false;
					} else {
						if(strlen($password) < 50){
							return true;
						} else {
							return false;
						}
					}
				} else {
					return false;
				}
		}

}