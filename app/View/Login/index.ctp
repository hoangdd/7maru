<div class="col-md-5">
	<form role="form" method="post" >
		<h1>Login</h1>
		<?php 			
			echo $this->Session->flash('auth');			
		?>
		<div class="form-group">
			<label for="inputUsername">Username</label>
			<input type="Username" name='User[username]' class="form-control" id="inputUsername1" placeholder="Username">
		</div>
		<div class="form-group">
			<label for="inputPassword">Password</label>
			<input type="password" name='User[password]' class="form-control" id="inputPassword" placeholder="Password">
		</div>
		
		<?php  
			if (isset($_SESSION['countFail'])){
				if ($_SESSION['countFail'] >= 3){					
					//echo input verifycode	
			?>		
		<p></p>
		<select name="question" class="form-control">
			<option>What subject do you like?</option>
			<option>What activity do you like?</option>
			<option>What do you do in freetime?</option>
			<option>How often do read book?</option>
			<option>What song do you like?</option>
		</select>
		<p></p>
		 <input name="answer" type="text" class="form-control" placeholder="<?php echo __('Answer this question') ?>" />
		 <p></p>
		<?php
				echo $this->Session->flash('verifycode');
		
				}
			}

		?>
		<button type="submit" class="btn btn-default">Submit</button>
	</form>
	<div class="login_form_label_field">
			<a rel="nofollow" href="">Forgot your password?</a>
		</div>
		<div class="checkbox">
			<label>
				<input type="checkbox" name='remember'> Remember me?
			</label>
		</div>
</div>

<script>
	$(document).ready(fucntion(){

	})
</script>