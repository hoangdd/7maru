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
    
    function hashPasswords($data, $enforce=false) {
        if($enforce && isset($this->data[$this->alias]['password']) && isset($this->data[$this->alias]['password']) ) {
                  if(!empty($this->data[$this->alias]['password']) && !empty($this->data[$this->alias]['username']) ) {
                      $stringToHash =   $this->data[$this->alias]['username'].$this->data[$this->alias]['password'];
                        $this->data[$this->alias]['password'] = Security::hash($stringToHash,'sha1');
                    }
                }

            return $data;
    }


    public function beforeSave($options = array()) {    

        //generate user id
        
        //hash password
        $this->data = $this->hashPasswords($this->data,true);

        return true;
    }
}
