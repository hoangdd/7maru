<style>
.multiselect {
    width:20em;
    height:15em;
    border:solid 1px #c0c0c0;
    overflow:auto;
}
 
.multiselect label {
    display:block;
}
 
.multiselect-on {
    color:#ffffff;
    background-color:#000099;
}
</style>

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
                <div class="multiselect">
                    <label><input type="checkbox" name="option[]" value="1" />Green</label>
                    <label><input type="checkbox" name="option[]" value="2" />Red</label>
                    <label><input type="checkbox" name="option[]" value="3" />Blue</label>
                    <label><input type="checkbox" name="option[]" value="4" />Orange</label>
                    <label><input type="checkbox" name="option[]" value="5" />Purple</label>
                    <label><input type="checkbox" name="option[]" value="6" />Black</label>
                    <label><input type="checkbox" name="option[]" value="7" />White</label>
                </div>
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