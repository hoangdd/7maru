<?php
echo $this->Html->css('common');
echo $this->Html->script(array('jquery.validate','additional-methods','jquery.validate.min','additional-methods.min'));
echo $this->Html->script(array('chartapi','bootstrap-datepicker'));
echo $this->Html->css('datepicker');
?>
<script type="text/javascript">
      // Load the Visualization API and the piechart package.      
      //======show datepicker
      $(document).ready(function(){         
            $("#dp").datepicker({
                  format: "dd-mm-yyyy",                  
            });
            $("#dp").datepicker('set','today');            
      })
</script>

<div class="col-md-12 highlight" style="background-image: url(/7maru/img/new-background-test.jpg);background-repeat: repeat;background-position: top center; background-size: contain;">
<h1 class="text-center"><?php echo __('Teacher Register') ?></h1>
<div class="col-md-1"></div>
<div class="col-md-9">
    <form id='register-form' class="form-horizontal" role="form" action="register" method="POST" enctype="multipart/form-data">
        <table class="table changecolor" id='register-table'>
            <tr>
                <td>
                    <div class="form-group">
                        <label class="pull-left control-label"><?php echo __('Username').':' ?></label>
                    </div>
                </td>
                <td>
                    <div class="col-md-12 <?php if(isset($error['username'])) echo "has-error has-feedback"?>">
                        <input id="username" type="text"  name='username' class="form-control changecolor" 
                            value="<?php if(isset($fill_box['username'])) echo $fill_box['username']; ?>">
                        <?php
                             if(isset($error['username'])&& is_array($error['username'])){
                                foreach($error['username'] as $usernames):
                                    echo $usernames;
                                    echo '<br/>';
                                endforeach;
                            }
                        ?>
                        <span class="glyphicon glyphicon-star span_star"></span>
                    </div>
                </td>
            </tr>

            <tr>
                <td>
                    <div class="form-group">
                        <label class="pull-left control-label"><?php echo __("Password")?></label>
                    </div>
                </td>
                <td>
                    <div class="col-md-12 <?php if(isset($error['password'])) echo "has-error has-feedback"?>">
                        <input id="password" type="password" name='password' class="form-control changecolor">
                        <?php
                             if(isset($error['password'])&& is_array($error['password'])){
                                foreach($error['password'] as $password):
                                        echo $password;
                                        echo '<br/>';
                                endforeach;
                            }
                        ?>
                        <span class="glyphicon glyphicon-star span_star"></span>
                    </div>
                </td>
            </tr>

            <tr>
                <td>
                    <div class="form-group">
                        <label class="pull-left control-label"><?php echo __('Retype Password').':' ?></label>
                    </div>
                </td>
                <td>
                    <div class="col-md-12 <?php if(isset($error['retypepassword'])) echo "has-error has-feedback"?>">
                        <input id="retypepass" type="password" name='retypepassword' class="form-control" >
                        <?php
                             if(isset($error['retypepassword'])&& is_array($error['retypepassword'])){
                                foreach($error['retypepassword'] as $retypepassword):
                                        echo $retypepassword;
                                        echo '<br/>';
                                endforeach;
                            }
                        ?>
                        <span class="glyphicon glyphicon-star span_star"></span>
                    </div>
                </td>
            </tr>

            <tr>
                <td>
                    <div class="form-group">
                        <label class="pull-left control-label"><?php echo __('Email').':' ?></label>
                    </div>
                </td>
                <td>
                    <div class="col-md-12 <?php if(isset($error['mail'])) echo "has-error has-feedback"?>">
                        <input id="email" type="email" name='mail' class="form-control"
                            value="<?php if(isset($fill_box['email'])) echo $fill_box['email']; ?>">
                        <?php
                             if(isset($error['mail'])&& is_array($error['mail'])){
                                foreach($error['mail'] as $mail):
                                    echo $mail;
                                    echo '<br/>';
                                endforeach;
                            }
                        ?>
                        <span class="glyphicon glyphicon-star span_star"></span>
                    </div>
                </td>
            </tr>
            
            <tr>
                <td>
                    <div class="form-group">
                        <label class="pull-left control-label"><?php echo __('First Name').':' ?></label>
                    </div>
                </td>
                <td>
                    <div class="col-md-12 <?php if(isset($error['firstname'])) echo "has-error has-feedback"?>">
                        <input id="firstname" type="text" name='firstname' class="form-control"
                            value="<?php if(isset($fill_box['firstname'])) echo $fill_box['firstname']; ?>">
                        <?php
                             if(isset($error['firstname'])&& is_array($error['firstname'])){
                                foreach($error['firstname'] as $firstname):
                                        echo $firstname;
                                        echo '<br/>';
                                endforeach;
                            }
                        ?>
                        <span class="glyphicon glyphicon-star span_star"></span>
                    </div>
                </td>
            </tr>
            
            <tr>
                <td>
                    <div class="form-group">
                        <label class="pull-left control-label"><?php echo __('Last Name').':' ?></label>
                    </div>
                </td>
                <td>
                    <div class="col-md-12 <?php if(isset($error['lastname'])) echo "has-error has-feedback"?>">
                        <input id="lastname" type="text" name='lastname' class="form-control"
                            value="<?php if(isset($fill_box['lastname'])) echo $fill_box['lastname']; ?>">
                        <?php
                             if(isset($error['lastname'])&& is_array($error['lastname'])){
                                foreach($error['lastname'] as $lastname):
                                        echo $lastname;
                                        echo '<br/>';
                                endforeach;
                            }
                        ?>
                        <span class="glyphicon glyphicon-star span_star"></span>
                    </div>
                </td>
            </tr>
            
            <tr>
                <td>
                    <div class="form-group">
                        <label class="pull-left control-label"><?php echo __('Birthday').':' ?></label>
                    </div>
                </td>
                <td>
                    <div class="col-md-12 date">
                        <input name='date_of_birth' class="form-control" id="dp" readonly=""/>
                       
                    </div>
                </td>
            </tr>

            <tr>
                <td>
                    <div class="form-group">
                        <label class="pull-left control-label"><?php echo __('Address').':' ?></label>
                    </div>
                </td>
                <td>
                    <div class="col-md-12">
                        <input type="text" name='address' class="form-control">
                    </div>
                </td>
            </tr>

            <tr>
                <td>
                    <div class="form-group">
                        <label class="pull-left control-label"><?php echo __('Gender').':' ?></label>
                    </div>
                </td>
                <td>
                    <div class="col-md-12">
                        <div class="radio">
                            <label>
                                <input name="gender" type="radio" value="1">
                                <?php echo __('Male') ?>
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input name="gender" type="radio" value="2">
                                <?php echo __('Female') ?>
                            </label>
                        </div>
                    </div>
                </td>
            </tr>

            <tr>
                <td>
                    <div class="form-group">
                        <label class="pull-left control-label"><?php echo __('Telephone number').':'?></label>
                    </div>
                </td>
                <td>
                    <div class="col-md-12 <?php if(isset($error['phone_number'])) echo "has-error has-feedback"?>">
                        <input type="number" name='phone_number' class="form-control"
                            value="<?php if(isset($fill_box['phone_number'])) echo $fill_box['phone_number']; ?>">
                        <?php
                             if(isset($error['phone_number'])&& is_array($error['phone_number'])){
                                foreach($error['phone_number'] as $phone_number):
                                    echo $phone_number;
                                endforeach;
                            }
                        ?>
                    </div>
                </td>
            </tr>

            <tr>
                <td>
                    <div class="form-group">
                        <label class="pull-left control-label"><?php echo __('Bank Account').':' ?></label>
                    </div>
                </td>
                <td>
                    <div class="col-md-12 <?php if(isset($error['bank_account'])) echo "has-error has-feedback"?>">
                        <input id="bank_account" type="text" name='bank_account' class="form-control"
                            value="<?php if(isset($fill_box['bank_account'])) echo $fill_box['bank_account']; ?>">
                        <?php
                             if(isset($error['bank_account'])&& is_array($error['bank_account'])){
                                foreach($error['bank_account'] as $bank_account):
                                    echo $bank_account;
                                endforeach;
                            }
                        ?>
                        <span class="glyphicon glyphicon-star span_star"></span>
                    </div>
                </td>
            </tr>

            <tr>
                <td>
                    <div class="form-group">
                        <label class="pull-left control-label"><?php echo __('Question').':' ?></label>
                    </div>
                </td>
                <td>
                    <div class="col-md-12">                    
                        <input id="verifycode_question" name="verifycode_question" type="text"  class="form-control"
                            value="<?php if(isset($fill_box['verifycode_question'])) echo $fill_box['verifycode_question']; ?>">
                        <span class="glyphicon glyphicon-star span_star"></span>
                    </div>
                </td>
            </tr>

            <tr>
                <td>
                    <div class="form-group">
                        <label class="pull-left control-label"><?php echo __('Answers').':' ?></label>
                    </div>
                </td>
                <td>
                    <div class="col-md-12">
                        <input id="verifycode_answer" name="verifycode_answer" type="text"  class="form-control"
                            value="<?php if(isset($fill_box['verifycode_answer'])) echo $fill_box['verifycode_answer']; ?>">
                        <span class="glyphicon glyphicon-star span_star"></span>
                    </div>
                </td>
            </tr>

            <tr>
                <td>
                    <div class="form-group">
                        <label class="pull-left control-label"><?php echo __('Upload photo').':' ?></label>
                    </div>
                </td>
                <td>
                    <div class="col-md-12">
                        <input type="file" class="form-control" name='profile_picture'>
                        <p class="help-block"><?php echo __('Upload your photo to display') ?></p>
                        <span>
                            <?php
                            if(isset( $error['profile_picture'][0])) echo  $error['profile_picture'][0];
                            ?>
                        </span>
                    </div>
                </td>
            </tr>
            
            <tr>
                <td>
                    <div class="form-group">
                        <label class="pull-left control-label"><?php echo __('Your school').':' ?></label>
                    </div>
                </td>
                <td>
                    <div class="col-md-12">
                        <input type="text" name='office' class="form-control">
                    </div>
                </td>
            </tr>
            
            <tr>
                <td>
                    <div class="form-group">
                        <label class="pull-left control-label"><?php echo __('Introduce yourself').':' ?></label>
                    </div>
                </td>
                <td>
                    <div class="col-md-12">
                         <textarea name='description' class="form-control changecolor" rows="4"></textarea>
                    </div>
                </td>
            </tr>
            
        </table>
        <div class="text-center">
            <button type="submit" class="btn btn-primary"><?php echo __('Register') ?></button>
            <button type="button" class="btn btn-primary"><?php echo __('Cancel') ?></button>
        </div>         
    </form>
