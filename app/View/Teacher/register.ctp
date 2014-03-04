<?php
echo $this->Html->css('common');
//debug($error);
?>
<div class="col-md-12 highlight" style="background-image: url(/7maru/img/51e356f4_2c9625be_1_2_resize.jpg);background-repeat: no-repeat;background-position: top center;">
<h1 class="text-center">Teacher Register</h1>
<div class="col-md-1"></div>
<div class="col-md-9">
    <form id='register-form' class="form-horizontal" role="form" action="register" method="POST">
        <table class="table changecolor" id='register-table'>
            <tr>
                <td>
                    <div class="form-group">
                        <label class="pull-left control-label">Username:</label>
                    </div>
                </td>
                <td>
                    <div class="col-md-12 <?php if(isset($error['username'])) echo "has-error has-feedback"?>">
                        <input type="text"  name='username' 
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
                        <input type="password" name='password' class="form-control changecolor" placeholder="Enter Password">
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
                        <input type="password" name='retypepassword' class="form-control" placeholder="Retype Password">
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
                    <div class="col-md-12">
                        <input type="email" name='mail' class="form-control" placeholder="Enter your mail">
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
                        <input type="text" name='firstname' class="form-control" placeholder="Enter first name">
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
                        <input type="text" name='lastname' class="form-control" placeholder="Enter last name">
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
                    <div class="col-md-12">
                        <input type="date" name='date_of_birth' class="form-control" placeholder="Enter your birthday">
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
                        <label class="pull-left control-label">Sex:</label>
                    </div>
                </td>
                <td>
                    <div class="col-md-12">
                        <div class="radio">
                            <label>
                                <input name="sex_select" type="radio" value="1">
                                Male
                            </label>
                        </div>

                        <div class="radio">
                            <label>
                                <input name="sex_select" type="radio" value="2">
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
                    <div class="col-md-12">
                        <input type="number" name='phone_number' class="form-control" placeholder="Enter telephone number">
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
                        <input type="text" name='bank_account' class="form-control" placeholder="Enter bank account">
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
                        <select class="form-control">
                          <option>What subject do you like?</option>
                          <option>What activity do you like?</option>
                          <option>What do you do freetime?</option>
                          <option>How often do learn homework?</option>
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
                        <input type="text"  class="form-control" placeholder="Answer this question">
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
                        <input type="file" class="form-control">
                        <p class="help-block">Upload your photo to display.</p>
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
            <button type="button" class="btn btn-primary" type="submit">Register</button>
            <button type="button" class="btn btn-primary">Cancel</button>
        </div>         
        <input type="submit">
    </form>
</div>
</div>