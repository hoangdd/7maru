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
//        debug($categories);
        $this->set('categories',$categories);
        
        if($this->request->is('post')){
            $data = $this->request->data;
            debug($data);
            $error = array(); //error that return to client;
            // check if copyright check box had checked yet?
            if(!isset($data['copyright'])){
                $this->Session->setFlash('Please Check copyright checkbox!!!');
                $error['copyright'] = 'Please confirm your copyright';               
            }
            
            // check if Lesson name is empty
            if(!$data['name']){
                $error['name'] = 'Lesson name do not suppose to be empty';
            }
            
            //check if Lesson Description is empty
            if($data['desc']==''){
                $error['desc'] = 'Lesson Description do not suppose to be empty';
            }
            
            if(count($error)){
                $this->set('error',$error);
                debug($error);
                $this->set('data',$data);
            }
        }
	}

	function Edit(){

	}

	function Destroy(){
		
	}
	function View(){
	}
	
	function Comment(){
	}
}
