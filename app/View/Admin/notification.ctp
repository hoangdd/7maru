<style>
.multiselect {
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
    $user = array(
        'name'  =>  array('Nguyen Van A','Nguyen Van B','Nguyen Van C',
                         'Nguyen Van D','Nguyen Van E','Nguyen Van F',
                         'Nguyen Van G','Nguyen Van H','Nguyen Van I',
                         'Nguyen Van J','Nguyen Van K','Nguyen Van L',
                         'Nguyen Van M','Nguyen Van N','Nguyen Van O',
                         'Nguyen Van P','Nguyen Van Q','Nguyen Van R',),
    );
    $message = array('Your lesson has many violation from student.',
                     'Your comments were violation.',
                     'You copied lesson of other.',
                     'Your lesson didn`t have any documents.',);
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
                        <!--<?php
                            echo $this->Form->button('Post', array('type' => 'submit'));
                            echo $this->Form->button('Cancel', array('type'=>'reset')); 
                        ?>-->
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
                        <?php
                            echo $this->Form->input('Message : ',array('type'=>'select','options'=>$message)); 
                        ?>
                    </div>
                </form>
                <p></p>
                <div class="multiselect">
                    <?php
                        foreach ($user['name'] as $name):
                           echo '<label><input type="checkbox" name="option[]"/>'.$name.'</label>';				
                        endforeach;
                    ?>
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