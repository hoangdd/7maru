
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
        <th class="info"><label><?php echo __("File");?></label></th>
        <th class="info"><label><?php echo __("Type");?></label></th>
		<th class="info"><label><?php echo __("Lesson");?></label></th>
        <th class="info"><label><?php echo __("Author");?></label></th>
        <th class="info"><label><?php echo __("Date Created");?></label></th>
        <th class="info"><label><?php echo __("Block");?></label></th>
        <th class="info"><label><?php echo __("Delete");?></label></th>
        <?php
        foreach ($reference as $d):                
            echo '<tr class="linktr">'.'<td>'.$d['Data']['file_name'].'</td>'.'<td>'.$d['Data']['type'].'</td>'.'<td>'.$d['Lesson']['name'].'</td><td>'.$d['Lesson']['Author']['username'].'</td><td>'.$d['Lesson']['created'].'</td>';
            echo '<td>';
            if ($d['Data']['is_block'] === '0'){
                echo $this->Html->link(__('Block'),array('controller' => 'Admin','action' => 'blockFile',$d['Data']['file_id']),array('link_type' => 'block_link','file_id' => $d['Data']['file_id']));
            }
            else{
                echo $this->Html->link(__('UnBlock'),array('controller' => 'Admin','action' => 'blockFile',$d['Data']['file_id']),array('link_type' => 'un_block_link','file_id' => $d['Data']['file_id']));
            }
            echo '</td>';
            echo '<td>';
            echo $this->Html->link(__('Delete'),array('controller' => 'Admin','action' => 'deleteData',$d['Data']['file_id']),array('link_type' => 'delete_link','file_id' => $d['Data']['file_id']));
            echo '</td></tr>';
        endforeach;
        ?>
	</table> 
</div>
<script>
    $(document).ready(function(){
        $("tr.linktr td a").click(function(){
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
                            link.attr('href',<?php echo "'".$this->Html->url(array('controller' => 'Admin','action' => 'unBlockFile'))."'"; ?> + '/'+link.attr('file_id'));
                            link.attr('link_type','un_block_link');                                                       
                        }
                        else{
                            link.html(<?php echo "'".__('Block')."'"; ?>);
                            link.attr('href',<?php echo "'".$this->Html->url(array('controller' => 'Admin','action' => 'blockFile'))."'"; ?> + '/'+link.attr('file_id')   );
                            link.attr('link_type','block_link');
                            console.log(link.attr('file_id'));
                        }
                    }
                    else
                    {
                        alert("<?php echo __('Error') ?>")
                    }
                }
            );
            return false;
        })
    })
</script>