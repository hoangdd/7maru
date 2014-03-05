<?php

class Student extends AppModel {
    public $primaryKey = 'student_id';
    public $validate = array(
        'credit_account' => array(
            'required' => true,
            'rule' => 'alphaNumeric',
            'message' => 'A credit number is required'
        )
    );

    public function beforeSave(){
    	$data = $this->data['Student'];
   		//generate admin id
        //username required
		$idString = $data['username'].'student';
    	$data['student_id'] = $this->_generateId($idString);

	    //hash password
	    
   		$this->data['Student'] = $data;
    	return true;
    }
}
