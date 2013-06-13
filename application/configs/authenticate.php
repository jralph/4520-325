<?php

/**
 * Configuration file for the authenticate object.
 *
 * Settings include the key to use to generate the hashed password.
 * The name of the table that the users information can be found in.
 * The field that the username can be found in and the field that the password
 * can be found in.
 *
 * Required Values:
 *		key
 *		table
 *		username_field
 *		password_field
 *
 * <code>
 *      //Access config file data
 *      $configs = Config::get('authenticate', 'location_of_this_file');
 *
 *      //Read values once set, returns data from the below array.
 *      $configs->table
 *
 * </code>
 *
 * WARNING: Updating the key when the site is live with registered users will
 * cause all users to be unable to login. This is because the hash checking
 * will not be able to match the password to the new key.
 *
 */

return array(
	'key' => 'g/tP78GnLd56dY8z',
	'table' => 'users',
	'username_field' => 'username',
	'password_field' => 'password'
);