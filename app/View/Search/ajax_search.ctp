<?php
if( !empty($data['Lesson'])) :
?>
	<h1>Lesson</h1>
	<?php 
		foreach ($data['Lesson'] as $key => $value) {
			echo '<div>';
			echo $this->Html->link($value['Lesson']['name'], array(
					'controller' => 'Lesson',
					'action' => 'index',
					$value['Lesson']['coma_id']
				));
			echo '</div>';
			echo '<div>';
			echo $value['Lesson']['name'].'...'.$value['Lesson']['title'].'...'.$value['Lesson']['description'].'...';
			echo '</div>';
			echo '<hr>';
		}
	?>
<?php
endif;

if( !empty($data['User'])) :
?>
	<h1>Teacher</h1>
	<?php 
		foreach ($data['User'] as $key => $value) {
			echo '<div>';
			echo $this->Html->link($value['User']['username'], '#');
			echo '</div>';
			echo '<div>';
			echo $value['User']['username'].'...'.$value['User']['lastname'].'...'.$value['User']['address'].'...'
								.$value['User']['phone_number'].'...'.$value['User']['mail'].'...';
			echo '</div>';
			echo '<hr>';
		}
	?>
<?php
endif;

?>