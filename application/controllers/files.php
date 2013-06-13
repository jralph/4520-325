<?php

/**
 * Files_Controller
 *
 * This controller manages any actions between the user and
 * any files they have stored.
 *
 * It includes actions to view files, statistics, upload files
 * delete files and wipe the users storage space.
 *
 */
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

			// If upload is true.
			if($uploadModel->upload() == true){
				// Return to files view page.
				header('Location: '.URL::to('files@view'));
			}

		} else {
			// No User is Logged In. Return Home.
			header('Location: '.URL::to('home'));
		}
	}

	// Action to delete files. Returns to view page when done.
	public function action_delete($values)
	{
		// Check to make sure a user is logged in.
		if(Authenticate::check()){

			// Initiate Files Delete Model.
			$deleteModel = new FilesDelete_Model;

			$deleteModel->setNames(array('file_id'));
			$deleteModel->setParams($values);
			$deleteModel->checkParams();

			$params = $deleteModel->params;

			if($deleteModel->delete($params->file_id) == true){
				// Return to files view page.
				header('Location: '.URL::to('files@view'));
			}

		} else {
			// No User Is Logged In. Return To Home.
			header('Location: '.URL::to('home'));
		}
	}

	// Function to wipe the users storage space and delete all files.
	public function action_wipe($values)
	{
		// Check to make sure a user is logged in.
		if(Authenticate::check()){

			// Initiate Files Wipe Model.
			$wipeModel = new FilesWipe_Model;

			// Deelte Files
			if($wipeModel->wipe() == true){
				// Return to files view page.
				header('Location: '.URL::to('files@view'));
			}
		}
	}

}