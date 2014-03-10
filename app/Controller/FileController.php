<?php

class FileController extends AppController {
	private function __hasPermission($file_id = null){
		if( $file_id==null || $this->Auth->loggedIn()){
			//not alow
			return false;
		}

		$file = $this->File->find($file_id);
		if(empty($file)){
			//file not found
			return false;
		}

	}
	public function file($file_id){

		$this->layout = false;
		$this->viewClass = 'Media';

		// check file_id empty
		if( empty($file_id)){
			return false;
		}

		//check file exist
		$file = $this->File->find($file_id);
		if(empty($file)){
			return false;
		}


		$mineType = $data['mimeType'][$file['File']['ext']];
 		$path = $file['File']['path']

		$params = array(
            'download'  => false, //no force download
            'extension' => 'swf',
	        'mimeType'  => array(
	            'flash' => 'application/x-shockwave-flash'
	        ),
            'path'      => $path
        );
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