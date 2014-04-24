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
	
	<div>       
		<?php
    $role = $_SESSION['Auth']['User']['role'];
      if ( !$isOther){
        echo "<br>";
        echo $this->Html->link(__('Edit Profile'),
          array(
            'controller' => 'Student',
            'action' => 'EditProfile'          
            ),
          array(
            'class'=>'btn btn-primary btn-lg',
            'role'=>'button',
            'style'=>'width:180px;height:30px;font-size:14px;text-align:center;padding: 6px;'
            ));
        echo "<br><br>";
        echo $this->Html->link(__('Statistic'),
          'Statistic',array(
            'class'=>'btn btn-primary btn-lg',
            'role'=>'button',
            'style'=>'width:180px;height:30px;font-size:14px;text-align:center;padding: 6px;'
            ));
        echo "<br><br>";
      }
      else if ($role === 'R1'){
        echo $this->Html->link(__('Edit Profile'),
          array(
            'controller' => 'Student',
            'action' => 'EditProfile',
            $data['User']['user_id']
            ),
          array(
            'class'=>'btn btn-primary btn-lg',
            'role'=>'button',
            'style'=>'width:180px;height:30px;font-size:14px;text-align:center;padding: 6px;'
            ));
        echo "<br><br>";
      }
        // echo $this->Html->link(__('Lesson Manage'),
        //   'Managelessons',array(
        //     'class'=>'btn btn-primary btn-lg',
        //     'role'=>'button',
        //     'style'=>'width:180px;height:30px;font-size:14px;text-align:center;padding: 6px;'
        //     ));
    ?>
	</div>
</div>
<div class="col-md-9">
	<dl style="font-size:16px;font-family:”Times New Roman”;border:1px solid #a1a1a1;padding:10px 40px; background:#99FF33;width:600px;border-radius:25px;" class="dl-horizontal">

      <dt><?php echo __('Username').':' ?></dt>
      <dd><?php echo $data['User']['username'];?></dd>
      <br>
      <dt><?php echo __('Real name').':' ?></dt>
      <dd><?php echo $data['User']['firstname'].$data['User']['lastname'];?></dd>
      <br>
      <dt><?php echo __('Birthday').':' ?></dt>
      <dd><?php echo $data['User']['date_of_birth'];?></dd>
      <br>
      <?php if($canViewEmail) { ?>
        <dt><?php echo __('メール').':' ?></dt>
        <dd><?php echo $data['User']['mail'];?></dd>
        <br>
        <dt><?php echo __('アドレス').':' ?></dt>
        <dd><?php echo $data['User']['address'];?></dd>
        <br>
        <dt><?php echo __('Telephone number').':' ?></dt>
        <dd><?php echo $data['User']['phone_number'];?></dd>
        <br>
        <dt><?php echo __('Bank Account').':' ?></dt>
        <dd><?php echo $data1['Student']['credit_account'];?></dd>
        <br>
      <?php } ?>
      <dt><?php echo __('Regitration Date').':' ?><dt>
      <dd><?php echo $data['User']['created'];?></dd>
      <br>
      
      </dl>
  <!--     
      <div style="font-size:16px;font-family:”Times New Roman”;border:1px solid #a1a1a1;padding:10px 40px;background:#FFFFFF;width:600px;border-radius:25px;">
            <table class="table">
                 <tr><td>STT</td><td><?php echo __('Lesson') ?></td><td><?php echo __('Subject') ?></td><td><?php echo __('Status') ?></td></tr>
                 <?php
                 for($i=0;$i<count($arr);$i++){
                    $b=$i+1;
                    echo "<tr><td>".$b."</td><td>".$arr[$i]['Coma']['name']."</td><td>".$arr[$i]['Coma']['title']."</td><td>bought</td></tr>";
                 }
                 ?>
            </table>
      </div>
      <br> -->     

</div>

</div>