<h3 class='text-center'>
	<?php
		echo __('ADMIN HOMEPAGE');
	?>
</h3>
<div class="input-group">
  <input type="text" class="form-control">
  <span class="input-group-btn">
    <button class="btn btn-default" type="button">
    	<span class=" glyphicon glyphicon-search">		
    	</span>
    	<?php
			echo __('Search');
		?>
    </button>
  </span>
</div>

<!-- left menu -->
<div class='col-md-3' style='min-height:400px;margin:10px;border:1px solid #ddd;padding:0px'>
	<ol class="breadcrumb" style='margin-bottom:0px'>
		<ul class="nav nav-pills nav-stacked" style='min-height:380px;'>
		  <li class="active">
		  	<?php  echo $this->Html->link(__('HomePage'),array('action' => 'index')) ?>		  	
		  </li>
		  <li>
		  	<?php  echo $this->Html->link(__('Block User'),array('action' => 'blockUser')) ?>
		  </li>		  
		  <li>
		  	<?php  echo $this->Html->link(__('Report'),array('action' => 'report')) ?>
		  </li>
		  <li>
		  	<?php  echo $this->Html->link(__('Statistic'),array('action' => 'statistic')) ?>
		  </li>
		  <li>
		  	<?php  echo $this->Html->link(__('IP Manage'),array('action' => 'ipManage')) ?>		  	
		  </li>
		  <li>
		  	<?php  echo $this->Html->link(__('Create another admin'),array('action' => 'createAdmin')) ?>
		  </li>
		  <li>
		  	<?php  echo $this->Html->link(__('User Manage'),array('action' => 'userManage')) ?>		
		  </li>
		  <li>
		  	<?php  echo $this->Html->link(__('Reference Manage'),array('action' => 'ReferenceManage')) ?>		
		  </li>		 
		</ul>
	</ol>
</div>

<!-- content -->
<div class='col-md-8' style='min-height:400px;margin:10px;border:1px solid #ddd;'>
	
</div>