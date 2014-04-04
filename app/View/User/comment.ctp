<?php 
	//@hoangdd
	$option = array(
		'width' => '50%', 
		'comma_id' => '1', 
		'comments' => $comments
		//f*ck comma or lesson
	);
	echo $this->element('comment', $option);
?>