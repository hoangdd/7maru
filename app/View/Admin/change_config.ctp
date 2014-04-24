<?php 
	// format $data = array('config_id' => 'value');
	if (isset($data) && !empty($data) ):	
		$unit = array(
			'backup_period' => '分',
			'block_time' => '秒',
			'error_login_times' => '秒',
			'limit_learn_day' => '日',
			'limit_session_time' => '秒',
			'money_per_lesson' => 'VND',
			'teacher_profit_percentage' => '%'
		);
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
					<?php echo __('コンフィグ') ?>
				</th>

				<th class='del-ip-col text-center' style="width:40%">
					<?php echo __('バリュー') ?>
				</th>			
				<th class='del-ip-col text-center' style="width:10%">
					<?php echo "単位" ?>
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
				<td>
					<?php echo $unit[$key] ?>
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