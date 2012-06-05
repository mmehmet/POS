<?php
$dd = getcwd()."/inventory";
$list = scandir($dd,1);
$i = 0;
$num = count($list);
print "<table class='t'><tr><td class='del' width='10'></td><td class='hd'>Description</td><td class='hd' align='center'>Cost</td><td class='hd'>Count</td><td class='hd' align='center'>Modified</td><td class='hd' align='center'>PO</td><td class='hd' colspan='2'></td></tr>";
while($i < $num){
	if($list[$i] != "." && $list[$i] != ".." && $list[$i] != "display.xsl") {
		$item	= $dd."/".$list[$i];
		$col = $i % 2;
		$frh = fopen($item,'r');
		$xmldata = fread($frh,filesize($item));
		fclose($frh);
		include 'details.php';
		print "<tr class='d".$col."'>";
		print "<td class='del' align='right'><a href=\"desure.php?item=$list[$i]\">X</a></td>";
		print "<td><b><a href=\"inventory/$list[$i]\">".$desc."</a></b></td>";
		print "<td align='right'>$".$cost."</td>";
		print "<td align='center'><b>".$cnt."</b></td>";
		$mod = date("Y-m-d H:i:s.", filemtime($item));
		print "<td><em>".substr($mod, 0, -1)."</em></td>";
		print "<td align='center'>".$po."</td>";
		print "<td class='butn'><a href=\"edit.php?fnam=$list[$i]\">EDIT</a></td>";
		if($bcd == "") {print "<td class='del'></td>";}
		else {print "<td align='center' class='del'><img src=\"barcode.png\" align='top' /></td>";}
		print "</tr>";
	}
	$i++;
}
print "</table>";
?>
