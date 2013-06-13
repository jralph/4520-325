<?php

/**
 * A simple logout controller.
 *
 * When a user navigates to the /logout URL the Authenticate::logout()
 * method is run, removing any session information and logging the user
 * out of the system.
 */
class Logout_Controller extends Base_Controller {

		public function action_index($values)
		{
				Authenticate::logout();
		}

}