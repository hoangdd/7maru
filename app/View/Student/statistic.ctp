<?php
	// echo var_dump($courses);
?>
<div class="learning-course panel panel-danger">
	<div class="panel-heading">
    	<h3 class="panel-title">概要情報</h3>
  	</div>
	<table class = "table-hover table-striped table">
		<tr>
			<td>授業を買うためのお金</td>
			<td><?php echo $spentMoney.' VND' ;?></td>
		</tr>
		<tr>
			<td>買った授業の数</td>
			<td><?php echo count($courses).' コース' ;?></td>
		</tr>
		<tr>
			<td>レポートしたコース数</td>
			<td><?php echo count($reported_lessons).' コース' ;?></td>
		</tr>
		<tr>
			<td>ブロック数</td>
			<td><?php echo count($blockeds).' ケース' ;?></td>
		</tr>
		<tr>
			<td>レートした授業の数</td>
			<td><?php echo count($rates).' コース' ;?></td>
		</tr>
		<tr>
			<td>コメントした数</td>
			<td><?php echo count($comments).' コメント' ;?></td>
		</tr>
	</table>
</div>

<div class="learning-course panel panel-danger">
	<div class="panel-heading">
    	<h3 class="panel-title">いま勉強まだ勉強できる授業(買った授業)</h3>
  	</div>
	<div class='row panel-body' style = 'overflow-x: auto'>
			<!-- <div class="thumbnail"> -->
				
	<?php 
		foreach ($courses as $course) {
			// echo var_dump($course);
			if($course['learn_able'] === true){
	?>
			<div class='text-center left-col col-sm-3 col-md-3'>
			<?php
				// echo var_dump($course);
				$lesson = $course['lesson']; 
				$cover = LESSON_COVER_LINK.$lesson['Lesson']['cover'];
			     echo $this->Html->image($cover,array(
			      'class' => 'img-rounded img-thumbnail img-responsive',        
			      'style' => 'margin:auto'
			      )); 
			     // echo "<h3 style = 'font-weight:bold;color:red'>".$lesson['Lesson']['name'].'</h3>';
			 ?>
				 <div class="caption">
			        <h3><?php echo $this->Html->link($lesson['Lesson']['name'],array(
			        											'controller' => 'Lesson',
			        											'action' => 'index',
			        											$lesson['Lesson']['coma_id']
			        	)); ?>
			    	</h3>
				</div>
			</div>
		
	<?php	
			}	
		}
	?>
	</div>
</div>

<div class="learning-course panel panel-info">
	<div class="panel-heading">
    	<h3 class="panel-title">いま勉強まだ勉強できない授業(買った授業)</h3>
  	</div>
	<div class='row panel-body' style = 'overflow-x: auto'>
			<!-- <div class="thumbnail"> -->
				
	<?php 
		foreach ($courses as $course) {
			// echo var_dump($course);
			if($course['learn_able'] === false){
	?>
			<div class='text-center left-col col-sm-3 col-md-3'>
			<?php
				// echo var_dump($course);
				$lesson = $course['lesson']; 
				$cover = LESSON_COVER_LINK.$lesson['Lesson']['cover'];
			     echo $this->Html->image($cover,array(
			      'class' => 'img-rounded img-thumbnail img-responsive',        
			      'style' => 'margin:auto'
			      )); 
			     // echo "<h3 style = 'font-weight:bold;color:red'>".$lesson['Lesson']['name'].'</h3>';
			 ?>
				 <div class="caption">
			        <h3><?php echo $this->Html->link($lesson['Lesson']['name'],array(
			        											'controller' => 'Lesson',
			        											'action' => 'index',
			        											$lesson['Lesson']['coma_id']
			        	)); ?>
			    	</h3>
				</div>
			</div>
		
	<?php	
			}	
		}
	?>
	</div>
</div>

<div class="learning-course panel panel-info">
	<div class="panel-heading">
    	<h3 class="panel-title">レポートしたコース</h3>
  	</div>
	<div class='row panel-body' style = 'overflow-x: auto'>
			<!-- <div class="thumbnail"> -->
				
	<?php 
		foreach ($reported_lessons as $course) {
			// echo var_dump($course);
	?>
			<div class='text-center left-col col-sm-3 col-md-3'>
			<?php
				$lesson = $course['lesson']; 
				$cover = LESSON_COVER_LINK.$lesson['Lesson']['cover'];
			     echo $this->Html->image($cover,array(
			      'class' => 'img-rounded img-thumbnail img-responsive',        
			      'style' => 'margin:auto'
			      )); 
			 ?>
				 <div class="caption">
			        <h3><?php echo $this->Html->link($lesson['Lesson']['name'],array(
			        											'controller' => 'Lesson',
			        											'action' => 'index',
			        											$lesson['Lesson']['coma_id']
			        	)); ?>
			    	</h3>
				</div>
			</div>
		
	<?php	
		}
	?>
	</div>
</div>

<div class="learning-course panel panel-info">
	<div class="panel-heading">
    	<h3 class="panel-title">レートした授業の数</h3>
  	</div>
	<div class='row panel-body' style = 'overflow-x: auto'>
			<!-- <div class="thumbnail"> -->
				
	<?php 
		foreach ($rates as $course) {
			// echo var_dump($course);
	?>
			<div class='text-center left-col col-sm-3 col-md-3'>
			<?php
				$lesson = $course['lesson']; 
				$cover = LESSON_COVER_LINK.$lesson['Lesson']['cover'];
			     echo $this->Html->image($cover,array(
			      'class' => 'img-rounded img-thumbnail img-responsive',        
			      'style' => 'margin:auto'
			      )); 
			 ?>
				 <div class="caption">
			        <h3><?php echo $this->Html->link($lesson['Lesson']['name'],array(
			        											'controller' => 'Lesson',
			        											'action' => 'index',
			        											$lesson['Lesson']['coma_id']
			        	)); ?>
			    	</h3>
				</div>
			</div>
		
	<?php	
		}
	?>
	</div>
</div>

<div class="learning-course panel panel-info">
	<div class="panel-heading">
    	<h3 class="panel-title">ブロックされた</h3>
  	</div>
	<div class='row panel-body' style = 'overflow-x: auto'>
			<!-- <div class="thumbnail"> -->
				
	<?php 
		foreach ($blockeds as $blocked) {
			// echo var_dump($blocked['Teacher']);
	?>
			<div class='text-center left-col col-sm-2 col-md-2'>
			<div class="col-md-2 text-center">
		     <?php
		     		$author = $blocked['Teacher']['User'];     		                  
		        $author_profile = IMAGE_PROFILE_LINK.DS.$author['profile_picture'];     
				     echo $this->Html->image($author_profile, array(
				      'alt' => __('Profile'),
				      'class' => 'img-rounded mini_profile',                
				      'url' => array('controller' => 'teacher', 'action' => 'profile', $author['user_id'])
				      ));
				     echo '<p>';
				     echo $this->Html->link($author['firstname'].$author['lastname'],array(
				      'controller' => 'teacher',
				      'action' => 'profile', $author['user_id']
				      ));
				     echo '</p>';                
		     ?>
				 <div class="caption">
			        <h3><?php 
			        					// echo $this->Html->link($lesson['Lesson']['name'],array(
			        					// 						'controller' => 'Lesson',
			        					// 						'action' => 'index',
			        					// 						$lesson['Lesson']['coma_id']
			        									// )); 
			        	?>
			    	</h3>
				</div>
			</div>
		
	<?php	
		}
	?>
	</div>
</div>