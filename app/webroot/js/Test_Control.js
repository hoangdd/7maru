var len = questions.length;
var cd = 0;
var c1 = 0;
var c2 = 0;
var c3 = 0;
var ctot;
var tt = 0, t_attempt = 0, xyz = "", abc, wtime, best_glob = "";
var arr1 = new Array();
var arr = new Array(0);
var hid;
var btime;
var flgques = 0;
var difficu;
// define this in gentest
var markedques = new Array();
var testmode = 'o';
var questiondiv = '';
var sec = new Array();
var sectime = new Array();
sectime[0] = sectime[1] = sectime[2] = 0;
var secid;
var flagQco = 0;
var len;
var tmVl;
var omrVar = '';
var omrSno = 1;
var omrsecC = 0;
var autoSave;
var mr = "", secCount = 1, multiMyshow = 1;
var setwidthfix = 100 / questions.length;
// arr[0]=0;
// alert(arr);

var i, k, h, j;
var r = 1;
var first = new Array("/", ".", "0", "1", "2", "3", "4", "5", "6", "7", "8",
		"9");
var divtoshow = "";

function doSection(sec1) {
}
function hideAnsSheet() {
	document.getElementById('dockcontent01').style.display = 'none';
}
function showAnsSheet() {
	document.getElementById('dockcontent01').style.display = 'block';
}

function writefn(otpt) {

	questiondiv += otpt;

}

