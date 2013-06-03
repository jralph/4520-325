<?php

// Initiate the controller and extend the base_controller()
class Home_Controller extends Base_Controller {

		// Create a class for the index action so that when the home page is requested, the index loads.
		public function action_index($values)
		{
				// Get any variables (if any) and organise into array. We will comment this out as it is not needed
				// for the home page, as we do not expect any variables to be passed to it through the url.
				// (eg. http://localhost/home/index/var1/var2)
				$indexModel = new HomeIndex_Model;
				/*
				$indexModel->setNames(array('name1'));
				$indexModel->setParams($values);
				$indexModel->checkParams();
				// Set variables to be retrieved (if any variables are set). (See Params Class Comments)
				$params = $indexModel->params;
				*/

				// Create the index view from within the home folder of the views directory.
				View::create('home.index');

		}

		// Create a class for the login action of the home controller. When home/login is requested, display the login page.
		public function action_login($values)
		{
				// Load the HomeLogin_Model. Created in the application->models directory.
				$loginModel = new HomeLogin_Model;

				// Logout user if currently logged in. This page will also be used as the logout page.
				Authenticate::logout();

				// Run login and check if success.
				if($loginModel->login() == true){

					//Display simple logged in message and exit the script.
					header('Location: '.URL::to('profile'));
					exit;
				} elseif($loginModel->login_requested == true) {

					// Set error.
					Error::set('general', 'Unable To Login, Please Check Username or Password and Try Again.');
				}

				// Create the login view.
				View::create('home.login');
		}

		public function action_register($values)
		{
				// Load the HomeRegister_Model. Created in the applications->models directory.
				$registerModel = new HomeRegister_Model;

				// Make sure all current users are logged out.
				Authenticate::logout();

				// Register User if requested.
				if($registerModel->register() == true){

					// Display simple registered message and exit.
					echo 'registered';
					exit;
				}

				// Create the register view.
				View::create('home.register');
		}

}