
<?php
	$role = !empty($_SESSION['Auth']['User']['role']) ? $_SESSION['Auth']['User']['role'] : 'R4';
	$page = array(
		'controller' => strtolower($this->name),
		'action' => strtolower($this->action),
		);
	$isActive = true;	
?>


<nav class="navbar navbar-default" role="navigation">
	<div class="container-fluid">
			<a class="navbar-brand" href="#">7Maru</a>
		</div>
<?php
/*
admin => account, blockuser, changepassword, createadmin, index, ipmanage, login ,notification, statistic, usermanage
reference => edit, index, new, view
search => index
student => buylesson, dotest, editprofile, index, profile, register, statistic, test, viewresult
teacher => creatlesson, editprofile, index, lesson, lessonmanage, profile, register, statistic
user => comment, index
*/
?>
		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		<?php 
		if( $role=='R2' ) :
		?>
			<ul class="nav navbar-nav">
				<?php
					$option = array(
						'controller' => 'Home',
						'action' => 'index'
					);
					if( $page['controller'] == strtolower($option['controller'])
						&& $page['action'] == strtolower($option['action'])
					){
						$isActive = true;
					}else{
						$isActive = false;
					}
				?>
				<li <?php if($isActive) echo "class='active'";?>>
					<?php
					echo $this->Html->link(__('Home'), $option);
					?>
				</li>


				<?php
					$option = array(
						'controller' => 'teacher',
						'action' => 'profile'
					);
					if( $page['controller'] == strtolower($option['controller'])
						&& $page['action'] == strtolower($option['action'])
					){
						$isActive = true;
					}else{
						$isActive = false;
					}
				?>
				<li <?php if($isActive) echo "class='active'";?>>
					<?php
					echo $this->Html->link(__('Profile'), $option);
					?>
				</li>


				<?php
					$option = array(
						'controller' => 'Teacher',
						'action' => 'LessonManage'
					);
					if( $page['controller'] == strtolower($option['controller'])
						&& $page['action'] == strtolower($option['action'])
					){
						$isActive = true;
					}else{
						$isActive = false;
					}
				?>
				<li <?php if($isActive) echo "class='active'";?>>
					<?php
					echo $this->Html->link(__('Lesson Manage'), $option);
					?>
				</li>


				<?php
					$option = array(
						'controller' => 'Teacher',
						'action' => 'Statistic'
					);
					if( $page['controller'] == strtolower($option['controller'])
						&& $page['action'] == strtolower($option['action'])
					){
						$isActive = true;
					}else{
						$isActive = false;
					}
				?>
				<li <?php if($isActive) echo "class='active'";?>>
					<?php
					echo $this->Html->link(__('Statistic'), $option);
					?>
				</li>

				<!-- Notify -->
				<?php
					$option = array(
						'controller' => 'user',
						'action' => 'notify'						
					);
					if( $page['controller'] == strtolower($option['controller'])
						&& $page['action'] == strtolower($option['action'])
					){
						$isActive = true;
					}else{
						$isActive = false;
					}
				?>
				<li <?php if($isActive) echo "class='active'"; ?> >
					<?php
						$title = __('Notify');
						if ($notify_num > 0){
							$title = $title . "<span class='badge'>".$notify_num."</span>";
						}
					echo $this->Html->link($title, $option,array('escape' => false));					
					?>
				</li> 
				
				<?php
					$option = array(
						'controller' => 'Login',
						'action' => 'logout'
					);
					if( $page['controller'] == strtolower($option['controller'])
						&& $page['action'] == strtolower($option['action'])
					){
						$isActive = true;
					}else{
						$isActive = false;
					}
				?>
				<li <?php if($isActive) echo "class='active'";?>>
					<?php
					echo $this->Html->link(__('Logout'), $option);
					?>
				</li>				
			</ul>
		<?php
		endif;	//	if( $role=='R2' ) :
		?>

		<?php 
		if( $role=='R3' ) :
		?>
			<ul class="nav navbar-nav">
				<?php
					$option = array(
						'controller' => 'Home',
						'action' => 'index'
					);
					if( $page['controller'] == strtolower($option['controller'])
						&& $page['action'] == strtolower($option['action'])
					){
						$isActive = true;
					}else{
						$isActive = false;
					}
				?>
				<li <?php if($isActive) echo "class='active'";?>>
					<?php
					echo $this->Html->link(__('Home'), $option);
					?>
				</li>


				<?php
					$option = array(
						'controller' => 'Student',
						'action' => 'profile'
					);
					if( $page['controller'] == strtolower($option['controller'])
						&& $page['action'] == strtolower($option['action'])
					){
						$isActive = true;
					}else{
						$isActive = false;
					}
				?>
				<li <?php if($isActive) echo "class='active'";?>>
					<?php
					echo $this->Html->link(__('Profile'), $option);
					?>
				</li>

