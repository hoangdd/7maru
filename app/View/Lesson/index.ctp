<?php
	/** 
	*	index.ctp
	*	lession review page of Student
	*	@author: Hoang Dac
	*/
	
	//================
	// sample variable for lesson data		
  echo $this->Html->css('common');
  $lesson = array(
    'description' => 'The lesson will support you about women. The more detail, it supplies a list of very interested video which will show you everything about women\'sbeauty, the most naturally excited beauty.',		
    'authorId' => '34wsdf',
    'title' => 'Victoria Secret',
    'image' => 'Victoria.jpeg',
    'tags' => array('math','18+'),
    'stars' => 2.5,
    'reader' => 4,
    'ranker' => 3,
    'buy_status' => 1,
    'created_date' => '2013/12/1',
    'materials' => array(),
    'tests' => array(
      )
    );
  $teacher = array(
    'image' => 'profile.jpg',
    'name' => 'agaraki yui',            
    'id' => 'afdf'
    );
  $recomendLesson = array(
    array(
     'name' => 'manh tren',
     'id' => 'asdfd'
     ),
    array(
     'name' => 'manh duoi',
     'id' => 'dgfg'
     )
    );
  $lesson['created_date'] = $util->convertDate($lesson['created_date']);

	//================
  ?>

  <!-- lesson information -->
  <div class='row'>
   <div class='col-md-4 text-center left-col'>
     <!-- Left col: Image and ranking-->
     <?php                 
     echo $this->Html->image($lesson['image'],array(
      'class' => 'img-rounded img-responsive',        
      )); 
     echo '<h1>'.$lesson['title'].'</h1>';
     echo '<p></p>';
    			//_____________________
    			//ranking by stars                   
     $options = array();
     $options['stars'] =   $lesson['stars'];      
     $options['width'] = 30;
     $options['height'] = 30;
     echo $this->element('star_rank',array(
      'options' => $options,                
      ));
    			//______________________
    			//created date
     echo '<p></p>';
     echo '<p class="text_center"> Created Date: <strong>'.$lesson['created_date'].'</strong> </p>';
     echo '<p>'.$lesson['stars'].' ranker / '.$lesson['reader'].' reader'.'</p>';
  
    			// [buy] button
     if ($lesson['buy_status']){
      echo $this->Form->create('Buy',array(
       'url' => array(
         'controller' => 'student',
         'action' => 'buy_lesson'
         )
       )); 
      $options = array(
       'label' => 'Buy',
       'div' => array(
         'class' => 'col-md-6 col-sm-offset-3 text-center',
         'style' => 'margin-bottom:10px'
         ),
       'class' => 'btn btn-lg btn-warning btn-block'
       );	
       echo $this->Form->submit('Buy',$options);	              
    }
    ?>    
  </div>
  <div class='col-md-8'>
   <!-- Lesson detail-->    

   <!-- author info -->
   <div class='row'>                     
    <div class="col-md-3 text-center">
     <?php     		            
     echo $this->Html->image("profile.jpg", array(
      'alt' => 'profile',
      'class' => 'img-rounded mini_profile',                
      'url' => array('controller' => 'teacher', 'action' => 'profile', $teacher['id'])
      ));
     echo '<p>';
     echo $this->Html->link($teacher['name'],array(
      'controller' => 'teacher',
      'action' => 'profile', $teacher['id']
      ));
     echo '</p>';                
     ?>
   </div>
 </div>
 <!-- end author col-md-3info-->

 <!-- Lesson content detail info -->
 <div class="row">
   <div class='description col-md-11'>
    <h4 class='text-muted'>Lesson description: </h4>    		
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
</div>
</div>
<!-- --> 

<!-- recommendation ( waitting for slide list) -->
<div class='row recommend-wrapper'>

  <h3 style='margin-left:10px;'> Relative lesson </h3>
</div>
