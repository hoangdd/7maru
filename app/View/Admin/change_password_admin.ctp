<?php
echo $this->Html->css('common');
?>

<h1 class="center-block">
    <?php
        echo __('Edit Admin');
    ?>
</h1>
<div class="col-md-1"></div>
<div class="col-md-9">
    <form class="form-horizontal" id="changePassword" role="form" method="POST">
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
                        <input type="text"  name='Admin[username]' 
                               class="form-control changecolor" 
                               value = "<?php echo $username ?>"
                               readonly
                        >                       
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
                        <input type="password" name='Admin[password]' class="form-control changecolor" id='newpw'>
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
                        <input type="password" name='retypepassword' class="form-control" id="confirmpw">
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
            
        </table>                        
            <div class='text-center'> 
            <button class="btn btn-primary" type="submit">
                <?php
                    echo __('Edit');
                ?>
            </button>
            <button type="button" class="btn btn-primary">
                <?php
                    echo __('Cancel');
                ?>
            </button>        
        </div>         
    </form>
</div>

<script >
    $(document).ready(function(){
        
        jQuery.validator.addMethod("checkpwd", function(value,element) {
            return /^[A-Za-z]\w+$/.test(value);
        });
        
        jQuery.validator.addMethod("checkMatch", function(value,element){
            if(value!=$("#newpw").val())
                return false;
            else return true;
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
