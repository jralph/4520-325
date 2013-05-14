<?php

// A simple validation class to check form inputs.
class Validate {

		// Check email to make sure it contains the @ symbol.
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

		// Check password to make sure it reaches the min length provided.
		public static function password($password, $length)
		{
				// Check the password is not blank, if so, return false.
				if($password != ''){
					// If password is too small, return false.
					if(strlen($password) < $length){
						return false;
					} else {
						return true;
					}
				} else {
					return false;
				}
		}

}