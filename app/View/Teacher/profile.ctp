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
      <div style="font-size:16px;font-family:”Times New Roman”;border:1px solid #a1a1a1;padding:10px 40px;background:#CAFFAC;width:600px;border-radius:25px;">
            <h4 style="font-family:”Times New Roman”;"><b>Introduce Themselves:</b></h4>
            <p style="font-family:”Times New Roman”;">
                  Lưu Diệc Phi xuất hiện lần đầu tiên trên màn ảnh vào cuối năm 2002 trong một quảng cáo do ông Trần Kim Phi thực hiện. Sau đó được đạo diễn Du Tiến Minh mời vào vai Bạch Tú Châu của phim Gia tộc Kim phấn. Sau đó, cô vào vai tiểu thư Vương Ngữ Yên trong Tân Thiên Long Bát Bộ cùng Lâm Chí Dĩnh. Vương Ngữ Yên chính là vai diễn đầu tiên khiến khán giả.
            </p>
      </div>
      <br>
      <div style="font-size:16px;font-family:”Times New Roman”;border:1px solid #a1a1a1;padding:10px 40px;background:#FFFFFF;width:600px;border-radius:25px;">
            <table class="table">
                 <tr><td>STT</td><td>Lesson</td><td>Subject</td><td>Creation Date</td></tr>
                 <tr><td>1 </td>
                  <td>
                    <?php echo $this->Html->link('Geometry',array(
                      'controller'=>'Lesson', 
                      'action'=>'index', 
                       ));?>
                  </td>
                  <td>Math</td><td>10/11/2010</td></tr>
                 <tr><td>2</td><td>Grammar</td><td>English</td><td>10/11/2010</td></tr>
                 <tr><td>3</td><td>Mechanical</td><td>Physical</td><td>10/11/2010</td></tr>
            </table>
      </div>
</div>

</div>