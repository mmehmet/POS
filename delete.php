<?php
$target = $_GET['it'];
$dfile = getcwd()."/inventory/".$target;
unlink($dfile);
$stf = $_GET['id'];
$filename =	getcwd()."/logs/st".$stf.".log";
$fh = fopen($filename,'a') or die("can't open file");
fwrite($fh,"invdel-".date(DATE_RFC822)."\r");
fclose($fh);
header("location:inventory.php");
?>
