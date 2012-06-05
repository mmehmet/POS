<div class='hed' style='font-size: 1.6em;'>NEW SALE<div id='clz'><input type='button' onclick='clnup();toggle("docket");' value='X' /></div></div>
<div class='inpt'>
<span class='lbl'>Code:</span>
<span style='float:left'><input type='text' name='scan0' onchange='lookitup(this);' /></span>
<span class='itm' style='width:120px;'>subtotal: <input readonly name='sub0' size='9' maxlength='9' style='text-align:right' /></span>
<span class='itm'>QTY: <input type='text' name='qty0' size='3' maxlength='3' value='0' onchange='adit();' /></span>
<span class='itm' style='width:150px;'>Price (ea): $<input type='text' name='price0' size='9' maxlength='9' value='0.00' onblur='dsct(this);' /></span>
</div><div class='inpt'>
<span class='lbl'>Product:</span>
<span style='float:left'><input readonly name='desc0' size='80' /></span>
<span style='float:right;margin-top:-6px;'><input type='button' name='moar0' onclick='additm(0);' value='+' class='btn' /></span></div>
<?php
for ($i=1; $i<=5; $i++)	{
	print"<span id='item$i'><div class='inpt'><span class='lbl'>Code:</span><span style='float:left'><input type='text' name='scan$i' onchange='lookitup(this);' /></span>";
	print"<span class='itm' style='width:120px;'>subtotal: <input readonly name='sub$i' size='9' maxlength='9' style='text-align:right' /></span>
";
	print"<span class='itm'>QTY: <input type='text' name='qty$i' size='3' maxlength='3' value='0' onchange='adit();' /></span><span class='itm' style='width:150px;'>Price (ea): $<input type='text' name='price$i' size='9' maxlength='9' value='0.00' onblur='dsct(this);' /></span>";
	print"</div><div class='inpt'><span class='lbl'>Product:</span><span style='float:left'><input readonly name='desc$i' size='80' /></span><span style='float:right;margin-top:-6px;'><input type='button' name='moar$i' onclick='additm($i);' value='+' class='btn' /></span></div></span>";
	}
?>
<div id='footr'>
<span style='margin-left:5px' class='lbl'>Total:</span>
<span style='float:left'><input readonly name='total' id='totsal' /></span>
<span style='float:right;margin-top:-6px;'><input type="button" name="gg" onclick="toggle('sanity');" value="KACHING!" class="btn" /></span>
<span style='float:right;margin-top:-6px;'><input type="button" onclick="clnup();" value="CLEAR" class="btn" /></span>
<span style='float:right'><label for='csh'><input type='radio' id='csh' value='cash' name='meth' checked onclick="document.getElementById('cshdt').style.visibility = 'visible';" />Cash</label>&nbsp;<label for="eft"><input type='radio' id='eft' value='electronic' name='meth' onclick="document.getElementById('cshdt').style.visibility = 'hidden';" />Card</label></span>
<span id='cshdt'>Cash Tendered: $<input type='text' name='tendered' size='9' maxlength='9' onblur='computit();' /> Change: $<input readonly name='reqchange' size='5' /></span>
</div>
<input type="hidden" name="staff" value="<?php echo $staffname;?>" />
<input type="hidden" name="stid" value="<?php echo $stfid;?>" />
