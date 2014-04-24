<?php
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
App::uses('Folder', 'Utility');
App::uses('File', 'Utility');

class User extends AppModel {
    public $primaryKey = 'user_id';
    public $validate = array(
        'username' => array(
            'required' => true,
            'rule' => '/^[A-Za-z]\w+$/',
            'message' => 'A username is required'
        ),
        'password' => array(
            'required' => true,
            'rule' => '/^\w+$/',
            'message' => 'A password is required'
        )
    );
    // public $hasMany = array(
    //     'Comment' => array(
    //         'foreignKey' => 'user_id',
    //         'dependent' => true
    //     ),        
    //     'Lesson' => array(
    //      'foreignKey' => 'author',
    //      'dependent' => true
    //     ),        
    //     'ReportLesson' => array(
    //      'foreignKey' => 'user_id',
    //      'dependent' => true
    //     ),
    //     'RateLesson' => array(
    //      'foreignKey' => 'student_id',
    //      'dependent' => true
    //     ),
    //     'BlockStudent' => array(
    //         'foreignKey' => 'student_id',
    //         'dependent' => true
    //     )
    // );
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
            //$verifycode_question = $data['User']['username'].$data['User']['verifycode_question'].FILL_CHARACTER;
            if ($data['User']['user_type'] == 1){
                //$verifycode_question = Security::cipher($data['User']['verifycode_question'],KEY_PRIVATE_QUESTION);
                $this->log($data['User']['verifycode_question'],'hlog');
                $verifycode_question = $data['User']['verifycode_question'];                
                $this->log($verifycode_question,'hlog');
                $verifycode_answer = $data['User']['username'].$data['User']['verifycode_answer'].FILL_CHARACTER;

                $data['User']['verifycode_question'] = $verifycode_question;
                $data['User']['verifycode_answer'] = $this->_hashPassword($verifycode_answer);

                $data['User']['original_verifycode_question'] = $data['User']['verifycode_question'];            
                $data['User']['original_verifycode_answer'] = $data['User']['verifycode_answer'];
            }
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
			
        }else $data['User']['profile_picture'] = DEFAULT_PROFILE_IMAGE;                   			
		$this->data = $data;
        return true;
    }

    public function getType($username)
    {
        $user = $this->find('first',array('conditions' => array('username' => $username)));
        if ($user){
            if ($user['User']['user_type'] == 1){
                $type = 'Teacher';
            }
            else{
                $type = 'Student';
            }        
        }
        return $type;
    }

    public function isDeleted($user_id)
    {
        $result = $this->find('first',array('conditions' => array('user_id' => $user_id,'activated' => 0)));
        if ($result)
            return true;
        else
            return false;
    }

    public function isApproved($username)
    {        
        $user = $this->find('first',array('conditions' => array('username' => $username, 'approved' => 1,'activated' => 1)));
        if ($user){            
            return true;
        }
        else{
            return false;            
        }        
    }

}
