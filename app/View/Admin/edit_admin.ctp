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
    <form class="form-horizontal" role="form" method="POST">
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
                               placeholder="Enter Username"                               
                               value = "<?php echo $data['Admin']['username'] ?>"
                               readonly
                        >
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
                                echo __('First Name');
                            ?>
                        :</label>
                    </div>
                </td>
                <td>
                    <div class="col-md-12">
                        <input type="text" name='Admin[first_name]' class="form-control changecolor" value="<?php  echo $data['Admin']['first_name'] ?>">                        
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
                        <input type="text" name='Admin[last_name]' class="form-control changecolor" value="<?php  echo $data['Admin']['first_name'] ?>">                        
                    </div>
                </td>
            </tr>

        </table>                
        <div style='float:left'>
            <?php 
            echo $this->Html->link(__('Change password'),array('controller' => 'admin', 'action' => 'changePasswordAdmin',$data['Admin']['admin_id']),array('class' => 'btn btn-primary'));
            ?>        
        </div>
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