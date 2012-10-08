<?php
// start session
session_start();

if (empty($_SESSION['count'])) {
	$_SESSION['count'] = 1;
} else {
	$_SESSION['count']++;
}
	
// connect to database and load up usre account functions
require_once('acct.php');
$errflag = false;

function errmsg() {
	$errflag = true;
	$_SESSION['ERRMSG'] = 1;
	// just wait a few seconds to fuck with brute force attacks
	// sleep(5);
	session_write_close();
	header("location:index.php");
	return;
}

// sanitize and process the form values
$login = clean($_POST['login']);
$password = clean($_POST['password']);
if($login == '' || $password == '') {
	return errmsg();
}
	
// create query
$checkUsers=mysql_query("SELECT * FROM pos_users WHERE user_login='$login'");
	
// check whether the query was successful or not
if(mysql_num_rows($checkUsers) == 1) {
	session_regenerate_id();
	$staff = mysql_fetch_assoc($checkUsers);
	$dbpass = $staff['user_password'];
	if(comparePassword($password, $dbpass)) {
		// SUCCESS!
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
	} else {
		return errmsg();
	}
} else {
	return errmsg();
}
