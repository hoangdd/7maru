<!-- header -->
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

				<th class='' style="width:30%">
					Name
				</th>

				<th class='text-center' style="width:10%">
					Username
				</th>

				<th class='text-center' style="width:5%">
					Type
				</th>
				<th class='text-center' style="width:10%">
					Date of birth
				</th>
				<th class='text-center' style="width:10%">
					Created Account Time
				</th>
				<th class='text-center' style="width:5%">
					Edit
				</th>
				<th class='text-center' style="width:5%">
					Destroy
				</th>
				<th class='text-center' style="width:10%">
					Reset password
				</th>
				<th class='text-center' style="width:10%">
					Verify code
				</th>
			</tr>
		</thead>
		<tbody>
			<?php 
				$i=1;
				foreach($data as $user):
			?>
			<tr>				
				<td class='text-center'>
					<?php echo $i++; ?>
				</td>
				<td class='text-center'>
					<?php echo $user['User']['lastname'].$user['User']['firstname'] ?>
				</td>

				<td class='text-center'>
					<?php echo $user['User']['username'] ?>
				</td>

				<td class='text-center'>
					<?php echo $user['User']['user_type'] ?>
				</td>
				<td class='text-center'>
					<?php echo $user['User']['date_of_birth'] ?>
				</td>

				<td class='text-center'>
					<?php echo $user['User']['created'] ?>
				</td>

				<td class='text-center'>
					<a href="#">Edit</a>
				</td>
				<td class='text-center'>
					<a href="#">Delete</a>
				</td>

				<td class='text-center'>
					<a href="#">Reset</a>
				</td>

				<td class='text-center'>
					<a href="#"></a>
				</td>
			</tr>
			<?php
				endforeach;
			?>
		</tbody>
	</table>
</div>

<!-- paginate -->
<div class='text-center'>
	<ul class="pagination">
	  <li><a href="#">&laquo;</a></li>
	  <li><a href="#">1</a></li>
	  <li><a href="#">2</a></li>
	  <li><a href="#">3</a></li>
	  <li><a href="#">4</a></li>
	  <li><a href="#">5</a></li>
	  <li><a href="#">&raquo;</a></li>
	</ul>

</div>
