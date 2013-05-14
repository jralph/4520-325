<?php

// The files controller for http://host/files
class Files_Controller extends Base_Controller {

	// Index action, displays the defaults for the /files.
	public function action_index($values)
	{
		// Check if user is logged in or not.
		if(Authenticate::check()){

			// Initiate files index model.
			$indexModel = new FilesIndex_Model;

			// If user is logged in, display files index page.
			View::create('files.index');

		} else {
			// No user logged in, go to home page.
			header('Location: '.URL::to('home'));
		}
	}

	// View Action, displays the view files page for the user to view
	// edit and delete any files they have uploaded.
	public function action_view($values)
	{
		// Check if user is logged in or not.
		if(Authenticate::check()){

			// Initiate files view model.
			$viewModel = new FilesView_Model;

			// If user is logged in, display view page.
			View::create('files.view');

		} else {
			// No user is logged in, return to home page.
			header('Location: '.URL::to('home'));
		}
	}

	// The upload files URL action. For the upload files form.
	public function action_upload($values)
	{
		// Check if user is logged in or not.
		if(Authenticate::check()){

			// Initiate files upload model.
			$uploadModel = new FilesUpload_Model;

			if($uploadModel->upload() == true){
				// Return to files view page.
				header('Location: '.URL::to('files@view'));
			}

		} else {
			// No User is Logged In. Return Home.
			header('Location: '.URL::to('home'));
		}
	}

}