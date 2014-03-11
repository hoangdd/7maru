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
	public function file($file=null){

		/*$this->layout = false;

				// check file_id empty
				if( empty($file_id)){
					return false;
				}

				//check file exist
				$file = $this->File->findByFileId($file_id);
				if(empty($file)){
					return false;
				}
		*/
		$this->viewClass = 'Media';
		// $this->autoLayout = false;
		// $ext = pathinfo($file, PATHINFO_EXTENSION);
		// @todo , xu li path
		// switch ($ext) {
		// 	case 'swf':
		// 		$path = SWF_DATA_DIR.DS.$file;
		// 		break;

		// 	default:
		// 		$path = '';
		// 		break;
		// }

		// $mineTypes = Configure::read('dataFile');
		// foreach ($mineTypes as $key => $value) {
		// 	if( in_array($ext,$value['extension'])){
		// 		$mineType = $value['mimeType'][$ext];
		// 		break;
		// 	}
		// }
		$path = '/opt/lampp/htdocs/7maru/app/data/swf/0432184d.swf';
		$params = array(
            'download'  => false, //no force download
            'extension' => 'ext',
	        'mimeType'  => array(
				'swf' => array('flash' => 'application/x-shockwave-flash'),
				),
            'path'      => '/opt/lampp/htdocs/7maru/app/data/swf/0432184d.swf'
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