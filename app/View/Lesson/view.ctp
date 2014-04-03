<?php
if(isset($data)) :
?>
	<?php
	/**
	*   view.ctp
	*   view content of lesson
	*   Author: HoangDD+ HoangNM
	*   Lesson: title, image, stars
	*/
		echo $this->Html->css('common');

		$lesson = $data['Lesson'];
		$user = $data['User'];
		//rate lesson
		if( isset($data['RateLesson']) && !empty($data['RateLesson'])){
			$number_rate = sizeof($data['RateLesson']);
			$sum = 0;
			foreach ($data['RateLesson'] as $value) {
				$sum += (float)$value['rate'];
			}
			$rate = $sum/(float)$number_rate;
		}else{
			$number_rate =0;
			$sum = 0;
			$rate = 0;
		}
		$lesson['created'] = date_create($lesson['created']); 
		$lesson['created'] = date_format($lesson['created'],'d-m-Y'); 
?>
	<!-- lesson information -->
	<div class="row">
		<div class='col-md-3 text-center'>
			<!-- Left col: Image and ranhking and vote stars-->
			<?php
					echo $this->Html->image(LESSON_COVER_LINK.$lesson['cover'],array('class' => 'img-rounded small_photo')); 
					echo '<p></p>';
					//Show title
					echo '<h1 class="text-center">'.$lesson['title'].'</h1>';
					echo '<p></p>';
					//_____________________
					//ranking by stars       
					$options = array();
					$options['coma_id'] = $data['Lesson']['coma_id'];
					$options['stars'] = $rate;
					$options['width'] = 30;
					$options['height'] = 30;
					echo $this->element('star_rank',array(
					'options' => $options,                
					));
					//Show author
					echo '<p></p>';
					echo $this->Html->image(IMAGE_PROFILE_LINK.$user['profile_picture'], array(
						'alt' => 'profile',
						'class' => 'img-rounded mini_profile',                
						'url' => array('controller' => 'teacher', 'action' => 'profile', $user['user_id'])
						));
					echo '<p>';
					echo __('Author'). ': ';
					echo $this->Html->link($user['firstname'].' '.$user['lastname'],array(
						'controller' => 'teacher',
						'action' => 'profile', $user['user_id']
						));
					echo '</p>';  
					//______________________
					//created date
					echo '<p></p>';
					echo '<p class="text_center">'. __('Created Date').': <br><strong>'.$lesson['created'].'</strong> </p>';
					echo '<p><strong><b>'.$sum.'</b></strong> '.__('rate'). ' ||'.' <strong><b>'.$number_rate.'</b></strong>'.__('ranker').'(s)'.'</p>';			
					
			?>
		</div>
		<div class='col-md-9'>
			<div class="panel panel-info">
				<!--panel header-->
				<div class="panel-heading">
					<h3 class="panel-title"><?php echo __('Content of Lesson') ?></h3>
				</div>
				<!--panel body-->
				<div class="panel-body">
					<!-- content of lesson -->
					<div>
						<?php 
						if( isset($data['File']) && !empty($data['File'])){
							?>
							<div class="list-group">
							<a href="#" class="list-group-item active"><?php echo __('Document') ?></a>
							<?php
							foreach ($data['File'] as $key => $value) {
								if( !$value['isTest']){
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
							?>
							</div>
							<div class="list-group">
							
							<?php				
							foreach ($data['File'] as $key => $value) {
								if($value['isTest']){
									echo $this->Html->link("Test".$key, array(
											'controller' => 'Student',
											'action' => 'Exam',
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
					</div>
				</div>
			</div>
		</div>
	</div>
<?php 
endif;
?>
