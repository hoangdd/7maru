<table width="99%" cellspacing="0" cellpadding="0" border="0" align="left" style="border: 1px solid rgb(219, 219, 219);">
	<tbody>
	<tr bgcolor="#f2eee2">
	<td height="22" align="left" class="profile_info_text">問題 <?php echo $qid+1; ?>: 点数 <?php echo $finalTest['Question'.$qid]['markNumber']; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php if($total>($qid+1)) { echo '<input type="button" onClick="javascript:showQuesSec('.($qid+1).');" value="Next" class="test_next_but" />'; } ?> &nbsp;&nbsp;&nbsp;&nbsp;<?php if($qid>0) { echo '<input type="button" onClick="javascript:showQuesSec('.($qid-1).');" value="Prev" class="test_next_but" />'; } ?></td>
	</tr>
	   <tr><td height="200" width="5%" valign="top" align="left" style="padding: 4px; line-height: 17px; color: rgb(0, 0, 0);" >

	<p align="justify" style="font-family: Arial; font-size: 13px;"><font size="2" face="Arial"><b><u>内容:</u></b></font></p>
	<p><font size="2" face="Arial"><b><?php echo stripcslashes($finalTest['Question'.$qid]['content']); ?></b></font></p>
	<div class="QBYQ_incorrect">選択 : <?php 
		if(strcmp($choosedEnd[$qid],"ignored") == 0) 
			echo '選ばない ';
		else if($choosedEnd[$qid] == $finalTest['Question'.$qid]['mark']) echo '正しい ';
		else echo '正しくない ';
		?></div><br /><br />
	<?php
	// 
				for($i=0;$i<count($finalTest['Question'.$qid]) - 3;$i++)
				{ $tempToCompare = intval($finalTest['Question'.$qid]['mark']);
					echo '<br/>';
					if($i == $tempToCompare)
						echo '<img src="/7maru/app/webroot/anything/tic_qByq.gif" />';
					else if(intval($choosedEnd[$qid])==$i)
						echo '<img src="/7maru/app/webroot/anything/q-by-q_cross.gif" />';
					else
						echo '<img src="/7maru/app/webroot/anything/qbyq_round.gif" />';
	?>
	<span align="left" class="exam_head_instruction" style=""><strong><?php echo stripcslashes($finalTest['Question'.$qid]['Option'.$i]); ?></strong></span>

	<?php	
				}
	?>
	            </td></tr>
			</tbody>
	        </table>