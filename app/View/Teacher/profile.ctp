<div class="row">
	
<div class="col-md-3">

	<?php    
    $image = IMAGE_PROFILE_LINK.$data['User']['profile_picture'];   
   echo $this->Html->image($image, array(	

	'width' => '180px',
	'class' => 'img-rounded',
	'style' => 'text-align:center;'
	)); 
	?>
	<br>
	<br>
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
      <dt><?php echo __('Email').':' ?></dt>
      <dd><?php echo $data['User']['mail'];?></dd>
      <br>
      <dt><?php echo __('Address').':' ?></dt>
      <dd><?php echo $data['User']['address'];?></dd>
      <br>
      <dt><?php echo __('Telephone number').':' ?></dt>
      <dd><?php
      	if(isset($data['User']['phone_number']))
      		echo $data['User']['phone_number'];
      	else echo __('電話番後はまだ登録しませんでした');
      	?></dd>
      <br>
      <dt><?php echo __('Regitration Date').':' ?><dt>
      <dd><?php echo $data['User']['created'];?></dd>
      <br>
      <?php 
        if(isset($data1['Teacher']['bank_account'])){
          echo "<dt>".__('Bank Account').':'."</dt>"."<dd>".$data1['Teacher']['bank_account']."</dd>";    
          }  
      	?>
      <br>
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
      <div style="font-size:16px;font-family:”Times New Roman”;border:1px solid #a1a1a1;padding:10px 40px;background:#FFFFFF;width:600px;border-radius:25px;">
            <table class="table">
                 <tr><td><?php echo __('No') ?></td><td><?php echo __('Lesson') ?></td><td><?php echo __('Subject') ?></td><td><?php echo __('Created Account Time') ?></td></tr>
                 <?php
                 for($i=0;$i<count($data2);$i++){
                   $temp=$i+1;
                   echo "<tr><td>".$temp."</td><td>".$data2[$i]['Coma']['name']."</td><td>".$data2[$i]['Coma']['title']."</td><td>".$data2[$i]['Coma']['created']."</td><tr>";
                 }
                 ?>
            </table>
      </div>
</div>

</div>