<div class="col-md-5">
	<form role="form" action="login" method="post" >
		<h1><?php echo __('Admin Login') ?></h1>
		<?php 
		echo $this->Session->flash('auth');
		?>
		<div class="form-group">
			<label for="inputUsername"><?php echo __('Username') ?></label>
			<input type="Username" name='Admin[username]' class="form-control" id="inputUsername" placeholder="Username">
		</div>
		<div class="form-group">
			<label for="inputPassword"><?php echo __('Password') ?></label>
			<input type="password" name='Admin[password]' class="form-control" id="inputPassword" placeholder="Password">
		</div>	
		<div class="checkbox">
			<label>
				<input type="checkbox" name='remember'> <?php echo __('僕をおぼえませんか？').'?' ?>
			</label>
		</div>
		<button type="submit" class="btn btn-default"><?php echo __('Login') ?></button>
	</form>
</div>

