<?php
    define('FILE_DIR', WEBROOT_DIR.DS.'files'.DS.'data');
class LessonController extends AppController {

    var $components =  array('Session');
    var $uses = array('Category','Lesson','LessonCategory');
    
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
        $filename = WEBROOT_DIR.DS.'img'.DS.'lessoncover'.DS.$_FILES['document']['name']; 
        debug($filename);
        // if (move_uploaded_file($_FILES['document']['tmp_name'],WEBROOT_DIR.DS.'img'.DS.'lessoncover'.DS.$_FILES['document']['name'])){
        //     $this->Session->setFlash('Upload OK');
        // }
        if(!empty($_FILES)){
            move_uploaded_file($_FILES["file"]["tmp_name"] ,WEBROOT_DIR.DS.'files'.DS.'data'.DS.$_FILES["file"]["name"]);
        }
        if($this->request->is('post')){
//            debug($_FILES);
//            die;
            $data = $this->request->data;
            debug($data);
            $error = array(); //error that return to client;
            // check if copyright check box had checked yet?
            if(!isset($data['copyright'])){
//                $this->Session->setFlash('Please Check copyright checkbox!!!');
                $error['copyright'] = 'Please confirm your copyright';               
            }
            
            // check if Lesson name is empty
            if(!$data['name']){
                $error['name'] = 'Lesson name do not suppose to be empty';
            }
            
            //check if Lesson Description is empty
            if(ctype_space($data['desc'])){
                $error['desc'] = 'Lesson Description do not suppose to be empty';
            }
            if($data['image']){
                //Check if image format is supported
                if(preg_match('/\.(jpg|png|gif|tif)$/',$data['image'])){
                    
                } else {
                    $error['image'] = 'Unsupported Image Format';
                }
            }
            
            if(count($error)){
                $this->set('error',$error);
                debug($error);
                $this->set('data',$data);
            }else{
                // Save Lesson Information
                $saveData = array(
                    'Lesson'=> array(
                        'name'=> $data['name'],
                        'description'=> $data['desc'],
                        'author' => $this->Auth->user('user_id')
                    )
                );
                debug($saveData);
                $this->Lesson->create();
                $lesson = $this->Lesson->save($saveData);
                // save Lesson Category
                if($lesson && isset($data['category'])){
                    $this->LessonCategory->saveLessonCategory($lesson['Lesson']['id'],$data['category']);
                }
                
                // Save Lesson image and files
                debug($_FILES);
                $filename = WEBROOT_DIR.'/img/lessoncover/'.$_FILES['image']['name']; 
                debug($filename);
                if (move_uploaded_file($_FILES['image']['tmp_name'],$filename)){
                    $this->Session->setFlash('Upload OK');
                }
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
