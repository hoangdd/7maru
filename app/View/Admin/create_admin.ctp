<?php
echo $this->Html->css('common');
?>

<h1 class="center-block">Create another admin</h1>
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
                        <input type="text" class="form-control changecolor" placeholder="Enter Username">
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
                        <input type="password" class="form-control changecolor" placeholder="Enter Password">
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
                    <div class="col-md-12">
                        <input type="password" class="form-control" placeholder="Retype Password">
                    </div>
                </td>
            </tr>
        </table>
        <div class="text-center">
            <input type="submit">
            <button type="button" class="btn btn-primary" type="submit">Register</button>
            <button type="button" class="btn btn-primary">Cancel</button>
        </div>         
    </form>
</div>