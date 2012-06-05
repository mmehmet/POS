<?php
	//Start session
$a = session_id();
if ($a == '') { session_start(); }
	//Log
$stf = $_SESSION['SESS_STAFF_ID'];
$filename =	getcwd()."/logs/st".$stf.".log";
$fh = fopen($filename,'a') or die("can't open file");
fwrite($fh,"logout-".date(DATE_RFC822)."\r");
fclose($fh);
	//Unset and destroy the session
session_unset(); //destroys variables
session_destroy(); //destroys session
	//Return to login screen
header("location: index.php");
?>
