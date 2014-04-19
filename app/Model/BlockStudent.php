<?php

class BlockStudent extends AppModel {
	public $primaryKey = 'id';

	public function isBlock($student_id,$teacher_id){
		$conditions = array(
			'student_id' => $student_id,
			'teacher_id' => $teacher_id
		);
		$result = $this->find('all',array('conditions' => $conditions));
		$this->log($result,'hlog');
		if ($result){
			return true;
		}
		else
			return false;
	}
}
