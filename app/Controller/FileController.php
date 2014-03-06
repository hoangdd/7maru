<?php

class FileController extends AppController {
	public function img($key = null){
		if($key==null) die;
		if($this->first==true) die;
		else
			$this->first = true;
		$this->viewClass = 'Media';
		$params = array(
            'download'  => false, //no force download
            'extension' => 'swf',
	        'mimeType'  => array(
	            'flash' => 'application/x-shockwave-flash'
	        ),
            'path'      => APP . 'data' . DS .'demo.swf'
        );
		$this->set($params);
	}
}
