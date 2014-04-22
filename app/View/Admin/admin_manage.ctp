<!-- header -->

<script>
    $(document).ready(function(){    	
        $("tr a.link_delete").click(function(){
        	var r = confirm("<?php echo __('Confirm') ?>");
        	var action = $(this).attr('href');
        	var tr = $(this).parent().parent();
        	if (r){
	        	$.get(
	        		action,
	        		function(data){
	        			if (data.trim() == '1'){
	        				alert("<?php echo __('Successfully') ?>");
	        				tr.replaceWith("");
	        				// window.location.reload(true);
	        			} else if(data.trim() == '-1'){
	        				alert("<?php echo 'デフォルトアカウントは削除できません'; ?>");
	        			} else {
	        				alert("<?php echo __('Error') ?>");	
	        			}
	        		}
	        	);
        	}
        	return false;        	
        })
    })
</script>
<div id="user_list">
<h3 style="text-align:center">
	<?php echo __('ADMIN MANAGE') ?>
</h3>
<!-- table -->
<div class="">
	<table class="table table-striped table-bordered">

		<thead>
			<tr>
				<th class='text-center' style="width:5%">
					<?php echo __('No.') ?>
				</th>

				<th class='text-center' style="width:10%">
					<?php echo __('Name') ?>
				</th>

				<th class='text-center' style="width:10%">
					<?php echo __('Username') ?>
				</th>

				<th class='text-center' style="width:5%">
					<?php echo __('Edit') ?>
				</th>
				<th class='text-center' style="width:5%">
					<?php echo __('Destroy') ?>
				</th>				
			</tr>
		</thead>
		<tbody>
			<?php 			
				$i=1;
				$td = "<td class='text-center'>";
				$close = "</td>";
				foreach($data as $user):
					echo "<tr>";
					echo $td.$i++."</td>";										
					echo $td.$user['Admin']['last_name'].$user['Admin']['first_name'].$close;				
					echo $td.$user['Admin']['username'].$close;													
					echo $td.$this->Html->link('修正',array('controller' => 'Admin','action' => 'editAdmin',$user['Admin']['admin_id'])).$close;
					echo $td.$this->Html->link('削除',array('controller' => 'admin','action' => 'deleteAdmin',$user['Admin']['admin_id']),array('class' => 'link_delete')).$close;					
					echo "</tr>";			
				endforeach;
			?>
		</tbody>
	</table>
</div>

</div>