function doQuestion(quest, ss) {
	var numdo, cc = 0;
	var numord = eval(quest + 1);
	var i = -1, ii, type, myname, gadget;
	type = questions[quest].type;
	numdo = type >= 3 ? 1 : questions[quest].response.length;

	if (opera && top == 0)
		top = document.getElementById("wq_user").style.top;

	writefn("\n")
	writefn("<div id=\"q")
	writefn(numord)
	writefn("\" ")
	writefn(opera ? " style=\"position: absolute; visibility:hidden; top:"
			+ top + "; z-index:" + (++zin) + ";\"" : " style=\"display:none\"");
	writefn(">")
	writefn("<table width='100%' border='0' cellspacing='0' cellpadding='0' style='border: 1px solid rgb(219, 219, 219); '>"
			+ "<tr class='tst_eng_inr_bg'>"
			+ "<td height='35' colspan='3' align='left' valign='middle' style='padding-left:10px;'><img src='/7maru/app/webroot/anything/test_head_icon.png' alt='icon' align='absmiddle' height='25' width='25' /> <span class='profile_info_text'>Question</span></td>"
			+ "</tr>");
	numb = quest + 1;
	writefn("<tr bgcolor='#f2eee2' height='25'>"
			+ "<td valign='top' align='left' height='24' width='10'></td>"
			+ "<td valign='middle' align='left' width='300'><strong>Question "
			+ numb + " of " + qno + "<span id='Fques" + quest
			+ "'></span></strong></td>" + "</tr>");

	writefn("<tr>"
			+ "<td colspan='3' align='left' valign='top' height='1' bgcolor='#cde3e0'></td>"
			+ "</tr>");
	writefn("<tr><td colspan='3' style='padding-left:10px'>");
	writefn("")
	writefn("\n")
	writefn("<p align=\"justify\" style=\"font-family:Arial; font-size:13px; padding:0px;\" class='web_font_19'>")
	writefn(questions[quest].qstring)
	writefn("</p>\n")
	var countarr = new Array('A', 'B', 'C', 'D', 'E', 'F', 'G');
	if ((questions[quest].sectionid % 2) != 0)
		var sceClass = 'bgcolor="#EAE9EB"';
	else
		var sceClass = 'bgcolor="#FFFFFF"';
	omrVar += "<tr Class=\"test_anwer_sect1\" " + sceClass
			+ "><td><a style=\"cursor:pointer\" onclick=\"myshow(" + omrSno
			+ ",0)\">" + omrSno + "</a></td>";
	for (i = 0; i < numdo; i++) {
		myname = questions[quest].qname;
		var q_option = "Question" + quest + "-" + i;
		// /////// Default radio button ////////
		gadget = "radio";
		// / Fill in the blanks options type=3 ////////
		if (type == 3)
			gadget = "text";
		// / Multiple select options type=1 ////////
		else if (type == 1) {
			myname += "_" + (i < 9 ? "0" : "") + (i + 1);
			gadget = "checkbox";
		}
		if (type == 4) {
			var idd1 = myname + 'c-0';
			var idd2 = myname + 'c-1';
			var idd3 = myname + 'c-2';
			var idd4 = myname + 'c-3';
			var tabletest = "<table width=\"200\" border=\"0\" cellpadding=\"1\" cellspacing=\"1\" bgcolor=\"#C1BFC8\">";
			tabletest += "<tr height='30'><td style=\"color:#F0EFF1;width:25%; \" align=\"center\" valign=\"middle\" height=\"15\">  <input id=\""
					+ idd1
					+ "\"  type=\"text\" style=\"width:15px; border:#333333; border-width:1px; border-style:solid; text-align:center\" readonly=\"true\" value=\"\" >&nbsp;</td>    <td style=\"color:#F0EFF1;width:25%; \" align=\"center\" valign=\"middle\" height=\"15\"><input id=\""
					+ idd2
					+ "\" style=\"width:15px; border:#333333; border-width:1px; border-style:solid; text-align:center\" type=\"text\" readonly=\"true\" value=\"\">&nbsp;</td>    <td style=\"color:#F0EFF1;width:25%; \" align=\"center\" valign=\"middle\" height=\"15\" width=\"50\"><input id=\""
					+ idd3
					+ "\" style=\"width:15px; border:#333333; border-width:1px; border-style:solid; text-align:center\" type=\"text\" readonly=\"true\" value=\"\">&nbsp;</td>    <td style=\"color:#F0EFF1;width:25%; \" align=\"center\" valign=\"middle\" height=\"15\" ><input id=\""
					+ idd4
					+ "\" type=\"text\"  style=\"width:15px; border:#333333; border-width:1px; border-style:solid; text-align:center\"readonly=\"true\" value=\"\">&nbsp;</td> </tr>";
			for (k = 0; k < 12; k++) {
				if (k < 2)
					var cellcolor = '#cccccc';
				else
					cellcolor = '#ffffff';
				tabletest += "<tr height=25 bgcolor=" + cellcolor + ">";
				for (i = 0; i < 4; i++) {
					var id0 = myname + "-" + i + "chq" + k + "-0";
					if ((i == 0 && k == 0) || (i == 0 && k == 2)
							|| (i == 3 && k == 0)) {
						tabletest += "<td  align=\"center\" valign=\"middle\" width='25%' height=\"15\"><div style='height:17; width:22; cursor:pointer; color:#000000;  text-align:center; ' id="
								+ id0 + " ></div></td>";
					} else {
						tabletest += "<td  align=\"center\" valign=\"middle\" width='25%' height=\"15\"><div style='background-image:url(omr1.png); background-repeat:no-repeat; height:17; background-position:center; vertical-align:middle; width:22; cursor:pointer; color:#000000;  text-align:center; ' id="
								+ id0
								+ " onclick=\"check("
								+ i
								+ ","
								+ k
								+ ",'"
								+ myname
								+ "',"
								+ quest
								+ ")\">"
								+ first[k] + "</div></td>";
					}
				}
				tabletest += "  </tr>";
			}
			tabletest += "</table><input class=\"input\" type='text' style='color:#003322; background:#999999; border:1px; width:1px; top:0px; position:absolute; font-size:1px;' id=\""
					+ myname + "\"  name=\"" + myname + "\" >";

			writefn(tabletest);

			// /////////GRID type end////////////////////////
		} else {
			writefn("\n")
			writefn("<br><span style=\"font:Arial\"  class=\"exam_head_instruction\" align=\"left\"> <b>"
					+ (i + 1) + ".</b>&nbsp;")
			writefn("</span>")
			writefn(type == 7 ? "<textarea  name=\"" + myname + "\"  id=\""
					+ myname + "\"  rows=5 cols=30 class=\"input\">"
					: "<input  id=\"" + q_option + "\"  type=" + gadget
							+ " name=\"" + myname);
			if (type < 3)
				writefn("\" value=\"" + i + "\" onclick=\"javascript:aa("
						+ quest + "," + i + "," + type + ")\">\n")
			else
				writefn(type == 7 ? "</textarea>"
						: "\" class=\"input\" onchange=\"javascript:aa("
								+ quest + ",this.value," + type + ")\" >\n")
			if (type < 3)
				writefn("<font face=\"Arial\" size=\"2\">"
						+ questions[quest].response[i] + "</font>");
			// writefn("</span>")
		}
		// //////////Answer Sheet/////////////////////
		var omrRadio1 = "omrRadio-" + quest;
		var omrRadio12 = "omrRadio-" + quest + '-' + i;
		if (gadget == 'text') {
			var colspanVar = 5;
			var readonl = 'readonly';
		} else {
			var colspanVar = '';
			var readonl = '';
		}
		if (type == 4) {
			var idd1omr = myname + 'comr-0';
			var idd2omr = myname + 'comr-1';
			var idd3omr = myname + 'comr-2';
			var idd4omr = myname + 'comr-3';
			omrVar += "<td colspan=5><table width=\"100%\" border=\"0\" cellpadding=\"1\" cellspacing=\"1\" bgcolor=\"#C1BFC8\">  <tr height=\"30\"><td style=\"color:#F0EFF1;width:25%; \" align=\"center\" valign=\"middle\" height=\"15\">  <input id=\""
					+ idd1omr
					+ "\"  type=\"text\" style=\"width:15px; border:#333333; border-width:1px; border-style:solid; text-align:center\" readonly=\"true\" value=\"\" >&nbsp;</td>    <td style=\"color:#F0EFF1;width:25%; \" align=\"center\" valign=\"middle\" height=\"15\"><input id=\""
					+ idd2omr
					+ "\" style=\"width:15px; border:#333333; border-width:1px; border-style:solid; text-align:center\" type=\"text\" readonly=\"true\" value=\"\">&nbsp;</td>    <td style=\"color:#F0EFF1;width:25%; \" align=\"center\" valign=\"middle\" height=\"15\"><input id=\""
					+ idd3omr
					+ "\" style=\"width:15px; border:#333333; border-width:1px; border-style:solid; text-align:center\" type=\"text\" readonly=\"true\" value=\"\">&nbsp;</td>    <td style=\"color:#F0EFF1;width:25%; \" align=\"center\" valign=\"middle\" height=\"15\" ><input id=\""
					+ idd4omr
					+ "\" type=\"text\"  style=\"width:15px; border:#333333; border-width:1px; border-style:solid; text-align:center\"readonly=\"true\" value=\"\">&nbsp;</td> </tr></table></td>";
		} else {
			omrVar += "<td colspan=" + colspanVar + "><input type=" + gadget
					+ " " + readonl + " name=" + omrRadio1 + " id="
					+ omrRadio12 + " value=\"" + i
					+ "\"   onclick=\"javascript:aa(" + quest + "," + i
					+ ")\" /></td>";
		}
		// //////////End Answer sheet////////////////
	}

	omrVar += "</tr>";
	writefn("</td></tr>");
	writefn("<tr>"
			+ "<td colspan='3' align='left' valign='top'>&nbsp;</td>"
			+ "</tr>"
			+ "<tr>"
			+ "<td colspan='3' height='30' align='left' valign='middle' style='padding-left:10px;'>");
	writefn("\n")
	writefn("\n")
	writefn("          ")
	if (quest > 0) {
		writefn("\n")
		writefn("&nbsp;")
		writefn("<input type='button' onClick=\"myshowopt(" + (quest)
				+ ",0)\" value='前へ' class=\"test_next_but\" />")
	}
	writefn("\n")
	writefn("          ")
	if (quest < questions.length - 1) {
		writefn("\n")
		writefn("\n")
		writefn("<input type='button' onClick=\"myshowopt(" + quest
				+ ",2)\" value='次へ' class=\"test_next_but\" />")
	}
	writefn(" <input type='button' onClick=\"javascript:resetRdo(" + quest
			+ "," + questions[quest].sectionid + "," + type + "," + myname
			+ ")\" value='レセット'  class=\"test_next_but\"  />")

	btime = "btime" + quest + "";
	hid = "hid[" + quest + "]";
	sectionID = "sectionID[" + quest + "]";
	difficu = "difficu" + quest + "";
//	alert(document.getElementById('testfilegettest').value);
	writefn("<input type='hidden' id=\"" + hid + "\" name=\"" + hid
			+ "\" value=\"" + questions[quest].img
			+ "\"><input type='hidden' name=\"" + btime + "\"  id=\"" + btime
			+ "\" value='0'><input type='hidden'  name=\"" + difficu
			+ "\" value=\"" + questions[quest].diff
			+ "\"><input type='hidden'  name=\"" + sectionID + "\" value=\""
			+ questions[quest].sectionid + "\">");
	
	
	if (type == 1) {
		writefn("<input type='hidden'  name=\"Question" + quest
				+ "\" id=\"Question" + quest + "\" >");
	}

	if (quest == questions.length - 1) {
		if (proc == 1) {
			writefn("\n")
			writefn(" <input type='button'  value='Go to next section' class='bluebut' onclick='javascript:evalu()' > ")
		} else {
			writefn("\n")
			writefn(" <input type='button'  value='完了' class='test_next_but'  onclick=\"javascript:shtm('','2')\" >")
		}
	}
	writefn("<div id='txt"
			+ questions[quest].img
			+ "' align='right' style=\"font-family:Arial, Helvetica, sans-serif; font-size:10px; color:#666666\"></div>");
	// writefn("</p>")

	writefn("</td>" + "</tr>" + "</table>");

	writefn("\n")
	writefn("<div style=\"clear:both\"></div> <div id=\"q")
	writefn(numord)
	writefn("a\" ")
	writefn(opera ? " style=\"position: absolute; visibility:hidden; top:"
			+ top + "; z-index:" + (++zin) + ";\"" : " style=\"display:none\"");
	writefn("\n")
	writefn("</div></div>\n")
	writefn("")
	omrSno++;
	omrsecC++;
}
function evalu() {
	document.getElementById('WapForm').submit();
}
function flagQues(quesID) {
	questions[quesID].flag = 1;
	document.getElementById('Fques' + quesID).innerHTML = '<img src="images/images4.gif" align="absmiddle">';
}
function unflagQues(quesID) {
	questions[quesID].flag = 0;
	document.getElementById('Fques' + quesID).innerHTML = '';
}
function aa(d, optvalue, quesType) {

	var omrRadio123 = "omrRadio-" + d + "-" + optvalue;
	var q_option = "Question" + d + "-" + optvalue;

	// //For multiple answer question///////////
	if (quesType == 1) {
		var q_res = '';
		numdo1 = questions[d].response.length;
		for (var res = 0; res < numdo1; res++) {
			if (document.getElementById("Question" + d + "-" + res).checked == true)
				q_res = q_res + "^" + parseInt(res + 1);
		}
		document.getElementById("Question" + d).value = q_res;
		questions[d].b_time = q_res;
	}
	// /// End multiple answer ques ////////
	if (quesType == 3) {
		var omrRadio123 = "omrRadio-" + d + "-0";
		var q_option = "Question" + d + "-0";
		questions[d].b_time = optvalue;
	} else if (quesType != 4) {
		questions[d].b_time = optvalue + 1;
	} else if (quesType == 4) {
		questions[d].b_time = document.getElementById("Question" + d).value;

	}

	var sidg1 = questions[d].sectionid - 1;
	var gg = "f";
	for (t = 0; t <= attmpt.length; t++) {
		if (d == attmpt[t]) {
			gg = 'yes';
		}
	}
	if (gg != 'yes') {
		var gh = attmpt.length;
		attmpt[gh] = d;
		sectionArr[sidg1].consumedsecq++;
		document.getElementById("disp" + (questions[d].sectionid) + "").innerHTML = sectionArr[sidg1].consumedsecq;
		document.getElementById("totattempt").innerHTML = attmpt.length;
	}

	// document.getElementById(omrRadio123).checked= true;

}
function newmyshow(v) {
	resetval = 'yes';
	myshow(parseInt(v), 0);
	DivCloseOpen('questionHid');
}

