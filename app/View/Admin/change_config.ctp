<?php 
	// format $data = array('config_id' => 'value');
	if (isset($data) && !empty($data) ):	
?>
	<!-- header -->

<div class="col-md-10">
	<h3 style="text-align:center">
	<?php echo __('Configuration').' '.__('Manage') ?>
</h3>
	<?php 
			//$array_item = $array_list['2'];
				echo $this->Form->create(
					'changeConfig',
					array( 						
						'type' => 'POST'
					)
				);
		?>	
	<table class="table table-striped table-bordered">
		<thead>
			<tr>			

				<th class='ip-col' style="width:50%">
					<?php echo __('Config') ?>
				</th>

				<th class='del-ip-col' style="width:50%">
					<?php echo __('Value') ?>
				</th>			
			</tr>
		</thead>			
		<tbody>
			<?php  
				foreach($data as $key=>$value):
			?>	
			<tr>
				<td><?php echo __($key) ?></td>
				<td>
				<?php echo $this->Form->input($key,array(
					'value' => $value,
					'name' => $key,
					'label' => '',
					'class' => 'form-control'
				)) 
				?>
				</td>
			</tr>
			<?php 
				endforeach;
			?>
		</tbody>		
	</table>
	<div class='text-center'>
	<?php 
			echo $this->Form->input(__('Submit'),array('label' => '','type' => 'submit','class' => 'btn btn-primary'));
		 	echo $this->Form->end(); 
		 ?>
		</div>
</div>
<?php endif; ?>