<!-- 
				<?php
					$option = array(
						'controller' => 'Student',
						'action' => 'BuyLesson'
					);
					if( $page['controller'] == strtolower($option['controller'])
						&& $page['action'] == strtolower($option['action'])
					){
						$isActive = true;
					}else{
						$isActive = false;
					}
				?> -->
				<!-- <li <?php if($isActive) echo "class='active'";?>>
					<?php
					echo $this->Html->link(__('Buy Lesson'), $option);
					?>
				</li> -->


				<?php
					$option = array(
						'controller' => 'Student',
						'action' => 'Statistic'
					);
					if( $page['controller'] == strtolower($option['controller'])
						&& $page['action'] == strtolower($option['action'])
					){
						$isActive = true;
					}else{
						$isActive = false;
					}
				?>
				<li <?php if($isActive) echo "class='active'";?>>
					<?php
					echo $this->Html->link(__('Statistic'), $option);
					?>
				</li>
				<!-- Notify -->
				<?php
					$option = array(
						'controller' => 'user',
						'action' => 'notify'						
					);
					if( $page['controller'] == strtolower($option['controller'])
						&& $page['action'] == strtolower($option['action'])
					){
						$isActive = true;
					}else{
						$isActive = false;
					}
				?>
				<li <?php if($isActive) echo "class='active'";?>>
					<?php
						$title = __('Notify');
						if ($notify_num > 0){
							$title = $title . "<span class='badge'>".$notify_num."</span>";
						}
					echo $this->Html->link($title, $option,array('escape' => false));					
					?>
				</li>
				<?php
					$option = array(
						'controller' => 'Login',
						'action' => 'logout'
					);
					if( $page['controller'] == strtolower($option['controller'])
						&& $page['action'] == strtolower($option['action'])
					){
						$isActive = true;
					}else{
						$isActive = false;
					}
				?>
				<li <?php if($isActive) echo "class='active'";?>>
					<?php
					echo $this->Html->link(__('Logout'), $option);
					?>
				</li>
				
			</ul>
		<?php
		endif;	//	if( $role=='R3' ) :
		?>


		<?php 
		if( $role=='R4' ) :
		?>
			<ul class="nav navbar-nav">
				<?php
					$option = array(
						'controller' => 'Home',
						'action' => 'index'
					);
					if( $page['controller'] == strtolower($option['controller'])
						&& $page['action'] == strtolower($option['action'])
					){
						$isActive = true;
					}else{
						$isActive = false;
					}
				?>
				<li <?php if($isActive) echo "class='active'";?>>
					<?php
					echo $this->Html->link(__('Home'), $option);
					?>
				</li>

				<?php
					$option = array(
						'controller' => 'Login',
						'action' => 'index'
					);
					if( $page['controller'] == strtolower($option['controller'])
						&& $page['action'] == strtolower($option['action'])
					){
						$isActive = true;
					}else{
						$isActive = false;
					}
				?>
				<li <?php if($isActive) echo "class='active'";?>>
					<?php
					echo $this->Html->link(__('Login'), $option);
					?>
				</li>

			<!-- 	<li>
					<a href="#">Register</a>
				</li> -->
				<?php
					$option = array(
						'controller' => 'Teacher',
						'action' => 'register'
					);
					if( $page['controller'] == strtolower($option['controller'])
						&& $page['action'] == strtolower($option['action'])
					){
						$isActive = true;
					}else{
						$isActive = false;
					}
				?>
				<li <?php if($isActive) echo "class='active'";?>>
					<?php
					echo $this->Html->link(__('Teacher'), $option);
					?>
				</li>
				<?php
					$option = array(
						'controller' => 'Student',
						'action' => 'register'
					);
					if( $page['controller'] == strtolower($option['controller'])
						&& $page['action'] == strtolower($option['action'])
					){
						$isActive = true;
					}else{
						$isActive = false;
					}
				?>
				<li <?php if($isActive) echo "class='active'";?>>
					<?php
					echo $this->Html->link(__('Student'), $option);
					?>
				</li>
			</ul>	
		<?php
		endif;	//	if( $role=='R2' ) :
		?>

		<?php //search form ?>
		<?php
				echo $this->Form->create(null, array(
				'type' => 'get',
				'controller' => 'search',
				'url' => array(
						'controller' => 'Search',
						'action' => 'index',
					),
				'class' => 'navbar-form navbar-right',
				));

				echo $this->Form->input(
						'keyword',
						array(
							'label' => '',
							'name' => 'keyword',
							'class' => 'form-control',
							'placeholder' => __('Enter a keyword'),
							'div' => array(
								'style' => 'display:inline-block;margin-right:10px;'
								),
						)
				);

				echo $this->Form->button(__('Search'), array(
					'class' => 'btn btn-default',
					'type' => 'Search',
				 ));
			echo $this->Form->end();
		?>
		</div>
	</div>
</nav>