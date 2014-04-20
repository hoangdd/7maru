
<style type="text/css">
 .no-col, .del-ip-col, .edit-ip-col{
 	text-align: center;
 }	
</style>

<!-- header -->
<h3 style="text-align:center">
	
</h3>
<!-- table -->
<?php
	if(isset($dataList)) {
?>
<div class="">
	<table class="table table-striped table-bordered">

		<thead>
			<tr>

				<th class='no-col' style="width:10%">
					<?php echo __('No') ?>
				</th>

				<th class='ip-col' style="width:50%">
					<?php echo __('ユーザーID') ?>
				</th>

				<th class='del-ip-col' style="width:20%">
					<?php echo __('時間') ?>
				</th>

				<th class='edit-ip-col' style="width:20%">
					<?php echo __('詳しく見る') ?>
				</th>
			</tr>
		</thead>
		<tbody>
			<?php 
			echo $this->Form->create('AdminBackup',
		  		array( 'url' => array('controller' => 'Admin', 'action' => 'backupManage')
		  			)
		  			);
			foreach($dataList as $key => $value) {
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
					.$value['user_test'].
				"</td>
				<td class='ip-col'>"
					.$value['test_time'].
				"</td>


				<td class='edit-ip-col'>";
					echo $this->Html->link(__("見る"), array(
											'controller' => 'Lesson',
											'action' => 'result?view='.$value['result_id']
											
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