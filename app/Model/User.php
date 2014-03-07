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
        
        $data = $this->data['User'];
        //user id
        $idString = $data['username'].'user';
        $data['user_id'] = $this->_generateId($idString);

        //hash password
        $passString = $data['username'].$data['password'];
        $data['password'] = $this->_hashPassword($passString);

        $this->data['User'] = $data;
        return true;
    }
}
