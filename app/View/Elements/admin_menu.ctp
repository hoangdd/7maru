<?php 
?>
<div class='col-md-2' style='min-height:400px;margin-left:10px;border:1px solid #ddd;padding:0px'>
	<ol class="breadcrumb" style='margin-bottom:0px'>
		<ul id='admin_menu' class="nav nav-pills nav-stacked" style='min-height:380px;'>		  
			<li id='acceptNewUser'>
		  	<?php  echo $this->Html->link(__('Accept New User'),array('controller' => 'admin','action' => 'acceptNewUser')) ?>
		  </li>		  
		  <li id= 'userManage'>
		  	<?php  echo $this->Html->link(__('User Manage'),array('controller' => 'admin','action' => 'userManage')) ?>		
		  </li>
<!-- 		  <li id= 'blockUser'>
		  	<?php  echo $this->Html->link(__('Block User'),array('controller' => 'admin','action' => 'blockUser')) ?>
		  </li>				   -->
		  <li id= 'Notification'>
		  	<?php  echo $this->Html->link(__('Notification'),array('controller' => 'admin','action' => 'Notification')) ?>
		  </li>		  

		  <li id = 'adminManage'>
		  		<?php  echo $this->Html->link(__('ADMIN MANAGE'),array('controller' => 'admin','action' => 'adminManage')) ?>	
		  </li>

		  <li id= 'ipManage'>
		  	<?php  echo $this->Html->link(__('IP Manage'),array('controller' => 'admin','action' => 'ipManage')) ?>		  	
		  </li>
		  <li id= 'createAdmin'>
		  	<?php  echo $this->Html->link(__('Create another admin'),array('controller' => 'admin','action' => 'createAdmin')) ?>
		  </li>	
		  <li id = 'lessonManage'>
		  		<?php  echo $this->Html->link(__('Lesson Manage'),array('controller' => 'admin','action' => 'lessonManage')) ?>	
		  </li>

		  <li id= 'ReferenceManage'>
		  	<?php  echo $this->Html->link(__('Reference Manage'),array('controller' => 'admin','action' => 'ReferenceManage')) ?>		
		  </li>
		  		 
		  <li id = 'Account'>
		  		<?php  echo $this->Html->link(__('Account'),array('controller' => 'admin','action' => 'Account')) ?>	
		  </li>
		  <li id = 'changeConfig'>
		  		<?php  echo $this->Html->link(__('Configuration'),array('controller' => 'admin','action' => 'changeConfig')) ?>	
		  </li>
		  
		  <li id = 'Backup'>
		  		<?php  echo $this->Html->link(__('Backup System'),array('controller' => 'admin','action' => 'backupManage')) ?>	
		  </li>		  
		  

<!-- 		  <li id= 'statistic'>
		  	<?php  echo $this->Html->link(__('Statistic'),array('controller' => 'admin','action' => 'statistic')) ?>
		  </li> -->
		  		 
		</ul>
	</ol>
</div>

<script>
$(document).ready(function(){
	var action = <?php echo "'".$this->request->params['action']."'"?>;
	$("#"+action).addClass('active');		

})
</script>