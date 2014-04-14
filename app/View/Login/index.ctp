<script>isBlock = 0;</script>
<div class="col-md-5">
	<form role="form" method="post" >
		<h1><?php echo __('Login') ?></h1>
		<?php 			
			echo $this->Session->flash('auth');			
		?>
		<div class="form-group">
			<label for="inputUsername"><?php echo __('Username') ?></label>
			<input type="Username" name='User[username]' class="form-control" id="inputUsername1" placeholder="Username">
		</div>
		<div class="form-group">
			<label for="inputPassword"><?php echo __('Password') ?></label>
			<input type="password" name='User[password]' class="form-control" id="inputPassword" placeholder="Password">
		</div>
		
		<?php  
			if ( ( isset($_SESSION['countFail']) && $_SESSION['countFail'] >= 3 ) || (isset($_SESSION['isValidIp']) && !$_SESSION['isValidIp']) ){
				if ($_SESSION['countFail'] >= 3){
					//isBlock
					echo "<script>isBlock =". $_SESSION['countFail']."</script>";
				}			
					//echo input verifycode	
			?>		
		<p></p>
		<select name="question" class="form-control">
			<option><?php echo __('What subject do you like') ?></option>
			<option><?php echo __('What activity do you like') ?></option>
			<option><?php echo __('What do you do in freetime') ?></option>
			<option><?php echo __('How often do read book') ?></option>
			<option><?php echo __('What song do you like') ?></option>
		</select>
		<p></p>
		 <input name="answer" type="text" class="form-control" placeholder="<?php echo __('Answer this question') ?>" />
		 <p></p>
		<?php
				echo $this->Session->flash('verifycode');			
			}

		?>
		<button type="submit" class="btn btn-default"><?php echo __('Login') ?></button>
	</form>
	<!-- <div class="login_form_label_field">
			<a rel="nofollow" href=""><?php echo __('Forgot your password')."?" ?></a>`
		</div>
		<div class="checkbox">
			<label>
				<input type="checkbox" name='remember'> <?php echo __('Remember me').'?' ?>
			</label>
		</div>
</div> -->
<div id="overlay" style="position:absolute;top:0;left:0;width:100%;height:100%;display:none;background-color:green;opacity:0.5;" >
	<strong style="position:absolute;top:50%;left:50%;font-size:larger"></strong>
</div>
<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <?php echo __('Please wait at least 5s to continue!'); ?>
    </div>
  </div>
</div>
<script>
$(document).ready(function(){
	if (isBlock %3 == 0 && isBlock != 0 ){
		count = 5;
		// alert(<?php echo  "'".__("Wait for 5s to continue")."'" ?>);
		//disable submit button		
		$("#overlay").show();
		$('.bs-example-modal-sm').modal();				
		counter = setInterval(timer,1000);		
		//time
	}
	function timer(){
		$("#overlay strong").html(count);
		count--;
		if (count < 0){
			clearInterval(counter);$("#overlay").hide();
		}
		return;
	}
})
</script>
