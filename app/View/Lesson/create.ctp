<script>
	window.onload = function(){
		// other tag process, add new files input
		$('#input_Category').on('input',function(e){
			hide_Checkbox_with($(this).val());

		});

		$('#input_Category').on('keypress',function(e){
			if(e.charCode == 13){
				var category = $(this).val();
				if(this_category_is_existed(category)){
					$('#input_Category_err').text('このカテゴリはも既存した');
				} else {
					$.ajax({
						'url' : "/7maru/lesson/addcategory/"+category,
						complete : function(res,err){
							if(err == 'success'){
								var newCategoryId = parseInt(res.responseText);
								if(newCategoryId < 0){
									$('#input_Category_err').text('すみませんが、何かエラーがでまして、追加できません。');
								} else {
									// add Category with new ID;
									add_Category_Checkbox_with(newCategoryId, category, true);
								}
							} else {
								$('#input_Category_err').text('ネットワークエラー。');
							}
						}
					});
				}
				// $(this).val('');
				return false;
			}
		});
		// $('.checkbox-result-wrapper').hide();

		$('.checkbox-wrapper').find('input').change(function(){
			if(this.checked){
				show_result_Checkbox_with($(this).parent().parent().find('label').text());
			} else {
				hide_result_Checkbox_with($(this).parent().parent().find('label').text());
			}
		});

	}

	function add_Category_Checkbox_with(id, name, checked){
		var checkbox_result = '<div class="input-group checkbox-result-wrapper" style="display: none">'
						+		'<span class="input-group-addon">'
						+			'<input type="checkbox" value="'+ id +'" checked="" disabled="">'
						+		'</span>'
						+		'<label class="form-control bg-success checkbox-result-name">'+name+'</label>'
						+	  '</div>';
		$('#category-result-container').append(checkbox_result);
		
		var container = $('#category-container');
		var appendHtml = '<div class="input-group checkbox-wrapper">'
						+	'<span class="input-group-addon">'
						+		'<input type="checkbox" value="' + id + '" name="category[]">'
						+	'</span>'
						+	'<label class="form-control bg-success checkbox-name">' + name + '</label>'
						+'</div>';
		

		var newCheckbox = $(appendHtml);
		newCheckbox.find('input').change(function(){
			if(this.checked){
				show_result_Checkbox_with($(this).parent().parent().find('label').text());
			} else {
				hide_result_Checkbox_with($(this).parent().parent().find('label').text());
			}
		});
		container.append(newCheckbox);

		// $('.checkbox-wrapper').find('input').change(function(){
		// 	if(this.checked){
		// 		show_result_Checkbox_with($(this).parent().parent().find('label').text());
		// 	} else {
		// 		hide_result_Checkbox_with($(this).parent().parent().find('label').text());
		// 	}
		// });

		// newCheckbox.prop('checked','true');

	}

	var on_document_input = function(){				
		var document_input = $(this).parent().find('input');		
		var needadd = true;
		var isExisted = new Array();
		for(var i=0, len=document_input.length ; i<len; i++){			 		
			if(document_input[i].value == ""){
				needadd = false;
				break;
			}
			if (isExisted[document_input[i].value] == null) {
				isExisted[document_input[i].value] = true;
			}
			else{
				alert("<?php  echo __('Duplicate upload') ?>");
				needadd = false;
				document_input[i].value = "";
				break;
			}
		}
		if(needadd) add_new_document_input($(this));
	}
	function this_category_is_existed(key){
		var categoryArr = $('.checkbox-name');
		for ( var i = 0, len = categoryArr.length; i < len ; i++ ){
			if(categoryArr[i].innerText.toLowerCase().trim() == key.toLowerCase().trim()){
				return true;
			}
		}
		return false;
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
	function add_new_document_input(file_input){							
		$(file_input).parent().append($(file_input)[0].outerHTML);
	}
</script>
<h1><?php echo __('Create New Lesson') ?></h1>
<div class="form-wrapper">
	<form class="form-horizontal" method="post" action="create" enctype="multipart/form-data">

	   
		
		<!--        Lesson Name-->
		<div class='form-group row <?php if(isset($error) && isset($error['name']))echo "has-error"; ?>'>
			<label class="control-label col-sm-4" for="lesson_type"><?php echo __('Lesson Name') ?></label>
			<div class="col-sm-8">
				<input type="text" class="form-control" placeholder="Enter Lesson Name" name="name" <?php if(isset($data) && isset($data['name']) && $data['name']) echo 'value ="'.$data['name'].'"'; ?> >
				<?php if(isset($error) && isset($error['name']))echo "<div class='text-danger'>".$error['name']."</div>"; ?>
			</div>
			
		</div>
		<div class='form-group row <?php if(isset($error) && isset($error['name']))echo "has-error"; ?>'>
			<label class="control-label col-sm-4" for="lesson_type"><?php echo __('Title') ?></label>
			<div class="col-sm-8">
				<input type="text" class="form-control" placeholder="Enter Title" name="title" <?php if(isset($data) && isset($data['title']) && $data['title']) echo 'value ="'.$data['title'].'"'; ?> >
				<?php if(isset($error) && isset($error['title']))echo "<div class='text-danger'>".$error['title']."</div>"; ?>
			</div>
			
		</div>
		<!--        Category check box-->
		<div class="form-group row">
			<label class="control-label col-sm-4" for="lesson_type"><?php echo __('Category') ?></label>
			<div class="col-sm-3" id = "category-container" style="height: 300px;overflow-y: scroll;">
				<?php foreach ($categories as $category){ ?>
				<div class="input-group checkbox-wrapper">
					<span class="input-group-addon">
						<input type="checkbox" value= <?php echo '"'.$category["Category"]["category_id"].'"'; ?> name= "category[]">
					</span>
					<label class="form-control bg-success checkbox-name" ><?php echo $category["Category"]["name"] ?></label>
				</div>
				<?php } ?>                
			</div>
			<div class="col-sm-3" id = "category-result-container">
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
				<div id = 'input_Category_err'></div>
			</div>
		</div>
		<!--        Lesson Description-->          
		<div class="form-group row <?php if(isset($error) && isset($error['desc']))echo "has-error"; ?>">
			<label class="control-label col-sm-4" for="lesson_type"><?php echo __('Description') ?></label>
			<div class="col-sm-8">
				<textarea class="form-control" rows="3" name="desc" ><?php if(isset($data) && isset($data['desc']) && $data['desc']) echo $data['desc']; ?></textarea>
				<?php if(isset($error) && isset($error['desc']))echo "<div class='text-danger'>".$error['desc']."</div>"; ?>
			</div>
		</div>
		<!--        Document-->  
		<div class="form-group row">
			<label class="control-label col-sm-4" for="lesson_type"><?php echo __('Document') ?></label>
			<div class="col-sm-8" id = "document-input-wrapper">
				<input type="file" name="document[]" class = 'document-input' onchange = "on_document_input.call(this)">
				<?php if(isset($error) && isset($error['document']))echo "<div class='text-danger'>".$error['document']."</div>"; ?>
				<!-- <input type="file" name="document[]" id='document'> -->
			</div>
		</div>
		<!--Test File-->
		<div class="form-group row">
			<label class="control-label col-sm-4" for="lesson_type"><?php echo __('Test File') ?></label>
			<div class="col-sm-8">
				<!-- <input type="file" name="test"> -->
				<input type="file" name="test[]" onchange = "on_document_input.call(this)">
				<?php if(isset($error) && isset($error['test']))echo "<div class='text-danger'>".$error['test']."</div>"; ?>
			</div>
		</div>
		<div class="form-group row">
			<label class="control-label col-sm-4" for="lesson_type"><?php echo __('Lesson Image') ?></label>
			<div class="col-sm-8">
				<input type="file" name="cover-image">   
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