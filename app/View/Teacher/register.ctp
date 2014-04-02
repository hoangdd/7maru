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
<h1 class="text-center">Teacher Register</h1>
<div class="col-md-1"></div>
<div class="col-md-9">
    <form id='register-form' class="form-horizontal" role="form" action="register" method="POST" enctype="multipart/form-data">
        <table class="table changecolor" id='register-table'>
            <tr>
                <td>
                    <div class="form-group">
                        <label class="pull-left control-label">Username:</label>
                    </div>
                </td>
                <td>
                    <div class="col-md-12 <?php if(isset($error['username'])) echo "has-error has-feedback"?>">
                        <input id="username" type="text"  name='username' 
                               class="form-control changecolor" 
                               placeholder="Enter Username">
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
                        <label class="pull-left control-label">Password:</label>
                    </div>
                </td>
                <td>
                    <div class="col-md-12 <?php if(isset($error['password'])) echo "has-error has-feedback"?>">
                        <input id="password" type="password" name='password' class="form-control changecolor" placeholder="Enter Password">
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
                        <label class="pull-left control-label">Retype Password:</label>
                    </div>
                </td>
                <td>
                    <div class="col-md-12 <?php if(isset($error['retypepassword'])) echo "has-error has-feedback"?>">
                        <input id="retypepass" type="password" name='retypepassword' class="form-control" placeholder="Retype Password">
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
                        <label class="pull-left control-label">Email:</label>
                    </div>
                </td>
                <td>
                    <div class="col-md-12 <?php if(isset($error['mail'])) echo "has-error has-feedback"?>">
                        <input id="email" type="email" name='mail' class="form-control" placeholder="Enter your mail">
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
                        <label class="pull-left control-label">First name:</label>
                    </div>
                </td>
                <td>
                    <div class="col-md-12 <?php if(isset($error['firstname'])) echo "has-error has-feedback"?>">
                        <input id="firstname" type="text" name='firstname' class="form-control" placeholder="Enter first name">
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
                        <label class="pull-left control-label">Last name:</label>
                    </div>
                </td>
                <td>
                    <div class="col-md-12 <?php if(isset($error['lastname'])) echo "has-error has-feedback"?>">
                        <input id="lastname" type="text" name='lastname' class="form-control" placeholder="Enter last name">
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
                        <label class="pull-left control-label">Birthday:</label>
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
                        <label class="pull-left control-label">Address:</label>
                    </div>
                </td>
                <td>
                    <div class="col-md-12">
                        <input type="text" name='address' class="form-control" placeholder="Enter your address">
                    </div>
                </td>
            </tr>

            <tr>
                <td>
                    <div class="form-group">
                        <label class="pull-left control-label">Gender:</label>
                    </div>
                </td>
                <td>
                    <div class="col-md-12">
                        <div class="radio">
                            <label>
                                <input name="gender" type="radio" value="1">
                                Male
                            </label>
                        </div>

                        <div class="radio">
                            <label>
                                <input name="gender" type="radio" value="2">
                                Female
                            </label>
                        </div>
                    </div>
                </td>
            </tr>

            <tr>
                <td>
                    <div class="form-group">
                        <label class="pull-left control-label">Telephone number:</label>
                    </div>
                </td>
                <td>
                    <div class="col-md-12 <?php if(isset($error['phone_number'])) echo "has-error has-feedback"?>">
                        <input type="number" name='phone_number' class="form-control" placeholder="Enter telephone number">
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
                        <label class="pull-left control-label">Bank account:</label>
                    </div>
                </td>
                <td>
                    <div class="col-md-12">
                        <input id="bank_account" type="text" name='bank_account' class="form-control" placeholder="Enter bank account">
                        <span class="glyphicon glyphicon-star span_star"></span>
                    </div>
                </td>
            </tr>

            <tr>
                <td>
                    <div class="form-group">
                        <label class="pull-left control-label">Verify code:</label>
                    </div>
                </td>
                <td>
                    <div class="col-md-12">
                        <select name="verifycode_question" class="form-control">
                            <option>What subject do you like?</option>
                            <option>What activity do you like?</option>
                            <option>What do you do in freetime?</option>
                            <option>How often do read book?</option>
                            <option>What song do you like?</option>
                        </select>
                    </div>
                </td>
            </tr>

            <tr>
                <td>
                    <div class="form-group">
                        <label class="pull-left control-label">Answers:</label>
                    </div>
                </td>
                <td>
                    <div class="col-md-12">
                        <input id="verifycode_answer" name="verifycode_answer" type="text"  class="form-control" placeholder="Answer this question">
                        <span class="glyphicon glyphicon-star span_star"></span>
                    </div>
                </td>
            </tr>

            <tr>
                <td>
                    <div class="form-group">
                        <label class="pull-left control-label">Upload photo:</label>
                    </div>
                </td>
                <td>
                    <div class="col-md-12">
                        <input type="file" class="form-control" name='profile_picture'>
                        <p class="help-block">Upload your photo to display.</p>
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
                        <label class="pull-left control-label">Your school:</label>
                    </div>
                </td>
                <td>
                    <div class="col-md-12">
                        <input type="text" name='office' class="form-control" placeholder="Enter your school">
                    </div>
                </td>
            </tr>
            
            <tr>
                <td>
                    <div class="form-group">
                        <label class="pull-left control-label">Introduce yourself:</label>
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
            <button type="submit" class="btn btn-primary">Register</button>
            <button type="button" class="btn btn-primary">Cancel</button>
        </div>         
    </form>
</div>
</div>
<script>
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
        minlength: 6,
        maxlength: 30,
        checkusername: true,
        checkusername_database: true,
        messages: {
            required: "Required input",
            minlength: jQuery.format("Please, at least {0} characters are necessary"),
            maxlength: jQuery.format("Please enter no more than {0} characters"),
            checkusername: jQuery.format("Please enter follow format: aaAA123 or abc_123"),
            checkusername_database: jQuery.format("Username is exist"),
        }
    });
    
    //rules of password
    $( "#password" ).rules( "add", {
        required: true,
        minlength: 8,
        maxlength: 30,
        checkpass: true,
        messages: {
            required: "Required input",
            minlength: jQuery.format("Please, at least {0} characters are necessary"),
            maxlength: jQuery.format("Please enter no more than {0} characters"),
            checkusername: jQuery.format("Please enter follow format: 123abc456"),
        }
    });
        
    jQuery.validator.addMethod("checkretypepass", function(value,element){
        if(value!=$("#password").val())
            return false;
        else return true;
    },jQuery.format("Password and RetypePassword are not equal."));
        
    $("#retypepass").rules("add", {
        required: true,
        checkretypepass: true,
        messages: {
            required: "Required input",
        }
    });
                    
    $("#email").rules("add", {
        required: true,
        messages: {
            required: "Required input",
        }
    });
        
    $( "#firstname" ).rules( "add", {
        required: true,
        maxlength: 30,
        messages: {
            required: "Required input",
            maxlength: jQuery.format("Please enter no more than {0} characters"),
        }
    });
        
    $( "#lastname" ).rules( "add", {
        required: true,
        maxlength: 30,
        messages: {
            required: "Required input",
            maxlength: jQuery.format("Please enter no more than {0} characters"),
        }
    });
        
    $("#bank_account").rules("add", {
        required: true,
        messages: {
            required: "Required input",
        }
    });
    
     $("#verifycode_answer").rules("add", {
        required: true,
        maxlength: 50,
        messages: {
            required: "Required input",
            maxlength: jQuery.format("Please enter no more than {0} characters"),
        }
    });
   });
        
</script>
