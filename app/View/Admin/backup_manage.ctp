
<style type="text/css">
 .no-col, .del-ip-col, .edit-ip-col{
 	text-align: center;
 }	
</style>

<!-- header -->
<h3 style="text-align:center">
	<?php echo __('Backup System').' '.__('Manage'); 
	echo $this->Html->link("すぐにバックアップする", array(
											'controller' => 'Admin',
											'action' => 'manualBackup'
											
										),
										array(
												'class' => "list-group-item"
										)
									);
	?>
</h3>
<!-- table -->
<?php
	if(isset($backup_history)) {
?>
<div class="">
	<table class="table table-striped table-bordered">

		<thead>
			<tr>

				<th class='no-col' style="width:10%">
					<?php echo __('No') ?>
				</th>

				<th class='ip-col' style="width:50%">
					<?php echo __('Backup History') ?>
				</th>

				<th class='del-ip-col' style="width:20%">
					<?php echo __('Delete').' '.__('Backup') ?>
				</th>

				<th class='edit-ip-col' style="width:20%">
					<?php echo __('Restore') ?>
				</th>
			</tr>
		</thead>
		<tbody>
			<?php 
			echo $this->Form->create('AdminBackup',
		  		array( 'url' => array('controller' => 'Admin', 'action' => 'backupManage')
		  			)
		  			);
			foreach($backup_history as $key => $value) {
			echo"<tr>
				<td class='no-col'>";
			echo $this->Form->input('AdminBackup.Id', array(
					    	'type' => 'text',
					    	'class' => 'form-control',
					    	'value' => $key,
					    	'label' => false,
					    	'readonly' => 'readonly'
							));
			echo "</td>
				<td class='ip-col'>"
					.$value.
				"</td>

				<td class='del-ip-col'>";
			echo $this->Html->link("Delete", array(
											'controller' => 'Admin',
											'action' => 'backupDelete?backup_folder='.$value
											
										),
										array(
												'class' => "list-group-item"
										)
									);
			
			echo "</td>

				<td class='edit-ip-col'>";
					echo $this->Html->link("Restore", array(
											'controller' => 'Admin',
											'action' => 'backupRestore?backup_folder='.$value
											
										),
										array(
												'class' => "list-group-item"
										)
									);	
			echo "
				</td>
			</tr>
			";
			}
			?>
		<?php echo $this->Form->end(); ?>
		</tbody>
	</table>
</div>


<?php 
	}
?>