<?php 
/**
*	statistic.ctp
*	Created by Hoang Dac
*	Teacher's statistic view
*/
//====================
//particular lib
echo $this->Html->script('chartapi');
//====================

//====================
// Sample data
$sttBy = 'week'; // statistic by week
$day = 21; $month = 2; $year = 2014;
$days = array(21,22,23,24,25,26,27);
$viewNums = array(1,2,3,4,10,20,30);
$voteNums = array(1,2,3,4,1,2,3);
$purchaseNums = array(1,2,3,4,1,2,3);
//====================
?>
<!-- script to draw chart -->
<script type="text/javascript">
	  // Load the Visualization API and the piechart package.
      google.load('visualization', '1', {'packages':['corechart']});

      // Set a callback to run when the Google Visualization API is loaded.
      google.setOnLoadCallback(drawViewChart);
      google.setOnLoadCallback(drawVoteChart);
      google.setOnLoadCallback(drawPurchaseChart);

      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.

	var days = <?php echo json_encode($days); ?>;
	var viewNums = <?php echo json_encode($viewNums); ?>;
	var voteNums = <?php echo json_encode($voteNums); ?>;
	var purchaseNums = <?php echo json_encode($purchaseNums); ?>;
	var i; 
	var dayNums = days.length;	
	var dataArray = new Array;
	dataArray[0] = ['day','number'];
	for (i=1; i<dayNums; i++){
		dataArray[i] = new Array;
		dataArray[i][0] = days[i];		
		dataArray[i][1] = viewNums[i];
	}
	function drawViewChart() {				
	  	var data = google.visualization.arrayToDataTable(dataArray);

		var options = {
		    title: 'Number of views through this '+<?php  echo '\''.$sttBy.'\'' ?>,
		    hAxis: {title: <?php echo '\''.$year.'\'' ?> + ' year'},
		    vAxis: {title: 'Views'},
		    legend: 'none',
	  	};
  		var chart = new google.visualization.LineChart(document.getElementById('chart_div_views'));
  		chart.draw(data, options);
	}
	for (i=1; i<dayNums; i++){			
		dataArray[i][1] = voteNums[i];
	}
	function drawVoteChart() {				
	  	var data = google.visualization.arrayToDataTable(dataArray);

		var options = {
		    title: 'Number of vote through this '+<?php  echo '\''.$sttBy.'\'' ?>,
		    hAxis: {title: <?php echo '\''.$year.'\'' ?> + ' year'},
		    vAxis: {title: 'Vote'},
		    legend: 'none',
	  	};
  		var chart = new google.visualization.LineChart(document.getElementById('chart_div_votes'));
  		chart.draw(data, options);
	}
	for (i=1; i<dayNums; i++){			
		dataArray[i][1] = purchaseNums[i];
	}
	function drawPurchaseChart() {				
	  	var data = google.visualization.arrayToDataTable(dataArray);
		var options = {
		    title: 'Number of purchase through this '+<?php  echo '\''.$sttBy.'\'' ?>,
		    hAxis: {title: <?php echo '\''.$year.'\'' ?> + ' year'},
		    vAxis: {title: 'Purchase'},
		    legend: 'none',
	  	};
  		var chart = new google.visualization.LineChart(document.getElementById('chart_div_purchases'));
  		chart.draw(data, options);
	}
</script>
<!-- main interface -->
<!-- Option to the statistics follow by : week,month,year -->
<div class='row'>
	<!-- choose for statistics by week -->
	<div class='col-md-3 stt-op'>Week</div>
	<!-- choose for statistics by month -->
	<div class='col-md-3 stt-op'>Month</div>
	<!-- choose for statistics by year -->
	<div class='col-md-3 stt-op'>Year</div>
</div>
<!-- graphs -->
<div class='row'>
	<!--for number of views -->
	<div class='row'>
		<p class='stt-figure'>The number of views: <?php echo $viewNums[2]; ?> </p>
		<div id='chart_div_views'></div>
	</div>
	<!--for number of votes -->
	<div class='row'>
		<p class='stt-figure'>The number of votes: <?php echo $voteNums[2]; ?></p>
		<div id='chart_div_votes'></div>
	</div>
	<!--for number of purchases -->
	<div class='row'>
		<p class='stt-figure'>The number of purchases: <?php echo $purchaseNums[2]; ?></p>
		<div id='chart_div_purchases'></div>
	</div>
</div>