function myshowsec(multi, sectioncount) {
	DivCloseOpen('sectionHid');
	document.getElementById('sectionnewid').innerHTML = "Section "
			+ sectioncount;
	myshow(multi, 0);
}

var statusInterval = null;
function loadStatusBar(trgtId, endVal) {
	begVal = ((document.getElementById(trgtId).style.width == null)
			|| (document.getElementById(trgtId).style.width == undefined) || (document
			.getElementById(trgtId).style.width == '')) ? 0
			: parseFloat(document.getElementById(trgtId).style.width);

	if (begVal < endVal) {
		newWidth = (begVal + 0.25) + "%";
		document.getElementById(trgtId).style.width = newWidth;
	}
}

function doTest(i) {
	doQuestion(i);
	i++;

	// alert(i);
	// alert(questions.length);

	if (i != questions.length) {
		var setwidth = setwidthfix * i;
	} else {
		setwidth = 100;
	}
	var divid = "question" + i;
	var optQues = "opt" + i;
	// alert(secCount);
	// var optSection1 = "";
	// var optQuesNext = "opt"+r;
	// alert(divid+' '+optQues);
	document.getElementById(divid).innerHTML = questiondiv;
	// alert(questiondiv);
	document.getElementById(optQues).innerHTML = "<a href='#' onclick='newmyshow("
			+ i + ")'>Q No. " + i + "</a>";

	if (statusInterval != null) {
		window.clearInterval(statusInterval);
		statusInterval = window.setInterval("loadStatusBar('statusBar', "
				+ setwidth + ");", 25);
	} else {
		statusInterval = window.setInterval("loadStatusBar('statusBar', "
				+ setwidth + ");", 25);
	}

	document.getElementById("statusBar").style.width = setwidth + "%";
	// alert(secCount)
	// alert(i)
	if (i == multiMyshow) {
		optionsec = "optSection" + secCount;
		document.getElementById(optionsec).innerHTML = "<a href='#' onClick=\"myshowsec("
				+ multiMyshow
				+ ","
				+ secCount
				+ ")\">Section "
				+ secCount
				+ "</a>";
		multiMyshow += parseInt(sectionArr[secCount - 1].secQues);
		if (multiMyshow != 1) {
			secCount++;
		}
	}

	var loadingLoaded = (i != questions.length) ? 'loaded so far ' : 'loaded';
	var imgInlineNone = (i != questions.length) ? 'inline' : 'none';
	var ifSection = ((secCount) && (loadingLoaded != 'loaded')) ? '(loading now) but you can START the test'
			: ' You can START the test';
	if ((i == questions.length) && ((secCount) && (loadingLoaded == 'loaded'))) {
		document.getElementById('fullyloaded').value = '1';
	}
//	ji = i+1;
//	document.getElementById('statusBar').innerHTML = ' Qs. ' + ji + '&nbsp;';

	optQues = '';
	questiondiv = '';
	if (i == 1) {
		document.getElementById('startTest').style.display = "block";
	}
	if (i == questions.length) {

		testcomeplete = 'yes';
		clearTimeout(quesstime)
	} else {
		quesstime = setTimeout('doTest(' + i + ')', 1000);

	}

}

