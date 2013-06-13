<?php

// Start of the HomeRegister_Model
class HomeRegister_Model extends Base_Model {

		// Create the initial function to handle use registration.
		// Will check if registration has been requested (by checking input) and register the user.
		public function register()
		{
				// Check if registration has been requested and required fields are set.
				if(Input::has('username') && Input::has('password') && Input::has('password_repeat')){

						// Set variables to the input values (to save running the function each time it is needed).
						// Also uses strip_tags to avoid any html input or scripts.
						$email = strip_tags(Input::get('username'));
						$password = strip_tags(Input::get('password'));
						$password_repeat = strip_tags(Input::get('password_repeat'));

						// Validate Password and Email
						if(Validate::email($email) && Validate::password($password, 6)){
							// Check if user exists already.
							if($this->check_for_user($email)){
								// Add user and return true or false for success and failure.
								return $this->add_user($email, $password);
							} else {
								Error::set('general', 'Email address already exists, please contact support to reset your account.');
								return false;
							}
						} else {
							Error::set('general', 'The password or email address entered is invalid, please try again.');
							return false;
						}
				}
		}

		// Function to check if the user already exists or not.
		public function check_for_user($username)
		{
			// Query the database for a matching username by counting the number of results.
			$user = DB::query('
						SELECT * FROM users
						WHERE username = :username
					')
					->params(array(
						':username' => $username
					))
					->count();

			// If the number of results is equal to or greater than 1, the user exists, so fail.
			// Else return true and the user does not exist and should be created.
			if($user > 1 || $user == 1){
				return false;
			} else {
				return true;
			}
		}

		// Function to add the user to the database.
		public function add_user($username, $password)
		{
			// Securely hash the users password for security.
			$password = Hash::make($password);

			// Add the user to the database.
			$user = DB::query('
						INSERT INTO users
						(username, password)
						VALUES
						(:username, :password)
					')
					->params(array(
						':username' => $username,
						':password' => $password
					))
					->execute();

			// Check again if the user exists, this time, if it does, the user has been created.
			// Return true if the user exists.
			if($this->check_for_user($username)){
				return false;
			} else {
				return true;
			}
		}

}