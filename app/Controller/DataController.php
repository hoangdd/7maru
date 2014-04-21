<?php
App::uses('MediaView', 'View');
class DataController extends AppController {
	private function __hasPermission($file_id = null){
		if( $file_id==null || $this->Auth->loggedIn()){
			//not alow
			return false;
		}

		$file = $this->Data->find($file_id);
		if(empty($file)){
			//file not found
			return false;
		}

	}
	public function file($file_id=null){

		$q = $this->request->query;
		if( empty($q['token'])) die;
		$user = $this->Auth->user();
		if ($user['role'] == 'R1'){
			$user_id = $user['admin_id'];
		}else{
			$user_id = $user['user_id'];
		}
		if( !$this->__checkToken($q['token'], $file_id, $user_id) ){
			// invalid token
			echo 'コピーするとバカになり	ます！';
			 die;
		}
		$this->viewClass = 'Media';
		$this->loadModel('Data');
		$this->loadModel('Lesson');
		//check file exist
		$file = $this->Data->findByFileId($file_id);		
		if(empty($file)){
			return false;
		}
		$lessonId = $file['Data']['coma_id'];
		$lesson = $this->Lesson->findByComaId($lessonId);		
		$authorId = $lesson['Lesson']['author'];
		if ($lesson['Lesson']['is_block'] == 1 || $file['Data']['is_block'] == 1){
			echo '<div class="alert alert-success">'.__('The file is blocked').'</div>';			
			//$this->redirect(array('controller' => 'Home','action' => 'index'));
			die;
		}
		// check permission					
		if ($user['role'] == 'R1'){

		}
		else if ($user['role'] == 'R2'){
			//Teacher
			//check teacher is author						
			$result = $this->Lesson->find('first',array('conditions' => array('coma_id' => $lessonId,'author' => $user['user_id'])));
			if (!$result){
				echo '<div class="alert alert-success">'.__('Forbidend error').'</div>';
				die;
			}
		}		
		else if ($user['role'] == 'R3'){
			//check if user bought the lesson
			$this->loadModel('LessonTransaction');
			$result = $this->LessonTransaction->had_active_transaction($user['user_id'],$file['Data']['coma_id']);
			if (!$result){				
				echo '<div class="alert alert-success">'.__('Forbidend error').'</div>';
				die;
			}
			$this->loadModel('BlockStudent');
			$result = $this->BlockStudent->isBlock($user['user_id'],$authorId);
			if ($result){
				//$this->Session->setFlash(__('You are blocked by author'));
				$this->redirect(array('controller' => 'Home','action' => 'index'));
			}
		}
		$this->autoLayout = false;

		$ext = pathinfo($file['Data']['path'], PATHINFO_EXTENSION);
		// @todo , xu li path
		$config = Configure::read('dataFile');
		foreach ($config as $key => $value) {
	//		debug($ext);die;
			if( in_array($ext, $value['extension'])){				
				$path = $value['path'].DS.$file['Data']['path'];
				break;
			}else{
				$path = '';
			}

		}
		$mimeType = '';
		$mimeTypes = Configure::read('dataFile');
		foreach ($mimeTypes as $key => $value) {
			if( in_array($ext,$value['extension'])){
				$mimeType = $value['mimeType'][$ext];
				break;
			}
		}
		$params = array(
            'download'  => false, //no force download
            'extension' => $ext,	      
            'path'      => $path,
            'mimeType' => $mimeType,
            'cache' => false
        );   
        //debug($params);
		$this->set($params);
	}
	private function __checkToken($token, $fid, $user_id){
		if( empty($token) || empty($fid) || empty($user_id)){
			return false;
		}
		$set = array();
		$set[] = md5(FILL_CHARACTER.date_format(new DateTime('now'), 'y/m/d h:m:s').$fid);
		$set[] = md5(FILL_CHARACTER.date_format(new DateTime('1 second ago'), 'y/m/d h:m:s').$fid);
		$set[] = md5(FILL_CHARACTER.date_format(new DateTime('2 second ago'), 'y/m/d h:m:s').$fid);

		//expired		
		if( !in_array($token, $set)){
			return false;
		}

		$tokens = $this->Session->read('Token');
		$this->log($tokens, 'hlog');
		//check token is used
		if( !empty($tokens) && 	!empty($tokens[$fid]) && !empty($tokens[$fid][$user_id]) && $tokens[$fid][$user_id] == $token){
			//check ok
			$this->Session->delete('Token.'.$fid.'.'.$user_id, $token);
			return true;
		}
		return false;
	}
}