<?php
	if( !empty($data)){
		echo $this->element('lesson_list', array('list' => $data));
	}else{
		echo '0';
	}
?>
