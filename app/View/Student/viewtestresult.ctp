<html>
	<head>
			<style>
				h1
				{
					color:orange;
					text-align:center;
				}
				
			</style>
	</head>

	<body>
	
		<h1>結果</h1>
		<div class="jumbotron">
		  <p>終わった時間:<?php echo $time;?>分</p>
		  <p>テストのテーマ:IT日本語</p>
		  
		</div>

<?php 
	$correct_per = round((intval($hit)/intval($total))*100,2);
	$incorrect_per = round(((intval($total)-intval($hit))/intval($total))*100,2);
	$notattempt_per = round(((intval($total)-intval($mark))/intval($total))*100,2);
?>
			<div>
                    <div class="width3">
                      
                      <hr />
                      <table class="no-style full" cellpadding="0" cellspacing="0" border="0">
                        <tbody>
                          <tr>
                            <td style="padding-left:10px;">正しい</td>
                            <td class="ta-right"><?php echo $hit; ?>/<?php echo $total; ?></td>
                            <td><div value="1" id="progress1" class="progress full progress-green"><span style="width: <?php echo $correct_per; ?>%; display: block;"><b style="display: inline;"><?php echo $correct_per; ?>%</b></span></div></td>
                          </tr>
                          <tr>
                            <td style="padding-left:10px;">正しくない</td>
                            <td class="ta-right"><?php $incorrect = intval($total) - intval($hit);
                            	echo $incorrect; ?>/<?php echo $total; ?></td>
                            <td><div value="2" id="progress2" class="progress full progress-red"><span style="width: <?php echo $incorrect_per; ?>%; display: block;"><b style="display: inline;"><?php echo $incorrect_per; ?>%</b></span></div></td>
                          </tr>
                          
                          <tr>
                            <td style="padding-left:10px;">選ぶ</td>
                            <td class="ta-right"><?php
                            	$not_attempt = intval($total) - intval($mark); 
                            	echo $not_attempt; ?>/<?php echo $total; ?></td>
                            <td><div value="2" id="progress3" class="progress full progress-blue"><span style="width: <?php echo $notattempt_per; ?>%; display: block;"><b style="display: inline;"><?php echo $notattempt_per; ?>%</b></span></div></td>
                          </tr>
                          <tr>
                            <td style="padding-left:10px;">選ばない</td>
                            <td class="ta-right"><?php echo $mark; ?>/<?php echo $total; ?></td>
                            <td><div value="2" id="progress4" class="progress full progress-orange"><span style="width: <?php echo (100-$notattempt_per); ?>%; display: block;"><b style="display: inline;"><?php echo (100-$notattempt_per); ?>%</b></span></div></td>
                          </tr>
                          <tr>
                            <td colspan="3" style="padding-left:10px;" align="center">
                            <span style="font-weight: bold"><a href="javascript:showQuesSec(0);" style="font-family:Trebuchet MS; font-size:13px; color:#484848; text-decoration:none;">実施したテストを見る</a> 
                            | <a href="#" style="font-family:Trebuchet MS; font-size:13px; color:#484848; text-decoration:none;"授業を見る</a>
                            | <a href="#" style="font-family:Trebuchet MS; font-size:13px; color:#484848; text-decoration:none;">次のテストをする</a></span>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                </div>

	</body>
</html>