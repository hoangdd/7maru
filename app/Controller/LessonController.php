<?php
class LessonController extends AppController {
    var $components =  array('Session');
    var $uses = array('Category');
    
	function index(){
		 App::uses('Utilities', 'Lib');
		 $util = new Utilities();
		 $this->set('util',$util);
	}

	function Create(){
        //  $this->loadModel('Category');
        $categories =  $this->Category->find('all');
        debug($categories);
        $this->set('categories',$categories);
        
        if($this->request->is('post')){
            $data = $this->request->data;
            debug($data);
            if(isset($data['copyright'])){
                $this->Session->setFlash('Checked');
            }
        }
	}

	function Edit(){

	}

	function Destroy(){
		
	}
	function View(){
		
	}
}
