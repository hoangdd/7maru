<?php
echo $this->Html->css('menu');
$role = !empty($_SESSION['Auth']['User']['role']) ? $_SESSION['Auth']['User']['role'] : 'R4';
?>

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
<?php
	echo $this->Html->scriptStart(array('inline' =>true));
?>
$(document).ready(function(){
	var menu = $('.ac_menu');
	menuChange = function(list, newList){
		var i = 0;
		$.when(list.find('li').each(function(){
			$(this).animate({
				'margin-top': -60,
				'opacity' : 0,
			},
			200+i*100,
			function(){
				$(this).hide();
			}
			);
			i++;
		})).done(function(){
			list.hide();
			menuShow(newList)
		});
	};
	menuShow = function(list){
		var i = 0;
		list.show();
		list.find('li').each(function(){
			$(this).show();
			$(this).animate({
				'margin-top':0,
				'opacity' : 1,
			},
			200+i*100
			);
			i++;
		})
	};

	$('.ac_menu > ul > li').click(function(){
		id = $(this).attr('id');
		list = $(this).parents('ul');
		if($(this).hasClass('title')){
			menuChange(list, menu.find('ul.root'));
		}else{
			if(typeof id == 'undefined') return;
			menuChange(list, menu.find('ul[root='+id+']'));
		}
	});
});
<?php
	echo $this->Html->scriptEnd();
