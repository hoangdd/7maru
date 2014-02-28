<?php
echo $this->Html->css('common');
?>

<h1 class="text-center">Teacher Register</h1>
<div class="col-md-1"></div>
<div class="col-md-9">
    <form class="form-horizontal" role="form" action="register" method="POST">
        <table class="table changecolor" id='register-table'>
            <tr>
                <td>
                    <div class="form-group">
                        <label class="pull-left control-label">Username:</label>
                    </div>
                </td>
                <td>
                    <div class="col-md-12">
                        <input type="text"  name='username' class="form-control changecolor" placeholder="Enter Username">
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
                    <div class="col-md-12">
                        <input type="password" name='password' class="form-control changecolor" placeholder="Enter Password">
                    </div>
                </td>
            </tr>

            <tr>
                <td>
                    <div class="form-group">
                        <label class="pull-left control-label">RetypePassword:</label>
                    </div>
                </td>
                <td>
                    <div class="col-md-12">
                        <input type="password" class="form-control" placeholder="Retype Password">
                    </div>
                </td>
            </tr>

            <tr>
                <td>
                    <div class="form-group">
                        <label class="pull-left control-label">Your name:</label>
                    </div>
                </td>
                <td>
                    <div class="col-md-12">
                        <input type="text" name='name' class="form-control" placeholder="Enter your name">
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
                        <input type="date" name='dob' class="form-control" placeholder="Enter your birthday">
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
                        <input type="text" name='tel' class="form-control" placeholder="Enter telephone number">
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
                          <option>How often learn homework?</option>
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
                        <label class="pull-left control-label">Introduce yourself:</label>
                    </div>
                </td>
                <td>
                    <div class="col-md-12">
                         <textarea class="form-control changecolor" rows="4"></textarea>
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