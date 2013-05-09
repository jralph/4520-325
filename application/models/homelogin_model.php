<?php

class HomeLogin_Model extends Base_Model {

		public function login()
		{
				// Check if input for username and password are set, if so, begin login procedure.
				if(Input::has('username') && Input::has('password')){

						// Make sure that the entered email is actually an email address.
						if(Validate::email(Input::get('username'))){

								// Get the email and password from the input and set appropriate variables.
								$email = Input::get('username');
								$password = Input::get('password');

								// Run the login and check if it is a success, if so, return true, else return false.
								if(Authenticate::login($email, $password)){
									return true;
								} else {
									return false;
								}

						} else {
							return false;
						}

				} else {
					return false;
				}
		}

}