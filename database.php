<?

/**
 * Connect to the mysql database.
 */
$conn = mysql_connect("localhost", "username", "password") or die(mysql_error());
mysql_select_db('staff', $conn) or die(mysql_error());

?>
