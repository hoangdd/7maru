<script>
	$(document).ready(function(){
		var notifies = <?php echo json_encode($notifies) ?>;
		$("a").click(function(){
			var index = $(this).attr('id');
			var id = $(this).attr('notify_id');
			var contentElement = $(this).find('p');
			contentElement.html(notifies[index]['Notification']['content']);
			$.get(
				"<?php echo $this->Html->url(array('controller' => 'User','action' => 'changeStateNotify')) ?>" + "/"+id
			);
			$(this).removeClass('active');
			return false;
		})
	})
</script>

<div class="list-group">
	<?php foreach ($notifies as $index=>$notify) : 
		if ($notify['Notification']['viewed'] == 0){
			$class = " active";
		}else
		{
			$class = "";
		}
	?>
	  <a notify_id = "<?php echo $notify['Notification']['notification_id'] ?>" id = "<?php echo $index ?>" href="#" class="list-group-item<?php echo $class; ?>">
	    <h4 class=""><?php echo $notify['Notification']['created'] ?></h4>
	    <p class="list-group-item-text"><?php echo substr($notify['Notification']['content'],0,10)."....."; ?></p>
	  </a>
  	<? endforeach; ?>
</div>

