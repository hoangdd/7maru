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
$limit = 10;

usort($dataToChart['most_bought'],function($a,$b){ return ($a[1] < $b[1] ); });
$dataToChart['most_bought'] = array_slice($dataToChart['most_bought'], 0,$limit);
$dataToChart['most_bought'] = array_merge(array(array('category','buy_num')),$dataToChart['most_bought']);

usort($dataToChart['favourite_category'],function($a,$b){return ($a[1] < $b[1] ); });
$dataToChart['favourite_category'] = array_slice($dataToChart['favourite_category'], 0,$limit);
$dataToChart['favourite_category'] = array_merge(array(array('category','rate')),$dataToChart['favourite_category']);
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

              <h2 class='text-center'>From the begin: <?php echo $util->convertDate($begin); ?></h2>                                                                      
              <h1 class='text-center'>
                <?php echo __("Total of Money").":"; ?>   
                <span><?php echo $total ?></span>
              </h1>          
              <div class="row">
              <?php echo "<p class='title'>". __("Top 3 bought lesson: ")."</p>";
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
            <div class='col-md-8 col-md-offset-3 from-to-date'>
                  <div class='col-md-6'>                                    
                        <div class="col-md-2"><?php echo __("From") ?></div>
                        <div class="col-md-9 date">
                              <input class="form-control" id="dp2" readonly=""/>
                        </div>                      
                  </div> 
                  <div class='col-md-6'>
                        <div class="col-md-2 text-right"><?php echo __("To"); ?></div>
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
                        <li class="active"><a href="#" id="money"><?php echo __("Money"); ?></a></li>
                        <li><a href="#" id="sale_category"><?php echo __("Sale category") ?></a></li>
                        <li><a href="#" id="favorite_category"><?php echo __("Favorite category") ?></a></li>
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
            $("ul.nav li a").click(function(){
                  $("ul.nav li.active").removeClass('active');
                  $(this).parent("li").addClass('active');                        
                  var unit = $(this).attr('id');
                        //do change chart here  
                        //dataArray will be get by ajax
                        var test = [["category","rate"],["数学",1.75],["地理学",1.5],["Lớp 1",1.5],["Lớp 2",1.5]];
                  var  options = {};   
                  if (unit == 'money'){
                    options.title = 'Money';                                      
                    drawLineChart(dataArray['Money'],options);
                  }
                  else if (unit == 'sale_category'){
                    options.title = 'Sale Category Rate';
                    options.pieHole = 0.4;
                    options.is3D = true;
                    drawPieChart(dataArray['most_bought'],options);
                  }
                  else if (unit == 'favorite_category'){
                    options.title = 'Favorite Category Rate';
                    options.is3D = true;
                    // drawPieChart(dataArray['favourite_category'],options);
                    drawPieChart(test,options);
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