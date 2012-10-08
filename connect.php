<?php

// MySQL database details
require_once('tpac.php');

// Connect to MySQL server
$link = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);
if(!$link) {
    die('Failed to connect to server: ' . mysql_error());
}

// Select database
$db = mysql_select_db(DB_DATABASE);
if(!$db) {
    die("Unable to select database");
}

// Function to sanitize form values - prevents SQL injection
function clean($str) {
	$str = @trim($str);
	if(get_magic_quotes_gpc()) {
		$str = stripslashes($str);
	}
	$str = str_replace("http://","",$str);
	$str = rtrim($str, "/");
	return mysql_real_escape_string($str);
}
