<div class="head-box">
    <h1>Lesson Manage</h1>
    
    <nav class="navbar navbar-inverse" role="navigation">
      <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
    
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav">
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="#">Action</a></li>
                <li><a href="#">Another action</a></li>
                <li><a href="#">Something else here</a></li>
                <li class="divider"></li>
                <li><a href="#">Separated link</a></li>
                <li class="divider"></li>
                <li><a href="#">One more separated link</a></li>
              </ul>
            </li>
          </ul>
          <div class="col-xs-8">
              <form class="navbar-form">
                    <input type="text" class="form-control " id = "search-input" placeholder="Search">
              </form>
          </div>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>     
</div>

<div class = "lesson-box row">
    <div class="lesson-action col-xs-2 list-group">
        <button type="button" id="addLesson" class="text-center btn btn-default btn-lg">
            <span class="glyphicon glyphicon-plus"></span> Add
        </button>
    </div>

    <div class="lesson-list col-xs-10 list-group">
        <?php 
        foreach ($lesson as $value) {?>

            <div class="media list-group-item lesson" lessonid ="<?php echo $value['Lesson']['coma_id']; ?>" >
                <div class="pull-left col-xs-3">
                    <div class="img" title = "Lesson Name" data-toggle="tooltip" data-placement="left">
                        <?php
                            echo $this->Html->image('data/cover/'.$value['Lesson']['cover'],array(
                                'width' => '140px',
                                'height' => '140px',
                                'url' => '/lesson/view'.$value['Lesson']['coma_id']
                                ));
                        ?>
                    </div>
                    <div class="star center-block" style="padding: 5px">
                        <span class="glyphicon glyphicon-star"></span>
                        <span class="glyphicon glyphicon-star"></span>
                        <span class="glyphicon glyphicon-star"></span>
                        <span class="glyphicon glyphicon-star"></span> 
                        <span class="glyphicon glyphicon-star"></span>
                    </div>
                    <div class="panel-heading">
                        <h3 class="panel-title"><?php echo $value['Lesson']['title']; ?></h3>
                    </div>
                </div>
                <div class="media-body">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <h2 class="panel-title"><a href= <?php echo "'../lesson/view/".$value['Lesson']['coma_id']."'" ;?> >
                                <strong>
                                    <?php 
                                    echo $value['Lesson']["name"]; 
                                    ?>
                                </strong>
                                </a>
                            </h2>
                        </div>
                        <div class="panel-body">
                            <?php 
                            echo ($value['Lesson']['description']);
                            ?>
                        </div>
                    </div>
                </div>
                <div>
                    <button type="submit" id="editLesson" name="<?php echo $value['Lesson']['coma_id']; ?>" class="edit-btn btn btn-default">Edit</button>
                    <button type="submit" name="<?php echo $value['Lesson']['coma_id']; ?>" class="delete-btn btn btn-default">Delete</button>
                </div>
            </div>
        <?php }?>
    </div>

</div>

<script type="text/javascript">
$(document).ready(function(){
    $('.delete-btn').click(function(){
        if(confirm("Are your sure about deleting this lesson ?!")){

            var id = $(this).attr('name');
            $.ajax({
            url : "deleteLesson",
            data : {id : id},
            type : 'post',
            dataType : 'text',
            complete : function(data){
                console.log(data);
                if (data.responseText == 1) {
                    $('.lesson[lessonid='+id+']').fadeOut();
                    alert('Deletion success');
                }else{
                    alert('can not  delete');
                }
            },
            /*error : function(){
                
            }*/
        })
   }

    })
    $('#search-input').on('input',function(e){
        hide_lesson_with($(this).val());
    });
});

$(document).on('click','#addLesson',function(){
    var link = "<?php echo Router::url('/',true)?>" ;
    location.href = link + 'lesson/create';

});

$(document).on('click','#editLesson',function(){
    var link = "<?php echo Router::url('/',true)?>" ;
    location.href = link + 'lesson/edit';

});
function hide_lesson_with(key){
    $('.lesson').each(function(wrapper){
        var text = this.innerText.replace('Edit','').replace('Delete','');
        if(text.indexOf(key) == -1){
            $(this).hide();
        } else {
            $(this).show();
        }
    });
}
</script>