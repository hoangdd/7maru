<?php

class ReportLesson extends AppModel {
	public $useTable = 'report_comas';
	public $primaryKey = 'report_id';
	public $belongsTo = array(
		'Lesson' => array(
			'foreignKey' => 'coma_id'
		)
	);
	public function isReported($user_id,$coma_id){
		$result = $this->find('first',array(
			'conditions' => array(
				'ReportLesson.user_id' => $user_id,
				'ReportLesson.coma_id' => $coma_id
			))
		);
		if ($result){
			return true;
		}
		else 
			return false;
	}
}
