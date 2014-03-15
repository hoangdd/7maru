<style type="text/css">
	@font-face {
		font-family:ankit;
		src:url(fonts/ankit0.eot);
	}
	@font-face {
		font-family: ankit;
		src:url(fonts/ankit.ttf);
	}
	.marked1 { background-image:url(/7maru/app/webroot/anything/1_continue.jpg); background-repeat:no-repeat; background-position:center; text-align: center; padding-bottom: 5px; line-height: 25px; padding-left: 10px; width: 100px; padding-right: 10px; font-family: arial, helvetica, sans-serif; float: right; font-size: 12px;padding-top: 5px;
	}
	.marked1 a {
		color: #000; text-decoration: none;
}
</style>

<div style="z-index: 110; border-bottom: #666666 2px solid; position: absolute; text-align: center; border-left: #666666 2px solid; padding-bottom: 20px; margin: auto; padding-left: 20px; padding-right: 20px; display: none; font-family: 'trebuchet ms'; background: #f2f2f2; color: #000000; font-size: 20px; border-top: #666666 2px solid; top: 200px; border-right: #666666 2px solid; padding-top: 20px; left: 260px" id="savetest"></div>

<?php 
echo $this->Html->script(array('test_test','Test_Control'));
?>
<script language="javascript">
	var xmlhttp;
	var servername = "<?php echo "exam" ?>";
	
	function showhint()
	{
	var testid="<?php $this->tst='aaa';echo $this->tst; ?>";
	// alert(testid);


	xmlhttp=getxmlhttpobject();
	if (xmlhttp==null)
	{
		alert ("your browser does not support ajax!");
		return;
	} 
	var url="incompletetest.php";
	url=url+"?testid="+testid;
	//alert(url);
	//xmlhttp.onreadystatechange=statechanged;
	xmlhttp.open("get",url,true);
	xmlhttp.send(null);
	} 
	
	function statechanged() 
	{ 
		if (xmlhttp.readystate==4)
		{ 
		//document.getelementbyid("txthint").innerhtml=xmlhttp.responsetext;
		}
	}
		
	function getxmlhttpobject()
		{
		var xmlhttp=null;
		try
		{
		// firefox, opera 8.0+, safari
			xmlhttp=new xmlhttprequest();
		}
		catch (e)
		{
		// internet explorer
			try
			{
				xmlhttp=new activexobject("msxml2.xmlhttp");
			}
			catch (e)
			{
				xmlhttp=new activexobject("microsoft.xmlhttp");
			}
		}
		return xmlhttp;
		}
</script>
<script language="javascript">
var qno=<?php 
$this->qno=4;
echo $this->qno; ?>;
var proc="";
var s=new array();
var attmpt=new array();
var arr= new array(0);
var totques=0,totqcon=0,totmincon=1;
var tottime=0;
var ttakenid='';
var testid='<?php
	
 echo $this->tst; ?>';
var esteemeduser="";
//var paidtest=1;
var paidtest=0;
//function traceststus(){
//showhint(testid,ttakenid);
//alert(testid);
//alert(ttakenid);
//}
</script>


<script language="javascript">
function divcloseopen(divid)
{
	if(document.getelementbyid(divid).style.display=="none")
		document.getelementbyid(divid).style.display="block";
	else
		document.getelementbyid(divid).style.display="none";
		
	//  document.getelementbyid(divid).focus();
}
</script>

<!-- javascript part ending-->
</head>

<body>
<div style="position:absolute" id="txterror"></div>
<div style="display: block" id="headernone"> </div>
<?php //include 'lightbox.phtml'; ?>

<!-- main table with 3 columns -->
<table width="947" border="0" align="center" cellpadding="0" cellspacing="0">
<!-- header row content -->
<?php
//include_once 'headerc.phtml';
?>
<!-- header row content -->

<!-- breadcrum() -->
<tr><td colspan="3" align="left" style="padding:5px; background-image:url(/7maru/app/webroot/anything/sprite_01.jpg); background-repeat:repeat-x;">&nbsp;<?php //breadcrum(); ?></td></tr>
<!-- breadcrum()-->

