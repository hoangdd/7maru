<?php
    define('FILE_DIR', WEBROOT_DIR.DS.'files'.DS.'data');
class LessonController extends AppController {

    var $components =  array('Session');
    var $uses = array('Category','Lesson','LessonCategory','File');
    
	function index(){
		 App::uses('Utilities', 'Lib');
		 $util = new Utilities();
		 $this->set('util',$util);
	}

	function Create(){
        $categories =  $this->Category->find('all');
        $this->set('categories',$categories);
        if($this->request->is('post')){
            $data = $this->request->data;
            debug($data);
            debug($_FILES);
            $error = array(); //error that return to client;
            // check if copyright check box had checked yet?
            if(!isset($data['copyright'])){
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
            if($_FILES['image']['name']){
                //Check if image format is supported
                if(!preg_match('/\.(jpg|png|gif|tif)$/',$_FILES['image']['name'])){
                    $error['image'] = 'Unsupported Image Format';
                } else if($_FILES['image']['size'] > 2097152){
                    $error['image'] = 'Image Size Too Big';
                }
            }
            if($_FILES['test']['name']){
                //Check if image format is supported
                if(!preg_match('/\.(csv)$/',$_FILES['test']['name'])){
                    $error['test'] = 'Unsupported Test File Format';
                } else if($_FILES['test']['size'] > 5242880){
                    $error['test'] = 'Test File Too Big';
                }
            }
            // for($i = 0, $len = $);
            if($_FILES['document']['name'][0]){
                //Check if image format is supported
                for($i = 0, $len = count($_FILES['document']['name']) ; $i < $len; $i++){
                    if($_FILES['document']['name'][$i]){
                        if(!preg_match('/\.(pdf|doc|docx|txt|ppt|pptx|xlsx|xls)$/',$_FILES['document']['name'][$i])){
                            $error['document'] = 'Unsupported Document Format';
                        } else if($_FILES['document']['size'][$i] > 5242880){
                            $error['document'] = 'Document Size Too Big';
                        }
                    }
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
                        'author' => $this->Auth->user('user_id'),
                        'cover' => $_FILES['image']['name']
                        )
                    );
                $lesson = $this->Lesson->save($saveData);
                // save Lesson Category
                if($lesson && isset($data['category'])){
                    $this->LessonCategory->saveLessonCategory($lesson['Lesson']['id'],$data['category']);
                }
                
                // Save Lesson image and files
                debug($_FILES);
                if($_FILES['image']['name']){
                    // get image subFix
                    $subfix = preg_split('/\./',$_FILES['image']['name']);
                    $subfix = '.'.$subfix[count($subfix)-1];

                    $filename = $_SERVER['DOCUMENT_ROOT'].$this->webroot.'app/webroot/img/lessoncover/'.$lesson['Lesson']['id'].$subfix; 
                    debug($filename);
                    if (move_uploaded_file($_FILES['image']['tmp_name'],$filename)){
                        $this->Session->setFlash('Upload OK');
                    }
                }
                $saveData = array();
                if($_FILES['document']['name'][0]){
                    for($i = 0, $len = count($_FILES['document']['name']) ; $i < $len; $i++){
                        // get document subFix
                        if($_FILES['document']['name'][$i]){
                            $subfix = preg_split('/\./',$_FILES['document']['name'][$i]);
                            $subfix = '.'.$subfix[count($subfix)-1];
                            $filename = $_SERVER['DOCUMENT_ROOT'].$this->webroot.'app/webroot/files/Document/'.$lesson['Lesson']['id'].'_'.$_FILES['document']['name'][$i]; 
                            debug($filename);
                            if (move_uploaded_file($_FILES['document']['tmp_name'][$i],$filename)){
                                $this->Session->setFlash('Upload OK');
                            }
                            $saveData[] = array(
                                'File' => array(
                                    'file_name' => $_FILES['document']['name'][$i],
                                    'path' => 'app/webroot/files/Document/'.$lesson['Lesson']['id'].'_'.$_FILES['document']['name'][$i],
                                    'coma_id' => $lesson['Lesson']['id'],
                                    'type' => $_FILES['document']['type'][$i],
                                    'isTest' => 'flase'
                                )
                            );

                        }
                    }
                } 
                if($_FILES['test']['name'][0]){
                    // get test subFix
                    $subfix = preg_split('/\./',$_FILES['test']['name']);
                    $subfix = '.'.$subfix[count($subfix)-1];
                    $filename = $_SERVER['DOCUMENT_ROOT'].$this->webroot.'app/webroot/files/Test/'.$lesson['Lesson']['id'].'_'.$_FILES['test']['name']; 
                    debug($filename);
                    if (move_uploaded_file($_FILES['test']['tmp_name'],$filename)){
                        $this->Session->setFlash('Upload OK');
                    }
                    $saveData[] = array(
                        'File' => array(
                            'file_name' => $_FILES['test']['name'],
                            'path' => 'app/webroot/files/Test/'.$lesson['Lesson']['id'].'_'.$_FILES['test']['name'],
                            'coma_id' => $lesson['Lesson']['id'],
                            'type' => $_FILES['test']['type'],
                            'isTest' => 'true'
                        )
                    );
                } 
                // Save Files Information

                
                $this->File->saveMany($saveData);

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

    private function check_Document_File(){

    }
}
