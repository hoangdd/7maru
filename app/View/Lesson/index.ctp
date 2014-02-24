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
		'description' => 'The lesson will support you about women. The more detail, it supplies a list of very interested video which will show you everything about women\'beauty, the most naturally excited beauty.',		
		'authorId' => '34wsdf',
		'title' => 'Victoria Secret',
		'image' => 'Victoria.jpeg',
		'tags' => array('math','18+'),
		'stars' => 3,
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
	$starsImage = 'star.png';
	$starsBlurImage = 'blurStar.png';
	$__MAX_RANK = 5;
	//================
?>

<!-- lesson information -->
	<div class='row'>
    	<div class='col-md-4 text-center'>
    	<!-- Left col: Image and ranhking-->
    		<?php                 
    			echo $this->Html->image($lesson['image'],array('class' => 'img-rounded')); 
                echo '<h1>'.$lesson['title'].'</h1>';
    			echo '<p></p>';
    			//_____________________
    			//ranking by stars
    			for ($i=1; $i<=$lesson['stars']; $i++){
    				echo $this->Html->image($starsImage);
    			}
    			for ($i; $i <= $__MAX_RANK; $i++){
    				echo $this->Html->image($starsBlurImage);    				
    			}
    			//______________________
    			//created date
    			echo '<p></p>';
    			echo '<p class="text_center"> Created Date: <strong>'.$lesson['created_date'].'</strong> </p>';
    			echo '<p>'.$lesson['stars'].' ranker / '.$lesson['reader'].' reader'.'</p>';
			?> 
			
			
			<?php
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
    					),
    					'class' => 'btn btn-lg btn-warning btn-block'
    				);		
					echo $this->Form->end($options);
    			}
    			    			
    		?>
    		
    	</div>
    	<div class='col-md-8'>
    	<!-- Lesson detail-->    

        <!-- author info -->
        <div class='row'>                     
            <div class="col-md-3">
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
        <!-- end author info-->

        <!-- Lesson content detail info -->
			<div class='description clearfix'>
				<p class='text-muted'><strong>Lesson description: </strong></p>    		
				<p><?php echo $lesson['description'] ?></p>
			</div>
			<div class='tag_list'>
			<?php 
				foreach ($lesson['tags'] as $tags):
					echo '<span>'.$tags.'</span>';					
				endforeach;
			?>
			</div>			
    	</div>
    </div>
 <!-- --> 
 
 <!-- recommendation ( waitting for slide list) -->
    <div class='row'>
    	<div class='col-md-2 text-center'><h3> Relative lesson </h3></div>
    	<?php
    	/*
    		foreach ($recommendLesson as $recommned):    			
    		endforeach;
    	*/
    	?>    	
    </div>    
<!-- -->
