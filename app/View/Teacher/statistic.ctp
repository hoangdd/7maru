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
      // google.setOnLoadCallback(drawVoteChart);
      // google.setOnLoadCallback(drawPurchaseChart);

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
                  width: '100%',
                  height:200,
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
            $("#dp1").datepicker({
                  format:"dd-mm-yyyy"                  
            });
            $("#dp2").datepicker({
                  format:"dd-mm-yyyy"
            });
            $("#dp3").datepicker({
                  format: "dd-mm-yyyy"
            });
      })
      </script>
      <!-- main interface -->
      <!-- Option to the statistics follow by : week,month,year -->      
      <div class="row">
            <!-- information -->
           <p class='title'>Information figure</p>

      </div>
      <div class="row">
            <div class='col-md-10'>                    
                  <div class='col-md-3'>
                        <p>Choose date</p>                        
                        <input class="form-control" id = 'dp1' type="text" readonly="" />                             
                  </div>              
                  <div class ='col-md-7 col-md-offset-2'>                                                   
                        <p class='stt-figure'>The number of views: <?php echo $viewNumADay; ?> / The total of views </p>
                        <p class='stt-figure'>The number of votes: <?php echo $voteNumADay; ?> / The total of views </p>
                        <p class='stt-figure'>The number of purchases: <?php echo $purchaseNumADay; ?> / The total of views </p>
                        <p class='stt-figure'>The number of posts: <?php echo $purchaseNumADay; ?> / The total of views </p>
                  </div>
            </div>
            <div>

            </div>
      </div>
      <!-- statistic by time -->
      <div class="row">
            <p class='title'>Statistic by time</p>
      </div>
      <div class="row">
            <div class='col-md-8 col-md-offset-3 from-to-date'>
                  <div class='col-md-6'>                                    
                        <div class="col-md-2">From</div>
                        <div class="col-md-9 date">
                              <input class="form-control" id="dp2" readonly=""/>
                        </div>                      
                  </div> 
                  <div class='col-md-6'>
                        <div class="col-md-2 text-right">To</div>
                        <div class="col-md-9 date">
                              <input class="form-control" id="dp3" readonly=""/>
                        </div>
                        
                  </div>
            </div>
      </div>      
      <p></p>
      <div class='row'>
            <div class='col-md-2'>
                  <ul class="nav nav-tabs  nav-stacked">
                        <li class="active" disable='disable'><a href="#">Views</a></li>
                        <li><a href="#" disable='disable'>Votes</a></li>
                        <li><a href="#" disable='disable'>Purchases</a></li>
                  </ul>
            </div>
            <div class='col-md-10 char-div' id='chart_div'></div>
      </div>
      <div class="row">
            <!-- general statistic -->

      </div>