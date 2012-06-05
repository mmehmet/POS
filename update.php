<?php
$bc =		$_POST['bcode'];
$fnm =	$_POST['nocode'];
$d =		$_POST['dsc'];
$c =		$_POST['count'];
$po =		$_POST['po'];
$cp =		$_POST['cst'];
$sp =		$_POST['prc'];
$st =		$_POST['staff'];
$id =		$_POST['stid'];
$acdo =	$_POST['dfdo'];

$filename =	getcwd()."/inventory/".$bc.".xml";

if ($acdo=="add")	{
	if ($bc=='')	{
		$filename =	getcwd()."/inventory/nocode-1.xml";
		$nc=1;
		while (file_exists(getcwd()."/inventory/nocode-".$nc.".xml")) {
			$nc++;
			$filename = getcwd()."/inventory/nocode-".$nc.".xml";
		}
	}
	if (file_exists($filename))	{
		die("<p><b><font color='red'>WARNING</font></b> - item already exists in inventory!</p><a href='edit.php?fnam=$bc.xml'>CLICK HERE</a> to update details of the existing record");
	}
}

if ($acdo=="edt")	{
	if ($bc=='')	{$filename = getcwd()."/inventory/".$fnm;}
	elseif (substr($fnm, 0, 6)=="nocode")	{
		unlink(getcwd()."/inventory/".$fnm);
		$lgfh = fopen(getcwd()."/logs/st".$id.".log",'a') or die("can't open file");
		fwrite($lgfh,"invdel-".date(DATE_RFC822)."\r");
		fclose($lgfh);
	}
}

$logfile =	getcwd()."/logs/st".$id.".log";
$lfh = fopen($logfile,'a') or die("can't open file");
fwrite($lfh,"inv".$acdo."-".date(DATE_RFC822)."\r");
fclose($lfh);

$head = <<<HEADER
<?xml version="1.0" encoding="UTF-8"?>
<?xml-stylesheet type="text/xsl" href="display.xsl" ?>
<stock_item>
HEADER;

$fh = fopen($filename,'w') or die("can't open file");
fwrite($fh,$head);
fwrite($fh,"\r\t<barcode>".$bc."</barcode>\r");
fwrite($fh,"\t<description>".$d."</description>\r");
fwrite($fh,"\t<count>".$c."</count>\r");
fwrite($fh,"\t<po>".$po."</po>\r");
fwrite($fh,"\t<cost>".$cp."</cost>\r");
fwrite($fh,"\t<price>".$sp."</price>\r");
fwrite($fh,"\t<staff>".$st."</staff>\r");
fwrite($fh,"</stock_item>\r");
fclose($fh);
header("location:inventory.php");
?>
