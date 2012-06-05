<?xml version="1.0" encoding="ISO-8859-1"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
<xsl:template match="stock_item">
<html>
<head>
	<link rel="stylesheet" type="text/css" href="../main.css" title="Style" />
	<link href="../favicon.ico" rel="icon" type="image/x-icon" />
</head>
<body onload="document.getElementById('clzbtn').focus();">
<div class="ctl">
	<input type='button' onclick="javascript:window.location.href='../pos.php';" value='POS' class='btn' title="switch to Point Of Sale screen" />
	<input type='button' onclick="javascript:window.location.href='../inventory.php';" value='INVENTORY' class='btn' title="back to inventory management" />
	<input type='button' onclick="javascript:window.location.href='../logout.php';" value='LOGOUT' class='btn' style="float:right" />
</div>
<span id="invform" style="margin-top:25px;text-align:left;">
<div class='hed' style='font-size:1.6em'>INVENTORY ITEM<input type="button" style="float:right" id="clzbtn" onclick="javascript:window.location.href='../inventory.php';" value="X" title="go back to the inventory list" /></div>
<div class="mainttl" style="margin-top:15px">
	<xsl:if test="string(barcode)">
		<span style="width:120px;float:left;">BARCODE: </span>
		<span class="box" style="float:left;margin-top:-5px;"><xsl:value-of select="barcode" /></span>
	</xsl:if>
	<div style="float:right">COUNT:
		<span class="box"><xsl:value-of select="count" /></span>
	</div>
	<xsl:if test="string(po)">
		<span class="box" style="margin-right:10px;float:right;margin-top:-5px;"><xsl:value-of select="po" /></span>
		<span style="margin-right:10px;float:right;">Purchase Order: </span>
	</xsl:if>
</div>
<div class="mainttl" style="margin-top:30px">
	<span style="width:120px;float:left;">Product Description: </span>
	<span class="box" style="width:575px;float:left;margin-top:-7px;"><xsl:value-of select="description" /></span>
</div>
<div class="mainttl" style="margin-top:30px">
	<span style="width:120px;float:left;">Cost Price: </span>
	<span class="box" style="float:left;margin-top:-5px;">$<xsl:value-of select="cost" /></span>
	<div style="float:right;">Sell Price: 
		<span class="box">$<xsl:value-of select="price" /></span>
	</div>
</div>
<div style="padding:5px;margin-top:30px;"><em>Entered into inventory by: <xsl:value-of select="staff" /></em></div>
</span>
</body>
</html>
</xsl:template>
</xsl:stylesheet>
