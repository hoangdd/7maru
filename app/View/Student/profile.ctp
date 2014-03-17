<div class="row">
	
<div class="col-md-3">
	
	<?php
	if($data['User']['profile_picture'] == null) $image = 'default_profile.jpg';
        else $image = IMAGE_PROFILE_LINK.$data['User']['profile_picture'];
   echo $this->Html->image($image, array(
	'width' => '180px',
	'class' => 'img-rounded',
	'style' => 'text-align:center;'
	)); 
	?>
	
	<div>
		<?php
    echo "<br>";
    echo $this->Html->link('EditProfile',
      'EditProfile',array(
        'class'=>'btn btn-primary btn-lg',
        'role'=>'button',
        'style'=>'width:180px;height:30px;font-size:14px;text-align:center;padding: 6px;'
      ));
    echo "<br><br>";
    echo $this->Html->link('Statistic',
      'Statistic',array(
        'class'=>'btn btn-primary btn-lg',
        'role'=>'button',
                'style'=>'width:180px;height:30px;font-size:14px;text-align:center;padding: 6px;'
      ));
        echo "<br><br>";
        echo $this->Html->link('ManageLessons',
            'Managelessons',array(
                'class'=>'btn btn-primary btn-lg',
                'role'=>'button',
                'style'=>'width:180px;height:30px;font-size:14px;text-align:center;padding: 6px;'
            ));
    ?>
	</div>
</div>
<div class="col-md-9">
	<dl style="font-size:16px;font-family:”Times New Roman”;border:1px solid #a1a1a1;padding:10px 40px; background:#99FF33;width:600px;border-radius:25px;" class="dl-horizontal">

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
      <dd><?php echo $data1['Student']['credit_account'];?></dd>
      <br>
      </dl>
      
      <div style="font-size:16px;font-family:”Times New Roman”;border:1px solid #a1a1a1;padding:10px 40px;background:#FFFFFF;width:600px;border-radius:25px;">
            <table class="table">
                 <tr><td>STT</td><td>Lesson</td><td>Subject</td><td>Status</td></tr>
                 <?php
                 for($i=0;$i<count($arr);$i++){
                    $b=$i+1;
                    echo "<tr><td>".$b."</td><td>".$arr[$i]['Coma']['name']."</td><td>".$arr[$i]['Coma']['title']."</td><td>bought</td></tr>";
                 }
                 ?>
            </table>
      </div>
      <br>
      <div style="font-size:16px;font-family:”Times New Roman”;border:1px solid #a1a1a1;padding:10px 40px;background:#CCFF66;width:600px;border-radius:25px;">
           <h4 style="font-family:”Times New Roman”;"><b>Test Result:</b></h4>
           <ul class="list-styled">
           <li>Math test 5: 9</li>
           <li>Math test 5: 8</li>
           </ul>
      <div>

</div>

</div>