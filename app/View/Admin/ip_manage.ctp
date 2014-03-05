<style type="text/css">
 .no-col, .del-ip-col, .edit-ip-col{
 	text-align: center;
 }	
</style>
<!-- header -->
<h3 style="text-align:center">
	IP Adress Manage
</h3>
<!-- table -->
<div class="">
	<table class="table table-striped table-bordered">

		<thead>
			<tr>

				<th class='no-col' style="width:10%">
					No.
				</th>

				<th class='ip-col' style="width:60%">
					IP address
				</th>

				<th class='del-ip-col' style="width:15%">
					Delete IP address
				</th>

				<th class='edit-ip-col' style="width:15%">
					Edit IP address
				</th>
			</tr>
		</thead>
		<tbody>
			<?php 
			$array_item = $array_list['2'];
			$i = 1;
			foreach($array_item as $value){
			echo"<tr>
				<td class='no-col'>".
					$i.
				"</td>
				<td class='ip-col'>"
					.$value.
				"</td>

				<td class='del-ip-col'>
					<a href=#>Delete</a>
				</td>

				<td class='edit-ip-col'>
					<a href=#>Edit</a>
				</td>
			</tr>
			";
			$i++;
			}
			?>
			<tr>
				<td class='no-col'>
					<button type="button" class="btn btn-default">
					  <span class="glyphicon glyphicon-plus"></span>Add
					</button>
				</td>
				<td class='ip-col'>
					<input type="text" class="form-control" placeholder="Add new IP address">

				</td>

				<td class='del-ip-col'>
					
				</td>

				<td class='edit-ip-col'>
					
				</td>
			</tr>

		</tbody>
	</table>
</div>

<!-- paginate -->
<div class='text-center'>
	<ul class="pagination">
	  <li><a href="#">&laquo;</a></li>
	  <?php 
	  $i = count($array_list);
	  for($ij = 1; $ij <= $i; $ij++){
		  echo "<li><a href=#>".$ij."</a></li>";
		}
	?>
	  <li><a href="#">&raquo;</a></li>
	</ul>

</div>
