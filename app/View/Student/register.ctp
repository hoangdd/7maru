<?php
echo $this->Html->css('common');
echo $this->Html->script(array('jquery.validate','additional-methods','additional-methods.min'));
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

<div class="col-md-12 highlight" style="background-image: url(/7maru/img/Hd-Background-Wallpapers-2.jpg);background-repeat: no-repeat;background-position: top center;">
<h1 class="text-center"><?php echo __('Student Register') ?></h1>
<div class="col-md-1"></div>
<div class="col-md-9">
    <form id='register-form' action='register' class="form-horizontal" role="form" method='post' enctype="multipart/form-data">
        <table class="table changecolor" id='register-table'>
            <tr>
                <td>
                    <div class="form-group">
                        <label class="pull-left control-label"><?php echo __('Username').':' ?></label>
                    </div>
                </td>
                <td>
                    <div class="col-md-12 <?php if(isset($error['username'])) echo "has-error has-feedback"?>">
                        <input id="username" type="text"  name='username' 
                               class="form-control changecolor" 
                               >
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
                        <label class="pull-left control-label"><?php echo __('Password').':' ?></label>
                    </div>
                </td>
                <td>
                    <div class="col-md-12 <?php if(isset($error['password'])) echo "has-error has-feedback"?>">
                        <input id="password" type="password" name='password' class="form-control changecolor" >
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
                        <input id="email" type="email" name='mail' class="form-control">
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
                        <input type="text" id='firstname' name='firstname' class="form-control" >
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
                        <input type="text" id='lastname'name='lastname' class="form-control" >
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
                    <div class="col-md-12">
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
                        <input type="text" name='address' class="form-control" >
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
                        <label class="pull-left control-label"><?php echo __('Telephone number').':' ?></label>
                    </div>
                </td>
               <td>
                    <div class="col-md-12 <?php if(isset($error['phone_number'])) echo "has-error has-feedback"?>">
                        <input type="number" name='phone_number' class="form-control" >
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
                        <label class="pull-left control-label"><?php echo __('Credit card').':' ?></label>
                    </div>
                </td>
                <td>
                    <div class="col-md-12 <?php if(isset($error['credit_account'])) echo "has-error has-feedback"?>">
                        <input type="text" id='credit_account' name='credit_account' class="form-control" >
                        <?php
                             if(isset($error['credit_account'])&& is_array($error['credit_account'])){
                                foreach($error['credit_account'] as $credit_account):
                                    echo $credit_account;
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
                         <input id="verifycode_question" name="verifycode_question" type="text" class="form-control" >
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
                        <input id="verifycode_answer" name="verifycode_answer" type="text" class="form-control" >
                        <span class="glyphicon glyphicon-star span_star"></span>
                    </div>
                </td>
            </tr>

            <tr>
                <td>
                    <div class="form-group">
                        <label class="pull-left control-label"><?php echo __('Your degree').':' ?></label>
                    </div>
                </td>
                <td>
                    <div class="col-md-12">
                        <input type="text" name='level' class="form-control" >
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
                        <input type="file" id='profile_picture' class="form-control" name='profile_picture'>
                        <p class="help-block"><?php echo __('Upload your photo to display') ?></p>
                        <span>
                            <?php
                            if(isset( $error['profile_picture'][0])) echo  $error['profile_picture'][0];
                            ?>
                        </span>
                    </div>
                </td>
            </tr>
        </table>
        <div class="text-center">
            <button class="btn btn-primary" type="submit"><?php echo __('Register') ?></button>
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
    // method check password follow form
    jQuery.validator.addMethod("checkpass", function(value,element) {
    return /^\w+$/.test(value);
    });
    //method check credit card
    jQuery.validator.addMethod("checkcreditcard",function(value,element){
    return /^\w{8}-\w{4}-\w{4}-\w{4}-\w{4}$/.test(value);
    });

     //rules of username
    $( "#username" ).rules( "add", {
        required: true,
        minlength: 2,
        maxlength: 30,
        checkusername: true,
        checkusername_database: true,
        messages: {
            required: '<?php echo __('Required input');?>',
            minlength: jQuery.format('<?php echo __('Please, at least {2} characters are necessary');?>'),
            maxlength: jQuery.format('<?php echo __('Please enter no more than {30} characters');?>'),
            checkusername: jQuery.format('<?php echo __('Start by a alphabet and please do not enter special characters');?>'),
            checkusername_database: jQuery.format('<?php echo __('Username is existed');?>'),
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
        
    $("#credit_account").rules("add", {
        required: true,
        checkcreditcard: true,
        messages: {
            required: '<?php echo __('Required input');?>',
            checkcreditcard: jQuery.format("例： 12345678-1111-2222-3333-4444"),
        }
    });
    
   $("#verifycode_answer").rules("add", {
        required: true,
        maxlength: 50,
        messages: {
            required: '<?php echo __('Required input');?>',
            maxlength: jQuery.format('<?php echo __('Please enter no more than {30} characters');?>'),
        }
    });
   });
        
</script>