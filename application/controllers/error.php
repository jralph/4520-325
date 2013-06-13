<?php

/**
 * Error_Controller
 *
 * This controller sets an error mesage which runs if an
 * invalid request is made to the URL.
 * For example, if the controller "home" does not exist,
 * navigating to localhost/home will throw an error using
 * this error controller.
 *
 */
class Error_Controller extends Base_Controller {

		private $error;

		public function __construct($error)
		{
				$this->error = $error;
		}

		public function ExecuteAction()
		{
			echo 'ERROR: '.$this->error;
		}

}