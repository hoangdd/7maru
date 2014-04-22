<?php
echo $this->Html->css('common');
?>

<h1 class="center-block">
    <?php
        echo __('Create another admin');
    ?>
</h1>
<div class="col-md-1"></div>
<div class="col-md-9">
    <form class="form-horizontal" role="form" action="createAdmin" method="POST">
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
                               class="form-control changecolor">
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
                        <input type="password" name='Admin[password]' class="form-control changecolor">
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
                        <input type="password" name='retypepassword' class="form-control" >
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
                        <input type="text" name='Admin[first_name]' class="form-control changecolor">                        
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
                        <input type="text" name='Admin[last_name]' class="form-control changecolor">                        
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
                        <input type="text" name='Admin[ip]' class="form-control changecolor">                        
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
            <button type="button" class="btn btn-primary">
                <?php
                    echo __('Cancel');
                ?>
            </button>
        </div>         
    </form>
</div>