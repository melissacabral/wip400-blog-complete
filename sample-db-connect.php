<?php
/*
Database connection credentials
this represents the whole site connecting to the database on the server. It is different from the users table in your db that reference the people logging into your site.
 */
//host //username //password //database name
$db = new mysqli('localhost', 'trish', '9E8ym8rH488XWt4t', 'demo_blog');

//handle any errors by stopping the page
if( $db->connect_errno > 0 ){
die('Unable to connect to Database');
}

//define constants - pieces of data that will not change
//use in links and src attributes
define('SITE_URL', 'http://PUT-YOUR-URL-HERE/' );

//use in includes
define('SITE_PATH', 'C:/PUT/YOUR/PATH/HERE/');

//control error reporting
error_reporting(E_ALL & ~E_NOTICE);

//load our custom functions
include_once(SITE_PATH.'includes/functions.php');

//no close php












