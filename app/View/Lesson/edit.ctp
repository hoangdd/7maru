<script>

    checkedCategory = [
        <?php 
            if(isset($LessonCategory) && $LessonCategory && count($LessonCategory)){
                echo $LessonCategory[0]['category_id'];
                for($i = 1; $i < count($LessonCategory) ; $i++){
                    echo ", ".$LessonCategory[$i]['category_id'];
                }
            }
        ?>
    ];

    window.onload = function(){
        // other tag process, add new files input
        $('#input_Category').on('input',function(e){
            hide_Checkbox_with($(this).val());
        });

        // $('.checkbox-result-wrapper').hide();

        $('.checkbox-wrapper').find('input').change(function(){
            if(this.checked){
                show_result_Checkbox_with($(this).parent().parent().find('label').text());
            } else {
                hide_result_Checkbox_with($(this).parent().parent().find('label').text());
            }
        });

        if(checkedCategory.length!=0){
            for(var i = 0; i < checkedCategory.length; i++){
                var t = document.querySelector(".input-group-addon input[value='" + checkedCategory[i] + "']");
                if(t != null){
                    t.checked = true;
                }    
            }

            $('.checkbox-wrapper').find('input').each(function(){
                if(this.checked){
                    show_result_Checkbox_with($(this).parent().parent().find('label').text());
                } else {
                    hide_result_Checkbox_with($(this).parent().parent().find('label').text());
                }
            });
        }

        t = document.querySelector("#description_textarea");
        t.value = t.value.trim();

    }
    function on_document_input(){
        var document_input = $(".document-input");
        var needadd = true;
        for(var i=0, len=document_input.length ; i<len; i++){
            if(document_input[i].value == ""){
                needadd = false;
                break;
            }
        }
        if(needadd) add_new_document_input();
    }
    function hide_Checkbox_with(key){
        $('.checkbox-name').each(function(wrapper){
            if(this.innerText.indexOf(key) == -1){
                $(this).parent().hide();
            // } else if( $(this).parent().find('input').is(':checked') ){
                // $(this).parent().hide();
            } else {
                $(this).parent().show();
            }
        });
    }
    function show_result_Checkbox_with(name){
        $('.checkbox-result-name').each(function(){
            if(this.innerText == name){
                $(this).parent().show();
            }
        })
    }
    function hide_result_Checkbox_with(name){
        $('.checkbox-result-name').each(function(){
            if(this.innerText == name){
                $(this).parent().hide();
            }
        })
    }
    function add_new_document_input(){
        $('#document-input-wrapper').append('<p></p><input type="file" name="document[]" class = "document-input form-control" onchange = "on_document_input()">');
    }
</script>
<h1><?php echo __('Create New Lesson') ?></h1>
<div class="form-wrapper">
    <form class="form-horizontal" method="post" action=<?php echo "'".$this->Html->url(array('controller' => 'Lesson','action' => 'Edit',$data['coma_id'] ))."'"; ?> enctype="multipart/form-data">
<!--        Category check box-->
        <div class="form-group row">
            <label class="control-label col-sm-4" for="lesson_type"><?php echo __('Category') ?></label>
            <div class="col-sm-3" style="height: 300px;overflow-y: scroll;">
                <?php foreach ($categories as $category){ ?>
                    <div class="input-group checkbox-wrapper">
                        <span class="input-group-addon">
                            <input type="checkbox" value= <?php echo '"'.$category["Category"]["category_id"].'"'; ?> name= "category[]">
                        </span>
                        <label class="form-control bg-success checkbox-name" ><?php echo $category["Category"]["name"] ?></label>
                    </div>
                <?php } ?>                
            </div>
            <div class="col-sm-3">
                <?php foreach ($categories as $category){ ?>
                    <div class="input-group checkbox-result-wrapper" style = "display: none">
                        <span class="input-group-addon">
                            <input type="checkbox" value= <?php echo '"'.$category["Category"]["category_id"].'"'; ?> checked disabled >
                        </span>
                        <label class="form-control bg-success checkbox-result-name" ><?php echo $category["Category"]["name"] ?></label>
                    </div>
                <?php } ?>                
            </div>
        </div>
<!--        Other Category input-->
        <div class="form-group row">
            <label class="control-label col-sm-4" for="lesson_type"><?php echo __('Different Category') ?></label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="input_Category" placeholder="Category" name="other_category">
            </div>
        </div>
        
