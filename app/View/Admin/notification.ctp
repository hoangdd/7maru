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
                <textarea class="form-control" rows="10" id="publicTextarea"></textarea>
                <p></p>
                
                <form class="form-horizontal" role="form">
                    <div class="form-group">
                        <button name="publicpost" type="submit" class="btn btn-success">
                        <span class="glyphicon glyphicon-envelope"></span> Post
                        </button>
                    
                        <button type="button" class="btn btn-warning" onClick="resetTextareaPublic();">
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
                    <div class="text-center">
                         <form class="form-horizontal" role="form">
                          <div class="form-group">
                              <label class="col-sm-2 control-label">Message: </label>
                                <div class="col-sm-10">
                                    <select class="form-control">
                                        <?php
                                            //echo $this->Form->input('',array('type'=>'select','options'=>$message)); 
                                            foreach($message as $m):
                                                echo '<option>'.$m.'</option>';
                                            endforeach;
                                        ?>
                                    </select>
                                </div>
                          </div>
                        </form>
                    </div>
                    <label>Input:</label>
                    <textarea class="form-control" rows="3" id="privateTextarea"></textarea>
                </form>
                <p></p>
                <div class="multiselect">
                    <table class="table table-bordered table-hover">
                        <th class="danger"><labe>Name</labe></th>
                        <th class="danger"><labe>Username</labe></th>
                        <th class="danger"><labe><input type="checkbox"/>Check</labe></th>
                        <?php
                            /*foreach ($user['name'] as $name):
                               echo '<label><input type="checkbox" name="option[]"/>'.$name.'</label>';				
                            endforeach;*/
                            foreach ($data as $d):
<<<<<<< Updated upstream
                                echo '<tr><td class="name">'.$d['User']['firstname'].' '.$d['User']['lastname'].'</td><td class="username">'.$d['User']['username'].'</td>';
                                echo '<td class="check_box"><input class="send-checkbox" type="checkbox" name="'.$d['User']['user_id'].'"/></td></tr>';
=======
                                echo '<tr><td class="name">'.$d['User']['firstname'].' '.$d['User']['lastname'].'</td><td                       
                                class="username">'.$d['User']['username'].'</td><td class="check_box">
                                <input type="checkbox" name="option[]"/></td></tr>';
>>>>>>> Stashed changes
                            endforeach;
                        ?>
                    </table>
                </div>
                <p></p>
<<<<<<< Updated upstream
                <div class="form-group">
                    <button type="button" id='post-button' class="btn btn-success">
                    <span class="glyphicon glyphicon-envelope"></span> Post
                    </button>
                
                    <button type="button" class="btn btn-warning" onClick="resetTextarea();">
                    <span class="glyphicon glyphicon-refresh"></span> Reset
                    </button>
                </div>
=======
                <form class="form-horizontal" role="form">
                    <div class="form-group">
                        <button name="privatepost" type="submit" class="btn btn-success">
                        <span class="glyphicon glyphicon-envelope"></span> Post
                        </button>
                    
                        <button type="button" class="btn btn-warning" onClick="resetTextareaPrivate();">
                        <span class="glyphicon glyphicon-refresh"></span> Reset
                        </button>
                    </div>
                </form>
>>>>>>> Stashed changes
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        $('#post-button').click(function(){
            var ids = new Array();
            $(".send-checkbox").each(function(){
                //danh sach tat ca the co' class = send-checkbox
                if($(this).prop('checked')==true){
                    // them vao mang ids tat ca nhung user_id ma co' check
                    ids.push($(this).prop('name'));
                }
            })
            $.ajax({
                'url':'send',//noi muon gui du lieu den
                'type':'post', //method
                'data' : 'ids='+ids.toString(),
                complete : function(res){
                    // du lieu tra ve tu controller
                    alert(res.responseText);
                }
            })
        });
        $("th input").click(function(){
            var status = $(this).prop('checked');            
            $(".check_box input").prop('checked',status);
        })
    })
    function resetTextareaPrivate(){
        document.getElementById('privateTextarea').value = "";
        $(".check_box input").prop('checked',false);
    };
    function resetTextareaPublic(){
        document.getElementById('publicTextarea').value = "";
    }
</script>