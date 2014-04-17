<div class='col-md-2' style='min-height:400px;margin-left:10px;border:1px solid #ddd;padding:0px'>
	<ol class="breadcrumb" style='margin-bottom:0px'>
		<ul id='admin_menu' class="nav nav-pills nav-stacked" style='min-height:380px;'>		  
			<li id='acceptNewUser'>
		  	<?php  echo $this->Html->link(__('Accept New User'),array('action' => 'acceptNewUser')) ?>
		  </li>		  
<!-- 		  <li id= 'blockUser'>
		  	<?php  echo $this->Html->link(__('Block User'),array('action' => 'blockUser')) ?>
		  </li>				   -->
		  <li id= 'Notification'>
		  	<?php  echo $this->Html->link(__('Notification'),array('action' => 'Notification')) ?>
		  </li>
		  <li id= 'statistic'>
		  	<?php  echo $this->Html->link(__('Statistic'),array('action' => 'statistic')) ?>
		  </li>
		  <li id= 'ipManage'>
		  	<?php  echo $this->Html->link(__('IP Manage'),array('action' => 'ipManage')) ?>		  	
		  </li>
		  <li id= 'createAdmin'>
		  	<?php  echo $this->Html->link(__('Create another admin'),array('action' => 'createAdmin')) ?>
		  </li>
		  
		 
		  
		  <li id= 'userManage'>
		  	<?php  echo $this->Html->link(__('User Manage'),array('action' => 'userManage')) ?>		
		  </li>
		  <li id= 'ReferenceManage'>
		  	<?php  echo $this->Html->link(__('Reference Manage'),array('action' => 'ReferenceManage')) ?>		
		  </li>		 
		  <li id = 'Account'>
		  		<?php  echo $this->Html->link(__('Account'),array('action' => 'Account')) ?>	
		  </li>
		  <li id = 'changeConfig'>
		  		<?php  echo $this->Html->link(__('Configuration'),array('action' => 'changeConfig')) ?>	
		  </li>
		  <li id = 'adminManage'>
		  		<?php  echo $this->Html->link(__('ADMIN MANAGE'),array('action' => 'adminManage')) ?>	
		  </li>
		  		 
		</ul>
	</ol>
</div>

<script>
$(document).ready(function(){
	var action = <?php echo "'".$this->request->params['action']."'"?>;
	$("#"+action).addClass('active');		

})
</script>