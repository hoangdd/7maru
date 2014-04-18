<?php
if( !empty($data['Lesson'])) :
?>
	<h3>Lesson</h3>
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
			echo '<b>';
			echo 'Author:'.$value['Lesson']['User']['username'];
			echo '<br>';
			echo 'Category:'.$value['Category']['name'];
			echo '<br>';
			echo '</b>';
			echo $value['Lesson']['name'].'...'.$value['Lesson']['title'].'...'.$value['Lesson']['description'].'...';
			echo '</div>';
			echo '<hr>';
		}
	?>
<?php
endif;

if( !empty($data['User'])) :
?>
	<h3>Teacher</h3>
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