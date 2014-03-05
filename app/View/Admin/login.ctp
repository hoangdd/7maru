<div class="col-md-5">
	<form role="form" action="login" method="post" >
		<h1>Admin login</h1>
		<?php 
		echo $this->Session->flash('auth');
		?>
		<div class="form-group">
			<label for="inputUsername">Username</label>
			<input type="Username" name='Admin[username]' class="form-control" id="inputUsername" placeholder="Username">
		</div>
		<div class="form-group">
			<label for="inputPassword">Password</label>
			<input type="password" name='Admin[password]' class="form-control" id="inputPassword" placeholder="Password">
		</div>
		<div class="login_form_label_field">
			<a rel="nofollow" href="">Forgot your password?</a>
		</div>
		<div class="checkbox">
			<label>
				<input type="checkbox" name='remember'> Remember me?
			</label>
		</div>
		<button type="submit" class="btn btn-default">Submit</button>
	</form>
</div>