function fill(s, l) {
	s = s + ""
	for (y = 1; y <= l; y++)
		if (s.length >= l)
			break;
		else
			s = "0" + s;
	return s
}

function CheckQName(wapf, ii, i, multi, selection) {
	var len;
	if (!multi)
		return (wapf.elements[ii].name == questions[i].qname);
	len = questions[i].qname.length;
	if (wapf.elements[ii].name.substring(0, len) != questions[i].qname)
		return false;
	if (wapf.elements[ii].name.substring(len, len + 1) != "_")
		return false;
	if (eval(wapf.elements[ii].name.substring(len + 1, len + 3)) == (selection + 1))
		return true;
	return false;
}

aknw = "<br><p align='center'><small><small></small></small></p>"
function stms(s) {
	if (Math.abs(tmMx) >= 3600) {
		h = Math.floor(s / 3600);
		m = Math.floor((s % 3600) / 60);
		s = ((s % 3600) % 60);

		return fill(h, 2) + ':' + fill(m, 2) + ':' + fill(s, 2);
	} else {
		m = Math.floor(s / 60);
		s = s % 60;
		return fill(m, 2) + ':' + fill(s, 2);
	}
}

// ////// stms() Copy /////////
function stmsC(s) {
	if (Math.abs(tmMx) >= 3600) {
		h = Math.floor(s / 3600);
		m = Math.floor((s % 3600) / 60);
		// s=((s%3600)%60);
		var rVar = h + ' hours';
		if (m != '0')
			rVar = rVar + '' + m + ' minutes.';
		return rVar;
	} else {
		m = Math.floor(s / 60);
		// s=s%60;
		var rVar = m + ' minutes.';
		return rVar;
		// return fill(m,2)+':'+fill(s,2);
	}
//	return 10;
}
// //////////////////////////////
function pauselayer(pausetimeStart) {
	document.getElementById('overlayloader').style.display = "block";
	document.getElementById('pauseTest').style.width = document
			.getElementById('innerloader').style.width;
	document.getElementById('pauseTest').style.height = document
			.getElementById('innerloader').style.height;
	document.getElementById('pauseTest').style.marginLeft = document
			.getElementById('innerloader').style.marginLeft;
	document.getElementById('pauseTest').style.display = "block";
	document.getElementById('pauseTest').innerHTML = '<table width="500" height="200" align="center"  border="1" style="border:#006699 1px solid" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF"><tr><td colspan="2"  class="test_head_question"><div align="center">Your test has been paused.</div><div  align="center"><input name="restartT" type="button" class="test_anwer_sect1"  id="restartT"  onclick="shtm1('
			+ tmVl + ')" value="RESUME TEST" /></div></td></tr></table>';
}
function shtm1(timeP) {
	document.getElementById('overlayloader').style.display = "none";
	document.getElementById('pauseTest').style.display = "none";
	shtm(timeP);
}

