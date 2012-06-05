<?xml version='1.0'?>
<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version='1.0'>
<xsl:output method="html" />
<xsl:template match="receipt">
<html>
<head>
	<link rel="stylesheet" type="text/css" href="../main.css" title="Style" />
	<link href="../favicon.ico" rel="icon" type="image/x-icon" />
</head>
<body onload="document.getElementById('clzbtn').focus();">
<div class="ctl">
	<input type='button' onclick="javascript:window.location.href='../pos.php';" value='POS' class='btn' title="back to Point Of Sale screen" />
	<input type='button' onclick="javascript:window.location.href='../inventory.php';" value='INVENTORY' class='btn' title="switch to inventory management" />
	<input type='button' onclick="javascript:window.location.href='../logout.php';" value='LOGOUT' class='btn' style="float:right" />
</div>
<span id="salesrec" style="margin-top:25px;text-align:left;">
<div class='hed' style='font-size:1.6em'>CW FOOTSCRAY - RECORD OF SALE<input type="button" style="float:right" id="clzbtn" onclick="javascript:window.location.href='../pos.php';" value="X" title="back to the Point Of Sale screen" /></div>
SOME BLA BLA DETAILS ABOUT THE ADDRESS AND ABN TO GO HERE
<hr />
<div class="mainttl">QTY
		<span style="margin-left:5px">Description</span>
	<span class="itm" style="margin-right:-5px;">Subtotal</span>
	<span class="itm">Unit Price</span>
</div>
<xsl:for-each select="item">
	<div style="padding:5px;"><xsl:value-of select="qty" />x
		<span style="margin-left:15px">(<xsl:value-of select="barcode" />) - <xsl:value-of select="description" /></span>
		<span class="itm" style="margin-right:-5px;"><xsl:value-of select="format-number(subt,'$#,##0.00')" /></span>
		<span class="itm"><xsl:value-of select="format-number(price,'$#,##0.00')" /></span>
	</div>
</xsl:for-each>
<hr />
<div class="ttl"><b>Total: </b> <xsl:value-of select="format-number(total,'$#,##0.00')" /><xsl:if test="discount  != '0'"> (NOT SOLD AT MARKED PRICE)</xsl:if></div>
<div class="mainttl">Transaction Reference:
	<span class="inpt"><xsl:value-of select="rcpt_num" /></span>
</div>
<div class="ttl"><b>Includes GST of: </b> <xsl:value-of select="format-number(gst,'$#,##0.00')" /></div>
<div class="mainttl">Served By:
	<span class="inpt"><xsl:value-of select="operator" /></span>
</div>
<div style="float:left;padding:5px;"><em><xsl:value-of select="date" /> at <xsl:value-of select="time" /></em></div>
<xsl:if test="method  = 'cash'">
	<div class="ttl"><b>Change: </b> <xsl:value-of select="format-number(change_given,'$#,##0.00')" /></div>
	<div class="ttl"><b>CASH: </b> <xsl:value-of select="format-number(tendered,'$#,##0.00')" /></div>
</xsl:if>
</span>
</body>
</html>
</xsl:template>
</xsl:stylesheet>
