<?php
$dd = getcwd()."/sales";
$xslfile = $dd."/index.xsl";
$list = scandir($dd,1);
$i = 0;
$num = count($list);
print "<table class='t'><tr><td class='hd'>Rcpt</td><td class='hd'>Item</td><td class='hd' align='center'>Qty</td><td class='hd' align='center'>Unit Price</td><td class='hd' align='center'>Total (inc)</td><td class='hd' align='center'>Operator</td><td class='hd'></td></tr>";
while($i < $num){
	if($list[$i] != "." && $list[$i] != ".." && $list[$i] != "display.xsl" && $list[$i] != "index.xsl") {
		$item	= $dd."/".$list[$i];
		$col = $i % 2;
		$frh = fopen($item,'r');
		$xmldata = fread($frh,filesize($item));
		fclose($frh);
		$mod = date("Y-m-d H:i:s.", filemtime($item));
		$xslt = new xsltProcessor;
		$xslt->importStyleSheet(DomDocument::load($xslfile));
		$xslt->setParameter( '', 'rcol', $col );
		print $xslt->transformToXML(DomDocument::loadXML($xmldata));
		print "</tr>";
	}
	$i++;
}
print "</table>";
?>