<!--        Lesson Name-->
        <div class='form-group row <?php if(isset($error) && isset($error['name']))echo "has-error"; ?>'>
            <label class="control-label col-sm-4" for="lesson_type"><?php echo __('Lesson Name') ?></label>
            <div class="col-sm-8">
                <input type="text" class="form-control" placeholder="Enter Lesson Name" name="name" <?php if(isset($data) && isset($data['name']) && $data['name']) echo 'value ="'.$data['name'].'"'; ?> >
                <?php if(isset($error) && isset($error['name']))echo "<div class='text-danger'>".$error['name']."</div>"; ?>
            </div>
            
        </div>
<!--        Lesson Description-->          
        <div class="form-group row <?php if(isset($error) && isset($error['desc']))echo "has-error"; ?>">
            <label class="control-label col-sm-4" for="lesson_type"><?php echo __('Description') ?></label>
            <div class="col-sm-8">
                <textarea class="form-control" rows="3" name="desc" id = "description_textarea">
                    <?php if(isset($data) && isset($data['description']) && $data['description']) echo $data['description']; ?>
                </textarea>
                <?php if(isset($error) && isset($error['desc']))echo "<div class='text-danger'>".$error['desc']."</div>"; ?>
            </div>
        </div>
<!--        Document-->  
        <div class="form-group row">
            <label class="control-label col-sm-4" for="lesson_type"><?php echo __('Document') ?></label>
            <div class="col-sm-8" id = "document-input-wrapper">
                <div class = "list-group-item row ">
                    <?php
                        foreach ($lesson['Data'] as $key => $value) {
                            if( !$value['isTest']){
                                echo $this->Html->link($value['file_name'], 
                                    array(
                                        'controller' => 'Lesson',
                                        'action' => 'viewContent',
                                        $value['file_id']
                                        ),
                                    array(
                                        'class' => "btn btn-link"
                                        )
                                );
                            }
                        }

                    ?>
                    <button class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-remove"></span></button>
                </div>
                <input type="file" name="document[]" class = 'form-control  document-input' onchange = "on_document_input()">
                <?php if(isset($error) && isset($error['document']))echo "<div class='text-danger'>".$error['document']."</div>"; ?>
                <!-- <input type="file" name="document[]" id='document'> -->
            </div>
        </div>
<!--Test File-->
        <div class="form-group row">
            <label class="control-label col-sm-4" for="lesson_type"><?php echo __('Test File') ?></label>
            <div class="col-sm-8">
                <input type="file" name="test" class = "form-control">
                <?php if(isset($error) && isset($error['test']))echo "<div class='text-danger'>".$error['test']."</div>"; ?>
            </div>
        </div>
        <div class="form-group row">
            <label class="control-label col-sm-4" for="lesson_type"><?php echo __('Lesson Image') ?></label>
            <div class="col-sm-8">
                <input type="file" name="cover-image" class = "form-control">   
                <?php if(isset($error) && isset($error['image']))echo "<div class='text-danger'>".$error['image']."</div>"; ?>                         
            </div>
        </div>
        <div class="form-group row">
            <label class="control-label col-sm-4" for="lesson_type"><?php echo __('Test File Format') ?></label>
            <div class="col-sm-8">
                <a class="btn btn-link"  href=<?php echo '"'.WEBROOT_DIR."/testfile.tsv".'"' ?> ><span class="glyphicon glyphicon-download-alt"></span>  <?php echo __('Download Here') ?></a>
            </div>
        </div>
        <div class="form-group row" <?php if(isset($error) && isset($error['copyright']))echo "has-error"; ?> >
            <label class="control-label col-sm-4" for="lesson_type"><?php echo __('Copyright') ?></label>
            <div class="col-lg-3">
                <div class="input-group">
                    <span class="input-group-addon">
                        <input type="checkbox" value="true" name="copyright" <?php if(isset($data) && isset($data['copyright'])) echo 'checked'; ?>>
                    </span>
                    <label class="form-control bg-success" ><?php echo __('Confirm') ?></label>
                </div>
                <?php if(isset($error) && isset($error['copyright']))echo "<div class='text-danger'>".$error['copyright']."</div>"; ?>
            </div>
        </div>
        <div class="form-group row">
            <label class="control-label col-sm-4" for="lesson_type"></label>
            <div class="col-sm-8">
                <div class="row">
                    <div class="col-lg-6">
                        <input type="submit" class="btn btn-success btn-lg btn-block" value="<?php echo __('Create') ?>" >
<!--                            <span class="glyphicon glyphicon-floppy-disk"></span> -->
                    </div>
                    <div class="col-lg-6">
                        <button type="button" class="btn btn-danger btn-lg btn-block">
                            <span class="glyphicon glyphicon-refresh"></span> 
                            <?php echo __('Reset') ?>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        
    </form>
</div>