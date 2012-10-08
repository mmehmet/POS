<?php

// Include database connection details
require_once('connect.php');

// returns true if the username has already been taken
function usernameTaken($id) {
	$unmqry = "SELECT * FROM pos_users WHERE user_login = '$id'";
	$unmresult = mysql_query($unmqry);
	return (mysql_num_rows($unmresult) > 0);
}

// function to insert the provided details into the database and return true on success...
function addNewUser($regname, $regpassword){
	$addq = "INSERT INTO pos_users VALUES ('$regname', '$regpassword')";
	return mysql_query($addq);
}

// get a new salt - 8 hexadecimal characters long
function getPasswordSalt() {
    return substr(str_pad(dechex(mt_rand()), 8, '0', STR_PAD_LEFT), -8);
}

// calculate the hash from a salt and a password
function getPasswordHash($salt, $password) {
    return $salt.(hash('whirlpool', $salt.$password));
}

// compare a password to a hash
function comparePassword($password, $hash) {
    $salt = substr($hash, 0, 8);
    return $hash == getPasswordHash($salt, $password);
}

// generate a random password
function createNewPassword() {
	$chars = "abcdefghijkmnopqrstuvwxyzABCDEFGHJKLMNPQRTUVWXYZ023456789";
    srand((double)microtime()*1000000);
	$i = 0;
	$pass = '' ;
	$validpwd = false;
	while (!$validpwd) {
		while ($i <= 7) {
			$num = rand() % strlen($chars);
			$tmp = substr($chars, $num, 1);
			$pass = $pass . $tmp;
			$i++;
		}
		if (preg_match('/\d/', $pass) && preg_match('/[A-Z]/', $pass) && preg_match('/[a-z]/', $pass)) {
			$validpwd = true;
		} else {
			$i = 0;
			$pass = '' ;
		}
	}
	return $pass;
}

