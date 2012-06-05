<?xml version='1.0'?>
<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version='1.0'>
<xsl:output method="html" />
<xsl:param  name="rcol"/>
<xsl:template match="receipt">
<xsl:for-each select="item[position() = 1]">
    <tr><xsl:attribute  name="class">d<xsl:value-of select="$rcol" /></xsl:attribute>
	<td rowspan="{count(//item)}"><b><xsl:value-of select="../rcpt_num"/></b></td>
	<td><b><xsl:value-of select="description" /></b></td>
	<td align="center"><xsl:value-of select="qty" /></td>
	<td align="right"><xsl:value-of select="format-number(price,'$#,##0.00')" /></td>
	<td align="right" rowspan="{count(//item)}"><b><xsl:value-of select="format-number(../total,'$#,##0.00')" /></b></td>
	<td rowspan="{count(//item)}"><xsl:value-of select="../operator" /></td>
	<td rowspan="{count(//item)}"><a href="sales/{../rcpt_num}.xml"><xsl:value-of select="../date" /> - <xsl:value-of select="../time" /></a></td></tr>
</xsl:for-each>
<xsl:for-each select="item[position() > 1]">
    <tr><xsl:attribute  name="class">d<xsl:value-of select="$rcol" /></xsl:attribute>
	<td><b><xsl:value-of select="description" /></b></td>
	<td align="center"><xsl:value-of select="qty" /></td>
	<td align="right"><xsl:value-of select="format-number(price,'$#,##0.00')" /></td></tr>
</xsl:for-each>
</xsl:template>
</xsl:stylesheet>
