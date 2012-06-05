<?php
include 'auth.php';
$staffid = $_SESSION['SESS_FIRST_NAME']." ".$_SESSION['SESS_LAST_NAME'];
$stf = $_SESSION['SESS_STAFF_ID'];
?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-AU" lang="en-AU">
<head>
	<link rel="stylesheet" type="text/css" href="main.css" />
</head>
<body>
<div class="ctl">
	<input type='button' onclick="javascript:window.location.href='inventory.php';" value='<' class='btn' />
	<input type='button' onclick="javascript:window.location.href='pos.php';" value='POS' class='btn' title="switch to Point Of Sale screen" />
	<input type='button' onclick="javascript:window.location.href='logout.php';" value='LOGOUT' class='btn' style="float:right" />
	<span class="login"><em>Currently logged in as <?php echo $staffid;?></em></span>
</div>
<p>OK let's delete this item</p>
<span id="sanity" style="margin-top:45px">
<div class="hed">ARE YOU SURE?</div>
<?php 
$thefile =	$_GET['item'];
print "<input type='button' onclick=\"javascript:window.location.href='delete.php?it=$thefile&id=$stf';\" value='YES' class='yo' title='".substr($thefile,0,-4)."' />";
print "<input type='button' onclick=\"javascript:window.location.href='inventory.php'\" value='NO' class='nup' />";
?>
</span>
</body>
</html>
