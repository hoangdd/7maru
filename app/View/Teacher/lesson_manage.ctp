<div class="head-box">
    <h1><?php echo __('Lesson Manage') ?></h1>
    
    <nav class="navbar navbar-inverse" role="navigation">
      <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
    
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav">           
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
    <div class="lesson-action col-xs-2">
        <button type="button" id="addLesson" class="text-center btn btn-default btn-lg">
            <span class="glyphicon glyphicon-plus"></span> <?php echo __('Add') ?>
        </button>
    </div>

    <div class="lesson-list col-xs-10 list-group">
        <?php 
        foreach ($lesson as $value) {?>

            <div class="media list-group-item lesson" lessonid ="<?php echo $value['Lesson']['coma_id']; ?>" >
                <div class="pull-left col-xs-3">
                    <div class="img" title = "Lesson Name" data-toggle="tooltip" data-placement="left">
                        <?php
                        	if(isset($value['Lesson']['coma_id']))
                            echo $this->Html->image('data/cover/'.$value['Lesson']['cover'], array(
                                'width' => '140px',
                                'height' => '200px',
                                'url' => array('controller' => 'Lesson' ,'action' => 'index',$value['Lesson']['coma_id'])
                                ));
                             else echo 'No Images';
                        ?>
                    </div>
                    <div class="star center-block" style="padding: 5px">
                        <?php 
                        $options = array(
                            'coma_id' => $value['Lesson']['coma_id'],
                            'stars' => $value['Lesson']['rate'],
                            'width' => 20,
                            'height' => 20,                     
                            );
                        $options['rateAllow'] = 0;                      
                        echo $this->element('star_rank', array(
                            'options' => $options
                            )
                        )
                        ?>
                    </div>
                    <div class="panel-heading">
                        <h3 class="panel-title"><?php echo $value['Lesson']['title']; ?></h3>
                    </div>
                </div>
                <div class="media-body">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <h2 class="panel-title">
                                <?php echo $this->Html->link($value['Lesson']["name"],array('controller' => 'lesson','action' => 'index',$value['Lesson']['coma_id'])) ?>
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
                    <button type="submit" name="<?php echo $value['Lesson']['coma_id']; ?>" class="editLesson edit-btn btn btn-default"><?php echo __('Edit') ?></button>
                    <button type="submit" name="<?php echo $value['Lesson']['coma_id']; ?>" class="delete-btn btn btn-default"><?php echo __('Delete') ?></button>
                </div>
            </div>
        <?php }?>
    </div>

    <div class='text-center'>   
        <ul class="pagination">
            <?php 
            echo $this->Paginator->prev('< ', array('tag' => 'li'), null, array('class' => 'disabled','tag' => 'li','disabledTag'=>'a'));
            echo $this->Paginator->numbers(array('tag' => 'li','separator' => '','currentClass' =>'active','currentTag' => 'a'));
            echo $this->Paginator->next(' >', array('tag' => 'li'), null, array('class' => 'disabled','tag' => 'li','disabledTag'=>'a',));
            ?>   
        </ul>
    </div>
</div>

<?php echo $this->Js->writeBuffer(); ?>

<script type="text/javascript">
$(document).ready(function(){
    $('.delete-btn').click(function(){
        if(confirm("Are your sure about deleting this lesson ?!")){

            var id = $(this).attr('name');
            $.ajax({
                url : "<?php echo $this->Html->url(array('controller' => 'Teacher','action' => 'deleteLesson')); ?>",
                data : {id : id},
                type : 'POST',
                dataType : 'text',
                complete : function(data){
                    var res = $(this).attr('class');
                    var respon = data.responseText.trim();
                    res = respon.split("|");                    
                    if (res[0] == '1') {
                        $('.lesson[lessonid='+id+']').fadeOut();
                        alert('Deletion success');
                    }else{
                        alert('can not  delete');
                    }
                },
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

$(document).on('click','.editLesson',function(){
    var link = "<?php echo Router::url('/',true)?>" ;
    location.href = link + 'lesson/edit/'+$(this).attr('name');
});
function hide_lesson_with(key){
    $('.lesson').each(function(wrapper){
        var text = this.innerText.replace('Edit','').replace('Delete','');
        if(text.toLowerCase().indexOf(key.toLowerCase()) == -1){
            $(this).hide();
        } else {
            $(this).show();
        }
    });
}
</script>