?>
<div id="ac_content" class="ac_content">
	<h1>
		<span><?php echo __('Study more') ?></span>
		7maru
	</h1>
	<div class="ac_menu">
		<?php if($role=='R1') :?>
			<ul class='root'>
				<li>
					<a href="<?php echo $this->Html->url(array(
						'controller' => 'admin',
						'action' => 'acceptNewUser'
					));?>"> <?php echo __('管理者');?> </a>
				</li>
				<li>
					<a href="<?php echo $this->Html->url(array(
						'controller' => 'home',
						'action' => 'index'
					));?>"> <?php echo __('Home');?> </a>
				</li>
				<li>
					<a href="<?php echo $this->Html->url(array(
						'controller' => 'admin',
						'action' => 'logout'
						));?>"> <?php echo __('Logout');?> </a>
				</li>
			</ul>			
		<?php endif;?>
		<?php if($role=='R2') :?>
			<ul class='root'>
				<li>
					<a href="<?php echo $this->Html->url(array(
						'controller' => 'Home',
						'action' => 'index'
						));?>"> <?php echo __('Home');?> </a>
				</li>
				<li id = 1 >
					<a href="#"> <?php echo __('Account');?> </a>
				</li>
				<li id = 2 >
					<a href="#"> <?php echo __('Profile');?> </a>
				</li>
				<li id = 3 >
					<a href="#"> <? echo __('Lesson');?> </a>
				</li>
				<li >
					<a href="<?php echo $this->Html->url(array(
						'controller' => 'Teacher',
						'action' => 'Statistic'
						)) ?>"> <? echo __('Statistic');?> </a>
				</li>
			</ul>
			<ul root = 1>
				<li class='title'>
					<a href="#"> <?php echo __('Account');?> </a>
				</li>
				<li>
					<a 
					href="<?php echo $this->Html->url(array(
						'controller'=>'Login',
						'action'=>'logout' 
						));?>"
					> <?php echo __('Logout');?> </a>
				</li>
				<li>
					<a 
					href="<?php echo $this->Html->url(array(
						'controller' => 'Login',
						'action' => 'changePassword',
						));
					?>"
					> <?php echo __('Change Password');?> </a>
				</li>
				<li>
					<a type='delete_link' href="<?php echo $this->Html->url(array('controller' => 'User','action' => 'delete')) ?>"> <?php echo __('Delete');?> </a>
				</li>
			</ul>
			<ul root = 2>
				<li class='title'>
					<a href="#"> <?php echo __('Profile');?> </a>
				</li>
				<li>
					<a href="<?php echo $this->Html->url(array(
						'controller' => 'Teacher',
						'action' => 'Profile'
						));?>"> <?php echo __('View');?> </a>
				</li>
				<li>
					<a href="<?php echo $this->Html->url(array(
						'controller' => 'Teacher',
						'action' => 'EditProfile'
						));?>"><?php echo __('Edit');?> </a>
				</li>
			</ul>

			<ul root = 3>
				<li class='title'>
					<a href="#"> <?php echo __('Lesson');?> </a>
				</li>
				<li>
					<a href="<?php echo $this->Html->url(array(
						'controller'=>'Teacher',
						'action' => 'LessonManage'
						)); ?>"> <?php echo __('Manage');?>  </a>
				</li>
				<li>
					<a href="<?php echo $this->Html->url(array(
						'controller'=>'Lesson',
						'action' => 'Create'
						)); ?>"> <?php echo __('Create');?> </a>
				</li>
			</ul>
		<?php endif;?>

		<?php if($role=='R3') :?>
			<ul class='root'>
				<li>
					<a href="<?php echo $this->Html->url(array(
						'controller' => 'Home',
						'action' => 'index'
					));?>"> <?php echo __('Home');?> </a>
				</li>
				<li id = 1 >
					<a href="#"> <?php echo __('Account');?> </a>
				</li>
				<li id = 2 >
					<a href="#"> <?php echo __('Profile');?> </a>
				</li>
				<!-- <li id = 3 >
					<a href="#"> <? echo __('Lesson');?> </a>
				</li> -->
				<li >
					<a href="<?php echo $this->Html->url(array(
						'controller' => 'Student',
						'action' => 'Statistic'
						)) ?>"> <? echo __('Statistic');?> </a>
				</li>
			</ul>
			<ul root = 1>
				<li class='title'>
					<a href="#"> <?php echo __('Account');?> </a>
				</li>
				<li>
					<a 
					href="<?php echo $this->Html->url(array(
						'controller'=>'Login',
						'action'=>'logout' 
						));?>"
					> <?php echo __('Logout');?> </a>
				</li>
				<li>
					<a 
					href="<?php echo $this->Html->url(array(
						'controller' => 'Login',
						'action' => 'changePassword',
						));
					?>"
					> <?php echo __('Change password');?> </a>
				</li>
				<li>
					<a type='delete_link' href=<?php echo "'".$this->Html->url(array('controller' => 'User','action' => 'delete'))."'" ?>> <?php echo __('Delete');?> </a>					
				</li>
			</ul>
			<ul root = 2>
				<li class='title'>
					<a href="#"> <?php echo __('Profile');?> </a>
				</li>
				<li>
					<a href="<?php echo $this->Html->url(array(
						'controller' => 'Student',
						'action' => 'Profile'
						));?>"> <?php echo __('View');?> </a>
				</li>
				<li>
					<a href="<?php echo $this->Html->url(array(
						'controller' => 'Student',
						'action' => 'EditProfile'
						));?>"><?php echo __('Edit');?> </a>
				</li>
			</ul>

			<!-- <ul root = 3>
				<li class='title'>
					<a href="#"> <?php echo __('Lesson');?> </a>
				</li>
				<li>
					<a href="#"> <?php echo __('Manage');?>  </a>
				</li>
				<li>
					<a href="#"> <?php echo __('Recent');?> </a>
				</li>
				<li>
					<a href="#"> <?php echo __('Bought');?> </a>
				</li>
			</ul> -->
		<?php endif;?>

		<?php if($role=='R4') :?>
			<ul class='root'>
				<li>
					<a href="<?php echo $this->Html->url(array(
						'controller' => 'Home',
						'action' => 'index'
					));?>"> <?php echo __('Home');?> </a>
				</li>
				<li>
					<a href="<?php echo $this->Html->url(array(
						'controller' => 'Login',
						'action' => 'index'
						)); ?>"> <?php echo __('Login');?> </a>
				</li>
				<li id = 2>
					<a href="#"> <?php echo __('Register');?> </a>
				</li>
			</ul>
			<ul root = 2>
				<li class='title'>
					<a href="#"> <?php echo __('Register');?> </a>
				</li>
				<li>
					<a href="<?php echo $this->Html->url(array(
						'controller' => 'Teacher',
						'action' => 'Register'
						));?>"> <?php echo __('Teacher');?> </a>
				</li>
				<li>
					<a href="<?php echo $this->Html->url(array(
						'controller' => 'Student',
						'action' => 'Register'
						));?>"><?php echo __('Student');?> </a>
				</li>
			</ul>
		<?php endif;?>
	</div><!-- ac_menu -->

	
</div><!-- ac_content -->
<script>
						$("document").ready(function(){
							$("a[type = 'delete_link']").click(function(){
								var r = confirm(<?php echo "'".__('Confirm').' '.__('Delete')."'";?>);
								if (r){
									return true;
								}
								return false;
							});
						})
					</script>