if (mr == "")
	autoSave = setInterval("save()", 100000);

function shtm(t, pauseT) {
	if (pauseT == '1') {
		clearTimeout(tmId);
		pauselayer(t);
	} else if (pauseT == '2') {
		// alert('ss');
		clearTimeout(tmId);
		evaluateNew();
	} else {
		
		tmVl = t + 1;
		update_time(stms(Math.abs(t)), t)
		document.getElementById('totmins').innerHTML = stms(waitTime
				- Math.abs(t));
		var dific = questions[abcd].diff;
		/*
		 * if(t==tot+Math.floor((waitTime/ctot)*dific)) { myshow(1,abcd+1); }
		 */
		if (waitTime == 0)
			return;
		else{ 
			tmId = setTimeout('shtm(tmVl)', 1000)
		}
		if (t == ((tmMx > 0) ? tmMx : 0)) {
			clearTimeout(tmId);
			alert('Time is over, correcting test now.');
			// var lastvalue= questions.length-1;
			evaluateNew();
		}
	}
}
var set = -waitTime, ttaken;
var sectimeTot;
function update_time(t, t1) {
	document.getElementById('disp').innerHTML = t;
	nowtime = t1;
	ttaken = nowtime - set;
	// questions[abcd].b_time=parseInt(questions[abcd].b_time)+parseInt(ttaken);
	sectimeTot = sectionArr[secid].consumedsecTime++;
	document.getElementById('sTime' + sectionArr[secid].sectionID).innerHTML = stms(sectimeTot);
	waitTime;
	set = nowtime;
	btime = "btime" + abcd + "";

	document.getElementById(btime).value = parseInt(document
			.getElementById(btime).value)
			+ parseInt(ttaken);

	// document.getElementById(btime).value=questions[abcd].b_time;
}
function checkTime() {
	tmMx = -waitTime;
	if (tmMx != 0) {
		alert('本当にテストをうけるね！ ');
		shtm((tmMx > 0) ? 0 : tmMx, '')
//		shtm(20,'');
	}
}
// /Start test tracking///////////
function insert_tracking() {
	xmlHttp = GetXmlHttpObject();
	if (xmlHttp == null) {
		alert("Browser does not support HTTP Request");
		return;
	}
	url = "update_testtaken.php?id=" + ttakenid;
	xmlHttp.onreadystatechange = stateChanged;
	xmlHttp.open("GET", url, true);
	xmlHttp.send(null);

}
// //////////////////////////////
// Function: myshow
// Purpose: to generate dynamic Div for questions in a test
// Modified By: Tajinder Singh (tcy445)
// Modified On: 17-12-2009
// //////////////////////////////
// Variable created to store a window.setInterval to track Next question view
// in an online test
var tsndQsDoesntExistInterval = null;
function myshow(count, dif) {
	// tcy445 modification begins
	if (document.getElementById('q' + (count + dif)) == undefined) {
		if (tsndQsDoesntExistInterval == null) {
			tsndQsDoesntExistInterval = window.setInterval('myshow(' + count
					+ ',' + dif + ');', 200);
		}
		return false;
	} else {
		window.clearInterval(tsndQsDoesntExistInterval);
		tsndQsDoesntExistInterval = null;
	}
	// tcy445 modification ends
	if (document.getElementById('q' + (count + dif)) == questions.length) {
		document.getElementById('fullyloaded').value = '1';
	}
	if (recdone == false) {
		document.getElementById('instructions').style.display = "none";
	}

	document.getElementById('headerNone').style.display = 'none';
	document.getElementById('headerSec').style.display = 'block';
	document.getElementById('footerNone').style.display = 'none';
	document.getElementById('footerorg').style.display = 'block';
	abcd = count + dif - 1;
	// doQuestion(abcd);
	if (abcd == 2) {
		insert_tracking();
	}
	if (recdone != false) {

		document.getElementById(recent).style.display = "none";

		// opera?recent.style.visibility="hidden":recent.style.display="none";
		if (recent2 != "")
			opera ? document.getElementById(recent2).style.visibility = "hidden"
					: document.getElementById(recent2).style.display = "none";
	}

	// document.getElementById('wq_user').innerHTML+=questiondiv;

	secid = questions[abcd].sectionid - 1;
	sect = questions[abcd].sectionid

	// / entry in hidden field for viewed ques ////
	if (document.getElementById('viewedQues').value == '') {
		document.getElementById('viewedQues').value = abcd;
	} else {
		var qq = document.getElementById('viewedQues').value;
		if (qq.search(',' + abcd + ',') == -1) {
			document.getElementById('viewedQues').value = document
					.getElementById('viewedQues').value
					+ ',' + abcd;
		}
	}

	// //Google track code
	/*
	 * var pageTracker = _gat._getTracker("UA-3438803-1");
	 * pageTracker._setSessionTimeout("10800");
	 * pageTracker._setDomainName("none"); pageTracker._setAllowLinker(true);
	 * pageTracker._initData(); pageTracker._trackPageview();
	 */

	if (abcd == 0) // ------------------------Best
	// Time-----------------------------//
	{
	} else {
		if (best_glob < arr[abcd - 1]) {
			arr1[abcd - 1] = best_glob;
		}
		if (best_glob > arr[abcd - 1]) {
			arr1[abcd - 1] = arr[abcd - 1];
		}
	}
	// var b_time = questions[abcd].b_time;
	// best_glob=b_time;

	if (abcd == 0) {

		tot = -waitTime;
	} else {
		tot = nowtime;
	}
	if (len == abcd) {
		alert('timeout')
	}
	if (divtoshow != "") {
		document.getElementById(divtoshow).style.display = "none";
		divtoshow = "";
	}
	xyzz = questions[abcd].fname;
	if (questions[abcd].fid != '' && questions[abcd].fname != '')
		xyz = questions[abcd].fname + '/' + questions[abcd].fid;
	else
		xyz = '';
	if (xyz != "") {

		divtoshow = "passage" + abcd;
		document.getElementById(divtoshow).style.display = "block";
		if (abc == xyz) {
		} else
			abc = questions[abcd].fid;
	} else {
	}
	var id, id2, wq_user, id_str, id2_str;
	if (recdone == false && waitTime != 0)
		checkTime();
	if (dif != -1)
		count += dif;

	mycount = count;
	id_str = "q" + count;
	id2_str = "q" + count + "a";
	question_str = "question" + count;
	id3 = document.getElementById(question_str);
	id = document.getElementById(id_str);
	id2 = document.getElementById(id2_str);

	recdone = true;
	opera ? id3.style.visibility = "visible" : id3.style.display = "block";
	opera ? id.style.visibility = "visible" : id.style.display = "block";
	opera ? id2.style.visibility = "visible" : id2.style.display = "block";
	if (questions[count - 1].type > 2)
		document.WapForm.elements[questions[count - 1].qname].focus();
	recent = id_str;
	recent2 = id2_str;
	document.getElementById('questionid').innerHTML = "<font style=\"size:14px;\">Q No. "
			+ (abcd + 1) + "</font>";
	document.getElementById('sectionnewid').innerHTML = "Select " + sect;
}

