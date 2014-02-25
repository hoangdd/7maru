<?php 
/**
*	statistic.ctp
*	@author Hoang Dac
*	Teacher's statistic view
*/
//====================
//particular lib
echo $this->Html->script(array('chartapi','bootstrap-datepicker'));
echo $this->Html->css('datepicker');
//====================

//====================
// Sample data
$sttBy = 'week'; // statistic by week
$day = 21; $month = 2; $year = 2014;
$days = array(21,22,23,24,25,26,27);
$viewNumADay = 1;
$voteNumADay = 1;
$purchaseNumADay = 1;
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
      var data,options;
      function drawViewChart() {				
      	data = google.visualization.arrayToDataTable(dataArray);

      	options = {
      		title: 'Number of views through this '+<?php  echo '\''.$sttBy.'\'' ?>,
                  width: 400,
                  height: 240,
      		hAxis: {title: <?php echo '\''.$year.'\'' ?> + ' year'},
      		vAxis: {title: 'Views'},                  
      		legend: 'none',
      	};
      	var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
      	chart.draw(data, options);
      }
      for (i=1; i<dayNums; i++){			
      	dataArray[i][1] = voteNums[i];
      }
      function drawVoteChart() {				
      	data = google.visualization.arrayToDataTable(dataArray);

      	options = {
      		title: 'Number of vote through this '+<?php  echo '\''.$sttBy.'\'' ?>,
      		hAxis: {title: <?php echo '\''.$year.'\'' ?> + ' year'},
      		vAxis: {title: 'Vote'},
      		legend: 'none',
      	};
      	var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
      	chart.draw(data, options);
      }
      for (i=1; i<dayNums; i++){			
      	dataArray[i][1] = purchaseNums[i];
      }
      function drawPurchaseChart() {				
      	data = google.visualization.arrayToDataTable(dataArray);
      	options = {
      		title: 'Number of purchase through this '+<?php  echo '\''.$sttBy.'\'' ?>,
      		hAxis: {title: <?php echo '\''.$year.'\'' ?> + ' year'},
      		vAxis: {title: 'Purchase'},
      		legend: 'none',
      	};
      	var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
      	chart.draw(data, options);
      }

      //======show datepicker
      $(document).ready(function(){
            $("#dp3").datepicker();
      })
      </script>
      <!-- main interface -->
      <!-- Option to the statistics follow by : week,month,year -->      
      <div class="row">
            <!-- information -->
            <div class='col-md-2'><p class='tittle'>Information figure</p></div>
            <div class='col-md-10'>                  
                  <div class='row'>
                        <div class='col-md-3'>
                              <input class="form-control" id = 'dp3' size="16" type="text" value="12-02-2012" readonly="" />     
                        </div>
                  </div>                                                                 
                  <p class='stt-figure'>The number of views: <?php echo $viewNumADay; ?> </p>
                  <p class='stt-figure'>The number of votes: <?php echo $voteNumADay; ?> </p>
                  <p class='stt-figure'>The number of purchases: <?php echo $purchaseNumADay; ?> </p>                                          
            </div>

      </div>
      <!-- statistic by time -->
      <div class="row">
            <p class='tittle'>General statistic</p>
      </div>
      <div class="row">
            <div class='col-md-8 col-md-offset-4'>
                  <div class='col-md-6'>                                    
                        <span>From</span>
                        <div class='date-picker'> 
                              <div class="input-append date" id="dp3" data-date="12-02-2012" data-date-format="dd-mm-yyyy">
                                    <input class="col-md-2" size="16" type="text" value="12-02-2012" readonly="">
                                    <span class="add-on"><i class="icon-calendar"></i></span>
                              </div>
                        </div> 
                  </div> 
                  <div class='col-md-6'>
                        <span>To</span>
                        <div class='date-picker'> 
                              <div class="input-append date" id="dp3" data-date="12-02-2012" data-date-format="dd-mm-yyyy">
                                    <input class="col-md-2" size="16" type="text" value="12-02-2012" readonly="">
                                    <span class="add-on"><i class="icon-calendar"></i></span>
                              </div>                  
                        </div>      
                  </div>
            </div>
      </div>      
      <div class='row'>
            <div class='col-md-4'>
                  <ul class="nav nav-tabs  nav-stacked">
                        <li class="active" disable='disable'><a href="#">Views</a></li>
                        <li><a href="#" disable='disable'>Votes</a></li>
                        <li><a href="#" disable='disable'>Purchases</a></li>
                  </ul>
            </div>
            <div class='col-md-8' id='chart_div'></div>
      </div>
      <div class="row">
            <!-- general statistic -->

      </div>