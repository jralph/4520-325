<?php

// Initiate the controller and extend the base_controller()
class Home_Controller extends Base_Controller {

		// Create a class for the index action so that when the home page is requested, the index loads.
		public function action_index($values)
		{
				// Get any variables (if any) and organise into array.
				// (eg. http://localhost/home/index/var1/var2)
				$indexModel = new HomeIndex_Model;
				$indexModel->setNames(array('name1'));
				$indexModel->setParams($values);
				$indexModel->checkParams();
				// Set variables to be retrieved (if any variables are set). (See Params Class Comments)
				$params = $indexModel->params;

				// Create the index view from within the home folder of the views directory.
				View::create('home.index');

		}

}