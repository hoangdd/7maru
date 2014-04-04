<?php
	//@hoangdd
?>
<li class='lesson-book'>
	<div class="bk-book book bk-bookdefault">
		<div class="bk-front" style="background-image: url(<?php echo '/7maru/app/webroot/img/'.LESSON_COVER_LINK.$lesson['Lesson']['cover'];?>);	">
		</div>
	</div>
	<div class="bk-info">
		<span>
			<?php
				$options = array(
						'coma_id' => $lesson['Lesson']['coma_id'],
						'stars' => $lesson['RateLesson'],
						'width' => 20,
						'height' => 20,						
				);
				$options['rateAllow'] = 0;						
				echo $this->element('star_rank', array(
					'options' => $options
					)
				)				
			?>			
		</span>
		<br>
		<button class = 'buy-button' id='buy-button-<?php echo $lesson['Lesson']['coma_id'] ?>' >
			<?php echo __('Buy') ?>
		</button>
		<button>
			<?php
				echo $this->Html->link(__('View'), array(
						'controller' => 'Lesson',
						'action' => 'Index',
						$lesson['Lesson']['coma_id']
					))
			?>
		</button>

		<h3>
			<span>
				<?php
				if(isset($lesson['Author']['firstname']) && isset($lesson['Author']['lastname']))
					echo $lesson['Author']['firstname'].' '.$lesson['Author']['lastname'];
				else if(isset($lesson['Author']['firstname'])) echo $lesson['Author']['firstname'];
				else if(isset($lesson['Author']['lastname'])) echo $lesson['Author']['lastname'];
				else echo 'Undefined Author';
				?>
			</span>
			<span>
				<?php
				if(isset($lesson['Lesson']['title'])) 
					echo $lesson['Lesson']['title']; 
				else echo 'No Title';
				?>
			</span>
			
		</h3>
		<p>
			<?php
			if(isset($lesson['Lesson']['description'])) 
				echo $lesson['Lesson']['description'];
			?>
		</p>
	</div>
</li>
