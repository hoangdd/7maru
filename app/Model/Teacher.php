<?php

class Teacher extends AppModel {
    public $primaryKey = 'teacher_id';
    // public $validate = array(
    //     'bank_account' => array(
    //         'required' => true,
    //         'rule' => '',
    //         'message' => 'Teacher\'s bank account is required'
    //     )
    // );

    public function beforeSave($options = array()){    	 
       
    	$data = $this->data['Teacher'];
        

   		//username required
		$idString = $data['username'].'teacher';
    	$data['teacher_id'] = $this->_generateId($idString);

	    //hash password
   		$this->data['Teacher'] = $data;
    	return true;
    }
}
