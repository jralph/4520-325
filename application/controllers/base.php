<?php

/*
 * The base controller.
 *
 * This contriller is needed as a parent in ALL other controllers
 * for the framework to function correctly.
 *
 * The executeAction method is called to generate the controller
 * action that is requested.
 *
 */

class Base_Controller {

		/**
		 * The action of the controller to be used.
		 */
		private $action;

		/**
		 * The extra URL values passed in with the request.
		 */
		private $urlvalues;

		/**
		 * On construct the action and urlvalues variables are set.
		 */
		public function __construct($action, $urlvalues)
		{
				$this->urlvalues = $urlvalues;
				$this->action = $action;
		}

		/**
		 * The executeAction executes the requested controller and action
		 * and sets any extra values for it to use.
		 */
		public function ExecuteAction()
		{
				return $this->{$this->action}($this->urlvalues);
		}

}