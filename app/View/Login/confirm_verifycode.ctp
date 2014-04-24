<div class="col-md-5">
	<form role="form" method="post" >
		<h1><?php echo __('Confirm verifycode') ?></h1>		
		<div class="form-group">
			<label for="inputUsername"><?php echo __('Username') ?></label>
			<input type="Username" name='User[username]' class="form-control" id="inputUsername1" value="<?php echo $username ?>" readonly>
		</div>		
		<p></p>
		 <input name="User[question]" type="text" class="form-control" value="<?php if (isset($question)) echo $question ?>" readonly />
		<p></p>
		 <input name="User[answer]" type="text" class="form-control" placeholder="<?php echo __('Answer this question') ?>" />
		 <p></p>		
		<button type="submit" class="btn btn-default"><?php echo __('Confirm') ?></button>
	</form>	
</div>