function resetRdo(a, secR, Qtype, Qmyname) {
	secR1 = secR - 1;// /////Grid type reset ///////////
	if (Qtype == 4) {
		for (var ii = 0; ii < 4; ii++) {
			for (var kk = 0; kk < 12; kk++) {
				var id11 = "Question" + a + "-" + ii + "chq" + kk + "-0";
				document.getElementById(id11).style.background = "url('omr1.png') no-repeat";
				document.getElementById(id11).style.color = "#000000";
			}
			var id1 = "Question" + a + "c-" + ii;
			var id123 = "Question" + a + "comr-" + ii;
			document.getElementById(id1).value = "";
			document.getElementById(id123).value = "";
		}
		sectionArr[secR1].consumedsecq--;
	} // ////Grid type reset end///////
	else if (Qtype == 3) {
		var id11 = "Question" + a + "-0";
		document.getElementById(id11).value = "";
		var id112 = "omrRadio-" + a + "-0";
		document.getElementById(id112).value = "";
		sectionArr[secR1].consumedsecq--;
	} else {
		Qtype1 = 1;
		numdo1 = questions[a].response.length;
		for (i = 0; i < numdo1; i++) {
			var fg = "Question" + a + "-" + i;
			var omrRadio123 = "omrRadio-" + a + "-" + i;
			if (document.getElementById(fg).checked == true) {
				// document.getElementById(omrRadio123).checked=false;
				document.getElementById(fg).checked = false;
				if (Qtype != 1)
					sectionArr[secR1].consumedsecq--;
				else if (Qtype1 == 1) {
					sectionArr[secR1].consumedsecq--;
					Qtype1++;
				}
			}
		}
	}
	attmpt.remove(a);
	document.getElementById("disp" + secR + "").innerHTML = sectionArr[secR1].consumedsecq;
	document.getElementById("totattempt").innerHTML = attmpt.length;
	// document.getElementById('dockcontent0').innerHTML=document.getElementById('dockcontent01').innerHTML;
}
Array.prototype.remove = function(s) {
	for (i = 0; i < this.length; i++) {
		if (s == this[i])
			this.splice(i, 1);
	}
}

