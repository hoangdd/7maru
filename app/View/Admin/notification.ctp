<?php
    echo $this->Html->css('common');
    
?>

<!-- Notification of Admin -->
<h1 class="text-center">Notification</h1>
<div clas="row">
    <!-- Message public -->
    <div class='col-md-4'>
        <div class="panel panel-danger">
            <!--panel header-->
            <div class="panel-heading">
                <h3 class="panel-title">Public message</h3>
            </div>
            
            <!--panel body-->
            <div class="panel-body">
                <label>Input:</label>
                <textarea class="form-control" rows="10"></textarea>
                <p></p>
                
                <form class="form-horizontal" role="form">
                    <div class="form-group">
                        <button type="button" class="btn btn-success">
                        <span class="glyphicon glyphicon-envelope"></span> Post
                        </button>
                    
                        <button type="button" class="btn btn-warning">
                        <span class="glyphicon glyphicon-refresh"></span> Reset
                        </button>
                    </div>
                </form>
            </div>
            
        </div>
    </div>
    
    <!-- Message private -->
    <div class="col-md-8">
        <div class="panel panel-danger">
            <!--panel header-->
            <div class="panel-heading">
                <h3 class="panel-title">Private message</h3>
            </div>
            <!--panel body-->
            <div class="panel-body">
                    <label>Input:</label>
                    <div class="text-center">
                        <select class="form-control">
                            <option>Your lesson has many violation from student.</option>
                            <option>Your comments were violation.</option>
                            <option>You copied lesson of other.</option>
                            <option>Your lesson didn't have any documents.</option>
                        </select>
                    </div>
                </form>
                <p></p>
                <select multiple class="form-control">
                  <option>Nguyen Van A</option>
                  <option>2</option>
                  <option>3</option>
                  <option>4</option>
                  <option>5</option>
                </select>
                <p></p>
                <form class="form-horizontal" role="form">
                    <div class="form-group">
                        <button type="button" class="btn btn-success">
                        <span class="glyphicon glyphicon-envelope"></span> Post
                        </button>
                    
                        <button type="button" class="btn btn-warning">
                        <span class="glyphicon glyphicon-refresh"></span> Reset
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>