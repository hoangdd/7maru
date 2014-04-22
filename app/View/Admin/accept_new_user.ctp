<?php 
// $this->Paginator->options(array(
// 	'update' => '#user_list',
// 	'evalScripts' => true,
// 	));
	?>
<!-- header -->
<div id="user_list">
	<h3 style="text-align:center">
		<?php echo __('Accept New User') ?>
	</h3>
	<!-- table -->
	<div class="">
		<table class="table table-striped table-bordered">

			<thead>
				<tr>
					<th class='text-center' style="width:5%">
						<?php echo __('No') ?>
					</th>

					<th class='' style="width:10%">
						<?php echo __('Name') ?>
					</th>

					<th class='text-center' style="width:10%">
						<?php echo __('Username') ?>
					</th>

					<th class='text-center' style="width:10	%">
						<?php echo __('Type') ?>
					</th>
					<th class='text-center' style="width:10%">
						<?php echo __('Date of birth') ?>
					</th>
					<th class='text-center' style="width:20%">
						<?php echo __('Created Account Time'); ?>
					</th>
					<th class='text-center' style="width:15%">
						<?php echo __('Profile'); ?>
					</th>
					<th class='text-center' style="width:5%">
						<?php echo __('Accept'); ?>
					</th>
					<th class='text-center' style="width:15%">
						<?php echo __('アクセプトをしない'); ?>
					</th>
				</tr>
			</thead>
			<tbody>
				<?php 			
				$i=1;
				$td = "<td class='text-center'>";
				$close = "</td>";
				foreach($data as $user):
					if ($user['User']['user_type'] == 1){ 
						$type = 'Teacher';
					}
					else{
						$type = 'Student';	
					}
					echo "<tr class='item' itemid='".$user['User']['user_id']."'>";
					echo $td.$i++."</td>";										
					echo $td.$user['User']['lastname'].$user['User']['firstname'].$close;				
					echo $td.$user['User']['username'].$close;						
					echo $td.__($type).$close;
					echo $td.$user['User']['date_of_birth'].$close;				
					echo $td.$user['User']['created'].$close;										
					echo $td.$this->Html->link(__('View'),array('controller' => $type,'action' => 'Profile',$user['User']['user_id'])).$close;
					echo $td.$this->Html->link(__('Accept'),array('controller' => 'admin','action' => 'approveUser',$user['User']['user_id'],1),array('class' => 'approve_link')).$close;
					echo $td.$this->Html->link(__('Unaccept'),array('controller' => 'admin','action' => 'approveUser',$user['User']['user_id'],2),array('class' => 'approve_link')).$close;
					echo "</tr>";			
					endforeach;
					?>
				</tbody>
			</table>
		</div>
</div>
<script>
$(document).ready(function(){
	$('a.approve_link').click(function(){
		var src = $(this).attr('href');
		var a = $(this);
		$.get(
			src,            	
			function(data){  
				if (data.trim() == '1') {
					alert("<?php echo __('Successful') ?>");
					var tr = a.parent().parent();
					tr.replaceWith("");
					// location.reload(true);
					// window.location.reload(true);
				}else{
					alert("<?php echo __('Error') ?>");
				}
			}
			);
		return false;
	})
});
</script>