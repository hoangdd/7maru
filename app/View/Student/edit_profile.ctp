
<div class="row">
    <div class="col-md-3">
        <?php        
        if($userData['profile_picture'] == null) $image = 'default_profile.jpg';
        else $image = IMAGE_PROFILE_LINK.$userData['profile_picture'];
        echo $this->Html->image($image,array(            
         'width'=>'180px',
         'class' => 'img-rounded',
         'style' => 'text-align:center;'
         ));
        echo "<br><br>";
        echo "<div class='text-center'>";
        echo $this->Html->link('Statistic',
         'Statistic',array(
            'class'=>'btn btn-primary',
            'role'=>'button',
            'style'=>'font-size:14px;margin:auto;width:80%'
            ));
        echo "<p></p></div><div class='text-center'>";        
        echo $this->Html->link('ChangePassword',
         array('controller' => 'Login','action' => 'changePassword'),array(
            'class'=>'btn btn-primary',
            'role'=>'button',
             'style'=>'font-size:14px;margin:auto;width:80%'
            ));
        echo "</div>";
        ?>
    </div>
    <div class="col-md-9" style="font-size:16px;font-family:”Times New Roman”;border:1px solid #a1a1a1;padding:10px 40px;background:#99FF00;width:600px;border-radius:25px;">
        <h1 style="text-align:center;font-family:”Times New Roman”;">Change Profile</h1>
        <br>
        <form name='Student' method="POST" action=<?php echo "'".$this->Html->url(array('controller' => 'Student','action' => 'EditProfile'))."'" ?>  class="form-horizontal" enctype="multipart/form-data" role="form">
             <div class="form-group" style="text-align:center;">
                <label class="col-sm-3 control-label">First Name:</label>
                <div class="col-sm-6">
                <input name="firstname"  type="text" class="form-control" id="inputEmail3" placeholder="First Name" value=<?php echo "'".$userData['firstname']  ."'" ?> >                                     
            </div>
             </div>
             <div class="form-group" style="text-align:center;">
                <label class="col-sm-3 control-label">Last Name:</label>
                <div class="col-sm-6">

                <input name="lastname" type="text" class="form-control" id="inputEmail3" placeholder="Last Name" value=<?php echo "'".$userData['lastname']  ."'" ?>>

                </div>
             </div>
             <div class="form-group">
                <label class="col-sm-3 control-label">Birthday:</label>
                 <div class="col-md-6">

                        <input name="date_of_birth" type="date" class="form-control" placeholder="Birthday" value=<?php echo "'".$userData['date_of_birth']  ."'" ?>>

                 </div>
             </div>
             <div class="form-group">
                <label class="col-sm-3 control-label">Email: </label>
                <div class="col-sm-6">

                <input name="mail" type="email" class="form-control" placeholder="Email address" value=<?php echo "'".$userData['mail']  ."'" ?>>

                </div>
             </div>
             <div class="form-group">
                <label class="col-sm-3 control-label">Addresss:</label>
                <div class="col-sm-6">

                <input name="address" class="form-control" placeholder="Adress" value=<?php echo "'".$userData['address']  ."'" ?>>

                </div>
             </div>
             <div class="form-group">
                <label class="col-sm-3 control-label">Phone Number:</label>
                <div class="col-sm-6">

                <input name="phone_number" class="form-control" placeholder="Phone Number" value=<?php echo "'".$userData['phone_number']  ."'" ?>>
                </div>
             </div>
             <div class="form-group">
                <label  class="col-sm-3 control-label">Credit Card Number:</label>
                <div class="col-sm-6">
                <input name="credit_account" lass="form-control"  placeholder="Credit Card Number" value=<?php echo "'".$studentData['credit_account']  ."'" ?>>
                </div>
             </div>                        

             <div class="form-group">
                <label class="col-sm-3 control-label">Upload photo:</label>
                <div class="col-md-6">
                <input type="file" name='profile_picture' class="form-control">
                <p class="help-block">Upload your photo to display.</p>
                </div>
             </div> 
            <div class="align-right" style="text-align:center;">

                <button class="btn btn-primary" type="submit">Save</button>
                <a href = <?php echo  "'".$this->Html->url(array('controller' => 'Student','action' => 'EditProfile'))."'" ?> class="btn btn-primary" style='color:white'>Refresh</a>                
            </div> 
        </form>     
    </div>
    
</div>