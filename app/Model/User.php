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
    function hashPassword($data, $enforce=false) {
        if($enforce && isset($this->data[$this->alias]['password']) && isset($this->data[$this->alias]['password']) ) {
                  if(!empty($this->data[$this->alias]['password']) && !empty($this->data[$this->alias]['username']) ) {
                      $stringToHash =   $this->data[$this->alias]['username'].$this->data[$this->alias]['password'];
                      $hasher = new SimplePasswordHasher(array('hashType' =>'sha1'));
                        $this->data[$this->alias]['password'] = $hasher->hash($stringToHash);
                    }
                }

            return $data;
    }


    public function beforeSave($options = array()) {    

        
        //hash password
        $this->data = $this->hashPassword($this->data,true);

        return true;
    }
}
