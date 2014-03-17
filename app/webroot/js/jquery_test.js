// JavaScript Document

var message = "Due to security reason, Right Click is not allowed";
function clickIE4() {

	if (event.button == 2) {

		alert(message);

		return false;

	}

}

function clickNS4(e) {

	if (document.layers || document.getElementById && !document.all) {

		if (e.which == 2 || e.which == 3) {

			alert(message);

			return false;

		}

	}

}

if (document.layers) {

	document.captureEvents(Event.MOUSEDOWN);

	document.onmousedown = clickNS4;

}

else if (document.all && !document.getElementById) {

	document.onmousedown = clickIE4;

}

document.oncontextmenu = new Function("alert(message);return false;")

function ajaxCode(url, divName) {
	// alert(url);
	var xmlhttp;
	if (window.XMLHttpRequest) {
		xmlhttp = new XMLHttpRequest();
	} else {
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange = function() {
		if (xmlhttp.readyState == 4) {
			
			myValue = xmlhttp.responseText;

//			 alert(myValue);

			if (myValue != '' && document.getElementById(divName))
				document.getElementById(divName).innerHTML = myValue;
			if (document.getElementById('comingDiv'))
				document.getElementById('comingDiv').style.display = 'none';
			ajaxLoadStatus = 0;
		} else {
			if (document.getElementById('comingDiv'))
				document.getElementById('comingDiv').style.display = 'block';
		}
	}
	xmlhttp.open("GET", url, true);
	xmlhttp.send(null);
}

function ajaxCodeWriting(divName,indexOfQues) {
	
	myValue = '<?php $qid = 0;';
//	myValue += indexOfQues;
	myValue += 'echo $qid ?>';
//	myValue = '';	
	myValue += '<table width="99%" cellspacing="0" cellpadding="0" border="0" align="left" style="border: 1px solid rgb(219, 219, 219);">';
	myValue += '<tbody>';
	myValue += '<tr bgcolor="#f2eee2">';
	myValue += '<td height="22" align="left" class="profile_info_text">Question <?php echo $qid+1; ?> of <?php echo $total; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php if($total>($qid+1)) { echo \'<input type="button" onClick="javascript:showQuesSec(\'.($qid+1).\');" value="Next" class="test_next_but" />\'; } ?> &nbsp;&nbsp;&nbsp;&nbsp;<?php if($qid>0) { echo \'<input type="button" onClick="javascript:showQuesSec(\'.($qid-1).\');" value="Prev" class="test_next_but" />\'; } ?></td>';
	myValue += '</tr>';
	myValue += '   <tr><td height="200" width="5%" valign="top" align="left" style="padding: 4px; line-height: 17px; color: rgb(0, 0, 0);" >';

	myValue += '<p align="justify" style="font-family: Arial; font-size: 13px;"><font size="2" face="Arial"><b><u>Directions:</u></b> <?php echo \'linh\'; ?></font></p>';
	myValue += '<p><font size="2" face="Arial"><b><?php echo stripcslashes($finalTest[\'Question\'.$qid][\'content\']); ?></b></font></p>';
	myValue += '<div class="QBYQ_incorrect">Result : <?php' 
	myValue += '	if(strcmp($choosedEnd[$qid],"ignored") == 0) echo \'選ばない \';';
	myValue += '	else if($choosedEnd[$qid] == $finalTest[\'Question\'.$qid][\'mark\']) echo \'正しい \';';
	myValue += '	else echo \'正しくない \';';
	myValue += '	?></div><br /><br />';
	myValue += '<?php';
	// 
	myValue += '			for($i=0;$i<count($finalTest[\'Question\'.$qid]) - 3;$i++)';
	myValue += '			{ $tempToCompare = intval($finalTest[\'Question\'.$qid][\'mark\']);';
	myValue += '				echo \'<br/>\';';
	myValue += '				if($i == $tempToCompare)';
	myValue += '					echo \'<img src="/7maru/app/webroot/anything/tic_qByq.gif" />\';';
	myValue += '				else if(intval($choosedEnd[$qid])==$i && $choosedEnd[$qid]!=\'ignored\')';
	myValue += '					echo \'<img src="i/7maru/app/webroot/anything/q-by-q_cross.gif" />\';';
	myValue += '				else';
	myValue += '					echo \'<img src="/7maru/app/webroot/anything/qbyq_round.gif" />\';';
	myValue += '?>';
	myValue += '<span align="left" class="exam_head_instruction" style=""><strong><?php echo stripcslashes($finalTest[\'Question\'.$qid][\'Option\'.$i]); ?></strong></span>';

	myValue += '<?php	';
	myValue += '			}';
	myValue += '?>';
	myValue += '            </td></tr>';
	myValue += '		</tbody>';
	myValue += '        </table>';

	document.getElementById(divName).innerHTML = myValue;
}