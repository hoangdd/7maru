<?php
echo $this->Html->css('common');
echo $this->Html->script(array('jquery.validate','additional-methods','additional-methods.min'));
echo $this->Html->script(array('chartapi','bootstrap-datepicker'));
echo $this->Html->css('datepicker');
?>

<h1 class="center-block">
    <?php
        echo __('Create another admin');
    ?>
</h1>
<div class="col-md-1"></div>
<div class="col-md-9">
    <form class="form-horizontal" id='register-form' role="form" action="createAdmin" method="POST">
        <table class="table changecolor" id='register-table'>
            <tr>
                <td>
                    <div class="form-group">
                        <label class="pull-left control-label">
                            <?php
                                echo __('Username');
                            ?>
                            :
                        </label>
                    </div>
                </td>
                <td>
                    <div class="col-md-12 <?php if(isset($error['username'])) echo "has-error has-feedback"?>">
                        <input type="text"  id='username' name='Admin[username]'class="form-control changecolor"
                            value="<?php if(isset($fill_box['username'])) echo $fill_box['username']; ?>">
                        <?php
                             if(isset($error['username'])&& is_array($error['username'])){
                                foreach($error['username'] as $usernames):
                                        echo $usernames;
                                        echo '<br/>';
                                endforeach;
                            }
                        ?>
                    </div>
                </td>
            </tr>

            <tr>
                <td>
                    <div class="form-group">
                        <label class="pull-left control-label">
                            <?php
                                echo __('Password');
                            ?>
                        :</label>
                    </div>
                </td>
                <td>
                    <div class="col-md-12 <?php if(isset($error['password'])) echo "has-error has-feedback"?>">
                        <input type="password" id='password' name='Admin[password]' class="form-control changecolor">
                        <?php
                             if(isset($error['password'])&& is_array($error['password'])){
                                foreach($error['password'] as $password):
                                        echo $password;
                                        echo '<br/>';
                                endforeach;
                            }
                        ?>
                    </div>
                </td>
            </tr>

            <tr>
                <td>
                    <div class="form-group">
                        <label class="pull-left control-label">
                            <?php
                                echo __('Retype Password');
                            ?>
                        :</label>
                    </div>
                </td>
                <td>
                     <div class="col-md-12 <?php if(isset($error['retypepassword'])) echo "has-error has-feedback"?>">
                        <input type="password" id='retypepass' name='retypepassword' class="form-control" >
                        <?php
                             if(isset($error['retypepassword'])&& is_array($error['retypepassword'])){
                                foreach($error['retypepassword'] as $retypepassword):
                                        echo $retypepassword;
                                        echo '<br/>';
                                endforeach;
                            }
                        ?>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="form-group">
                        <label class="pull-left control-label">
                            <?php
                                echo __('First Name');
                            ?>
                        :</label>
                    </div>
                </td>
                <td>
                    <div class="col-md-12">
                        <input type="text" id='firstname' name='Admin[first_name]' class="form-control changecolor"
                            value="<?php if(isset($fill_box['firstname'])) echo $fill_box['firstname']; ?>"> 
                    </div>
                </td>
            </tr>

            <tr>
                <td>
                    <div class="form-group">
                        <label class="pull-left control-label">
                            <?php
                                echo __('Last Name');
                            ?>
                        :</label>
                    </div>
                </td>
                <td>
                    <div class="col-md-12">
                        <input type="text" id='lastname' name='Admin[last_name]' class="form-control changecolor"
                            value="<?php if(isset($fill_box['lastname'])) echo $fill_box['lastname']; ?>">                    
                    </div>
                </td>
            </tr>
            
            <tr>
                <td>
                    <div class="form-group">
                        <label class="pull-left control-label">
                            <?php
                                echo __('IP');
                            ?>
                        :</label>
                    </div>
                </td>
                <td>
                    <div class="col-md-12">
                        <input type="text" name='Admin[ip]' class="form-control changecolor"
                            value="<?php if(isset($fill_box['ip'])) echo $fill_box['ip']; ?>">         
                        <?php
                             if(isset($error['ip'])&& is_array($error['ip'])){
                                foreach($error['ip'] as $ip):
                                        echo $ip;
                                        echo '<br/>';
                                endforeach;
                            }
                        ?>
                    </div>
                </td>
            </tr>
            
        </table>
        <div class="text-center">
            <button class="btn btn-primary" type="submit">
                <?php
                    echo __('Register');
                ?>
            </button>
            <a href = <?php echo  "'".$this->here."'" ;?>  type="button" class="btn btn-primary">
                <?php
                    echo __('Cancel');
                ?>
            </a>
        </div>         
    </form>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        
    $("#register-form").validate();
         // method check username follow form    
        jQuery.validator.addMethod("checkusername", function(value,element) {
            return /^[A-Za-z]\w+$/.test(value);
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

          // method check password follow form
        jQuery.validator.addMethod("checkpass", function(value,element) {
            return /^\w+$/.test(value);
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
    });
</script>