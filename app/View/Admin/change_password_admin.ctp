<?php
    echo $this->Html->css('common');
    echo $this->Html->script(array('jquery.validate','additional-methods','jquery.validate.min','additional-methods.min'));
?>

<div class="col-md-5 form">
    <h1 class="center-block"><?php echo __('Edit Admin');?></h1>
    <form class="form-horizontal" id="changePassword" type="form" role="form" method="POST">
        <div class="form-group changecolor">

                        <label class="pull-left control-label">
                            <?php
                                echo __('Username');
                            ?>
                            :
                        </label>

                        <input type="text" name='Admin[username]' class="form-control changecolor col-md-12" value = "<?php echo $username ?>" readonly>

        </div>
        <div class="form-group">        
            <label for="newPassword"><?php echo __('Password');?>:</label>
            <input type="password" name='Admin[password]' class="form-control" id='newpw'>
            <br>
        </div>

        <div class="form-group">
            <label for="confirmPassword"><?php echo __('Retype Password');?>:</label>
            <input type="password" name='retypepassword' class="form-control" id="confirmpw">
            <br>
        </div>                      
        <div class='text-center'> 
            <button class="btn btn-primary" type="submit">
                <?php
                    echo __('Edit');
                ?>
            </button>
            <a href = <?php echo  "'".$this->here."'" ;?>   type="button" class="btn btn-primary">
                <?php
                    echo __('Cancel');
                ?>
            </a>        
        </div>         
    </form>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $("#changePassword").validate();
        jQuery.validator.addMethod("checkpwd", function(value,element) {
            return /^\w+$/.test(value);
        });
        
        jQuery.validator.addMethod("checkMatch", function(value,element){
            if(value!=$("#newpw").val())
                return false;
            else return true;
        });

        $( "#newpw" ).rules( "add", {
            required: true,
            minlength: 5,
            maxlength: 30,
            checkpwd: true,
            messages: {
                required: "<?php echo __('Required input');?>", 
                minlength: "<?php echo __('Please, at least {5} characters are necessary');?>",
                maxlength: jQuery.format("<?php echo __('Please enter no more than {30} characters');?>"),
                checkpwd: jQuery.format("<?php echo __('Start by a alphabet and please do not enter special characters');?>"),
            }
        });

        $( "#confirmpw" ).rules( "add", {
            required: true,
            minlength: 5,
            maxlength: 30,
            checkMatch:true,
            checkpwd: true,
            messages: {
                required: jQuery.format("<?php echo __('Required input');?>"),
                minlength: jQuery.format("<?php echo __('Please, at least {5} characters are necessary');?>"),
                maxlength: jQuery.format("<?php echo __('Please enter no more than {30} characters');?>"),
                checkpwd: jQuery.format("<?php echo __('Start by a alphabet and please do not enter special characters');?>"),
                checkMatch: jQuery.format("<?php echo __('Password do not match');?>")
            }
        });
    });
</script>