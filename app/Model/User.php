<?php
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
class User extends AppModel {
    
    public $primarykey = 'user_id';
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
    if (isset($this->data[$this->alias]['password'])) {
        $passwordHasher = new SimplePasswordHasher();
        $password =   $this->data[$this->alias]['username'].$this->data[$this->alias]['password'];
        $this->data[$this->alias]['password'] = $passwordHasher->hash(
          $password
        );
    }
    return true;
}
}
