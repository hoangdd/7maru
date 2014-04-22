
<div class="row">
	<div class="col-md-3">
		<?php           
        $image = IMAGE_PROFILE_LINK.$userData['profile_picture'];
        echo $this->Html->image($image,array(            
         'width'=>'180px',
         'class' => 'img-rounded',
         'style' => 'text-align:center'
         ));
        $role = $_SESSION['Auth']['User']['role'];
        if ($role == "R2"){
            echo "<br><br>";
            echo "<div class='text-center'>";
            echo $this->Html->link(__('Statistic'),
                array('controller' => 'Teacher','action' => 'Statistic'),
                array(
                'class'=>'btn btn-primary',
                'role'=>'button',
                'style'=>'font-size:14px;margin:auto;width:80%'
                ));
            echo "<p></p></div><div class='text-center'>";        
            echo $this->Html->link(__('Change Password'),
             array('controller' => 'Login','action' => 'changePassword'),array(
                'class'=>'btn btn-primary',
                'role'=>'button',
                 'style'=>'font-size:14px;margin:auto;width:80%'
                ));
            echo "</div>";
        }
		?>
	</div>
	<div class="col-md-9" style="font-size:16px;font-family: Times New Roman;border:1px solid #a1a1a1;padding:10px 40px;background:#99FF00;width:600px;border-radius:25px;">
		<h1 style="text-align:center;font-family:Times New Roman;"><?php echo __('Change Profile') ?></h1>
		<br>
        <form name='Teacher' method="POST" action="" class="form-horizontal" enctype="multipart/form-data" role="form">
             <div class="form-group" style="text-align:center;">
                <label class="col-sm-3 control-label"><?php echo __('First Name').':' ?></label>
                <div class="col-sm-6">
                <input name="firstname"  type="text" class="form-control" id="inputEmail3" placeholder="<?php echo __('First Name');?>" value=<?php echo "'".$userData['firstname']  ."'" ?> >                                     
            </div>
             </div>
             <div class="form-group" style="text-align:center;">
                <label class="col-sm-3 control-label"><?php echo __('Last Name').':' ?></label>
                <div class="col-sm-6">

                <input name="lastname" type="text" class="form-control" id="inputEmail3" placeholder="<?php echo __('Last Name');?>" value=<?php echo "'".$userData['lastname']  ."'" ?>>

                </div>
             </div>
             <div class="form-group">
                <label class="col-sm-3 control-label"><?php echo __('Birthday').':' ?></label>
                 <div class="col-md-6">

                        <input name="date_of_birth" type="date" class="form-control" placeholder="<?php echo __('Birthday');?>" value=<?php echo "'".$userData['date_of_birth']  ."'" ?>>

                 </div>
             </div>
             <div class="form-group">
                <label class="col-sm-3 control-label"><?php echo __('メール').':' ?></label>
                <div class="col-sm-6">

                <input name="mail" type="email" class="form-control" placeholder="<?php echo __('メール');?>" value=<?php echo "'".$userData['mail']  ."'" ?>>

                </div>
             </div>
             <div class="form-group">
                <label class="col-sm-3 control-label"><?php echo __('アドレス').':' ?></label>
                <div class="col-sm-6">

                <input name="address" class="form-control" placeholder="<?php echo __('アドレス');?>" value=<?php echo "'".$userData['address']  ."'" ?>>

                </div>
             </div>
             <div class="form-group">
                <label class="col-sm-3 control-label"><?php echo __('Phone Number').':' ?></label>
                <div class="col-sm-6">

                <input name="phone_number" class="form-control" placeholder="<?php echo __('Phone Number');?>" value=<?php echo "'".$userData['phone_number']  ."'" ?>>
                </div>
             </div>
             <div class="form-group">
                <label  class="col-sm-3 control-label"><?php echo __('Bank Account').':' ?></label>
                <div class="col-sm-6">
                <input name="bank_account" lass="form-control"  placeholder="<?php echo __('Bank Account');?>" value=<?php echo "'".$teacherData['bank_account']  ."'" ?>>
                </div>
             </div>                        

             <div class="form-group">
             	<label class="col-sm-3 control-label"><?php echo __('Upload photo').':' ?></label>
             	<div class="col-md-6">
                <input type="file" name='profile_picture' class="form-control">
                <p class="help-block"><?php echo __('Upload your photo to display')?></p>
                </div>
             </div>	
            <div class="align-right" style="text-align:center;">

                <button class="btn btn-primary" type="submit"><?php echo __('Save') ?></button>
                <a href = <?php echo  "'".$this->here."'" ;?> class="btn btn-primary" style='color:white'><?php echo __('Refresh') ?></a>                
            </div> 
        </form>     
	</div>
    
</div>