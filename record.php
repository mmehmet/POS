<?php
foreach ($_POST as $key => $val) {
	$v[] = "$val";
}
$oper = $v[35];
$id = $v[36];
$mthd = $v[32];
$slno = 1;
$fnm = date("Ymd").str_pad($slno, 2, '0', STR_PAD_LEFT).".xml";
$filename = getcwd()."/sales/".$fnm;
while (file_exists($filename)) {
	$slno++;
	$fnm = date("Ymd").str_pad($slno, 2, '0', STR_PAD_LEFT).".xml";
	$filename = getcwd()."/sales/".$fnm;
}
$rcpt = substr($fnm, 0, -4);
$tot = substr($v[31],1);
$dt = date("d-m-Y");
$tm = date("h:ia");
$logfile =	getcwd()."/logs/st".$id.".log";
$lfh = fopen($logfile,'a') or die("can't open file");
fwrite($lfh,"nwsale-".date(DATE_RFC822)."\r");
fclose($lfh);
$head = <<<HEADER
<?xml version="1.0" encoding="UTF-8"?>
<?xml-stylesheet type="text/xsl" href="display.xsl" ?>
<receipt>
HEADER;
$fh = fopen($filename,'w') or die("can't open file");
fwrite($fh,$head);
fwrite($fh,"\r\t<operator>".$oper."</operator>\r");
fwrite($fh,"\t<rcpt_num>".$rcpt."</rcpt_num>\r");
$bc=1;
for ($i=0; $i<=5; $i++)	{
	if ($v[$bc+2] != 0)	{
		fwrite($fh,"\t<item>\r");
		fwrite($fh,"\t\t<barcode>".$v[$bc]."</barcode>\r");
		fwrite($fh,"\t\t<description>".$v[$bc+4]."</description>\r");
		fwrite($fh,"\t\t<qty>".$v[$bc+2]."</qty>\r");
		fwrite($fh,"\t\t<price>".$v[$bc+3]."</price>\r");
		fwrite($fh,"\t\t<subt>".substr($v[$bc+1],1)."</subt>\r");
		fwrite($fh,"\t</item>\r");
	}
	$bc=$bc+5;
}
fwrite($fh,"\t<total>".$tot."</total>\r");
$gsval = $tot/10;
$gst = sprintf("%01.2f", $gsval);
fwrite($fh,"\t<gst>$gst</gst>\r");
fwrite($fh,"\t<date>".$dt."</date>\r");
fwrite($fh,"\t<time>".$tm."</time>\r");
fwrite($fh,"\t<discount>".$v[0]."</discount>\r");
fwrite($fh,"\t<method>".$mthd."</method>\r");
if ($mthd == "cash")	{
	fwrite($fh,"\t<tendered>".$v[33]."</tendered>\r");
	fwrite($fh,"\t<change_given>".$v[34]."</change_given>\r");
}
fwrite($fh,"</receipt>");
fclose($fh);
header("location:pos.php");
?>
