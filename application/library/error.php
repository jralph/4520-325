<?php

/**
 * The errors class is used to check if any errors have been activated and display them.
 * It also has a specific function to set an error to be displayed when the user next
 * loads the page.
 *
 * @author Joseph Ralph <jralph@arrowvaleacademy.co.uk>
 *
 */
class Error {

	/**
	 * Function check, checks if an error has been set.
	 *
	 * Using this class, errors are stored using _error_ as the prefix.
	 * This function will automatically use _error_ as a prefix for any
	 * requested names.
	 * eg. _error_login or _error_register or _error_general
	 *
	 * @param string $name The name of the error to be checked
	 * @param string $location The location (eg, in session or cookie). Default as session.
	 * @return boolean
	 */
	public static function check($name, $location = 'session')
	{
		switch($location){
			case 'session':
				if(isset($_SESSION['_error_'.$name])){
					return true;
				} else {
					return false;
				}
			break;

			case 'cookie':
				if(isset($_COOKIE['_error_'.$name])){
					return true;
				} else {
					return false;
				}
			break;

			default:
				return false;
			break;
		}
	}

	/**
	 * Function get, will get the requested error message.
	 *
	 * Best used after Error::check();
	 * Example:
	 * <code>
	 *	if( Error::check('general') ){
	 *		echo Error::get('general');
	 *  }
	 * </code>
	 *
	 * Will return the value if available or false if not. If a value is returned
	 * the value will then be unset from the session or cookie so that it is only
	 * used once.
	 *
	 *
	 * @param string $name The name of the error to be returned
	 * @param string $location The location (eg, in session or cookie). Default as session.
	 * @return string/boolean
	 */
	public static function get($name, $location = 'session')
	{
		switch($location){
			case 'session':
				$error = $_SESSION['_error_'.$name];
				unset($_SESSION['_error_'.$name]);
				return $error;
			break;

			case 'cookie':
				$error = $_COOKIE['_error_'.$name];
				unset($_COOKIE['_error_'.$name]);
				return $error;
			break;

			default:
				return false;
			break;
		}
	}

	/**
	 * Function to set a cookie or session as an error. Returns true if successful, false if not.
	 *
	 * @param string $name The name of the  error (excluding _error_).
	 * @param string $value The error message or value.
	 * @param string $location The location to store the error (session or cookie).
	 * @return boolean
	 */
	public static function set($name, $value, $location = 'session')
	{
		switch($location){
			case 'session':
				$_SESSION['_error_'.$name] = $value;
				return true;
			break;
			case 'cookie':
				setcookie('_error_'.$name, $value);
				return  true;
			break;
			default:
				return false;
			break;
		}
	}

}