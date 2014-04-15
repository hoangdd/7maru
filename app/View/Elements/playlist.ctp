<?php //playlist ?>
<?php 
	$list[2] = $list[1] = $list[0];
	$list[2]['Data']['file_id'] = $list[0]['Data']['file_id'] = 'xxxx';
	echo $this->Html->css('playlist.css');
	echo $this->Html->script('jquery');
?>

<?php echo $this->Html->scriptStart();?>
	$(document).ready(function(){
		$('#list-button').click(function(){
			if( $(this).hasClass('reverse')){
				$('.element:not(.current)').fadeIn(600);
			}else{
				$('.element:not(.current)').fadeOut(600);
			}
			$(this).toggleClass('reverse');
			$('.element.current').toggleClass('active');
		});
	});
<?php echo $this->Html->scriptEnd();?>
<div id='playlist'>
	<div class="list">
		<?php 
			if( !empty($list)) :
				foreach ($list as $key => $value) :
					
		?>
			<div class='element <?php if( $current == $value['Data']['file_id']) echo 'current';?>'>
				<?php
					if( !isset($value['Data']['isTest']) || $value['Data']['isTest'] != true){
						echo $this->Html->link($value['Data']['file_name'], array(
							'controller' => 'Lesson',
							'action' => 'viewContent',
							$value['Data']['file_id']
						), array());	
					}else{
						echo $this->Html->link($value['Data']['file_name'], array(
							'controller' => 'Student',
							'action' => 'DoTest',
							$value['Data']['file_id']
						), array());
					}
					
				?>
			</div>
		
		<?php
				endforeach;
			endif;
		?>
	</div>
	<?php if(sizeof($list)>1) : ?>
		<span id='list-button' class='reverse'>
			<?php echo $this->Html->image('down.png');?>
		</span>
	<?php endif;?>
</div>