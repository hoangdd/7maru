<?php
	/** 
	*	index.ctp
	*	lession review page of Student
	*	@author: Hoang Dac
	*/
	
	//================
	// sample variable for lesson data		
	$lesson = array(
		'description' => 'Cuon nay hay vl',
		'author'	=> 'Bloodfire',
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
    	<div class='col-md-3 text-center'>
    	<!-- Left col: Image and ranhking-->
    		<?php 
    			echo $this->Html->image($lesson['image']); 
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
			
			
			<?
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
    	<div class='col-md-6'>
    	<!-- Lesson detail-->
    	<?php 
    		echo '<h1>'.$lesson['title'].'</h1>';
    		echo '<h2>'.$lesson['author'].'</h2>';	    		    			
    		echo '<p class="text-right">';
    		echo $this->Html->link(
    			$lesson['author'].' profile',
    			array(
    				'controller' => 'teacher',
    				'action' => 'profile',$lesson['authorId']
    			)
    		);
    	?>
			<div class='description'>
				<p>Lesson description: </p>    		
				<p><?php echo $this->Text->autoParagraph($lesson['description'])  ?></p>
			</div>
			<div class='tag_list'>
			<?php 
				foreach ($lesson['tags'] as $tags):
					echo '<span class="btn">'.$tags.'</span>';					
				endforeach;
			?>
			</div>			
    	</div>
    </div>
 <!-- --> 
 
 <!-- recommendation ( waitting for slide list) -->
    <div class='row'>
    	<h2 class='text-left'> Relative lesson </h2>
    	<?php
    	/*
    		foreach ($recommendLesson as $recommned):    			
    		endforeach;
    	*/
    	?>    	
    </div>    
<!-- -->