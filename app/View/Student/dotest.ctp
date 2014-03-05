<?php

/* If you refresh the page
   or
   leave the page to browse and come back
   then the timer will continue to count down until finished. */

// $minutes and $seconds are added together to get total time.
$minutes = 1; // Enter minutes
$seconds = 0; // Enter seconds
$time_limit = ($minutes * 60) + $seconds + 1; // Convert total time into seconds
if(!isset($_SESSION["start_time"	])){$_SESSION["start_time"] = mktime(date(G),date(i),date(s),date(m),date(d),date(Y)) + $time_limit;} // Add $time_limit (total time) to start time. And store into session variable.
?>
<div class="row">
  <div class="col-md-8">
  	<h3> Question </h3>
  	 
		<table width=100%> <tr> <td width=30>&nbsp;<td> <table border=1>
		<?php 
				foreach($test_list as $key => $value) {
				echo "<tR><td><span class=style2><h3>".$key."</h3>".$value['content']."</style>";
				$ignore = 0;
				foreach($value as $keyItem => $valueItem) {
					
					//if((strcmp($keyItemStr,"content")!=0) || (strcmp($keyItemStr,"mark")!=0)) {
					if($ignore!=0 && $ignore != count($value)-1) {
						echo "<tr><td class=style8>".$keyItem[6].".".$valueItem;
					}
					$ignore++;
				} 
			}
		?>
		
	
</table></table>
  </div>
  <div class="col-md-4">
  	<h3> Answer </h3>
  	
  	<?php echo $this->Form->create('Student',
  		array( 'url' => array('controller' => 'student', 'action' => 'viewtestresult')
  			)
  			);
  		 ?>
	  <table width=100%> <tr> <td width=30>&nbsp;<td> <table border=0>
	  <?php 
				foreach($test_list as $key => $value) {
				echo "<tR><td><span class=style2><h3>"."</h3></style>";
				$ignore = 0; $opt;
				foreach($value as $keyItem => $valueItem) {
					
					//if((strcmp($keyItemStr,"content")!=0) || (strcmp($keyItemStr,"mark")!=0)) {
					if($ignore!=0 && $ignore != count($value)-1) {
						if($ignore == 1) $opt = array($keyItem => intval($keyItem[6]));
						else $opt += array($keyItem => intval($keyItem[6]));
						//echo $this->Form->inputs(array('name' => array('type' => 'radio','value' =>intval($keyItem[6]))));
						//echo "<input type=radio name=ans value=".intval($keyItem[6]).">";
						
						//echo $this->Form->radio($keyItem, array($keyItem => intval($keyItem[6])));
					}
					$ignore++;
				}
				echo $this->Form->radio($key, $opt); 
			}
		?>
			<tR><td><span class=style2><h3>Time :</h3>
				<?php 
					echo $this->Form->input('Student.timer', array(
				    	'type' => 'text',
				    	'id' => 'txt',
				    	'disable' => 'disable'
						));
				?> 
				
			</style>
			<script>
var ct = setInterval("calculate_time()",100); // Start clock.
function calculate_time()
{

 var end_time = "<?php echo $_SESSION["start_time"]; ?>"; // Get end time from session variable (total time in seconds).
 var dt = new Date(); // Create date object.
 var time_stamp = dt.getTime()/1000; // Get current minutes (converted to seconds).
 var total_time = end_time - Math.round(time_stamp); // Subtract current seconds from total seconds to get seconds remaining.
 var mins = Math.floor(total_time / 60); // Extract minutes from seconds remaining.
 var secs = total_time - (mins * 60); // Extract remainder seconds if any.
 if(secs < 10){secs = "0" + secs;} // Check if seconds are less than 10 and add a 0 in front.
 document.getElementById("txt").value = mins + ":" + secs; // Display remaining minutes and seconds.
 // Check for end of time, stop clock and display message.
 if(mins <= 0)
 {
  if(secs <= 0 || mins < 0)
  {
   clearInterval(ct);
   document.getElementById("txt").value = "0:00";
   document.getElementById("submitButton").disabled = true; 
   alert("The time is up.");
   }
  }
 }
</script>
			<tR><td><span class=style2>
			
				<?php
				$options = array(
				    'label' => 'サブメット',
				    'id' => 'submitButton',
				    'div' => array(
				        'class' => 'glass-pill',
				    )
				);
					echo $this->Form->end($options);
				 //echo $this->Form->end('Done'); ?>
				
				
			</style>
		</table></table>
		</form>
  </div>
</div>

<script type="text/javascript">countDown(5, "timer")</script>
