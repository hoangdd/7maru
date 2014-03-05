<?php
class Admin extends AppModel {

  public $useTable = false;
  public $primarykey = 'admin_id';
  public $validate = array(
      'username' => array(
          'required' => true,
          'rule' => 'alphaNumeric',
          'message' => 'A username is required'
      ),
      'password' => array(
          'required' => true,
          'rule' => 'alphaNumeric',
          'message' => 'A password is required'
      )
  );
 public function beforeSave($options = array()) {    
    $data = $this->data['Admin'];

    //generate admin id
		$idString = $data['username'].'admin';
    $data['admin_id'] = $this->_generateId($idString);

    //hash password
    $passString = $data['username'].$data['password'];
    $data['password'] = $this->_hashPassword($passString);

    $this->data['Admin'] = $data;
    return true;
  }
}
