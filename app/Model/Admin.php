<?php
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
class Admin extends AppModel {
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

        //generate admin id
		$data = $this->data;
		$idString = $data['Admin']['username'].'admin';
        $this->data['Admin']['admin_id'] = hash('crc32', $idString);
         
        //hash password
        $this->hashPassword($this->data['Admin'],true);
        return true;
    }
    public $primaryKey = 'admin_id';
}
