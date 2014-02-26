<div class="row">
	
<div class="col-md-3">
	
	<?php
   echo $this->Html->image('resource/ldp.jpg', array(
	'alt' => 'CakePHP',
	'width' => '180px',
	'class' => 'img-rounded',
	'style' => 'text-align:center;'
	)); 
	?>
	
	<div>
		<?php
    echo "<br>";
    echo $this->Html->link('Editprofile',
      'Editprofile',array(
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
    <?php
    $user=array('username'=>'PhiLP',
    'realname'=>'Luu Diec Phi',
    'date_of_birth'=>'25/8/1987',
    'address'=>'Hoang Mai, Hai Ba Trung, Ha Noi',
    'phone_number'=>'01685914218',
    'created'=>'23/2/2014',
    'bank_account'=>'ADGDGDGD3232DGDG'
      )
    ?>
      <dt>User name:</dt>
      <dd><?php echo $user['username'];?></dd>
      <br>
      <dt>Real name:</dt>
      <dd><?php echo $user['realname'];?></dd>
      <br>
      <dt>Birthday:</dt>
      <dd><?php echo $user['date_of_birth'];?></dd>
      <br>
      <dt>Living:</dt>
      <dd><?php echo $user['address'];?></dd>
      <br>
      <dt>Telephone number:</dt>
      <dd><?php echo $user['phone_number'];?></dd>
      <br>
      <dt>Regitration Date:<dt>
      <dd><?php echo $user['created'];?></dd>
      <br>
      <dt>Bank Account:</dt>
      <dd><?php echo $user['bank_account'];?></dd>
      <br>
      </dl>
      
      <div style="font-size:16px;font-family:”Times New Roman”;border:1px solid #a1a1a1;padding:10px 40px;background:#FFCCCC;width:600px;border-radius:25px;">
            <table class="table">
                 <tr><td>STT</td><td>Lesson</td><td>Subject</td><td>Status</td></tr>
                 <tr><td>1 </td>
                  <td>
                    <?php echo $this->Html->link('Geometry',array(
                      'controller'=>'Lesson', 
                      'action'=>'index', 
                       ));?>
                  </td>
                  <td>Math</td><td>bought</td></tr>
                 <tr><td>2</td><td>Grammar</td><td>English</td><td>bought</td></tr>
                 <tr><td>3</td><td>Mechanical</td><td>Physical</td><td>bought</td></tr>
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