<?php
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
App::uses('Folder', 'Utility');
App::uses('File', 'Utility');

class User extends AppModel {
    public $primaryKey = 'user_id';
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

        //save image profile
        if( !empty($data['profile_picture'])&&
            !empty($data['profile_picture']['tmp_name'])&&
            !empty($data['profile_picture']['name'])){
              
            $ext = pathinfo($data['profile_picture']['name'], PATHINFO_EXTENSION);
            $file_url = IMAGE_PROFILE_DIR.DS.$data['user_id'].'.'.$ext;
            
            //if file exist, remove
            if(file_exists($file_url)){
                unlink($file_url);
            }
            move_uploaded_file($data['profile_picture']['tmp_name'],$file_url );
            $data['profile_picture'] = $data['user_id'].'.'.$ext;
        }
        
        //hash verifycode
        $verifycode_question = $data['username'].$data['verifycode_question'].FILL_CHARACTER;
        $verifycode_answer = $data['username'].$data['verifycode_answer'].FILL_CHARACTER;
        $data['verifycode_question'] = $this->_hashPassword($verifycode_question);
        $data['verifycode_answer'] = $this->_hashPassword($verifycode_answer);
        
        //hash password
        $passString = $data['username'].$data['password'];
        $data['password'] = $this->_hashPassword($passString);

        $this->data['User'] = $data;
        return true;
    }
}
