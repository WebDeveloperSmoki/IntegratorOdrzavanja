<?php
//contains db configuration information
$db_server = "localhost"; //localhost is ok for most applications
$db_name = "dbname"; //your database name
$db_user = "dbuser"; //your database username
$db_pass = "sbpass"; //your database password

//No need to change anything below this line
//This file also takes care of the connection to the db:
$link = mysql_connect("$db_server", "$db_user", "$db_pass");

if (!$link) die('Could not connect: ' . mysql_error() . 'Stopping API exec!');

@mysql_select_db($db_name) or die( "Unable to select database. Stopping API exec!");

?>
