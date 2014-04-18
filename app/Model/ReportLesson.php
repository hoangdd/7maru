<?php

class ReportLesson extends AppModel {
	public $useTable = 'report_comas';
	public $primaryKey = 'report_id';
	public $belongsTo = array(
		'Lesson' => array(
			'foreignKey' => 'coma_id'
		)
	);
}