function evaluateNew() {
	mr = 1;
	clearTimeout(autoSave);// alert(EsteemedUser);

	document.getElementById('WapForm').action = "dotest";
	document.forms["WapForm"].submit();
}


function unique(arrayName) {
	var newArray = new Array();
	label: for (var i = 0; i < arrayName.length; i++) {
		for (var j = 0; j < newArray.length; j++) {
			if (newArray[j] == arrayName[i])
				continue label;
		}
		newArray[newArray.length] = arrayName[i];
	}
	return newArray;
}

function save() {
	if (document.getElementById('viewedQues').value != '') {
		var the_form = document.getElementById("WapForm");

		var vQuesids = document.getElementById('viewedQues').value.split(',');

		var QuesIds = atime = '';
		var answers = '';
		var sections = new Array();
		vQuesids = unique(vQuesids);
		var cntQues = parseInt(vQuesids.length - 1);

		var delim = ',';
		for (var k = 0; k < cntQues; k++) {
			var i = vQuesids[k];
			sections[k] = questions[i].sectionid;

			if (sections[k - 1] != questions[i].sectionid && k > 0) {
				delim = "~";
			} else {
				delim = ",";
			}

			QuesIds = QuesIds + delim + questions[i].img;

			if (questions[i].b_time == 0 && questions[i].type == 0)
				answers = answers + delim + 'U';
			else
				answers = answers + delim + questions[i].b_time;

			atime = atime + delim + document.getElementById('btime' + i).value;
		}
		var sect = unique(sections);

		document.getElementById('viewedQues').value = abcd;

		var file = "saveTest_newchg.php?tid=" + testid + "&qids=" + QuesIds
				+ "&ans=" + answers + "&time=" + atime + "&sections=" + sect;
		xmlHttp = GetXmlHttpObject();
		if (xmlHttp == null) {
			alert("Browser does not support HTTP Request");
			return;
		}
		xmlHttp.onreadystatechange = stateChanged1;
		xmlHttp.open("GET", file, true);
		xmlHttp.send(null);
	}
}

function stateChanged1() {
	if (xmlHttp.readyState == 4) {
		if (xmlHttp.status == 200) {
			// document.getElementById('SaveTest').style.display='none';
			// window.parent.location='http://'+servername+'/india/savetest1.php';
			// result = http_request.responseText;
			// document.getElementById('myspan').innerHTML = result;
		} else {
			// alert('There was a problem with the request.');
		}
	}
}

