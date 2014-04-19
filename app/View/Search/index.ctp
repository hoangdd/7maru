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
			// if( keyword.length == 0 ) return;

			//loading
			$('.result').html('<?php echo $this->Html->image("loading.gif");?>');

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

			//sort
			var order;
			$('input[name="order"]:checked').each(function(){
				order =  $(this).val();
			});

			//author
			var author = $('.author1 option:checked').val()+' '+$('.author2 option:checked').val();

			var data = {
				'keyword' : keyword,
				'type' : type,
				'category' : category,
				'time' : time,
				'rate' : rate,
				'order' : order,
				'author' : author
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
		
		$('.advanced-search').click(function(){
			$('.filter').toggleClass('hide');
		});
		$('input[name="type"]').click(function(){
			$('table').hide();
			var type = $(this).val();
			$('.'+type+'-filter').show();
		});
		//first load
		$('.search-button').click();
	});
<?php echo $this->Html->scriptEnd();?>
<!-- <div class='panel' style='width:1000px;height:1000px;position:fixed;z-index=5;'></div> -->
<div>
	<input name = 'keyword' value = '<?php if(isset($data['keyword'])) echo $data['keyword'];?>'>
	<button class='search-button'><?php echo __('Search');?></button>
	<button class='advanced-search'><?php echo __('Show advanced search');?></button>
</div>
<div class = 'filter hide'>
 <div>
	<input name='type' type='radio' value='lesson' checked> <?php echo __('Lesson');?>

	<input name='type' type='radio' value='teacher'> <?php echo __('Teacher');?>

	<input name='type' type='radio' value='category'><?php echo __('Category');?>
</div>
	<table class='lesson-filter'>
		<tr>
			<td>
				<?php echo __('Category');?>
			</td>
			<td>
				<?php echo __('Time');?>
			</td>
			<td>
				<?php echo __('Rate');?>
			</td>
			 <td>
				<?php echo __('Author');?>
			</td>
			<td>
				<?php echo __('Sort by');?>
			</td>
		</tr>
	

		<tr>
			<td >
				<div style='height:100px;overflow:auto'>
					<?php foreach ($categories as $key => $value) : 
						if( !empty($data['category'])) :
					?>
						<div>
							<input type="checkbox" name="category" <?php if($data['category']==$value['Category']['category_id']) echo 'checked';?>
							value="<?php echo $value['Category']['category_id']?>">
							<?php echo $value['Category']['name'];?>
						</div>
					<?php else : ?>
					  <div>
							<input type="checkbox" name="category" checked
							value="<?php echo $value['Category']['category_id']?>">
							<?php echo $value['Category']['name'];?>
						</div>
					<?php 
						endif;
					endforeach;?>
				</div>
			<td>
				<?php 
					$today = date('y/m/d');
					$tomorrow = date_format(new DateTime('tomorrow'),'y/m/d');
				?>
				<div>
					<input name = 'time' from = '<?php echo $today;?>' to =  '<?php echo $tomorrow;?>' type='radio'><?php echo __('Today');?>
				</div>
				<div>
					<input name = 'time' from = '<?php echo date_format(new DateTime('1 week ago'), 'y/m/d');?>' to =  '<?php echo $tomorrow;?>' type='radio'><?php echo __('This week');?>
				</div>
				<div>
					<input name = 'time' from = '<?php echo date_format(new DateTime('1 month ago'), 'y/m/d');?>' to =  '<?php echo $tomorrow;?>' type='radio'><?php echo __('This month');?>
				</div>
				<div>
					<input checked name = 'time' from = '<?php echo date_format(new DateTime('1 year ago'), 'y/m/d');?>' to =  '<?php echo $tomorrow;?>' type='radio'><?php echo __('This year');?>
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
				<?php for($i=0;$i<6;$i++) : ?>
					<div>
						<input name='rate' type="checkbox" checked value=<?php echo $i ?>><?php echo $i;?>
					</div>
				<?php endfor;?>
			</td>
			<td>
				1:
				<select class='author1'>
					<option value=''> <?php echo __('Any'); ?></option>
					<?php 
						foreach ($teacher_list as $key => $value) {
							$markup =  '<option ';
							if( !empty($data['author'])&&$data['author']==$value['User']['user_id'] )
								$markup .= 'selected';
							$markup .= ' value="'.$value['User']['user_id'].'">'.$value['User']['username'].'</option>';
							echo $markup;
						}
					?>
				</select>
				<br>
				<br>
				2:
				<select class='author2'>
					<option value=''> <?php echo __('Any'); ?></option>
					<?php 
						foreach ($teacher_list as $key => $value) {
							echo '<option value="'.$value['User']['user_id'].'">'.$value['User']['username'].'</option>';
						}
					?>
				</select>
			</td>
			<td>
				<div>
					<input name = 'order' checked type='radio' value='Lesson.created'><?php echo __('Time');?>
				</div>
				<div>
					<input name = 'order' type='radio' value='Lesson.name'><?php echo __('Name');?>
				</div>
				<div>
					<input name = 'order' type='radio' value='Category.name'><?php echo __('Tag');?>
				</div>
			</td>
		</tr>   
	</table>
	<table class='teacher-filter' style="display:none">
		<tr>
		   
		</tr>
		<tr>
			
		</tr>   
	</table>
   <table class='category-filter' style="display:none">
		<tr>
			
		</tr>
		<tr>
		   
		</tr>   
	</table>
</div>
<form>
<hr>
<h1><b><?php echo __('Result');?></b></h1>
<div class='result'>
</div>