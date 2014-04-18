<script>
	count = 0;username = "";
</script>
<?php 
	if (!isset($username))
		$username = "";
	if (isset($isBlock) && ($isBlock > 0)){
		echo "<script>count =" .$isBlock. "; username = '". $username ."'; </script>";
	}
?>
<div class="col-md-5">
	<form role="form" method="post" >
		<?php if (!isset($isBlock) || ($isBlock == 0)){ ?>
		<h1><?php echo __('Login') ?></h1>
		<?php 			
			echo $this->Session->flash('auth');			
		?>			
		<div class="form-group">
			<label for="inputUsername"><?php echo __('Username') ?></label>
			<input type="Username" name='User[username]' class="form-control" id="inputUsername1" placeholder="Username" value="<?php echo $username ?>">
		</div>		
		<div class="form-group">
			<label for="inputPassword"><?php echo __('Password') ?></label>
			<input type="password" name='User[password]' class="form-control" id="inputPassword" placeholder="Password">
		</div>				
		<button type="submit" class="btn btn-default"><?php echo __('Login') ?></button>
		<?php } ?>
	</form>
	<div id='warning'> </div>
</div>	
<script>
$(document).ready(function(){	
	if (count > 0 ){		
		// alert(<?php echo  "'".__("Wait for 5s to continue")."'" ?>);
		//disable submit button					
		counter = setInterval(timer,1000);		
		$("#warning").addClass("alert alert-success");
		$("#warning").html(<?php echo "'".__("Your account is blocking, waiting for ")."'" ?>+count+"s");		
		//time
	}
	function timer(){
		$("#warning").html(<?php echo "'".__("Your account is blocking, waiting for ")."'" ?>+count+"s");		
		count--;
		if (count < 0){
			//redirect to confirmverifyCode			
			window.location.replace("<?php echo $this->Html->url(array('controller' => 'Login','action' =>'confirmVerifycode')) ?>"+"/"+username+"/1");
		}
		return;
	}
})
</script>