function saveAndExit() {
	if (document.getElementById('viewedQues').value != '') {
		var the_form = document.getElementById("WapForm");

		var vQuesids = document.getElementById('viewedQues').value.split(',');

		var QuesIds = atime = '';
		var answers = '';
		var sections = new Array();
		vQuesids = unique(vQuesids);
		var cntQues = parseInt(vQuesids.length - 1);

		var delim = ',';
		for (var k = 0; k < cntQues; k++) {
			var i = vQuesids[k];
			sections[k] = questions[i].sectionid;

			if (sections[k - 1] != questions[i].sectionid && k > 0) {
				delim = "~";
			} else {
				delim = ",";
			}

			QuesIds = QuesIds + delim + questions[i].img;

			if (questions[i].b_time == 0 && questions[i].type == 0)
				answers = answers + delim + 'U';
			else
				answers = answers + delim + questions[i].b_time;

			atime = atime + delim + document.getElementById('btime' + i).value;

		}
		var sect = unique(sections);

		document.getElementById('viewedQues').value = abcd;

		var file = "saveTest_newchg.php?tid=" + testid + "&qids=" + QuesIds
				+ "&ans=" + answers + "&time=" + atime + "&sections=" + sect;
		xmlHttp = GetXmlHttpObject();
		if (xmlHttp == null) {
			alert("Browser does not support HTTP Request");
			return;
		}
		xmlHttp.onreadystatechange = stateChanged2;
		xmlHttp.open("GET", file, true);
		xmlHttp.send(null);
	}
}

function myshowopt(qno, nxt) {
	// markedques.sort(sortNumber);
	if (qno == '1') {
		// save();
	}
	var a = qno + nxt - 1;
	var numdo1 = questions[a].response.length;
	// /////////////////
	var att_ = 'no';
	if (questions[a].type == 4) {
		for (var ii = 0; ii < 4; ii++) {
			var id1 = "Question" + a + "c-" + ii;
			if (document.getElementById(id1).value != "")
				att_ = 'yes';
		}
	} // ////Grid type reset end///////
	else if (questions[a].type == 3) {
		var id11 = "Question" + a + "-0";
		if (document.getElementById(id11).value != "")
			att_ = 'yes';
	}
	// /////////////////
	if (testmode == "f") {
		if (questions[a].flag == 0) {
			// myshowopt((qno+1),0);
			if (nxt == 2)
				qno++;
			if (a == 0 && nxt == 0) {
				alert("No marked questions")
				nxt = 2;
			}
			if (a == len - 1 && nxt == 2) {
				alert("No marked questions further")
			}
			if (nxt == 0 && qno > 1)
				qno--;
			myshowopt(qno, nxt);
		} else {
			myshow(qno, nxt);
		}
	} else if (testmode == "u") {
		var questatt = '';
		var numdo1 = questions[a].response.length;
		if (questions[a].type == 3 || questions[a].type == 4) {
			if (att_ == 'yes')
				questatt = 'yes';
		} else {
			for (i = 0; i < numdo1; i++) {
				var fg = "Question" + a + "-" + i;
				if (document.getElementById(fg).checked == true)
					questatt = 'yes';
			}
		}
		if (questatt == 'yes') {
			if (nxt == 2)
				qno++;
			if (a == 0 && nxt == 0) {
				alert("Previous question is already attempted");
				nxt = 2;
			}
			if (a == len - 1 && nxt == 2)
				alert("Next question is already attempted");
			if (nxt == 0 && qno > 1)
				qno--;
			myshowopt(qno, nxt);
		} else
			myshow(qno, nxt);
	} else if (testmode == "a") {
		var questatt = '';
		var numdo1 = questions[a].response.length;
		if (questions[a].type == 3 || questions[a].type == 4) {
			if (att_ == 'yes')
				questatt = 'yes';
		} else {
			for (i = 0; i < numdo1; i++) {
				var fg = "Question" + a + "-" + i;
				if (document.getElementById(fg).checked == true)
					questatt = 'yes';
			}
		}
		if (questatt != 'yes') {
			if (nxt == 2)
				qno++;
			if (a == 0 && nxt == 0) {
				alert("Previous question is already unattempted");
				nxt = 2;
			}
			if (a == len - 1 && nxt == 2)
				alert("Next question is already unattempted");
			if (nxt == 0 && qno > 1)
				qno--;
			myshowopt(qno, nxt);
		} else
			myshow(qno, nxt);
	} else
		myshow(qno, nxt);
}
function sortNumber(a, b) {
	return a - b;
}

if (window.XMLHttpRequest) {
	req1 = new XMLHttpRequest();
}

function GetXmlHttpObject() {
	var xmlHttp = null;
	try {
		xmlHttp = new XMLHttpRequest();
	} catch (e) {
		try {
			xmlHttp = new ActiveXObject("Msxml2.XMLHTTP");
		} catch (e) {
			xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
		}
	}
	return xmlHttp;
}
