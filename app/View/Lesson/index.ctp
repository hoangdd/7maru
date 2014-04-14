<?php
	/** 
	*	index.ctp
	*	lession review page of Student
	*	@author: Hoang Dac
	*/
	
	//================
	// sample variable for lesson data		
  echo $this->Html->css('common');

  $lesson['created_date'] = preg_split("/ /", $lesson['created']);
  $lesson['created_date'] = $lesson['created_date'][0];

	//================
  ?>

  <!-- lesson information -->
  <div class='row' style = 'border: 1px solid rgba(86,61,124,.2)'>
   <div class='col-md-3 text-center left-col'>
     <!-- Left col: Image and ranking-->
     <?php                           
      $cover = LESSON_COVER_LINK.$lesson['cover'];
     echo $this->Html->image($cover,array(
      'class' => 'img-rounded img-responsive',        
      'style' => 'margin:auto'
      )); 
     echo "<h2 style = 'color:red'>".$lesson['name'].'</h2>';
     echo '<p></p>';
    			//_____________________
    			//ranking by stars                   
     $options = array();
     $options['rateAllow'] = 0;
     if ($user['user_type'] == 2)
        $options['rateAllow'] = 1;
     $options['stars'] =   $lesson['stars'];      
     $options['width'] = 30;
     $options['height'] = 30;
     $options['coma_id'] = $lesson['coma_id'];
     $options['action'] = '/'.FILL_CHARACTER.'/Lesson/rate';
     if(isset($user)){
        $options['user_id'] = $user['user_id'];
     }
     echo $this->element('star_rank',array(
      'options' => $options,                
      ));
    			//______________________
    			//created date
     echo '<p></p>';
     echo '<p class="text_center">'. __('Created Date').': <br><strong>'.$lesson['created'].'</strong> </p>';
          echo '<p><strong><b>'.$lesson['stars'].'</b></strong> '.__('rate'). ' ||'.' <strong><b>'.$lesson['ranker'].'</b></strong>'.__('ranker').'(s)'.'</p>';
  
    			// [buy] button
     $options = array(            
       'class' => 'btn btn-lg btn-warning btn-block',
       'style' => 'margin-bottom:20px'
       ); 
     echo "<div class='col-md-6 col-sm-offset-3 text-center' id='div_buy_view'>";
     if (!$lesson['buy_status']){ 
      $options['id']  = 'buy-button';
      $options['label'] = __('Buy');
      echo $this->Form->button(__('Buy'),$options);	              
    }
    else{
       foreach ($file as $key => $value):
          if (!$value['isTest']){
            $firstComaId = $value['file_id'];
            break;
          }
        endforeach;
      echo $this->Html->link(__('View'), array(
            'controller' => 'Lesson',
            'action' => 'viewContent',
            $firstComaId
          ),
        $options
      );
    }
    echo "</div>";
    ?>    
  </div>
  <div class='col-md-8'>
   <!-- Lesson detail-->    

   <!-- author info -->
   <div class='row'>                     
    <div class="col-md-3 text-center">
     <?php     		                
     if ($author['profile_picture'] == null || $author['profile_picture'] === ''){
        $author_profile = DEFAULT_PROFILE_IMAGE;
     }
     else{
        $author_profile = IMAGE_PROFILE_LINK.DS.$author['profile_picture'];
     }
     echo $this->Html->image($author_profile, array(
      'alt' => __('Profile'),
      'class' => 'img-rounded mini_profile',                
      'url' => array('controller' => 'teacher', 'action' => 'profile', $author['user_id'])
      ));
     echo '<p>';
     echo $this->Html->link($author['firstname'].$author['lastname'],array(
      'controller' => 'teacher',
      'action' => 'profile', $author['user_id']
      ));
     echo '</p>';                
     ?>
   </div>
 </div>
 <!-- end author col-md-3info-->

 <!-- Lesson content detail info -->
 <div class="row">
   <div class='description col-md-12'>
    <h4 class='text-muted'><?php echo __('Lesson description').':' ?> </h4>    		
    <p class='content'><?php echo $lesson['description'] ?></p>
  </div>
