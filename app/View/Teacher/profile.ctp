<div class="row">
	
	<div class="col-md-3 center-block">
		<?php    
		 $image = IMAGE_PROFILE_LINK.$data['User']['profile_picture'];   
		echo $this->Html->image($image, array(	

		'width' => '180px',
		'class' => 'img-rounded',
		'style' => 'text-align:center;'
		)); 
		?>
		<hr>
		<?php if($canLike) : ?>
			<script type="text/javascript">
			var teacher_id = '<?php echo $teacher_id; ?>';
			var student_id = '<?php echo $student_id; ?>';
			$(document).ready(function(){
				$('.like-btn').click(function(){
					if( !$(this).hasClass('active') ){
						//like
						$.ajax({
							'url' : '<?php echo $this->Html->url(array("controller" => "student", "action" => "like"));?>',
							'type' : 'post', 
							'data' : {'teacher_id':teacher_id, 'student_id':student_id},
							complete : function(res){
								if( res.responseText == 1){
									$('.like-btn').html('<?php echo __("Liked");?>');
								}else{
									alert("<?php echo __('Has error! Please try again later.')?>");
									$('.like-btn').removeClass('active');
								}
							}
						});
					}else{
						//unlike
						$.ajax({
							'url' : '<?php echo $this->Html->url(array("controller" => "student", "action" => "unlike"));?>',
							'type' : 'post', 
							'data' : {'teacher_id':teacher_id, 'student_id':student_id},
							complete : function(res){
								console.log(res);
								if( res.responseText == 1){
									$('.like-btn').html('<?php echo __("Like");?>');
								}else{
									alert("<?php echo __('Has error! Please try again later.')?>");
									$('.like-btn').addClass('active');
								}
							}
						});
					}
				})
			});	
			</script>
			<div class="btn-group " data-toggle="buttons">
					<?php
						if( !empty($likes))
							echo '<label class="btn btn-primary like-btn active">'.__('Liked');
						else
							echo '<label class="btn btn-primary like-btn">'.__('Like');
					?>
				</label>
			</div>
		<?php endif;?>
	<div>
	 <?php 
		$role = $_SESSION['Auth']['User']['role'];
		if ( !$isOther){
	 ?>
		<a href="<?php echo $this->Html->url(array('controller' => 'Teacher', 'action' => 'EditProfile')) ?>" style="width:180px;height:30px;font-size:14px;text-align:center;" class="btn btn-primary btn-lg" role="button"><?php echo __('Edit Profile') ?></a>
		<br><br>
		<a href="Statistic" style="width:180px;height:30px;font-size:14px;text-align:center;" class="btn btn-primary btn-lg" role="button"><?php echo __('Statistic') ?></a>
		<br><br>
		<a href=<?php echo "'".$this->Html->url(array('controller' => 'login','action' => 'changePassword'))."'" ?> style="width:180px;height:30px;font-size:14px;text-align:center;" class="btn btn-primary btn-lg" role="button"><?php echo __('Change Password') ?></a>	
  <?php     
	 }else if ($role === 'R1'){
  ?>
  <a href="<?php echo $this->Html->url(array('controller' => 'Teacher', 'action' => 'EditProfile', $data['User']['user_id'])) ?>" style="width:180px;height:30px;font-size:14px;text-align:center;" class="btn btn-primary btn-lg" role="button"><?php echo __('Edit Profile') ?></a>  
  <?php  
	 }    
  ?>
</div>
</div>
<div class="col-md-9">
	<dl style="font-size:16px;font-family:”Times New Roman”;border:1px solid #a1a1a1;padding:10px 40px; background:#CCFFCC;width:600px;border-radius:25px;" class="dl-horizontal">
		<dt><?php echo __('Username').':' ?></dt>
		<dd><?php echo $data['User']['username'];?></dd>
		<br>
		<dt><?php echo __('Real name').':' ?></dt>
		<dd><?php echo $data['User']['firstname'].$data['User']['lastname'];?></dd>
		<br>
		<dt><?php
		//if(isset($data['User']['date_of_birth'])) { 
			echo __('Birthday').':' ?></dt>
		<dd><?php echo $data['User']['date_of_birth']; ?></dd>
		<br>
		<?php if($canViewEmail){ ?>
			<dt><?php echo __('メール').':' ?></dt>
			<dd><?php echo $data['User']['mail'];?></dd>
			<br>
			<dt><?php echo __('アドレス').':' ?></dt>
			<dd><?php echo $data['User']['address'];?></dd>
			<br>
			<dt><?php echo __('Telephone number').':' ?></dt>
			<dd><?php
				if(isset($data['User']['phone_number']))
					echo $data['User']['phone_number'];
				else echo __('電話番後はまだ登録しませんでした');
				?></dd>
			<br>
			<br>
			<?php 
			  if(isset($data1['Teacher']['bank_account'])){
				 echo "<dt>".__('Bank Account').':'."</dt>"."<dd>".$data1['Teacher']['bank_account']."</dd>";    
				 }  
				?>
			<br>
		<?php }?>
		<dt><?php echo __('Regitration Date').':' ?><dt>
		<dd><?php echo $data['User']['created'];?></dd>
		
	</dl>
		<div style="font-size:16px;font-family:”Times New Roman”;border:1px solid #a1a1a1;padding:10px 40px;background:#CAFFAC;width:600px;border-radius:25px;">
				<h4 style="font-family:”Times New Roman”;"><b><?php echo __('Introduce yourself').':' ?></b></h4>
				<p style="font-family:”Times New Roman”;">
						<?php
						if(!isset($data1['Teacher']['description']) || $data1['Teacher']['description'] === '')
							echo __('');
						else echo $data1['Teacher']['description'];
						?>
				</p>
		</div>
		<br>
		<!-- <div style="font-size:16px;font-family:”Times New Roman”;border:1px solid #a1a1a1;padding:10px 40px;background:#FFFFFF;width:600px;border-radius:25px;">
				<table class="table">
					  <tr><td><?php echo __('No') ?></td><td><?php echo __('Lesson') ?></td><td><?php echo __('Subject') ?></td><td><?php echo __('Created Account Time') ?></td></tr>
					  <?php
					  for($i=0;$i<count($data2);$i++){
						 $temp=$i+1;
						 echo "<tr><td>".$temp."</td><td>".$data2[$i]['Coma']['name']."</td><td>".$data2[$i]['Coma']['title']."</td><td>".$data2[$i]['Coma']['created']."</td><tr>";
					  }
					  ?>
				</table>
		</div> -->
</div>

</div>
<?php //comment ?>
<br><br><br>
<?php
	$option = array(
		'width' => '100%', 
		'teacher_id' => $data['User']['user_id'],
		'comments' => !empty($comments) ? $comments : array(),
		'canComment' => $canComment
	);
	echo $this->element('comment_teacher', $option);
?>
