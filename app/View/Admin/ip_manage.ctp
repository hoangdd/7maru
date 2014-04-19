<style type="text/css">
 .no-col, .del-ip-col, .edit-ip-col{
 	text-align: center;
 }	
</style>

<!-- header -->
<h3 style="text-align:center">
	<?php echo __('IP Address').' '.__('Manage') ?>
</h3>
<!-- table -->
<div class="">
	<table class="table table-striped table-bordered">

		<thead>
			<tr>

				<th class='no-col' style="width:10%">
					<?php echo __('No') ?>
				</th>

				<th class='ip-col' style="width:30%">
					<?php echo __('Admin') ?>
				</th>
				
				<th class='ip-col' style="width:30%">
					<?php echo __('IP Address') ?>
				</th>

				<th class='del-ip-col' style="width:15%">
					<?php echo __('Delete').' '.__('IP Address') ?>
				</th>

				<th class='edit-ip-col' style="width:15%">
					<?php echo __('Edit').' '.__('IP Address') ?>
				</th>
			</tr>
		</thead>
		<tbody>
			<?php 
			//$array_item = $array_list['2'];
			echo $this->Form->create('AdminIp',
		  		array( 'url' => array('controller' => 'Admin', 'action' => 'ipManage')
		  			)
		  			);
		  		 
			
			$i = ($this->Paginator->current($model = null)-1)*3+1;
			foreach($data as $numb => $value) {
			$iTemp=1;
			echo"<tr>
				<td class='no-col'>";
			echo $this->Form->input('AdminIp.IpId', array(
					    	'type' => 'text',
					    	'class' => 'form-control',
					    	'value' => $i,
					    	'label' => false,
					    	'readonly' => 'readonly'
							));
			echo "</td>
				<td class='ip-col'>"
					.$value['admin'].
				"</td><td class='ip-col'>"
					.$value['ip'].
				"</td>

				<td class='del-ip-col'>";
			
			//echo $this->Form->submit('Delete', array('name' => 'delete','class' => 'btn btn-default'));
			echo "<a href=".$this->here."?mod=delete&ip=".$value['ip'].">".__('Delete')."</a>";
			
			echo "</td>

				<td class='edit-ip-col'>";
			//echo $this->Form->submit('Edit', array('name' => 'edit','class' => 'btn btn-default'));
			echo "<a href=".$this->here."?mod=edit&ip=".$value['ip']."&admin=".$value['admin']."&ip_admin=".$value['ip_id'].">".__('Edit')."</a>";
			echo "
				</td>
			</tr>
			";
			$i++;
			}
			?>
			
			<tr>
			<td class='del-ip-col'>
					
				</td>
				<td class='del-ip-col'>
					<?php
					if($modFlag == 1)  
						echo $this->Form->input('AdminIp.Admininput', array(
					    	'type' => 'text',
					    	'class' => 'form-control',
					    	'placeholder' => 'Admin',
					    	'label' => false,
					    	'readonly' => 'readonly',
					    	'value' => $admin_hidden
							));
						else {
							echo $this->Form->input('AdminIp.Admininput', array(
					    	'type' => 'select',
					    	'class' => 'form-control',
					    	'label' => false,
 					    	'options' => $data_admin_query
							));
							}
							?> 
				</td>
				
				<td class='ip-col'>
					<?php 
						echo $this->Form->input('AdminIp.Ipinput', array(
					    	'type' => 'text',
					    	'class' => 'form-control',
					    	'placeholder' => 'IP address',
					    	'label' => false,
					    	'value' => $enter
							));
							?> 
					

				</td>
				<td class='no-col'>
					
					<?php
						//$options = array(
						  //  'label' => 'サブメット',
						    //'class' => 'btn btn-default',
						//);
							//echo $this->Form->end($options);
							?>
					<?php echo $this->Form->submit('サブメット', 
						array('name' => 'add','class' => 'btn btn-default')); ?>
					  
					</button>
				</td>
				

				<td class='del-ip-col'>
					<?php 
						if($modFlag == 1) {
							echo $this->Form->input('AdminIp.Hidden', array(
					    	'type' => 'hidden',
					    	'value' => $enterID
							));
							}
							?>
						
					
				</td>

				<td class='edit-ip-col'>
					
				</td>
			</tr>
		<?php echo $this->Form->end(); ?>
		</tbody>
	</table>
</div>

<!-- paginate -->
<div class='text-center'>
	<ul class="pagination">

	  <li>
	  	<?php echo $this->Paginator->prev('<< ' . __('previous'), array(), null, array('class'=>'disabled'));?>
	  </li>
	  <li>
	  	<?php echo $this->Paginator->numbers(array('separator' => ''));?>
	  </li>
	  <li>
	  	<?php echo $this->Paginator->next(__('next') . ' >>', array(), null, array('class' => 'disabled'));?>
	  </li>
	  
	</ul>

</div>

