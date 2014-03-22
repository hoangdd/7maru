<?php
	echo $this->Html->css('component');
	echo $this->Html->css('lesson');
?>
<!-- <ul id="bk-list" class="bk-list clearfix"> -->
	<?php
		foreach ($list as $lesson) {
			echo $this->element('lesson', array(
				'lesson' => $lesson,
				));
		}
	?>
<!-- </ul> -->
