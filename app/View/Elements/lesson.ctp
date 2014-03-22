<li class='lesson-book'>
	<div class="bk-book book bk-bookdefault">
		<div class="bk-front" style="background-image: url(<?php echo '/7maru/app/webroot/img/'.LESSON_COVER_LINK.$lesson['Lesson']['cover'];?>);	">
		</div>
	</div>
	<div class="bk-info">
		<span>
			<?php
				echo $this->element('star_rank', array(
					'options' => array(
						'coma_id' => $lesson['Lesson']['coma_id'],
						'stars' => $lesson['RateLesson'],
						'width' => 20,
						'height' => 20
						)
					))
			?>
		</span>
		<br>
		<button>
			<a href='#'><?php echo __('Buy') ?></a>
		</button>
		<button>
			<?php
				echo $this->Html->link(__('View'), array(
						'controller' => 'Lesson',
						'action' => 'View',
						$lesson['Lesson']['coma_id']
					))
			?>
		</button>

		<h3>
			<span>
				<?php echo $lesson['Lesson']['Author']['firstname'].' '.$lesson['Lesson']['Author']['lastname']?>
			</span>
			<span>
				<?php echo $lesson['Lesson']['title']; ?>
			</span>
			
		</h3>
		<p>
			<?php echo $lesson['Lesson']['description'];?>
		</p>
	</div>
			<?php echo '...'; ?>
</li>
