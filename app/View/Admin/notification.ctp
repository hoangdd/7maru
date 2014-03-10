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
    $message = array(__('Your lesson has many violation from student.'),
                     __('Your comments were violation.'),
                     __('You copied lesson of other.'),
                     __('Your lesson didn`t have any documents.'),);
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
                <form action='notification' class="form-horizontal" role="form" method="POST">
                    <label>Input:</label>
                    <textarea class="form-control" rows="10" id="publicTextarea" name="publicTextarea"></textarea>
                    <p></p>
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
                                    <select id="select_message" class="form-control">
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

                <div class = "input-group">
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-search"></span>
                    </span>
                    <input type = "text" id = "search-input" class = "form-control" placeholder = "Search">
                   <!--  <div>
                        <button class = "btn btn-primary" id = "search-button">Search</button>
                    </div> -->
                </div>
                <p></p>

                <div class="multiselect">
                    <table class="table table-bordered table-hover" id = "user-table">
                        <th class="danger"><labe>Username</labe></th>
                        <th class="danger"><labe>Full Name</labe></th>
                        <th class="danger"><labe><input type="checkbox"/>Check</labe></th>
                        <?php
                            /*foreach ($user['name'] as $name):
                               echo '<label><input type="checkbox" name="option[]"/>'.$name.'</label>';				
                            endforeach;*/
                            foreach ($data as $d):
                                echo '<tr><td class="username">'.$d['User']['username'].'</td><td class="name">'
                                    .$d['User']['firstname'].' '.$d['User']['lastname'].'</td>';
                                echo '<td class="check_box"><input class="send-checkbox" type="checkbox" name="'.$d['User']['user_id'].'"/></td>
                                </tr>';
                            endforeach;
                        ?>
                    </table>
                </div>
                <p></p>
                    <div class="form-group">
                        <button id='post-button' name="privatepost" type="submit" class="btn btn-success">
                        <span class="glyphicon glyphicon-envelope"></span> Post
                        </button>
                    
                        <button type="button" class="btn btn-warning" onClick="resetTextareaPrivate();">
                        <span class="glyphicon glyphicon-refresh"></span> Reset
                        </button>
                    </div>
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
            });
            var privatepost = $("#privateTextarea").val();
            //var data = {ids:ids,privatepost:privatepost};
            $.ajax({
                'url':'check_notification',//noi muon gui du lieu den
                'type':'post', //method
                'data':{ids:ids,privatepost:privatepost},
                complete : function(res){
                    // du lieu tra ve tu controller
                    alert(res.responseText);
                }
            })
        });
        
        $("th input").click(function(){
            var status = $(this).prop('checked');      
            
            $(".check_box input").each(function(){
                if($(this).is(":visible")) $(this).prop('checked',status);
            });
        })

        $('#search-input').on('input',function(e){
            hide_row_with($(this).val());
        });
        $(".check_box input").click(function(){
            $("th input").prop('checked',false);
        })
    })
    
    $("#select_message").change(function(){
        $("#privateTextarea").val($("#select_message").val());
    });
    
    function resetTextareaPrivate(){
        document.getElementById('privateTextarea').value = "";
        $(".check_box input").prop('checked',false);
        $("th input").prop('checked',false);
    };
    function resetTextareaPublic(){
        document.getElementById('publicTextarea').value = "";
    }
    function hide_row_with(key){
        $('#user-table tr').each(function(index){
            if(index){
                if(this.innerText.indexOf(key) == -1){
                    $(this).hide();
                } else {
                    $(this).show();
                }    
            }
        });
    }
</script>