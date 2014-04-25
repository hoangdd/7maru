<?php 
	// format $data = array('config_id' => 'value');
	echo $this->Html->script(array('bootstrap-datepicker'));
	echo $this->Html->css('datepicker');
	if (isset($data) && !empty($data) ):	
		$unit = array(
			'backup_period' => '時刻',
			'block_time' => '秒',
			'error_login_times' => '秒',
			'limit_learn_day' => '日',
			'limit_session_time' => '秒',
			'money_per_lesson' => 'VND',
			'teacher_profit_percentage' => '%'
		);
?>
<script type="text/javascript">
      // Load the Visualization API and the piechart package.      
      //======show datepicker
      $(document).ready(function(){         
            $("#dp").datepicker({
                  format: "dd-mm-yyyy",                  
            });
            $("#dp").datepicker('set','today');         
      })
</script>
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
				<th class='ip-col' style="width:30%">
					<?php echo __('コンフィグ') ?>
				</th>

				<th class='del-ip-col text-center' style="width:60%">
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
				<?php 
					if ($key == 'backup_period'){
						$type = "datetime";
						$class = 'form-control';
						echo $this->Form->input($key,array(							
							//'name' => $key,
							'label' => '',
							//'class' => $class,
							'type' => $type,
							'selected' => array(
								'year' => $value[0],
								'month' => $value[1],
								'day' => $value[2],
								'hour' => $value[3],
								'min' => $value[4]
							),
							'minYear' => date('Y'),
							'maxYear' => date('Y'),
							'monthNames' => false,
							'style' => 'margin:10px',
							'timeFormat' => '24',
							'dateFormat' => 'YMD'
							)) ;
						}
					else{
						$type = "text";
						$class = 'form-control';
						echo $this->Form->input($key,array(
							'value' => $value,
							'name' => $key,
							'label' => '',
							'class' => $class,
							'type' => $type
						)) ;
					}					
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