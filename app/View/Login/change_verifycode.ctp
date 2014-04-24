<?php
echo $this->Html->css('common');
echo $this->Html->script(array('jquery.validate','additional-methods','jquery.validate.min','additional-methods.min'));
?>
<div class="col-md-4 users form">
    <form id="changePassword" type="form" method="post">
        <h1>
            <?php
                echo __('Change Password');
            ?>
        </h1>

         <input type="text" name='username' class="form-control" value="<?php echo $username ?>" readonly>        
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
        <div class="form-group">
            <label for="New Question">
                <?php
                    echo __('New Question');
                ?>
            </label>
            <input type="tetx" id="new-question" name='new-question' class="form-control">
            <?php if (!empty($error["new"])) { ?>
                <span class="text-danger "><?php echo $error["new"]; ?></span>
            <?php } else echo '</br>'; ?>
        </div>
        <div class="form-group">
            <label for="confirmPassword">
                <?php
                    echo __('New Answer');
                ?>
            </label>
            <input type="new-answer" id="confirmpw" name='new-answer' class="form-control">
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
        jQuery.validator.addMethod("checkpwd", function(value,element) {
            return /^[A-Za-z]\w+$/.test(value);
        });    

        
        $( "#currentpw" ).rules( "add", {
            required: true,
            messages: {
                required: "Please specify your current password",
            }
        }); 

        $( "#new-answer" ).rules( "add", {
            required: true,
            messages: {
                required: "Please specify your new answer",
            }
        }); 

        $( "#new-question" ).rules( "add", {
            required: true,
            messages: {
                required: "Please specify your new question",
            }
        }); 
    });
</script>
