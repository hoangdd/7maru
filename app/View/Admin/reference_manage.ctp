<?php 
	$this->Paginator->options(array(
         'update' => '#reference_list',
         'evalScripts' => true
         ));
?>
<!-- header -->
<div id="reference_list">
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
		<th class="info"><label><?php echo __("Reference");?></label></th>
        <th class="info"><label><?php echo __("Author");?></label></th>
        <th class="info"><label><?php echo __("Date Created");?></label></th>
        <th class="info"><label><?php echo __("Violation");?></label></th>
        <th class="info"><label><?php echo __("Delete");?></label></th>
        
	</table>
</div>
