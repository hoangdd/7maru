
<!-- header -->
<div id="user_list">
<h3 style="text-align:center">
	<?php echo __('USER MANAGE') ?>
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

				<th class='text-center' style="width:6%">
					<?php echo __('Type') ?>
				</th>
				<th class='text-center' style="width:10%">
					<?php echo __('Date of birth') ?>
				</th>
				<th class='text-center' style="width:15%">
					<?php echo __('Created Account Time') ?>
				</th>
				<th class='text-center' style="width:5%">
					<?php echo __('Profile') ?>
				</th>
				<th class='text-center' style="width:5%">
					<?php echo __('Destroy') ?>
				</th>
				<th class='text-center' style="width:10%">
					<?php echo __('Password') ?>
				</th>
				<th class='text-center' style="width:5%">
					<?php echo __('verify コード') ?>
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
					echo $td.$user['User']['lastname'].$user['User']['firstname'].$close;				
					echo $td.$user['User']['username'].$close;								
					if ($user['User']['user_type'] == 1){
						$user_type = 'Teacher';
					}
					else{
						$user_type = 'Student';
					}
					echo $td.$user_type.$close;								
					echo $td.$user['User']['date_of_birth'].$close;				
					echo $td.$user['User']['created'].$close;				
					$type = $user['User']['user_type'] == 1 ? 'Teacher': 'Student';

					echo $td.$this->Html->link(__('View'),array('controller' => $type,'action' => 'profile',$user['User']['user_id'])).$close;
					echo $td.$this->Html->link(__('Delete'),array('controller' => 'User','action' => 'delete',$user['User']['user_id']),array('class' => 'delete_link')).$close;
					echo $td;					
					echo $this->Html->link(__('Reset'),array('controller' => 'admin','action' => 'resetPassword',$user['User']['user_id']));				
					echo $close;
					echo $td;
					if ($user['User']['user_type'] == 1){
						echo $this->Html->link(__('Reset'),array('controller' => 'admin','action' => 'resetVerifycode',$user['User']['user_id']));
					}
					echo $close;
					echo "</tr>";			
				endforeach;
			?>
		</tbody>
	</table>
</div>


</div>

<script>
    $(document).ready(function(){
        $("a.delete_link").click(function(){
            var src = $(this).attr('href');           
            var link = $(this);
            var isConfirm = confirm("<?php echo __('Confirm') ?>");
            if (!isConfirm){
                return false;
            }                    
            $.get(
                src,             
                function (data){                
                    if (data.trim() === '1'){
                        alert("<?php echo __('Successfully') ?>");                       
                        // link.parent().parent().replaceWith("");
                        window.location.reload(true);
                        return;                        
                    }
                    else
                    {
                        alert("<?php echo __('Error') ?>")
                    }
                }
            );
            return false;
        })
    })
</script>