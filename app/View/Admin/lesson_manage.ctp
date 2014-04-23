
<!-- header -->
<div>
<h1 style="text-align:center">
	<?php echo __('Reference Manage'); ?>
</h1>
<p></p>
<div class = "input-group col-md-8">
    <span class="input-group-addon">
        <span class="glyphicon glyphicon-search"></span>
    </span>
    <input type = "text" id = "search-input" class = "form-control" placeholder = "Search">
</div>
<p></p>
<div class="row col-md-12">
	<table class="table table-bordered table-hover">
        <th class="info"><label><?php echo __("Lesson");?></label></th>        		
        <th class="info"><label><?php echo __("Author");?></label></th>        
        <th class="info"><label><?php echo __("Report Title");?></label></th>
        <th class="info"><label><?php echo __("Copyrightレポート ");?></label></th>
        <th class="info"><label><?php echo __("ブロック");?></label></th>
        <th class="info"><label><?php echo __("Delete");?></label></th>
        <?php
        foreach ($lessons as $d):                
            echo '<tr class="linktr">'.'<td>'.$this->Html->link($d['Lesson']['name'],array('controller' => 'Lesson','action' =>'index',$d['Lesson']['coma_id'] )).'</td><td>'.$d['Author']['username'].'</td>';
            //get number of report
            $copyright = 0;
            $title = 0;
            foreach ($d['ReportLesson'] as $report):
                if ($report['report_reason'] === 'title'){
                    ++$title;
                }
                else{
                    ++$copyright;
                }
            endforeach;
            echo '<td>'.$title.'</td><td>'.$copyright.'</td>';
            //end
            echo '<td class="link_td">';
            if ($d['Lesson']['is_block'] === '0'){
                echo $this->Html->link(__('Block'),array('controller' => 'Admin','action' => 'blockLesson',$d['Lesson']['coma_id']),array('link_type' => 'block_link','coma_id' => $d['Lesson']['coma_id']));
            }
            else{
                echo $this->Html->link(__('UnBlock'),array('controller' => 'Admin','action' => 'unBlockLesson',$d['Lesson']['coma_id']),array('link_type' => 'un_block_link','coma_id' => $d['Lesson']['coma_id']));
            }
            echo '</td>';
            echo '<td class="link_td">';
            echo $this->Html->link(__('Delete'),array('controller' => 'Admin','action' => 'deleteLesson',$d['Lesson']['coma_id']),array('link_type' => 'delete_link','coma_id' => $d['Lesson']['coma_id']));
            echo '</td></tr>';
        endforeach;
        ?>
	</table> 
</div>
<script>
    $(document).ready(function(){
        $("tr.linktr td.link_td a").click(function(){
            var src = $(this).attr('href');
            var type = $(this).attr('link_type');
            var link = $(this);
            var isConfirm = confirm("<?php echo __('Confirm') ?>");
            if (!isConfirm){
                return false;
            }                    
            $.get(
                src,             
                function (data){                
                    if (data.trim() === '1'){
                        alert("<?php echo __('Successfully') ?>");
                        if (type === 'delete_link'){                             
                            link.parent().parent().replaceWith("");
                            return;
                        }
                        else if (type === 'block_link'){                         
                            link.html(<?php echo "'".__('Unblock')."'"; ?>);
                            link.attr('href',<?php echo "'".$this->Html->url(array('controller' => 'Admin','action' => 'unBlockLesson'))."'"; ?> + '/'+link.attr('coma_id'));
                            link.attr('link_type','un_block_link');                            
                        }
                        else{
                            link.html(<?php echo "'".__('Block')."'"; ?>);
                            link.attr('href',<?php echo "'".$this->Html->url(array('controller' => 'Admin','action' => 'blockLesson'))."'"; ?> + '/'+link.attr('coma_id')   );
                            link.attr('link_type','block_link');
                            console.log(link.attr('coma_id'));
                        }
                    }
                    else
                    {
                        alert("<?php echo __('Error') ?>")
                    }
                }
            );
            return false;
        });

        $('#search-input').on('input',function(e){
            hide_lesson_with($(this).val());
        });
    });
   function hide_lesson_with(key){
        $('.linktr').each(function(wrapper){
            var text = this.innerText.replace('ブロック','').replace('削除','').replace('Edit','').replace('Delete','');
            if(text.toLowerCase().indexOf(key.toLowerCase()) == -1){
                $(this).hide();
            } else {
                $(this).show();
            }
        });
    }
</script>