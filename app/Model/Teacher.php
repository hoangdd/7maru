<?php

class Teacher extends AppModel {
    public $primaryKey = 'teacher_id';
    public $validate = array(
        'bank_account' => array(
            'required' => true,
            'rule' => 'alphaNumeric',
            'message' => 'Teacher\'s bank account is required'
        ),
        'office' => array(
            'required' => true,
            'rule' => 'alphaNumeric',
            'message' => 'Teacher\' office is required'
        )
    );

    public function beforeSave(){
    	
    	$data = $this->data['Teacher'];
   		//generate admin id
   		//username required
		$idString = $data['username'].'teacher';
    	$data['student_id'] = $this->_generateId($idString);

	    //hash password
   		$this->data['Student'] = $data;
    	return true;
    }
}