<!-- middle row content -->
<tr>
	 <td colspan="3" bgcolor="#ffffff" class="sprite_padding_1">

		<table width="100%" border="0" cellspacing="0" cellpadding="0" height="200">
			<tr>
				<!-- left coloumn code -->
			 
				<!-- center coloumn code -->
				<td width="*" style="padding-left:6px; padding-right:6px;" valign="top">
				<?php // echo ucwords($_session['msg']); if(!empty($_session['msg']))unset($_session['msg']);?>
				<table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-top:5px;">
					<tr bgcolor="#f68122">
						<td width="6" style="background:url(/7maru/app/webroot/anything/sprite_05.jpg) left no-repeat;" height="27">&nbsp;</td>
						<td width="705" background="/7maru/app/webroot/anything/sprite_07.jpg" class="content_head" ><strong>テストを受ける</strong></td>
						<td width="6" style="background:url(/7maru/app/webroot/anything/sprite_06.jpg) right no-repeat;" height="27">&nbsp;</td>
					</tr>
					<tr>
						<td colspan="3" align="left" valign="top" class="sprite_padding_1 main_box_border">
<!-- -->
<div style="display: none" id="headersec">
			
			<table border="0" cellspacing="0" cellpadding="0" width="100%" align="center">
				<tbody>
				<tr>
					<td valign="bottom" width="235">
						
		<div id="sectionaldiv">
<!-- timer & move to table -->    
	<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
												<tr>
													<td width="50%" bgcolor="#efefef" class="web_border_1"><table width="100%" border="0" cellspacing="0" cellpadding="0">
															<tr>
																<td bgcolor="#f8f8f8" class="web_padding_1"><table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
																	<tr>
																		<td height="33" colspan="4" align="center" valign="middle" background="/7maru/app/webroot/anything/ismart_48.jpg" class="web_font_9" style="border-right:#dbdbdb dashed 1px;"><strong>時間</strong></td>
																		</tr>
								
<script language="javascript">
	 var sectiondisplaydata='', sectionvar, statusbarcode='',statuswidth="";
	 
	sectionvar ='';
	statuswidth = math.floor(100/sectionarr.length);
	seccoun=1;
	totmincon=sectionarr[seccoun-1].sectime/60;
			document.write('<tr><td width="28%" height="33" align="center" class="web_font_9" style="border-right:#dbdbdb dashed 1px;border-bottom:#dbdbdb dashed 1px;"><strong>選ぶ数 </strong></td>');

			sectionvar+='<div class=\"bid_middle_slet_under\" id=\"optsection'+seccoun+'\"><img src="/7maru/app/webroot/anything/loader.gif" border="0" /></div>';
			statusbarcode+='<div style=\"width:100%;\"><div style=\"width:'+statuswidth+'%; float:left; border:1px solid #e1e1e1; border-right:0px;\">section '+seccoun+'</div></div>';
			
	document.write('<td width="19%" align="center" class="web_font_9" style="border-bottom:#dbdbdb dashed 1px;border-right:#dbdbdb dashed 1px"><div id=satt'+seccoun+'><span name=disp'+seccoun+' id=disp'+seccoun+'>0</span>/'+sectionarr[seccoun-1].secques+'</div></td>');

	document.write('<td width="21%" align="center" class="web_font_9" style="border-bottom:#dbdbdb dashed 1px;border-right:#dbdbdb dashed 1px"><div><span id="stime'+seccoun+'">00:00</span></div></td>'+
	'<td width="32%" rowspan="2" align="center" valign="top" bgcolor="#f2eee2" class="web_font_11" ><strong><br />'+
	'時間落<br /><br /><span id=disp name="disp">00:00:00</span></strong></td></tr>'+
	'<tr><td height="33" align="center" class="web_font_9" style="border-right:#dbdbdb dashed 1px;"><strong>全部</strong></td>'+
		'<td align="center" class="web_font_9" style="border-right:#dbdbdb dashed 1px"><span id="totattempt">0</span></td>'+
	'<td align="center" class="web_font_9" style="border-right:#dbdbdb dashed 1px"><div id=\"totmins\">00:00</div></td>'+
	'</tr>');
</script>
																</table></td>
															</tr>
													</table></td>
													<td width="50%" bgcolor="#efefef" class="web_border_1"><table width="100%" border="0" cellspacing="0" cellpadding="0">
															<tr>
																<td bgcolor="#f8f8f8" class="web_padding_1"><table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
																		<tr>
																			<td height="33" colspan="3" align="center" valign="middle" background="/7maru/app/webroot/anything/ismart_48.jpg" class="web_font_9" style="border-right:#dbdbdb dashed 1px;"><strong>問題選択</strong></td>
																		</tr>
																		<tr>
																			
																			<td width="2%" height="33" align="center" class="web_font_9" style="border-right:#dbdbdb dashed 1px">&nbsp;</td>
																			<td width="51%" rowspan="2" align="center" valign="middle" bgcolor="#f2eee2" class="web_font_11" > 
																			<div id="questionid" class="bid_middle_left_text_box" onclick="divcloseopen('questionhid')" ></div>
									<div style="position: absolute; display: none;" id="questionhid" class="bid_middle_slet_ques" >
									<?php
						
						//for($i=1;$i<=$this->qno;$i++)
						for($i=1;$i<=$this->qno;$i++)
						{
							echo '<div id="opt'.$i.'" class="bid_middle_slet_under" value="'.$i.'" onclick="divcloseopen(\'questionhid\')"></div>';
						}
					?>
				</div> </td>
																		</tr>
																		<tr>
																			<td height="33" align="center" class="web_font_9" style="border-right:#dbdbdb dashed 1px">&nbsp;</td>
																		</tr>
																</table></td>
															</tr>
													</table></td>
													</tr>
										</table>
									<span style="display:none;">
					<script language="javascript">
						if(sectionarr.length>=1)
						document.write(sectionvar);
					</script>
									</span>

