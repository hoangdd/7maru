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
		$this->viewClass = 'Media';
		$this->loadModel('Data');
		//check file exist
		$file = $this->Data->findByFileId($file_id);
		if(empty($file)){
			return false;
		}
		if ($file['Data']['is_block'] == 1){
			$this->Session->setFlash(__('The file is blocked'));
			//$this->redirect(array('controller' => 'Home','action' => 'index'));
			die;
		}
		// check permission	
		$lessonId = $file['Data']['coma_id'];	
		$user = $this->Auth->user();
		if ($user['role'] == 'R1'){

		}
		else if ($user['role'] == 'R2'){
			//Teacher
			//check teacher is author			
			$result = $this->Lesson->find('first',array('conditions' => array('coma_id' => $lessonId,'author' => $user['user_id'])));
			if (!$result){
				die;
			}
		}		
		else if ($user['role'] == 'R3'){
			//check if user bought the lesson
			$this->loadModel('LessonTransaction');
			$result = $this->LessonTransaction->had_active_transaction($user['user_id'],$file['Data']['coma_id']);
			if (!$result){				
				die;
			}
		}
		$this->autoLayout = false;
		$ext = pathinfo($file['Data']['path'], PATHINFO_EXTENSION);
		// @todo , xu li path
		switch ($ext) {
			case 'swf':
				$path = SWF_DATA_DIR.DS.$file['Data']['path'];
				break;
			case 'js':
				$path = HTML_DATA_DIR.DS.$file['Data']['path'];
				break;
			case 'mp3':
				$path = AUDIO_DATA_DIR.DS.$file['Data']['path'];
				break;
			case 'ogg':
				$path = AUDIO_DATA_DIR.DS.$file['Data']['path'];
				break;
			case 'mp4':
				$path = VIDEO_DATA_DIR.DS.$file['Data']['path'];
				break;
			case 'flv':
				$path = VIDEO_DATA_DIR.DS.$file['Data']['path'];
				break;
			default:
				$path = '';
				break;
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
}



/*
$ext = pathinfo($file['File']['url'], PATHINFO_EXTENSION);

$dataFile = Configure::read('dataFile');
if( !isset($data['mimeType'][$ext])||empty($data['mimeType'][$ext]) ){
	//unsupported file
	return false;
}*/