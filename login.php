<?php
	//Start session
session_start();

if (empty($_SESSION['count'])) {
 $_SESSION['count'] = 1;
} else {
 $_SESSION['count']++;
}
	
	//Include database connection details
require_once('tpac.php');
	
	//Array to store validation errors
$errmsg_arr = array();
	
	//Validation error flag
$errflag = false;
	
	//Connect to mysql server
$link = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);
if(!$link) {
	die('Failed to connect to server: ' . mysql_error());
}
	
	//Select database
$db = mysql_select_db(DB_DATABASE);
if(!$db) {
	die("Unable to select database");
}
	
	//Function to sanitize values received from the form. Prevents SQL injection
function clean($str) {
	$str = @trim($str);
	if(get_magic_quotes_gpc()) {
		$str = stripslashes($str);
	}
	return mysql_real_escape_string($str);
}
	
	//Sanitize the POST values
$login = clean($_POST['login']);
$password = clean($_POST['password']);

	//Input Validations
if($login == '') {
	$errmsg_arr[] = 'Login ID missing';
	$errflag = true;
}
if($password == '') {
	$errmsg_arr[] = 'Password missing';
	$errflag = true;
}
	
	//If there are invalidations, redirect back to the login form
if($errflag) {
	$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
	session_write_close();
	header("location: index.php");
	exit();
}
	
	//Create query
$qry="SELECT * FROM pos_users WHERE user_login='$login' AND user_password='".md5($_POST['password'])."'";
$result=mysql_query($qry);
	
	//Check whether the query was successful or not
if($result) {
	if(mysql_num_rows($result) == 1) {
		//Login Successful
		session_regenerate_id();
		$staff = mysql_fetch_assoc($result);
		$staffid = $staff['user_num'];
		$_SESSION['SESS_SID'] = session_id();
		$_SESSION['SESS_STAFF_ID'] = $staffid;
		$_SESSION['SESS_STAFF_NAME'] = $staff['user_name'];
        $_SESSION['SESS_GROUP'] = $staff['user_access'];
		$_SESSION['SESS_LAST_ACCESS'] = $staff['user_lastaccess'];
		$_SESSION['SESS_LAST_UA'] = $_SERVER['HTTP_USER_AGENT'];
		$_SESSION['SESS_LAST_IP'] = ip2long($_SERVER['REMOTE_ADDR']);
		session_write_close();
		$accesslog = "UPDATE pos_users SET user_lastaccess='".date(DATE_RFC822)."' WHERE user_num=$staffid";
		mysql_query($accesslog);
		$filename =	getcwd()."/logs/st".$staffid.".log";
		$fh = fopen($filename,'a') or die("can't open file");
		fwrite($fh,"login-".date(DATE_RFC822)."\r");
		fclose($fh);
		if($staff['user_access'] == "back") {
			header("location: inventory.php");
		} else {
			header("location: pos.php");
		}
		exit();
	}else {
		//Login failed
		header("location: index.php");
		exit();
	}
}else {
	die("Query failed");
}
?>
