<?php
echo $this->Html->css('common');
echo $this->Html->script(array('jquery.validate','additional-methods','jquery.validate.min','additional-methods.min'));
?>
<div class="col-md-4 users form">
    <form id="changePassword" type="form" method="post">
        <h1>
            <?php
                echo __('Admin Change Password');
            ?>
        </h1>

        <div class="form-group">
            <label for="currentPassword">
                <?php
                    echo __('Current Password');
                ?>
            </label>
            <input type="password" id="currentpw" name='current-pw' class="form-control">
            <?php if (!empty($error["current"])) { ?>
                <span class="text-danger"><?php echo $error["current"]; ?></span>
            <?php } else echo '</br>'; ?>

        </div>
        <span><?php echo $this->Session->read("password"); ?></span>
        <div class="form-group">
            <label for="newPassword">
                <?php
                    echo __('New Password');
                ?>
            </label>
            <input type="password" id="newpw" name='new-pw' class="form-control">
            <?php if (!empty($error["new"])) { ?>
                <span class="text-danger "><?php echo $error["new"]; ?></span>
            <?php } else echo '</br>'; ?>
        </div>
        <div class="form-group">
            <label for="confirmPassword">
                <?php
                    echo __('Confirm Password');
                ?>
            </label>
            <input type="password" id="confirmpw" name='confirm-pw' class="form-control">
            <?php if (!empty($error["confirm"])) { ?>
                <span class="text-danger "><?php echo $error["confirm"]; ?></span>
            <?php } else echo '</br>'; ?>
        </div>
        <button type="submit" class="btn btn-default">
            <?php
                    echo __('Change');
                ?>
        </button>
    </form>
</div>

<script >
    $(document).ready(function(){
        $("#changePassword").validate({
            onfocusout: false
        });
        
        jQuery.validator.addMethod("checkpwd", function(value,element) {
            return /^[A-Za-z]\w+$/.test(value);
        });
        
        jQuery.validator.addMethod("checkMatch", function(value,element){
            if(value!=$("#newpw").val())
                return false;
            else return true;
        });

        
        $( "#currentpw" ).rules( "add", {
            required: true,
            messages: {
                required: "Please specify your current password",
            }
        }); 

        $( "#newpw" ).rules( "add", {
            required: true,
            minlength: 8,
            maxlength: 30,
            checkpwd: true,
            messages: {
                required: "Please specify your new password", 
                minlength: "Please, at least {8} characters are necessary",
                maxlength: jQuery.format("Please enter no more than {30} characters"),
                checkpwd: jQuery.format("format is wrong"),
            }
        });

        $( "#confirmpw" ).rules( "add", {
            required: true,
            minlength: 8,
            maxlength: 30,
            checkMatch:true,
            checkpwd: true,
            messages: {
                required: jQuery.format("Required input"),
                minlength: jQuery.format("Please, at least {8} characters are necessary"),
                maxlength: jQuery.format("Please enter no more than {30} characters"),
                checkpwd: jQuery.format("format is wrong"),
                checkMatch: jQuery.format("Password do not match")
            }
        });
    });
</script>