<!-- timer & move to table ends here-->    

		</div>           </td>
			</tr>
				<tr valign="top">          </tr></tbody></table></div>
<!-- -->    &nbsp;

 <!-- exam part-1 -->

<table border="0" cellspacing="0" cellpadding="0" height="*" bgcolor="#ffffff" width="100%">
	<tbody>
	<tr height="2">
		<td colspan="3"></td></tr>
	<tr valign="top">
		<td width="7"></td>
		<td valign="top">
			<script language="javascript">
			for(var iframe =0; iframe<<?php echo $this->qno; ?>; iframe++){
				 if(questions[iframe].fid!='' && questions[iframe].fname!='')
				{
				// alert(iframe)        
				var src = questions[iframe].fname+'/'+questions[iframe].fid;
				document.write('<div id=\"passage'+iframe+'\" style=\"position:relative; z-index:0; width:100%; height:100% ;display:none;\"><iframe id=\"inderjit'+iframe+'\" width=\"450\" height=\"400\" src=\"'+src+'\" ></iframe></div>');
				}
			}
			</script>
			<form id="wapform" method="post" name="wapform" 
			action="dotest">
			<input id="fullyloaded" type="hidden" name="fullyloaded" > <input id="viewedques" type="hidden" name="viewedques">
			<!--<div id="dockcontent01" class="test_answer_main" style=" background-color:#eaeaea; display:none; " ></div>-->
			<input type="hidden" name="test_id" id="test_id" value="<?php echo $this->tst; ?>" />
			<div style="display:block;" id="wq_user" align="left">
			<div style="z-index: 110; position: absolute; display: none; top: 70px; left: 49px" id="feedback"></div>
			<?php
				for($i=1; $i<=$this->qno; $i++) 
			{
			echo '<div style="width: 100%; display: none" id="question'.$i.'"></div>';
		}
	 ?>
			<div style="width: 100%; display: block" id="instructions" align="center">
			<table border="0" cellspacing="0" cellpadding="3" align="center" width="100%" style="border: 1px solid rgb(219, 219, 219);">
				<tbody>
				<tr>
					<td class="test_list_border" height="18" colspan="2" align="left"><img src="/7maru/app/webroot/anything/test_head_icon.png" alt="icon" width="20" height="20" align="absmiddle" /><span class="profile_info_text">テスト詳細</span></td>
				</tr>
				<tr bgcolor="#f3efe4">
					<td width="34%" height="30" align="right" class="test_list_border"><strong>テスト名前 :</strong></td>
					<td width="66%" align="left" class="web_font_19 test_list_border"><strong>test</strong></td>
				</tr>
				<tr>
					<td height="30" align="right" class="test_list_border"><strong>問題数</strong></td>
					<td align="left" class="test_list_border web_font_19">
						<div id="totques1"><strong>
						<script language="javascript">
				document.write(questions.length);
						</script>
						</strong></div></td>
				</tr>
				<tr bgcolor="#f3efe4">
					<td height="30" align="right" class="test_list_border"><strong>時間 : </strong></td>
					<td align="left" class="test_list_border web_font_19">
						<strong><div id="tottime1"></div></strong></td></tr>
				<tr class="blue_bg_admin">
					<td height="30" colspan="2" align="center" class="test_list_border">
						<table 
						style="border-bottom: #cccccc 1px solid; border-left: #cccccc 1px solid; border-top: #cccccc 1px solid; border-right: #cccccc 1px solid; display:none;" 
						border="0" cellspacing="0" cellpadding="0" width="50%" align="center">
							<tbody>
							<tr>
								<td class="test_paragra_home" width="50%" 
									align="middle"><b>sections</b></td>
								<td class="test_paragra_home" align="middle"><b>no.of questions</b></td></tr>
							<script language="javascript">
				document.write(sectiondisplaydata);
							</script>
							</tbody></table></td></tr>
				
				
				
				<tr class="blue_bg_admin">
					<td colspan="2" align="middle" class="test_list_border" style="font-family: arial, helvetica, sans-serif; font-size: 12px">
						<div style="z-index: 10; border-bottom:#ff9900 1px solid; position: relative; border-left: #ff9900 1px solid; width: 100%; float: left; clear: both; border-top: #ff9900 1px solid; border-right: #ff9900 1px solid">
						<div style="text-align: right; background: url(/7maru/app/webroot/anything/testloader.gif) repeat-x 50% top; float: left; height: 14px; color: #333; font-weight:bold;" 
						id="statusbar"></div></div>
						<div style="z-index: 5; position: relative; width: 100%; float: left; height: 15px; color: #5f5f5f; clear: both; top: -15px">
						<?php
				$qn=$this->qno;
				if($qn>4)
				$nofdivs=floor($qn/5);
				else
				$nofdivs=1;
				
				if($qn%5==0)
					$nofdivs++;
				
				$width=100/$nofdivs;
				$qq=5;
				for($i=1;$i<$nofdivs;$i++)
				{
					echo '<div style="text-align: right; width: '.$width.'%; float: left">'.$qq.'</div>';
					$qq+=5;
				}
			?>
						</div><br><br>
						<!--<div class="test_foot_pau" id = "starttest" style="display:none;"><a href="#" onclick="myshow(1,0);">始める</a></div>-->
						<div style="text-align: left; line-height: 2em; display: none; font-family: arial, helvetica, sans-serif; white-space: nowrap; float: left; color: #006699; font-size: 1em; font-weight: bold" id="divnotloading" align="left"></div>
						<div style="display: none" id="starttest" class="marked1"><a href="javascript:void(0);" onclick="myshow(1,0);"><strong>始める</strong></a></div>      </td>
			</tr>
			</tbody></table>
			</div></div>
			<script language="javascript" type="text/javascript">       
				document.getelementbyid('tottime1').innerhtml=totmincon;
			 </script>
			</form></td>
			<td width="10"></td>
			</tr>
			</tbody></table> 

