// all the various juicy bits that need to be handled clientside by javascript...

function toggle(area) {
	var visSetting = document.getElementById(area).style.visibility;
	if (visSetting == 'visible') {
		document.getElementById(area).style.visibility = 'hidden';
		if (area == 'docket')	{clnup();}
		}
	else {
		document.getElementById(area).style.visibility = 'visible';
		if (area == 'docket')	{document.transaction.scan0.focus();}
		}
}

function adit() {
	var i=0;
	var result=0;
	for (i=0;i<=5;i++)	{
		var p=eval(document.transaction.elements['price'+i].value);
		var q=eval(document.transaction.elements['qty'+i].value);
		subtot = (p*q);
		result = result + subtot;

		prce = new String(p);
		if(prce.indexOf('.') < 0) { prce += '.00'; }
		if(prce.indexOf('.') == (prce.length - 2)) { prce += '0'; }
		prce = '' + prce;
		document.transaction.elements['price'+i].value = prce;
		stt = new String(subtot);
		if(stt.indexOf('.') < 0) { stt += '.00'; }
		if(stt.indexOf('.') == (stt.length - 2)) { stt += '0'; }
		stt = '' + stt;
		document.transaction.elements['sub'+i].value = "$"+stt;
		res = new String(result);
		if(res.indexOf('.') < 0) { res += '.00'; }
		if(res.indexOf('.') == (res.length - 2)) { res += '0'; }
		res = '' + res;
		document.transaction.total.value = "$"+res;
	}
}

function computit() {
	if(document.transaction.tendered.value != '')	{
		var rq=eval(document.transaction.total.value.substr(1));
		var td=eval(document.transaction.tendered.value);
		cg = td-rq;
		tdrd = new String(td);
		if(tdrd.indexOf('.') < 0) { tdrd += '.00'; }
		if(tdrd.indexOf('.') == (tdrd.length - 2)) { tdrd += '0'; }
		tdrd = '' + tdrd;
		document.transaction.tendered.value = tdrd;
		chge = new String(cg);
		if(cg >= 0)	{
			if(chge.indexOf('.') < 0) { chge += '.00'; }
			if(chge.indexOf('.') == (chge.length - 2)) { chge += '0'; }
			chge = '' + chge;
			document.transaction.reqchange.value = chge;
			document.transaction.gg.focus();
		}
		else	{document.transaction.reqchange.value = '?!';}
	}
}

function dsct(i)	{
	var itnmbr=i.name.substr(-1);
	itcode=document.transaction.elements['scan'+itnmbr].value;
	checkprice(itcode,itnmbr);
}

function checkprice(code,nbr)	{
	var url="inventory/"+code+".xml";
	xmlmarkup=new XMLHttpRequest();
	xmlmarkup.open("GET",url,false);
	xmlmarkup.send();
	xmlbit=xmlmarkup.responseXML;
	origval=xmlbit.getElementsByTagName("price")[0].childNodes[0].nodeValue;
	if (document.transaction.elements['price'+nbr].value != origval)	{document.transaction.discount.value=1;}
	adit();
	document.transaction.tendered.focus();
}

function clnup()	{
	document.transaction.reset();
	var l=1;
	for (l=1;l<=5;l++)	{
	document.getElementById("item"+l).style.visibility = 'hidden';
	}
	document.getElementById('footr').style.top="140px";
	document.getElementById('docket').style.height="80px";
}	

function lookitup(invitem)	{
	loadXMLDoc(invitem);
}

function loadXMLDoc(itm)	{
	var url="inventory/"+itm.value+".xml";
	var itnum=itm.name.substr(-1);
	xmlhttp=new XMLHttpRequest();
	xmlhttp.open("GET",url,false);
	xmlhttp.send();
	xmlDoc=xmlhttp.responseXML;
	document.transaction.elements['desc'+itnum].value=xmlDoc.getElementsByTagName("description")[0].childNodes[0].nodeValue;
	document.transaction.elements['price'+itnum].value=xmlDoc.getElementsByTagName("price")[0].childNodes[0].nodeValue;
	document.transaction.elements['qty'+itnum].value=1;
	adit();
	document.transaction.elements['qty'+itnum].focus();
	document.transaction.elements['qty'+itnum].select();
}

function additm(inum)	{
	var el=(inum+1);
	elmtid = "item"+el;
	newh = 80+(60*el);
	newb = newh+60;
	document.getElementById(elmtid).style.visibility = 'visible';
	document.getElementById('footr').style.top=newb+"px";
	document.getElementById('docket').style.height=newh+"px";
	document.transaction.elements['scan'+el].focus();
}

