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

$total = 0;
$count = count($dataToChart['Money']);
for ($i = 1; $i< $count; $i++ ){
  $total = $total + $dataToChart['Money'][$i][1];
}
$total = $total * Configure::read('customizeConfig.money_per_lesson') * (1 - Configure::read('customizeConfig.teacher_profit_percentage')/100);
//====================
?>
<!-- script to draw chart -->
<script type="text/javascript">
      // Load the Visualization API and the piechart package.      
      //======show datepicker
      $(document).ready(function(){         
            $("#dp2").datepicker({
                  format:"dd-mm-yyyy",
                  date: <?php echo "'".$util->convertDate($begin)."'" ?>
            });
            $("#dp2").datepicker('setValue',<?php echo "'".$util->convertDate($begin)."'" ?>);
            $("#dp3").datepicker({
                  format: "dd-mm-yyyy",                  
            });
            $("#dp3").datepicker('set','today');
      })
</script>
      <!-- main interface -->
      <!-- Option to the statistics follow by : week,month,year -->      
      <div class="row">
            <!-- information -->
                    

      </div>
      <div class="row">
            <div class='col-md-12'>                    

              <h2 class='text-center'><?php echo __('From the begin').':' ?> <?php echo $util->convertDate($begin); ?></h2>                                                                      
              <h1 class='text-center'>
                <?php echo __("Total of Money").":"; ?>   
                <span><?php echo $total ?></span>
              </h1>          
              <div class="row">
              <?php echo "<p class='title'>". __("Top 3 bought lesson")."</p>";
              foreach($top3BoughtLesson as $lesson){                                    
                  echo "<div style='float:left;margin:20px' class='text-center'>";
                echo $this->Html->image((LESSON_COVER_LINK.$lesson['Lesson']['cover']), array(
                  'alt' => 'profile',
                  'class' => 'img-rounded mini_profile',
                  'style' => 'margin:10px',
                  'url' => array('controller' => 'lesson', 'action' => 'index', $lesson['Lesson']['coma_id'])
                  ));                                               
               $options = array();
                   $options['stars'] =   $lesson['rate'];      
                   $options['width'] = 20;
                   $options['height'] = 20;
                   $options['coma_id']  = $lesson['Lesson']['coma_id'];
                   $options['rateAllow'] = 0;
                   if(isset($user)){
                      $options['user_id'] = $user['user_id'];
                   }
                    echo $this->element('star_rank',array(
                    'options' => $options,                
                    ));
          //______________________
          //created date                                                             
                    echo "<p class='text-primary'>".$lesson['Lesson']['name']."</p>";
                    echo '<p>'.__('Rate point').': <b class="index">'.$lesson['rate'].'</b>  / '.__('Buy').': <b class="index">'.$lesson['buy_num'].'</b></p>';  
                    echo "</div>";       
              }                                                
              ?>  
              </div>
              <div class = "row">                            
                <?php echo "<p class='title'>".__("Top 3 favourite lesson")."</p>";                                
                foreach($top3FavouriteLesson as $lesson){                                    
                  echo "<div style='float:left;margin:20px' class='text-center'>";
                  echo $this->Html->image((LESSON_COVER_LINK.$lesson['Lesson']['cover']), array(
                    'alt' => 'profile',
                    'class' => 'img-rounded mini_profile',
                    'style' => 'margin:10px',
                    'url' => array('controller' => 'lesson', 'action' => 'index', $lesson['Lesson']['coma_id'])
                    ));      
                    $options = array();
                   $options['stars'] =   $lesson['rate'];      
                   $options['width'] = 20;
                   $options['height'] = 20;
                   $options['coma_id']  = $lesson['Lesson']['coma_id'];
                   $options['rateAllow'] = 0;
                   if(isset($user)){
                      $options['user_id'] = $user['user_id'];
                   }
                    echo $this->element('star_rank',array(
                    'options' => $options,                
                    ));
          //______________________
          //created date                                                             
                    echo "<p class='text-primary'>".$lesson['Lesson']['name']."</p>";
                    echo '<p>'.__('Rate point').': <b class="index">'.$lesson['rate'].'</b>  / '.__('Buy').': <b class="index">'.$lesson['buy_num'].'</b></p>';  
                    echo "</div>";
                }
              ?>
            </div>
            </div>            
      </div>
      <!-- statistic by time -->
      <div class="row">
            <p class='title'><?php echo __("Statistic by time") ?></p>
      </div>
      <div class="row">
            <div class='col-md-8 col-md-offset-1 from-to-date'>
                  <div class='col-md-5'>                                    
                        <div class="col-md-3"><?php echo __("From") ?></div>
                        <div class="col-md-9 date">
                              <input class="form-control" id="dp2" readonly=""/>
                        </div>                      
                  </div> 
                  <div class='col-md-5'>
                        <div class="col-md-3 text-right"><?php echo __("To"); ?></div>
                        <div class="col-md-9 date">
                              <input class="form-control" id="dp3" readonly=""/>
                        </div>
                        
                  </div>
                  <div class='col-md-2'>
                    <button id = "load_button" type="button" class="btn btn-warning">
                      <span class="glyphicon glyphicon-repeat"></span> <?php echo __('Load') ?>
                    </button>

                  </div>
            </div>
      </div>      
      <p></p>
      <div class='row'>
            <div class='col-md-2'>
                  <ul class="chart nav nav-pills nav-stacked">
                        <li class="active"><a href="#" id="money"><?php echo __("Money"); ?></a></li>
                        <li><a href="#" id="sale_category"><?php echo __("Sale category") ?></a></li>
                        <li><a href="#" id="favourite_category"><?php echo __("Favourite category") ?></a></li>
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
      google.load('visualization', '1', {'packages':['corechart']});      
      var dataArray = eval('(<?php echo json_encode($dataToChart) ?>)');      
      options = {
       title: 'Money',             
       width: '100%',
       height:'100%',
       hAxis: {title: 'day'},
       vAxis: {title: 'Money'},                  
       legend: 'none',
    };   
      google.setOnLoadCallback(function(){drawLineChart(dataArray['Money'],options)});
      function drawPieChart(dataArray,options) {               
            data = google.visualization.arrayToDataTable(dataArray);
            var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
            chart.draw(data, options);
      }
      function drawLineChart(dataArray,options) {               
            data = google.visualization.arrayToDataTable(dataArray);
            var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
            chart.draw(data, options);
      }
      $(document).ready(function(){ 
            //========================
            //load button click
            //========================
            $("#load_button").click(function(){
              $.ajax({
                type:'post',               
                data: {begin: $("#dp2").val(), end:$("#dp3").val() },
                url: "<?php $this->Html->url(array('action' => 'getDataStatistic')) ?>",
                dataType: 'json',
              }).done(function(result){
                dataArray = result;
              });
              var active = $("ul.chart li.active a")[0];
              var unit = $(active).attr('id');
                        //do change chart here  
                        //dataArray will be get by ajax                
                  var  options = {};   
                  if (unit == 'money'){
                    options.title = 'Money';                                      
                    drawLineChart(dataArray['Money'],options);
                  }
                  else if (unit == 'sale_category'){
                    options.title = 'Sale Category Rate';                   
                    options.is3D = true;
                    drawPieChart(dataArray['most_bought'],options);
                  }
                  else if (unit == 'favourite_category'){
                    options.title = 'Favourite Category Rate';
                    options.is3D = true;
                    // drawPieChart(dataArray['favourite_category'],options);
                    drawPieChart(dataArray['favourite_category'],options);
                  }
            });
            //========================
            //Change chart
            //========================
            $("ul.chart li a").click(function(){
                  $("ul.chart li.active").removeClass('active');
                  $(this).parent("li").addClass('active');                        
                  var unit = $(this).attr('id');
                        //do change chart here  
                        //dataArray will be get by ajax                
                  var  options = {};   
                  if (unit == 'money'){
                    options.title = 'Money';                                      
                    drawLineChart(dataArray['Money'],options);
                  }
                  else if (unit == 'sale_category'){
                    options.title = 'Sale Category Rate';                   
                    options.is3D = true;
                    drawPieChart(dataArray['most_bought'],options);
                  }
                  else if (unit == 'favourite_category'){
                    options.title = 'Favourite Category Rate';
                    options.is3D = true;
                    // drawPieChart(dataArray['favourite_category'],options);
                    drawPieChart(dataArray['favourite_category'],options);
                  }                    
                  return false;
            })                  
      }) 
</script>  

      <style>
        .index{
          color:red;
          font-size: large;
        }
      </style>