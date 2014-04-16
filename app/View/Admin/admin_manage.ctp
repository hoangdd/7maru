<style type="text/css">
 .no-col, .del-ip-col, .edit-ip-col{
 	text-align: center;
 }	
</style>

<!-- header -->
<h3 style="text-align:center">
	<?php echo __('Admin').' '.__('Manage') ?>
</h3>
<!-- table -->
<div class="">
	<table class="table table-striped table-bordered">

		<thead>
			<tr>

				<th class='no-col' style="width:10%">
					<?php echo __('No') ?>
				</th>

				<th class='ip-col' style="width:60%">
					<?php echo __('Admin') ?>
				</th>

				<th class='del-ip-col' style="width:15%">
					<?php echo __('Delete') ?>
				</th>

				<th class='edit-ip-col' style="width:15%">
					<?php echo __('Change IP') ?>
				</th>
				<th class='edit-ip-col' style="width:15%">
					<?php echo __('Change Password') ?>
				</th>
			</tr>
		</thead>
		<tbody>
			<?php 
			echo $this->Form->create('AdminManage',
		  		array( 'url' => array('controller' => 'Admin', 'action' => 'adminManage')
		  			)
		  			);
		  		 
			
			$i = ($this->Paginator->current($model = null)-1)*3+1;
			//foreach($array_item as $value){
			foreach($data as $numb => $value) {
			echo"<tr>
				<td class='no-col'>";
			echo $this->Form->input('AdminManage.Id', array(
					    	'type' => 'text',
					    	'class' => 'form-control',
					    	'value' => $i,
					    	'label' => false,
					    	'readonly' => 'readonly'
							));
			echo "</td>
				<td class='ip-col'>"
					.$value['username'].
				"</td>

				<td class='del-ip-col'>";
			//echo $this->Form->submit('Delete', array('name' => 'delete','class' => 'btn btn-default'));
			echo $this->Html->link("Delete", array(
											'controller' => 'Admin',
											'action' => 'delAdmin',
											$value['admin_id']
											
										),
										array(
												'class' => "list-group-item"
										)
									);	
			//echo "<a href=".$this->here."?mod=delete&ip=".$value['admin_id'].">".__('Delete')."</a>";
			
			echo "</td>

				<td class='edit-ip-col'>";
			//echo $this->Form->submit('Change IP', array('name' => 'edit','class' => 'btn btn-default'));
			//echo "<a href=".$this->here."?mod=edit&ip=".$data[$numb]['admin_id'].">".__('Edit')."</a>";
			echo $this->Html->link("Change IP", array(
											'controller' => 'Admin',
											'action' => 'ipManage?mod=edit&ip='.$data[$numb]['ip']
										),
										array(
												'class' => "list-group-item"
										)
									);	
			echo "
				</td>
				
				<td class='edit-ip-col'>";
			//echo $this->Form->submit('Change Password', array('name' => 'edit','class' => 'btn btn-default'));
			echo "<a href=".$this->here."?mod=edit&ip=".$data[$numb]['admin_id'].">".__('Edit')."</a>";
			echo "
				</td>
			</tr>
			";
			$i++;
			}
			?>
			
			
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

