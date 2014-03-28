<?php
	// echo $this->Html->css('component');
	// echo $this->Html->css('lesson');
?>
	<?php
		foreach ($list as $lesson) {
			echo $this->element('lesson', array(
				'lesson' => $lesson,
				));
		}
	?>
