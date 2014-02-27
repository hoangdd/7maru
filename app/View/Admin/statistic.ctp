<?php 
/**
*     statistic.ctp
*     @author Hoang Dac
*     Teacher's statistic view
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
$beginDate = '21/2/2013';
//====================
?>
<!-- script to draw chart -->
<script type="text/javascript">
        // Load the Visualization API and the piechart package.
        google.load('visualization', '1', {'packages':['corechart']});

      // Set a callback to run when the Google Visualization API is loaded.    
      // google.setOnLoadCallback(drawVoteChart);
      // google.setOnLoadCallback(drawPurchaseChart);

      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
      var unit = 'views';
      var dataArray = ([['day','number'],[1,2],[2,3],[3,4]]); 
      options = {
                           title: 'Number of '+unit,             
                           width: '100%',
                           height:'100%',
                           hAxis: {title: 'day'},
                           vAxis: {title: unit},                  
                           legend: 'none',
                     };   
      google.setOnLoadCallback(function(){drawChart(dataArray,options)});
      function drawChart(dataArray,options) {               
            data = google.visualization.arrayToDataTable(dataArray);
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
            <div class='col-md-12'>                    
                  <div class='col-md-6' style='border-right:1px solid #cccccc'>
                        <p>Today: 
                              <script>today = new Date()
                              var dd = today.getDate();
                              var mm = today.getMonth()+1; //January is 0!

                              var yyyy = today.getFullYear();
                              if(dd<10){dd='0'+dd} if(mm<10){mm='0'+mm} today = mm+'/'+dd+'/'+yyyy;
                              document.write(today);
                              </script>
                        </p>     
                        <ul class="list-group">
                            <li class="list-group-item">
                                <span class="badge">14</span>
                                The number of views
                              </li>
                              <li class="list-group-item">
                                <span class="badge">14</span>
                                The number of votes
                              </li>
                              <li class="list-group-item">
                                <span class="badge">14</span>
                                The number of purchases
                              </li>                              
                        </ul>                   
                  </div>
                  <div class='col-md-6'>
                        <p>From the begin: <?php echo $beginDate; ?></p>
                         <ul class="list-group">
                            <li class="list-group-item">
                                <span class="badge">124</span>
                                The total of views
                              </li>
                              <li class="list-group-item">
                                <span class="badge">124</span>
                                The total of votes
                              </li>
                              <li class="list-group-item">
                                <span class="badge">124</span>
                                The total of purchases
                              </li>                              
                        </ul>       
                  </div>
                  <div class='col-md-4'>

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
                  <ul class="nav nav-pills nav-stacked">
                        <li class="active"><a href="#" id="views">Views</a></li>
                        <li><a href="#" id="votes">Votes</a></li>
                        <li><a href="#" id="purchases">Purchases</a></li>
                  </ul>
            </div>
            <div class='col-md-10 char-div' id='chart_div'>
                  <!--  chart will be showed here-->
            </div>
      </div>
      <div class="row">
            <!-- general statistic -->

      </div>

      <script type="text/javascript">
      $(document).ready(function(){       
            $("ul.nav li a").click(function(){
                  $("ul.nav li.active").removeClass('active');
                  $(this).parent("li").addClass('active');                        
                  var unit = $(this).attr('id');
                        //do change chart here  
                        //dataArray will be get by ajax
                        var dataArray = ([['day','number'],[1,2],[2,3],[3,4]]); 
                        options = {
                           title: 'Number of '+unit,             
                           width: '100%',
                           height:'100%',
                           hAxis: {title: 'day'},
                           vAxis: {title: unit},                  
                           legend: 'none',
                     };   
                     drawChart(dataArray,options);                               
                     return false;
               })                  
      })
      </script>  