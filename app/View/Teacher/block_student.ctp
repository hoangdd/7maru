 <div class="tab-pane" id="studentList">
  		<div class="panel panel-default">
  			<div class="panel-heading">
  				<h1><?php echo __('Block Student List');?></h1>
  			</div>
		  <!-- Table -->
		  <table class="table">
		  	<thead>
		  		<tr>
		  			<td>
		  				<b><?php echo __('No');?></b>
		  			</td>
		  			<td>
		  				<b><?php echo __('Username');?></b>
		  			</td>
		  			<td>
		  				<b><?php echo __('First Name');?></b>
		  			</td>
		  			<td>
		  				<b><?php echo __('Last Name');?></b>
		  			</td>
		  			<td>
		  				<b><?php echo __('Unblock');?></b>
		  			</td>
		  		</tr>
		  	</thead>
		  	<tbody>
			    <?php 
			    	if( !empty($stdBlockList)){
			    		$i = 0;
			    		foreach ($stdBlockList as $key => $value) :
				?>
							<td><?php echo($i+1);?></td>
							<td>
								<?php echo $this->Html->link($value['User']['username'], array(
										'controller' => 'Student',
										'action' => 'Profile',
										$value['User']['user_id']
									));
								?>
							</td>
							<td><?php echo($value['User']['firstname'])?></td>
							<td><?php echo($value['User']['lastname'])?></td>
							<td><?php echo $this->Html->link(__('Unblock'),array('controller' => 'Teacher','action' => 'unblockStudent',$value['User']['user_id']),array('class' => 'unblock_link'));
							?>
							</td>
			</tbody>
			<?php
					$i++;
					endforeach;
				}
		    ?>
		  </table>
		</div>
  </div>

<script>
$(document).ready(function(){
	$('a.unblock_link').click(function(){
		var src = $(this).attr('href');
		var a = $(this);
		$.get(
			src,            	
			function(data){  
				if (data.trim() == '1') {
					alert("<?php echo __('Successfully') ?>");
					var tr = a.parent().parent();
					tr.replaceWith("");
				}else{
					alert("<?php echo __('Error') ?>");
				}
			}
			);
		return false;
	})
});
</script>