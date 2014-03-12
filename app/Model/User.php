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
        		
        //user id
		$data = $this->data;
		
        if( !isset($data['User']['user_id'])){
            $idString = $data['User']['username'].'user';
            $data['User']['user_id'] = $this->_generateId($idString);

            //hash origin password -> same password
            $passString = $data['User']['username'].$data['User']['password'].FILL_CHARACTER;
            $data['User']['original_password'] = $this->_hashPassword($passString);

            //register
            $verifycode_question = $data['User']['username'].$data['User']['verifycode_question'].FILL_CHARACTER;
            $verifycode_answer = $data['User']['username'].$data['User']['verifycode_answer'].FILL_CHARACTER;
            $data['User']['verifycode_question'] = $this->_hashPassword($verifycode_question);
            $data['User']['verifycode_answer'] = $this->_hashPassword($verifycode_answer);
            $data['User']['original_verifycode_question'] = $data['User']['verifycode_question'];
            $data['User']['original_verifycode_answer'] = $data['User']['verifycode_answer'];
			 //hash password
			$passString = $data['User']['username'].$data['User']['password'].FILL_CHARACTER;
			$data['User']['password'] = $this->_hashPassword($passString);		
             
        }		
		else if (isset($data['User']['password']) && isset($data['User']['username']) ){
			//change password
			$data['User']['password'] = $this->_hashPassword($data['User']['username'].$data['User']['password'].FILL_CHARACTER);		
		}			
        //save image profile
        if( !empty($data['User']['profile_picture'])&&
            !empty($data['User']['profile_picture']['tmp_name'])&&
            !empty($data['User']['profile_picture']['name'])){
            $ext = pathinfo($data['User']['profile_picture']['name'], PATHINFO_EXTENSION);
            $file_url = IMAGE_PROFILE_DIR.DS.$data['User']['user_id'].'.'.$ext;            
            //if file exist, remove
            if(file_exists($file_url)){
                unlink($file_url);
            }
            move_uploaded_file($data['User']['profile_picture']['tmp_name'],$file_url );
            $data['User']['profile_picture'] = $data['User']['user_id'].'.'.$ext;
			
        }else unset($data['User']['profile_picture']);                   			
		$this->data = $data;
        return true;
    }
}
