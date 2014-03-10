<?php 
	$this->Paginator->options(array(
         'update' => '#user_list',
         'evalScripts' => true
         ));
?>
<!-- header -->
<div id="user_list">
<h3 style="text-align:center">
	USER MANAGE
</h3>
<!-- table -->
<div class="">
	<table class="table table-striped table-bordered">

		<thead>
			<tr>

				<th class='text-center' style="width:5%">
					No.
				</th>

				<th class='' style="width:10%">
					Name
				</th>

				<th class='text-center' style="width:10%">
					Username					
				</th>

				<th class='text-center' style="width:5%">
					Type
				</th>
				<th class='text-center' style="width:15%">
					Date of birth
				</th>
				<th class='text-center' style="width:25%">
					Created Account Time
				</th>
				<th class='text-center' style="width:5%">
					Edit
				</th>
				<th class='text-center' style="width:5%">
					Destroy
				</th>
				<th class='text-center' style="width:5%">
					Reset password
				</th>
				<th class='text-center' style="width:5%">
					Verify code
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
					echo $td.$user['User']['user_type'].$close;								
					echo $td.$user['User']['date_of_birth'].$close;				
					echo $td.$user['User']['created'].$close;				
					echo $td.$this->Html->link('Edit',array('controller' => 'admin','action' => 'edit')).$close;
					echo $td.$this->Html->link('Delete',array('controller' => 'admin','action' => 'delete')).$close;
					echo $td.$this->Html->link('Reset',array('controller' => 'admin','action' => 'Reset')).$close;
					echo $td.$this->Html->link('Reset',array('controller' => 'admin','action' => 'Reset')).$close;
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
<?php echo $this->Js->writeBuffer(); ?>