<?php
	debug($error);
?>
<div class="col-md-5">
	<form role="form" method="post">
		<h1>Change Password</h1>
		<div class="form-group">
		<label for="currentPassword">Current Password</label>
			<input type="password" name='current-pw' class="form-control">
		</div>
		<div class="form-group">
			<label for="newPassword">New Password</label>
			<input type="password" name='new-pw' class="form-control">
		</div>
		<div class="form-group">
			<label for="confirmPassword">Confirm Password</label>
			<input type="password" name='confirm-pw' class="form-control">
		</div>
		<button type="submit" class="btn btn-default">Submit</button>
	</form>
</div>