</div>
<div class="row">
    <div class='tag_list'>
     <?php 
     foreach ($lesson['tags'] as $tags):
       echo '<span>'.$tags.'</span>';					
     endforeach;
     ?>
   </div>
 </div>
 <div class = 'row'>
      <div class="panel-body">
          <!-- content of lesson -->
          <div>
              <?php 
              if( isset($file) && !empty($file)){
                ?>
                <div class="list-group"> 
                <a class="list-group-item active"><?php echo __('Document') ?></a>               
                <ul class="list-group" id="list_file">
                <?php
                foreach ($file as $key => $value) {
                  if( !$value['isTest']){
                    if (!$lesson['buy_status']){
                      echo "<li class='list-group-item'><span class='glyphicon glyphicon-book'></span>".$value['file_name']."</li>";     
                    } 
                    else{
                      echo $this->Html->link($value['file_name'], 
                    array(
                      'controller' => 'Lesson',
                      'action' => 'viewContent',
                      $value['file_id']
                      ),
                    array(
                      'class' => "list-group-item"
                      )
                  );
                    }               
                  }
                }
                ?>
              </ul>
                </div>
                <div class="list-group">
                  <a class="list-group-item active"><?php echo __('Test') ?></a>
                  <ul class="list-group" id="list_test_file">
                  <?php       
                  foreach ($file as $key => $value) {
                    if($value['isTest']){
                     if (!$lesson['buy_status']){
                       echo "<li class='list-group-item'><span class='glyphicon glyphicon-book'></span>".$value['file_name']."</li>";       
                     }
                     else{
                      echo $this->Html->link("Test".$key, array(
                        'controller' => 'Student',
                        'action' => 'Exam?id='.$value['file_id']                        
                        ),
                      array(
                        'class' => "list-group-item"
                        )
                      );    
                    }  
                  }                  
                }
                echo "</ul></div>";
              }
              ?>              
                
        </div>
    </div>
</div>
</div>
</div>
<!-- --> 

<!-- recommendation ( waitting for slide list) -->
<div class='row recommend-wrapper panel panel-info'>
  <div class="panel-heading">
          <h2 class="panel-title"><?php echo __('Relative lesson') ?></h2>
        </div>  
  <div>
    <div class='panel-body'>
  <?php 
  foreach ($relativeLesson as $l):
    echo "<div class='text-center' style = 'float:left;margin-left:10px;'>";
      if ($l['Lesson']['cover'] == null || $l['Lesson']['cover'] == ''){
          $cover = DEFAULT_COVER_IMAGE;
       }
       else{
          $cover = LESSON_COVER_LINK.$l['Lesson']['cover'];
       }
       echo $this->Html->image($cover,array(
        'class' => 'img-rounded img-responsive mini_profile',        
        'url' => array('controller' => 'lesson', 'action' => 'index',$l['Lesson']['coma_id']),        
        )); 
       echo $this->Html->link($l['Lesson']['name'],array(
        'controller' => 'lesson', 
        'action' => 'index',
        $l['Lesson']['coma_id']
        ),
        array('style' => 'font-size: large')
       );       
       echo "</div>";
     endforeach;
     ?>
   </div>
</div>
</div>

<script>
  $(document).ready(function(){
    $("#buy-button").click(function(){      
      var r = confirm("<?php echo __('Confirm') ?>");      
      var coma_id = <?php echo $lesson['coma_id'] ?>;
      var result = false;
      if (r == true){               
          $.get(
            "<?php echo $this->Html->url(array('controller' => 'Lesson','action' => 'buy')) ?>" + "/" +  coma_id,
            function(data){             
              if (data.trim() === "1"){
                alert("<?php echo __('Transaction successfully') ?>");              
                result = true;                
              }             
            }
          );
        if (result){
          //reload page
          location.reload();
        }
      }       
      })
  });
</script>