<div style="display: none" id="footerorg">
<table width='100%' border='0' cellspacing='0' cellpadding='0' align="center">
	<tr>
	 <td width="7"></td>

	 <td width="10"></td>
	</tr>
</table>
</div>

<div id="footernone"></div>

<div style="z-index: 110; position: absolute; display: none; top: 70px; left: 49px" id="pausetest">
<div style="z-index: 1; border-bottom: #7b9bbd 2px double; position: absolute; border-left: #7b9bbd 2px double; padding-bottom: 2px; background-color: #f5f5f5; padding-left: 2px; width: 200px; bottom: 10px; padding-right: 2px; display: none; font-family: arial, helvetica, sans-serif; color: #235fba; font-size: 13px; border-top: #7b9bbd 2px double; border-right: #7b9bbd 2px double; padding-top: 2px; left: 0px" id="viewsection"></div>
<div id="mytarget"></div>
<script>
var txt="";
if((typeof(window['questions']) == "undefined"))
{
	document.getelementbyid("divnotloading").style.display="block"; 
}

function handleerr(msg,url,l)
{
	document.getelementbyid("divnotloading").style.display="block"; 
	var browser=navigator.appname;
	var b_version=navigator.appversion;
	//var version=parsefloat(b_version);
	var url="l29ubgluzxrlc3qvrxhhbs5waha/cw5vptumdhn0pti0mjixmgdlbiz0dgfrzw49mzm2mte4mcziyw5uzxi9jkvzdgvlbwvkvxnlcj0mbmv4dd1vsep2wtjwemmwzgxibvz5wvhsbexuqm9jrdl3y205alpytnpqveltzedwemrhbgtqvekwtwpjee1hzgxiavowzedgclpxndlnek0ytvrfne1dwkzjm1jswlcxbfpgvnpawek5";
	//alert(url);
	
	var redirecturl="testerrormail2.php?msg="+msg+"&url="+url+"&l="+l+"&browser="+browser;
	/*var redirecturl="testerrormail.php?details="+txt;*/
	senderrreport(redirecturl);
	return true;
}
onerror=handleerr;

document.getelementbyid('fullyloaded').value='';
document.getelementbyid('viewedques').value='';
dotest(0);
</script>
</div>      

						</td>
					</tr>
				</table>
				</td>
				<!-- right coloumn code -->
				<td width="0" style="padding-left:0px; padding-right:0px;" valign="top"></td>
			</tr>
		</table>

	</td>
</tr>


</table>
