<?php
// echo $this->Form->create('Category');
// echo $this->Form->input('name');
// echo $this->Form->input('description ');
// echo $this->Form->end('Add');
?>
<form action="/7maru/admin/addCategory" id="CategoryAddCategoryForm" method="post" accept-charset="utf-8" class = "form-horizontal">
	<div style="display:none;">
		<input type="hidden" name="_method" value="POST">
	</div>
	<div class="input text form-group">
		<label for="CategoryName" class="col-sm-2 control-label" >名前</label>
		<div class="col-sm-10">
			<input class="form-control" name="data[Category][name]" maxlength="30" type="text" id="CategoryName" value = <?php echo "'".$category['Category']['name']."'" ?> >
		</div>
	</div>
	<div class="input text form-group">
		<label for="CategoryDescription" class="col-sm-2 control-label">Description</label>
		<div class="col-sm-10">
			<input class="form-control" name="data[Category][description]" type="text" id="CategoryDescription" value = <?php echo "'".$category['Category']['description']."'" ?>>
		</div>
	</div>
	<div class="submit">
		<div class = ""></div>
		<div class="col-sm-10">
			<input type="submit" value="Add" class = "btn btn-primary">
		</div>
	</div>
</form>