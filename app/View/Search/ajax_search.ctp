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
			echo 'Author: '.$value['User']['username'];
			echo '<br>';
			echo 'Category: ';
			foreach ($value['LessonCategory'] as $key => $category) {
				echo $category['Category']['name'].' - ';
			}
			echo '<br>';
			echo '</b>';
			$str = sprintf(__('Has %s document(s) and test(s)'), sizeof($value['Data']));
			echo $str;
			echo '<br>';
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
			echo $this->Html->link($value['User']['username'], array(
					'controller' => 'Teacher',
					'action' => 'Profile',
					$value['User']['user_id']
				));
			echo '</div>';
			echo '<div>';
			echo $value['User']['username'].'...'.$value['User']['lastname'].'...'.$value['User']['address'].'...'
								.$value['User']['phone_number'].'...'.$value['User']['mail'].'...';
			echo '</div>';
			echo $this->Html->link(__('Show all lesson of ').$value['User']['username'], array(
				'controller' => 'Search',
				'action' => 'index?author='.$value['User']['user_id'],
				));
			echo '<hr>';
		}
	?>
<?php
endif;

if( !empty($data['Category'])) :
?>
	<h3>Category</h3>
	<?php 
		foreach ($data['Category'] as $key => $value) {
			echo '<div>';
			echo $this->Html->link($value['Category']['name'], array(
				'controller' => 'Search',
				'action' => 'index?category='.$value['Category']['category_id'],
				));
			echo '</div>';
			echo '<div>';
			echo $value['Category']['name'].'...'.$value['Category']['description'];
			echo '</div>';
			echo $this->Html->link(__('Show all lesson of ').$value['Category']['name'], array(
				'controller' => 'Search',
				'action' => 'index?category='.$value['Category']['category_id'],
				));
			echo '<hr>';
		}
	?>
<?php
endif;

?>