</div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        
    $("#register-form").validate();
    // method check username follow form    
    jQuery.validator.addMethod("checkusername", function(value,element) {
        return /^[A-Za-z]\w+$/.test(value);
    });

    //method check username in the database
    jQuery.validator.addMethod("checkusername_database",function(value,element){
        var result = true;
         $.ajax({
                url:'CheckUsername',//noi muon gui du lieu den
                type:'post', //method
                data:{value:value},                
                complete : function(res){
                    // du lieu tra ve tu controller
                    console.log(res.responseText.trim());
                    if(res.responseText.trim() == "exist")
                        result = false;
                    else{
                    result = true;}
                }
        })
         return result;
    });

    // method check password follow form
    jQuery.validator.addMethod("checkpass", function(value,element) {
        return /^\w+$/.test(value);
    });

    //rules of username
    $( "#username" ).rules( "add", {
        required: true,
        minlength: 2,
        maxlength: 30,
        checkusername: true,
        messages: {
            required: '<?php echo __('Required input');?>',
            minlength: jQuery.format('<?php echo __('Please, at least {2} characters are necessary');?>'),
            maxlength: jQuery.format('<?php echo __('Please enter no more than {30} characters');?>'),
            checkusername: jQuery.format('<?php echo __('Start by a alphabet and please do not enter special characters');?>'),
        }
    });

    //rules of password
    $( "#password" ).rules( "add", {
        required: true,
        minlength: 6,
        maxlength: 30,
        checkpass: true,
        messages: {
            required: '<?php echo __('Required input');?>',
            minlength: jQuery.format('<?php echo __('Please, at least {6} characters are necessary');?>'),
            maxlength: jQuery.format('<?php echo __('Please enter no more than {30} characters');?>'),
            checkpass: jQuery.format('<?php echo __('Please do not enter special characters');?>'),
        }
    });
        
    jQuery.validator.addMethod("checkretypepass", function(value,element){
        if(value!=$("#password").val())
            return false;
        else return true;
    },jQuery.format('<?php echo __('Password and RetypePassword are not equal');?>'));
        
    $("#retypepass").rules("add", {
        required: true,
        checkretypepass: true,
        messages: {
            required: '<?php echo __('Required input');?>',
        }
    });
                    
    $("#email").rules("add", {
        required: true,
        messages: {
            required: '<?php echo __('Required input');?>',
            email : jQuery.format('<?php echo __('Not email format');?>'),
        }
    });
        
    $( "#firstname" ).rules( "add", {
        required: true,
        maxlength: 30,
        messages: {
            required: '<?php echo __('Required input');?>',
            maxlength: jQuery.format('<?php echo __('Please enter no more than {30} characters');?>'),
        }
    });
        
    $( "#lastname" ).rules( "add", {
        required: true,
        maxlength: 30,
        messages: {
            required: '<?php echo __('Required input');?>',
            maxlength: jQuery.format('<?php echo __('Please enter no more than {30} characters');?>'),
        }
    });
        
     //method check credit card
    jQuery.validator.addMethod("checkbankaccount",function(value,element){
    return /^\w{4}-\w{3}-\w{1}-\w{7}$/.test(value);
    });

    $("#bank_account").rules("add", {
        required: true,
        checkbankaccount: true,
        messages: {
            required: '<?php echo __('Required input');?>',
            checkbankaccount: jQuery.format('例： 1111-222-3-4444444'),
        }
    });
    
     $("#verifycode_answer").rules("add", {
        required: true,
        maxlength: 30,
        messages: {
            required: '<?php echo __('Required input');?>',
            maxlength: jQuery.format('<?php echo __('Please enter no more than {30} characters');?>'),
        }
    });
   });
        
</script>
