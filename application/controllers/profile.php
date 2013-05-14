<?php

// Controller for user profile (http://host/profile)
class Profile_Controller extends Base_Controller {

	// Index function, display profile index page.
	public function action_index($values)
	{
		// Require user to be logged in to display any requests
		if(Authenticate::check()){

			// Initiate the profile index model.
			$indexModel = new ProfileIndex_Model;

			// User is logged in, display paga.
			View::create('profile.index');
		} else {
			// Not logged in, return to home page.
			header('Location: '.URL::to('home'));
		}
	}

}