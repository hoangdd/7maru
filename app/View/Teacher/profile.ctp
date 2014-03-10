<div class="row">
	
<div class="col-md-3">
	
	<?php
   echo $this->Html->image("data/avata/".$data1['User']['profile_picture'], array(
	'alt' => 'CakePHP',
	'width' => '180px',
	'class' => 'img-rounded',
	'style' => 'text-align:center;'
	)); 
	?>
	<br>
	<br>
	<div>
		<a href="EditProfile" style="width:180px;height:30px;font-size:14px;text-align:center;" class="btn btn-primary btn-lg" role="button">Edit Profile</a>
		<br><br>
		<a href="Statistic" style="width:180px;height:30px;font-size:14px;text-align:center;" class="btn btn-primary btn-lg" role="button">Statistic</a>
		<br><br>
		<a href="ChangePassword" style="width:180px;height:30px;font-size:14px;text-align:center;" class="btn btn-primary btn-lg" role="button">Change Password</a>
	</div>
</div>
<div class="col-md-9">
	<dl style="font-size:16px;font-family:”Times New Roman”;border:1px solid #a1a1a1;padding:10px 40px; background:#CCFFCC;width:600px;border-radius:25px;" class="dl-horizontal">
      <dt>User name:</dt>
      <dd><?php echo $data['User']['username'];?></dd>
      <br>
      <dt>Real name:</dt>
      <dd><?php echo $data['User']['firstname'].$data['User']['lastname'];?></dd>
      <br>
      <dt>Birthday:</dt>
      <dd><?php echo $data['User']['date_of_birth'];?></dd>
      <br>
      <dt>Living:</dt>
      <dd><?php echo $data['User']['address'];?></dd>
      <br>
      <dt>Telephone number:</dt>
      <dd><?php echo $data['User']['phone_number'];?></dd>
      <br>
      <dt>Regitration Date:<dt>
      <dd><?php echo $data['User']['created'];?></dd>
      <br>
      <dt>Bank Account:</dt>
      <dd><?php echo $data1['Teacher']['bank_account'];?></dd>
      <br>
      </dl>
      <div style="font-size:16px;font-family:”Times New Roman”;border:1px solid #a1a1a1;padding:10px 40px;background:#CAFFAC;width:600px;border-radius:25px;">
            <h4 style="font-family:”Times New Roman”;"><b>Introduce Themselves:</b></h4>
            <p style="font-family:”Times New Roman”;">
                  <?php
                  echo $data1['Teacher']['description'];
                  ?>
            </p>
      </div>
      <br>
      <div style="font-size:16px;font-family:”Times New Roman”;border:1px solid #a1a1a1;padding:10px 40px;background:#FFFFFF;width:600px;border-radius:25px;">
            <table class="table">
                 <tr><td>STT</td><td>Lesson</td><td>Subject</td><td>Creation Date</td></tr>
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