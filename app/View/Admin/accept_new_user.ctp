<?php 
$this->Paginator->options(array(
	'update' => '#user_list',
	'evalScripts' => true
	));
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

						<th class='text-center' style="width:5%">
							<?php echo __('Type') ?>
						</th>
						<th class='text-center' style="width:15%">
							<?php echo __('Date of birth') ?>
						</th>
						<th class='text-center' style="width:25%">
							<?php echo __('Created Account Time'); ?>
						</th>
						<th class='text-center' style="width:5%">
							<?php echo __('Accept'); ?>
						</th>
					</tr>
				</thead>
				<tbody>
					<?php 			
					$i=1;
					$td = "<td class='text-center'>";
					$close = "</td>";
					foreach($data as $user):
						echo "<tr class='item' itemid='".$user['User']['user_id']."'>";
						echo $td.$i++."</td>";										
						echo $td.$user['User']['lastname'].$user['User']['firstname'].$close;				
						echo $td.$user['User']['username'].$close;								
						echo $td.$user['User']['user_type'].$close;
						echo $td.$user['User']['date_of_birth'].$close;				
						echo $td.$user['User']['created'].$close;				
						echo $td."<button type='button' id='acceptUser' name='".$user['User']['user_id']."' class='text-center accept-btn btn btn-default'>OK</button>".$close;
						echo "</tr>";			
					endforeach;
					?>
				</tbody>
			</table>
		</div>

		<!-- paginate -->
		<div class='text-center'>	
			<ul class="pagination">
				<?php 
				echo $this->Paginator->prev('< ', array('tag' => 'li'), null, array('class' => 'disabled','tag' => 'li','disabledTag'=>'a'));
				echo $this->Paginator->numbers(array('tag' => 'li','separator' => '','currentClass' =>'active','currentTag' => 'a'));
				echo $this->Paginator->next(' >', array('tag' => 'li'), null, array('class' => 'disabled','tag' => 'li','disabledTag'=>'a',));
				?>	 
			</ul>
			<?php
			?>
		</div>
	</div>



<script>
    $(document).ready(function(){
    	$('.accept-btn').click(function(){
            var id = $(this).attr('name');
            $.ajax({
            url : "isAcceptNewUser",
            data : {id : id},
            type : 'post',
            dataType : 'json',
            complete : function(data){
                console.log(data);
                if (data.responseText == 1) {
                    location.reload();
                }else{
                    alert('Error has occured.');
                }
            },
        })

    })
});
</script>