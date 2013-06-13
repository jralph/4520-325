<?php

/**
 * The configuration for the database connection.
 *
 * Required values to be set are:
 *      driver
 *      host
 *      database
 *      username
 *      password
 *
 * Any optional values may be set after the above.
 * Values can be accessed from the config object.
 * <code>
 *      //Access config file data
 *      $configs = Config::get('database', 'location_of_this_file');
 *
 *      //Read values once set, returns data from the below array.
 *      $configs->driver
 *
 * </code>
 *
 */
return array(
    'driver'    => 'mysql',
    'host'      => '127.0.0.1',
    'database'  => 'test',
    'username'  => 'root',
    'password'  => '',
);
