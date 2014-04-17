<?php 
    echo $this->Html->css(array('search'));
?>
<?php echo $this->Html->scriptStart();?>
    $(document).ready(function(){
        $('input[name="time"]').click(function(){
            if($('.custom-time').is(':checked')){
                $('.from-to-time').css({'visibility': 'visible'});
            }else{
                $('.from-to-time').css({'visibility': 'hidden'});
            }
        });
        $('.search-button').click(function(){

            //keyword
            var keyword = $('input[name="keyword"').val();

            //type
            var type = '';
            $('input[name="type"]:checked').each(function(){
                type += $(this).val()+' ';
            });


            //category
            var category = '';
            $('input[name="category"]:checked').each(function(){
                category += $(this).val()+' ';
            });

            //time
            var time;
            $('input[name="time"]:checked').each(function(){
                time = {
                    'from' : $(this).attr('from'),
                    'to' : $(this).attr('to'),
                }
            });
            var rate = '';
            $('input[name="rate"]:checked').each(function(){
                rate += $(this).val()+' ';
            });

            var data = {
                'keyword' : keyword,
                'type' : type,
                'category' : category,
                'time' : time,
                'rate' : rate,
            }
            $.ajax({
                'url' : '<?php echo $this->Html->url(array("controller" => "Search", "action" => "ajaxSearch"));?>',
                'type' : 'get',
                'data' : data,
                complete : function(res){
                    $('.result').html(res.responseText);
                }
            });
        });
    });
<?php echo $this->Html->scriptEnd();?>
<div>
    <input name = 'keyword'>
    <button class='search-button'>Search</button>
</div>
<div class = 'filter'>
    <table>
        <tr>
            <td>
                <?php echo __('Type');?>
            </td>

            <td>
                <?php echo __('Category');?>
            </td>
            <td>
                <?php echo __('Time');?>
            </td>
            <td>
                <?php echo __('Rate');?>
            </td>
        </tr>
    

        <tr>
            <td>
                <div>
                    <input name='type' type='checkbox' value='lesson'> <?php echo __('Lesson');?>
                </div>
                <div>
                    <input name='type' type='checkbox' value='teacher'> <?php echo __('Teacher');?>
                </div>
                <div>
                    <input name='type' type='checkbox' value='student'> <?php echo __('Student');?>
                </div>
            </td>
            <td>
                <?php foreach ($categories as $key => $value) : ?>
                    <div>
                        <input type="checkbox" name="category" 
                        value="<?php echo $value['Category']['category_id']?>">
                        <?php echo $value['Category']['name'];?>
                    </div>
                <?php endforeach;?>
            <td>
                <?php 
                    $today = date('y/m/d');
                ?>
                <div>
                    <input name = 'time' from = '<?php echo $today;?>' to =  '<?php echo $today;?>' type='radio'><?php echo __('Today');?>
                </div>
                <div>
                    <input name = 'time' from = '<?php echo date_format(new DateTime('1 week ago'), 'y/m/d');?>' to =  '<?php echo $today;?>' type='radio'><?php echo __('This week');?>
                </div>
                <div>
                    <input name = 'time' from = '<?php echo date_format(new DateTime('1 month ago'), 'y/m/d');?>' to =  '<?php echo $today;?>' type='radio'><?php echo __('This month');?>
                </div>
                <div>
                    <input name = 'time' from = '<?php echo date_format(new DateTime('1 year ago'), 'y/m/d');?>' to =  '<?php echo $today;?>' type='radio'><?php echo __('This year');?>
                </div>
                <div style='display:none'>
                    <input name = 'time'  from = '' to = '' 
                        type='radio' class='custom-time'><?php echo __('Custom time');?>
                    <div class='from-to-time'>
                        <div>
                            <?php echo __('From')?>: 
                        </div>
                        <input type='datetime' name='from-input'>
                        <input name="date_of_birth" class="form-control valid" id="dp" >
                        <div>
                            <?php echo __('To')?>: 
                        </div>
                        <input type='datetime' name='to-input'>
                        <input name="date_of_birth" class="form-control valid" id="dp">
                    </div>
                </div>
            </td>
            <td>
                <?php for($i=0;$i<5;$i++) : ?>
                    <div>
                        <input name='rate' type="checkbox" value=<?php echo $i+1 ?>><?php echo $i+1;?>
                    </div>
                <?php endfor;?>
            </td>
        </tr>   
    </table>
</div>
<form>
<div class='result'>
</div>