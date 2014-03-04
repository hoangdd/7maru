<?php
 echo $this->Form->create(null,
 	array('action' => 'index')
 	);
 ?>
<div class="form-group">
    <label for="exampleInputEmail1">Your comment</label>
    <textarea class="form-control" rows="3" width: 200px;></textarea>
</div>
<button type="submit" class="btn btn-default">Submit</button>
<?php echo $this->Form->end(); ?>