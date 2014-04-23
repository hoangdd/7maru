<?php
define('FILE_DIR', WEBROOT_DIR.DS.'files'.DS.'data');
class LessonController extends AppController {

	public $components =  array('Session','Paginator');
	public $uses = array(
		'Category',
		'Lesson',
		'LessonCategory',
		'Data',
		'Teacher',
		'RateLesson',
		'LessonTransaction',
		'BlockStudent',
		'TestResult',
		'User'
		);
	
	public function beforeFilter(){
		parent::beforeFilter();
		//$this->Auth->allow('index');//allow all, manual check
	}
	/**
	* 授業の総体情報を表示する。ユーザーはこのページを見るから、授業を買うかどうかを決定できる。
	*　$id: 授業のID
	*/
	function index($id = null){
		App::uses('Utilities', 'Lib');
		$util = new Utilities();		;
		if($id){
			//授業の見られる数を1回を増加する。

			//$this->Lesson->increaseView($id);

			// データベースから、授業の情報を取得

			$this->Lesson->bindModel(array(			
			'hasMany' => array(				
				'File' => array(
					'className' => 'Data',
					'foreignKey' => 'coma_id' 
					)				
				),
			));			
			$lesson = $this->Lesson->find('first',array('conditions' => array('coma_id' => $id,'Lesson.is_block' => 0), 'recursive' => 2));						
			if ($lesson == null){
				$this->Session->setFlash(__('The lesson is blocked'));			
				//$this->redirect(array('controller' => 'Home','action' => 'index'));
				header("location:javascript://history.go(-1)");
			}
			$file = $lesson['File'];
			$lesson = $lesson['Lesson'];			
			$lesson['created'] = $util->convertDate($lesson['created'],'d-m-Y');
			$this->loadModel('User');
			$author = $this->User->findByUserId($lesson['author']);
			$author = $author['User'];		
			//授業の評価された数を準備する。
			$lesson['ranker'] = $this->RateLesson->get_rate_num($lesson['coma_id']);
			
			//平均評価を数いる。
			$lesson['stars'] = $this->RateLesson->get_mean_rate($lesson['coma_id']);
			
			//授業の見られる数を準備する。
			
			// ユーザーはこの授業を買ったかどうかをチェックして、クライアントへ送信する。			
			$user = $this->Auth->user();
			// debug($user);
			$lesson['buy_status'] = 1;						
			if ($user['role'] == 'R3'){				
				if(!$this->LessonTransaction->had_active_transaction($user['user_id'],$lesson['coma_id'])){
					$lesson['buy_status'] = 0;
				}
				$student_id = $user['user_id'];
				$teacher_id = $author['user_id'];
				$this->log($student_id,'hlog');$this->log($teacher_id,'hlog');
				$this->loadModel('BlockStudent');
				if ($this->BlockStudent->isBlock($student_id,$teacher_id)){
					//$this->Session->setFlash(__('You are blocked by author'));
					$this->redirect(array('controller' => 'Home','action' => 'index'));
				}
			}						
			
			//　授業のカテゴリを全部GET
			$tagsId = $this->LessonCategory->get_Lesson_categories($lesson['coma_id']);
			$tags= $this->Category->get_all_category_name($tagsId);
			$lesson['tags'] = $tags;
			//get relative lesson
			$this->loadModel('LessonCategory');
			$this->LessonCategory->bindModel(array(
				'belongsTo' => array(
						'Lesson' => array(
							'foreignKey' => 'coma_id'
						)
					)
				)
			);
			$relativeLesson = array();
			//foreach ($tags as $tag):					
				$relativeLesson = $this->LessonCategory->find('all',array(
					'contain' => array(						
						'Lesson' => array(
							'fields' => array('cover','name','coma_id'),
							'conditions' => array('is_block' => 0)
						)
					),
					'conditions' => array(						
						'category_id' => $tagsId,
						'LessonCategory.coma_id <>' => $id
					),
					'fields' => array('id'),
					'recursive' => 2
				));				
			//endforeach;							
			$this->set('lesson',$lesson);
			$this->set('user',$this->Auth->user());
			$this->set('author', $author);
			$this->set('file', $file);
			$this->set('relativeLesson',$relativeLesson);
			// $teacher = $this->Teacher->findByTeacherId($lesson['Lesson']['author']);			
		} else {
			$this->Session->setFlash(__('Forbidden error'));
		}	
	}

	function create(){
		$categories =  $this->Category->find('all');
		$this->set('categories',$categories);
		if($this->request->is('post')){
			$data = $this->request->data;						
			$error = array(); //error that return to client;
			// check if copyright check box had checked yet?
			if(empty($data['copyright'])){
				$error['copyright'] = __('Please confirm your copyright');               
			}
			
			// check if Lesson name is empty
			if(empty($data['name'])){
				$error['name'] = __('Lesson name do not suppose to be empty');
			}
			
			//check if Lesson Description is empty
			if(empty($data['desc']) || ctype_space($data['desc'])){				
				$error['desc'] = __('Lesson Description do not suppose to be empty');
			}				
			if(!empty($_FILES['cover-image']['name'])){
				//Check if image format is supported
				if(!preg_match('/\.(jpg|png|gif|tif|jpeg|png)$/',$_FILES['cover-image']['name'])){
					$error['image'] = __('Unsupported Image Format');
				} else if($_FILES['cover-image']['size'] > MAX_COVER_SIZE*UNIT_SIZE){
					$error['image'] = __('Image Size Too Big');
				}
			}

			if(!empty($_FILES['test']['name'][0])){
				//Check if image format is supported
				$len = count($_FILES['document']['name']);
				$this->log($_FILES['test'], 'hlog');
				for($i = 0, $len; $i < $len; $i++){
					if ($_FILES['test']['name'][$i]){
						if(!preg_match('/\.(csv|tsv)$/',$_FILES['test']['name'][$i])){
							$error['test'] = __('Unsupported Test File Format');
						} else if($_FILES['test']['size'][$i] > MAX_TEST_FILE_SIZE * UNIT_SIZE){
							$error['test'] = __('Test File Too Big');
						} else if($this->check_Document_File($_FILES['test']['tmp_name'][$i])){
								$error['test'] = __('Format not true');
						}
						//テストファイルの構造は正しいかどうかをチェックする。
						$fileReader = fopen($_FILES['test']['tmp_name'][$i],'r');				
						if($fileReader){
							while (($line = fgets($fileReader)) !== false) {

							}
						} else {
							$error['test'] = 'テストファイルの構造正しくない、テストファイルのテンプレートを使ってください。';
						}
					}
					}
				}
			// for($i = 0, $len = $);						
			if(!empty($_FILES['document']['name'][0])){
				//Check if image format is supported				
				$len = count($_FILES['document']['name']);
				for($i = 0, $len; $i < $len; $i++){
					if($_FILES['document']['name'][$i]){

						//check data, tam thoi lam don gian da
						$ext = pathinfo($_FILES['document']['name'][$i], PATHINFO_EXTENSION);
						$this->log($ext, 'hlog');
						$this->log( mime_content_type($_FILES['document']['tmp_name'][$i]), 'hlog');

						if( $ext == 'pdf'){
							if( mime_content_type($_FILES['document']['tmp_name'][$i]) !='application/pdf'){
								$error['document'] = __('Invalid file!');
							}
						}
						if( $ext == 'wav'){
							if( mime_content_type($_FILES['document']['tmp_name'][$i]) !='audio/x-wav'){
								$error['document'] = __('Invalid file!');
							}
						}
						if( $ext == 'mp4'){
							if( mime_content_type($_FILES['document']['tmp_name'][$i]) !='audio/mpeg' ){
								$error['document'] = __('Invalid file!');
							}
						} 
						if( $ext == 'mp3'){
							if( mime_content_type($_FILES['document']['tmp_name'][$i]) !='video/mp4'){
								$error['document'] = __('Invalid file!');
							}
						}


						if(!preg_match('/\.(pdf|mp3|mp4|jpg|png|gif|wav|tsv)$/',$_FILES['document']['name'][$i])){
							$error['document'] = __('Unsupported Document Format');
						} else if($_FILES['document']['size'][$i] > MAX_DOCUMENT_FILE_SIZE * UNIT_SIZE){
							$error['document'] = __('Document Size Too Big');
						}						
					}
				}
				
			}			
			if(count($error)){
				$this->log($error, 'hlog');
				$this->set('error',$error);
				// debug($error);
				$this->set('data',$data);				
			}else{
				// Save Lesson Information
				$this->Lesson->create();		
				$saveData = array(
					'Lesson'=> array(
						'name'=> $data['name'],
						'description'=> $data['desc'],
						'author' => $this->Auth->user('user_id'),
						'cover' => $_FILES['cover-image'],
						'title' => $data['title']
						)
					);				
				$lesson = $this->Lesson->save($saveData);				
				if ($lesson){
					$this->Session->setFlash(__('Create lesson successfully'));
				}
				// save Lesson Category
				if($lesson && !empty($data['category'])){										
					$this->LessonCategory->saveLessonCategory($lesson['Lesson']['coma_id'],$data['category']);										
				}
				
				// Save Lesson files

				//reformat array
				$document = array();
				if($_FILES['document']){
					foreach ($_FILES['document'] as $k1 => $v1) {
						foreach ($v1 as $k2 => $v2) {
							if( !empty($v2)){
								$document[$k2][$k1] = $v2;
							}
						}
					}
				}           				

				// save data   
				foreach ($document as $key => $value) {
					if(!(isset($value['error']) && $value['error']!=0 ) ){
						$value['coma_id'] = $lesson['Lesson']['coma_id'];						
						$this->Data->create($value);
						if (!$this->Data->save()){							
						}
					} 
				}

				//Test file upload

				// save data   
				$test = array();
				if($_FILES['test']){
					foreach ($_FILES['test'] as $k1 => $v1) {
						foreach ($v1 as $k2 => $v2) {
							if( !empty($v2)){
								$test[$k2][$k1] = $v2;
							}
						}
					}				 							
				foreach($test as $key=>$value){
					if(!(isset($value['error'])&&$value['error']!=0) ){											
						$value['coma_id'] = $lesson['Lesson']['coma_id'];
						$value['isTest'] = true;					
						$this->Data->create($value);
						$this->Data->save();    
					}					
				}
				$this->redirect(array('controller' => 'Teacher','action' => 'LessonManage'));
			}			
		}		
	}
}	
function Edit($id)
{
	$this->Lesson->recursive = 2 ;
	$lesson = $this->Lesson->findByComaId($id);
	if(!$lesson){
			//throw 404
		throw new NotFoundException();
	} 
	else {
		$categories =  $this->Category->find('all');
		$this->set('categories',$categories);
		$this->set('data',$lesson['Lesson']);
		$this->set('LessonCategory', $lesson['LessonCategory']);
		$this->set('lesson',$lesson);	

		$categories = $this->LessonCategory->get_Lesson_categories($id);
		$category_list = $this->Category->find('all');	

		$cur_cat = array();
		foreach ($lesson['LessonCategory'] as $key => $value) {
			array_push($cur_cat, $value['category_id']);
		}
		$lesson['category_list'] = $cur_cat;

		$this->set('lesson_data', $lesson);
		$this->set('categories', $categories);
		$this->set('category_list', $category_list);
	}
	if( $this->request->is('post')){
		$data = $this->request->data;		
			$error = array(); //error that return to client;
			// check if copyright check box had checked yet?
			if(empty($data['copyright'])){
				$error['copyright'] = __('Please confirm your copyright');               
			}
			
			// check if Lesson name is empty
			if(empty($data['name'])){
				$error['name'] = __('Lesson name do not suppose to be empty');
			}
			
			//check if Lesson Description is empty
			if(empty($data['desc']) || ctype_space($data['desc'])){				
				$error['desc'] = __('Lesson Description do not suppose to be empty');
			}				
			if(!empty($_FILES['cover-image']['name'])){
				//Check if image format is supported
				if(!preg_match('/\.(jpg|png|gif|tif|jpeg)$/',$_FILES['cover-image']['name'])){
					$error['image'] = __('Unsupported Image Format');
				} else if($_FILES['cover-image']['size'] > MAX_COVER_SIZE*UNIT_SIZE){
					$error['image'] = __('Image Size Too Big');
				}
			}

			if(!empty($_FILES['test']['name'][0])){
				//Check if image format is supported
				$len = count($_FILES['document']['name']);
				for($i = 0, $len; $i < $len; $i++){
					if ($_FILES['test']['name'][$i]){
						if(!preg_match('/\.(csv|tsv)$/',$_FILES['test']['name'][$i])){
							$error['test'] = __('Unsupported Test File Format');
						} else if($_FILES['test']['size'][$i] > MAX_TEST_FILE_SIZE * UNIT_SIZE){
							$error['test'] = __('Test File Too Big');
						}
					//テストファイルの構造は正しいかどうかをチェックする。
						$fileReader = fopen($_FILES['test']['tmp_name'][$i],'r');				
						if($fileReader){
							while (($line = fgets($fileReader)) !== false) {

							}
						} else {
							$error['test'] = 'テストファイルの構造正しくない、テストファイルのテンプレートを使ってください。';
						}
					}
				}

			}
			// for($i = 0, $len = $);			
			if(!empty($_FILES['document']['name'][0])){
				//Check if image format is supported
				$len = count($_FILES['document']['name']);
				for($i = 0, $len; $i < $len; $i++){
					if($_FILES['document']['name'][$i]){
						if(!preg_match('/\.(pdf|mp3|mp4|jpg|png|gif|wav|tsv)$/',$_FILES['document']['name'][$i])){							
							$error['document'] = __('Unsupported Document Format');
						} else if($_FILES['document']['size'][$i] > MAX_DOCUMENT_FILE_SIZE * UNIT_SIZE){
							$error['document'] = __('Document Size Too Big');
						}						
					}
				}
			}			
			if(count($error)){
				$this->set('error',$error);
				debug($error);
				$this->set('data',$data);				
			}
			else{
				// Update Lesson Information
				$this->Lesson->read(null, $data['coma_id']);
				$saveData = array(
					'Lesson'=> array(
						'coma_id' => $data['coma_id'],
						'name'=> $data['name'],
						'description'=> $data['desc'],
						'author' => $this->Auth->user('user_id'),
						'cover' => $_FILES['cover-image'],
						'title' => $data['title']
						)
					);				
				$lesson = $this->Lesson->save($saveData);				
				// save Lesson Category
				if($lesson && !empty($data['category'])){					
					$this->LessonCategory->saveLessonCategory($lesson['Lesson']['coma_id'],$data['category']);					
					$this->Session->setFlash(__('Update lesson successfully'));
				}
				// Save Lesson files

				//reformat array
				$document = array();
				$this->log($_FILES['document'], 'hlog');
				if($_FILES['document']){
					foreach ($_FILES['document'] as $k1 => $v1) {
						foreach ($v1 as $k2 => $v2) {
							if( !empty($v2)){
								$document[$k2][$k1] = $v2;
							}
						}
					}
				}           				

				// save data   
				foreach ($document as $key => $value) {
					if(!(isset($value['error']) && $value['error']!=0 ) ){
						$value['coma_id'] = $lesson['Lesson']['coma_id'];						
						$this->Data->create($value);
						if (!$this->Data->save()){

						}
					} 
				}

				//Test file upload

				$test = array();
				if($_FILES['test']){
					foreach ($_FILES['test'] as $k1 => $v1) {
						foreach ($v1 as $k2 => $v2) {
							if( !empty($v2)){
								$test[$k2][$k1] = $v2;
							}
						}
					}
				}           								
				foreach($test as $key=>$value){
					if(!(isset($value['error'])&&$value['error']!=0) ){											
						$value['coma_id'] = $lesson['Lesson']['coma_id'];
						$value['isTest'] = true;					
						$this->Data->create($value);
						$this->Data->save();    
					}					
				}

				//delete files
				$file_ids = explode(',',$data['delete-file']);
				$this->Data->deleteAll(array('file_id' => $file_ids));
				$this->redirect(array('controller' => 'Teacher','action' => 'LessonManage'));
			}
		}
	}

	function Destroy(){
		
	}	
	
	private function check_Document_File($src){
		$nFile = fopen($src, 'r');
		$check_format_file = 1;
		if ($nFile !== FALSE) {
		        $flag = 0;
		        $start_question = 0;//To flag start each a question
		        $start_answer = 0;//check head of question
		        $hasEnd = 0;//to set 0 when detect a new question
		        $line_count = 0;//to loop all line
		        $line_mean = 0;//line without comment
		        $question_number = 0;
		        while (!feof($nFile)) {
			        $nLineData = fgets($nFile);
			        $line_count++;
			        //if empty content file
			        //IF 1
		            //if($nLineData == "") {echo "Linh";echo $line_count;}
		            $CheckAfterEnd = 0;
			         //ELSE 1
			        
		              $string = preg_replace('/\s+/', '', $nLineData);
		          if(!empty($nLineData) && $string[0] !='#') {
		          $line_mean++;
		          if($line_mean > 2) {
		          
		          $nParsed = "";
			        $nParsed = explode("\t", $nLineData);
		
		
			        $checkempty=1;//init empty line
		            for($ii = 0;$ii < count($nParsed);$ii++){
		                
		              }
		              if(!ctype_space($nLineData)) $checkempty = 0;//not empty
		              
		            if(strpos($nLineData,'End') !== false) { echo "end";
		                $hasEnd = 1;
		                
		                for($ii = 1;$ii < count($nParsed);$ii++) {
		                    if(strcmp($nParsed[$ii],"") != 0)
		                    {
		                    //echo "no pass";
		                    //$check_format_file = 0; 
		                    
			                  //$CheckAfterEnd = 1;   
			                  
			                 // break;
			                  
			                  }
			                }
			                
		                        
		            }//end check line end
		            else {
		            if($hasEnd == 1) {
		            $stringEND = preg_replace('/\s+/', '', $nLineData);
		                if($checkempty != 1 && $stringEND[0]!='#')
		                {
		                    $check_format_file = 0; 
		                    //echo "<br> result:".$check_format_file;
		                  $CheckAfterEnd = 1;
		                  }
		
		            }//end check after END
		            //start check content
		            //
		                if($hasEnd == 0 && (strpos($nLineData,'End') == false)) {
		                if(count($nParsed) < 3 ) {
		                
		                if(!ctype_space($nLineData)) {
		                    
		                        $check_format_file = 0; 
		                        $CheckAfterEnd = 1;
		                    }
		                }else{
		                    
		                    if($checkempty == 1){
		                    
		                        $flag_empty = 0;
		                        if (!ctype_space($nLineData)) {
		                            $flag_empty = 1;
		                        }
		                        
		                        if($flag_empty == 1) {
		                            $check_format_file = 0; 
		                            $CheckAfterEnd = 1;
		                        } else{
		                            $question_number++;
		                            $start_question = 0;
		                        }
		                        }//End check line empty
		                        //start check question format:
		                    else {
		                        //check question head each line
		                        $flag_question = 0;
		                        
		                        if(strcmp($nParsed[0],"Q(".$question_number.")") !=0) {
		                            $flag_question=1;
		                            
		                            }
		                        //Choice:
		                        
		                        if($start_question == 0) {
                        
		                        //check for comment exist in question:
		                        for($uu = 3;$uu<count($nParsed);$uu++){
		                            $stringTemp = "";
		                            $stringTemp = preg_replace('/\s+/', '', $nParsed[$uu]);
		                            if($stringTemp[0]=='#'){
		                                break;
		                               }
		                            if($stringTemp != ''){
		                                if($stringTemp[0] != '#') {
		                                $flag_question = 1;
		                                break;
		                                }
		                            }
		                        }//end for
		                        $stringTemp = preg_replace('/\s+/', '', $nParsed[2]);
		                        if($stringTemp[0]=='#' || ctype_space($nParsed[2]))
		                            $flag_question = 1;
		                           if(strcmp ($nParsed[1],"QS")!=0)
		                            $flag_question = 1;  
		                            else {$start_question = 1;//return begin of question state  
		                            
		                            }
		                            }
		                            else {
		                            
		                            //check choice
		                                if($start_answer == 0) {//if not answer
		                                for($uu = 3;$uu<count($nParsed);$uu++){
		                                    $stringTemp = "";
		                                    $stringTemp = preg_replace('/\s+/', '', $nParsed[$uu]);
		                                    if($stringTemp[0]=='#'){
		                                        break;
		                                       }
		                                    if($stringTemp != ''){
		                                        if($stringTemp[0] != '#') {
		                                        $flag_question = 1;
		                                        break;
		                                        }
		                                    }
		                                }//end for
		                                $stringTemp = preg_replace('/\s+/', '', $nParsed[2]);
		                                if($stringTemp[0]=='#' || ctype_space($nParsed[2]))
		                                    $flag_question = 1;
		
		                                    $strToCompare = "S(".$start_question.")";
		                                    if(strcmp($nParsed[1],$strToCompare) !=0) 
		                                    $flag_question = 1;
		                                    else { $start_question++;
		                                        $start_answer = 1;}
		                                }
		                                else {
		                                    //may be answer
		                                    
		                                    if(strcmp($nParsed[1],"KS") !=0) {
		                                        if(strcmp($nParsed[1],"S(".$start_question.")") !=0)
		                                            $flag_question = 1;
		                                         else  {
		                                         for($uu = 3;$uu<count($nParsed);$uu++){
		                                                $stringTemp = "";
		                                                $stringTemp = preg_replace('/\s+/', '', $nParsed[$uu]);
		                                                if($stringTemp[0]=='#'){
		                                                    break;
		                                                   }
		                                                if($stringTemp != ''){
		                                                    if($stringTemp[0] != '#') {
		                                                    $flag_question = 1;
		                                                    break;
		                                                    }
		                                                }
		                                            }//end for
		                                            $stringTemp = preg_replace('/\s+/', '', $nParsed[2]);
		                                            if($stringTemp[0]=='#' || ctype_space($nParsed[2]))
		                                                $flag_question = 1;
		                                         
		                                         $start_question++;
		                                         }
		                                    }
		                                    else {
		                                    if(count($nParsed) > 4) {
		                                    for($uu = 4;$uu<count($nParsed);$uu++){
		                                            $stringTemp = "";
		                                            $stringTemp = preg_replace('/\s+/', '', $nParsed[$uu]);
		                                            if($stringTemp[0]=='#'){
		                                                break;
		                                               }
		                                            if($stringTemp != ''){
		                                                if($stringTemp[0] != '#') {
		                                                $flag_question = 1;
		                                                break;
		                                                }
		                                            }
		                                        }//end for
		                                     }
		                                        $stringTemp = preg_replace('/\s+/', '', $nParsed[2]);
		                                        if($stringTemp[0]=='#' || ctype_space($nParsed[2]))
		                                            $flag_question = 1;
		                                        $stringTemp = preg_replace('/\s+/', '', $nParsed[3]);
		                                        if($stringTemp[0]=='#' || ctype_space($nParsed[3]))
		                                            $flag_question = 1;
		                                            
		                                            $flag_aws = 0;
		                                            for($yy = 1;$yy<$start_question;$yy++) {
		                                                if(strcmp($nParsed[2],"S(".$yy.")") ==0)
		                                                $flag_aws = 1;
		                                            }
		                                            if($flag_aws == 0)
		                                                $flag_question = 1;
		                                        $start_answer = 0;
		                                    } 
		                                }
		                            }
		                            //process
		                        if($flag_question == 1) {
		                            $check_format_file = 0; 
		                            $CheckAfterEnd = 1;
		                        }
		                    }
		                }
		                
		            }
		            //
		            }
		            }//end check not comment
		             //ChECK after end
		             	            }
		             	            
		             	            if($CheckAfterEnd == 1) {
			                         break;}
		}
		//END WHILE
				        
				        if($line_mean < 3){
				        
		    	           $check_format_file = 0;  
			            }
		}
		fclose ( $nFile );
		if($check_format_file == 0) return false;
		return true;
		
	}
	
	public function viewContent($fid = null){					
		if (!$fid) die;
		$file = $this->Data->find('first', array(
			'conditions' => array('file_id' =>$fid)
			));

		//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
		//token process
		$token = md5(FILL_CHARACTER.date('y/m/d h:m:s').$fid);
		$this->set('token', $token);				
		$user = $this->Auth->user();
		if ($user['role'] == 'R1'){
			$user_id = $user['admin_id'];
		}else{
			$user_id = $user['user_id'];
		}
		$this->Session->write('Token.'.$fid.'.'.$user_id, $token);
		//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

		//check is block or not
		$lessonId = $file['Data']['coma_id'];
		$lesson = $this->Lesson->findByComaId($lessonId);		
		$this->loadModel('User');
		$authorId = $lesson['Lesson']['author'];
		if ($lesson['Lesson']['is_block'] == 1 || $file['Data']['is_block'] == 1){
			$this->Session->setFlash(__('The file is blocked'));
			//$this->redirect(array('controller' => 'Home','action' => 'index'));
			header("location:javascript://history.go(-1)");
		}
		// check teacher permission			
		$user = $this->Auth->user();
		if ($user['role'] == 'R1'){

		}
		else if ($user['role'] == 'R2'){
			//Teacher
			//check teacher is author			
			$result = $this->Lesson->find('first',array('conditions' => array('coma_id' => $lessonId,'author' => $user['user_id'])));
			if (!$result){
				$this->Session->setFlash(__("Forbidden error"));				
				$this->redirect($this->referer());
			}
		}		
		else if ($user['role'] == 'R3'){
			//check if user bought the lesson
			$result = $this->LessonTransaction->had_active_transaction($user['user_id'],$file['Data']['coma_id']);
			if (!$result){
				$this->Session->setFlash(__("Forbidden error"));				
				$this->redirect($this->referer());
			}

			//check if user is block by author
			$this->loadModel('BlockStudent');
			$result = $this->BlockStudent->isBlock($user['user_id'],$authorId);
			if ($result){
				//$this->Session->setFlash(__('You are blocked by author'));
				$this->redirect(array('controller' => 'Home','action' => 'index'));
			}
		}
		$this->set('user',$user);
		$this->set('file', $file);
		//play list
		$list = $this->Data->find('all', array(
			'conditions' => array(
				'coma_id' => $file['Data']['coma_id']
				),
			'order' => array('Data.isTest'),
			'recursive' => 0
			));
		$this->set('list', $list);
		//get comments
		$this->loadModel('Comment');
		$this->loadModel('User');
		$this->Comment->bindModel(array(
			'belongsTo' => array(
				'User' => array(
					'foreignKey' => 'user_id',
					)
				)
			));
		$comments = $this->Comment->find('all', array(
			'conditions' => array(
				'file_id' => $fid
				)
			));
		$this->set('comments',$comments);

		//Set Student List
		$this->LessonTransaction->bindModel(array(
			'belongsTo' =>array(
				'Lesson' => array(
					'foreignKey' => 'coma_id',					
					),
				'User' => array(
					'foreignKey' => 'student_id'
					)				
				)
			));

		$this->BlockStudent->bindModel(array(
			'belongsTo' => array(
				'User' => array(
					'foreignKey' => 'student_id'
					)
				) 
			));

		$stdBlockList = $this->BlockStudent->findAllByTeacherId($this->Auth->user('user_id'),array(),array('BlockStudent.created' => 'desc'),10);
		$stdList = $this->LessonTransaction->findAllByComaId($lessonId,array(),array('LessonTransaction.created' => 'asc'));
		if(!empty($stdList)){
			$lessonName = $stdList[0]['Lesson']['name'];
			foreach($stdList as $key=>$valueL){
				$j = 0;
				foreach ($stdBlockList as $key => $valueB) {
					if ($valueB['BlockStudent']['student_id'] === $valueL['User']['user_id']) {
						unset($stdList[$j]);
					}
					$j++;
				}
			}
		}else{
			$stdList = array();
			$lessonName = array();
		}
		$this->set('lessonName',$lessonName);
		$this->set('stdList',$stdList);
		// die(var_dump($stdList));

		//Set Rate List
		$this->RateLesson->bindModel(array(
			'belongsTo' => array(
				'Lesson' => array(
					'foreignKey' => 'coma_id'
					),
				'User' => array(
					'foreignKey' => 'student_id'
					)
				)
			));
		$rateList = $this->RateLesson->findAllByComaId($lessonId,array(),array('RateLesson.created' => 'desc'));
		$this->set('rateList',$rateList);
	}

	public function rate(){
		if($this->request->is('post')){
			$data = $this->request->data;			
			$this->RateLesson->rate_Lesson($data['coma_id'], $data['user_id'], $data['rate']);
		}
	}
	
	function HotLesson($pageIndex = 1, $page_limit = 4) {
		$user = $this->Auth->User();
		$role = $user['role'];

		if( empty($user)|| empty($role)){
			// R4, chua login
			$role = 'R4';
		}
		$this->layout = null;
		$this->loadModel('Lesson');
		$this->loadModel('User');
		$this->loadModel('RateLesson');
		$this->RateLesson->bindModel(array(
			'belongsTo' => array(
				'Lesson' => array(
					'className' => 'Lesson',
					'foreignKey' => 'coma_id'
					)
				),    		
			));
		$this->Lesson->bindModel(array(
			'belongsTo' => array(    		
				'Author' => array(
					'className' => 'User',
					'foreignKey' => 'author'
					)
				) 
			)
		);
		$options = array (
			'limit' => $page_limit, 
			'offset' => ($pageIndex-1) * $page_limit,
			'fields' => array('AVG(RateLesson.rate) as RateLesson','Lesson.*'),
			'order' => array('AVG(RateLesson.rate)' => 'DESC'),
			'group' => 'RateLesson.coma_id',
			'conditions' =>array('Lesson.is_block' => 0),
			'recursive' => 3
			);    
		//$this->Paginator->settings = $pagination;
		$data = $this->RateLesson->find ('all',$options);
		foreach($data as $key=>$value){			
			// check show buy button or not
			$isShowBuyButton = false;
			if ( ($role === 'R3') && !$this->LessonTransaction->had_active_transaction($user['user_id'],$value['Lesson']['coma_id'])){
				$isShowBuyButton = true;
			}				
			$data[$key]['Lesson']['is_show_buy_button'] = $isShowBuyButton;
			$data[$key]['RateLesson'] = $data[$key]['0']['RateLesson'];
			$data[$key]['Author'] = $data[$key]['Lesson']['Author'];		
			unset($data[$key]['Lesson']['Author']);
			unset($data[$key]['0']);
		}
		if(empty($data)){
			echo '0';
			die;
		}		
		$this->set('data', $data);
		// debug($data);
	}
	
	function NewLesson($pageIndex = 1, $page_limit = 4) {
		$user = $this->Auth->User();
		$role = $user['role'];

		if( empty($user)|| empty($role)){
			// R4, chua login
			$role = 'R4';
		}
		$this->layout = false;
		$this->loadModel('Lesson');
		$this->loadModel('User');
		$this->loadModel('RateLesson');    	
		$this->Lesson->bindModel(array(
			'belongsTo' => array(    		
				'Author' => array(
					'className' => 'User',
					'foreignKey' => 'author'
					)
				) ,
			'hasMany' => array(
				'RateLesson' => array(
					'foreignKey' => 'coma_id',    				
					)
				),
			));
		$options = array (
			'limit' => $page_limit,    			
			'offset' => ($pageIndex-1) * $page_limit,
			'order' => array('Lesson.created' => 'ASC'),				
			'recursive' => 2,
			'conditions' => array('Lesson.is_block' => 0)				
			);    	
		$data = $this->Lesson->find ( 'all',$options); 
			//debug($data);
		foreach($data as $key=>$lesson){
			$isShowBuyButton = false;
			if ( ($role === 'R3') && !$this->LessonTransaction->had_active_transaction($user['user_id'],$lesson['Lesson']['coma_id'])){
				$isShowBuyButton = true;
			}				
			$data[$key]['Lesson']['is_show_buy_button'] = $isShowBuyButton;			
			$rank = 0;$count = 0;
			foreach($lesson['RateLesson'] as $le){    			
				$rank =  $rank + $le['rate'];
				++$count;
			}
			if ($count != 0) {
				$rank = $rank / $count;
			}			    		
			$data[$key]['RateLesson'] = $rank;      						
				//unset($data[$key]['LessonTransaction']);
		}
		if(empty($data)){
			echo '0';
			die;
		}
		$this->set("data",$data);
		// debug($data);
	}
	function RecentLesson($pageIndex = 1, $page_limit = 4){
		$this->layout = false;
		$user = $this->Auth->User();
		$role = $user['role'];

		if( empty($user)|| empty($role)){
			// R4, chua login
			$role = 'R4';
		}

		$this->loadModel('Lesson');
		$this->loadModel('User');
		$this->loadModel('LessonTransaction');
		$this->loadModel('RateLesson');

		//guest 
		// Logic: nhung lesson moi duoc upload

		if( $role == 'R4'){					
			// $options = array (
			// 	'limit' => $page_limit,    			
			// 	'offset' => ($pageIndex-1) * $page_limit,
			// 	'order' => array('Lesson.created' => 'DESC'),				
			// 	'recursive' => 2,
			// 	'conditions' => array('Lesson.is_block' => 0)				
			// 	);    	
			// $data = $this->Lesson->find ( 'all',$options); 
			// //debug($data);
			// foreach($data as $key=>$lesson){			
			// 	$rank = 0;$count = 0;
			// 	foreach($lesson['RateLesson'] as $le){    			
			// 		$rank =  $rank + $le['rate'];
			// 		++$count;
			// 	}
			// 	if ($count != 0) {
			// 		$rank = $rank / $count;
			// 	}			    		
			// 	$data[$key]['RateLesson'] = $rank;      						
			// 	//unset($data[$key]['LessonTransaction']);
			// }
		}


		//teacher 
		// Logic: nhung lesson chua teacher moi duoc up
		else if( $role == 'R2'){
			$this->Lesson->bindModel(array(
				'hasMany' => array(
					'RateLesson' => array(
						'foreignKey' => 'coma_id',    				
						)
					)
				));
			$data = $this->Lesson->find('all', array(
				'conditions' => array(
					'author' => $user['user_id'],
					'is_block' =>  0
					),
				'order' => array(
					'created', 
					'modified'
					),
				'limit' => $page_limit,
				'offset' => ($pageIndex-1) * $page_limit,
				));
			foreach($data as $key=>$lesson){
				$isShowBuyButton = false;
				if ( ($role === 'R3') && !$this->LessonTransaction->had_active_transaction($user['user_id'],$lesson['Lesson']['coma_id'])){
					$isShowBuyButton = true;
				}				
				$data[$key]['Lesson']['is_show_buy_button'] = $isShowBuyButton;			
				$rank = 0;$count = 0;
				foreach($lesson['RateLesson'] as $le){    			
					$rank =  $rank + $le['rate'];
					++$count;
				}
				if ($count != 0) {
					$rank = $rank / $count;
				}			    		
				$data[$key]['RateLesson'] = $rank;      		
				$data[$key]['Author'] = $user;
				unset($data[$key]['Lesson']['RateLesson']);  		
				unset($data[$key]['LessonTransaction']);
			}
			// debug($data);
		}
		
		//student moi mua
		else if( $role == 'R3' ){			
			$list_coma_id = $this->LessonTransaction->find('list', array(
				'conditions' => array(
					'student_id' => $user['user_id']						
					),
				'fields' => array(
					'coma_id'
					),
				'order' => array(
					'created ASC', 
					),
				'limit' => $page_limit,
				'offset' => ($pageIndex-1) * $page_limit,
				));
			$data = $this->Lesson->find('all', array(
				'conditions' => array(
					'coma_id' => $list_coma_id,	
					'Lesson.is_block' => 0
					)
				));

			foreach($data as $key=>$lesson){
				$isShowBuyButton = false;
				if ( ($role === 'R3') && !$this->LessonTransaction->had_active_transaction($user['user_id'],$lesson['Lesson']['coma_id'])){
					$isShowBuyButton = true;
				}				
				$data[$key]['Lesson']['is_show_buy_button'] = $isShowBuyButton;			
				$rank = 0;$count = 0;
				foreach($lesson['RateLesson'] as $le){    			
					$rank =  $rank + $le['rate'];
					++$count;
				}
				if ($count != 0) {
					$rank = $rank / $count;
				}			    		
				$data[$key]['RateLesson'] = $rank;      		
				$data[$key]['Author'] = $user;				
			}
		}
		if(empty($data)){
			echo '0';
			die;
		}		
		$this->set("data",$data);
	}
	function Bestseller($pageIndex = 1, $page_limit = 4) {
		$this->layout = false;
		$user = $this->Auth->User();
		$role = $user['role'];

		if( empty($user)|| empty($role)){
			// R4, chua login
			$role = 'R4';
		}

  //   	// $data = $this->LessonTransaction->query("SELECT coma_id,COUNT(*) as count FROM 7maru_coma_transactions GROUP BY coma_id ORDER BY count ASC;");
		// $page_limit = 4;
		// $pagination = array (				
		// 	'fields' => array (
		// 		'LessonTransaction.coma_id','Count(*) as count'),
		// 	'order' => array('count' => 'DESC'),
		// 	'group' =>  'LessonTransaction.coma_id',
		// 	'limit' => $page_limit

		// 	);		
		// $data = array();
		$this->LessonTransaction->bindModel(array(
			'belongsTo' => array(
				'Lesson' => array(
					'foreignKey' => 'coma_id',		 			
					)
				)
			));
		$this->Lesson->bindModel(array(
			'belongsTo' => array(
				'Author' => array(
					'className' => 'User',
					'foreignKey' => 'author'
					)
				)
			));
		$options = array (
			'limit' => $page_limit, 
			'offset' => ($pageIndex-1) * $page_limit,			
			'group' => 'LessonTransaction.coma_id',
			'order' => 'COUNT(transaction_id) DESC',
			'conditions' =>array('Lesson.is_block' => 0),
			'recursive' => 3
			);
		$data = $this->LessonTransaction->find('all',$options);		
		foreach($data as $key=>$lesson){
			$isShowBuyButton = false;
			if ( ($role === 'R3') && !$this->LessonTransaction->had_active_transaction($user['user_id'],$lesson['Lesson']['coma_id'])){
				$isShowBuyButton = true;
			}				
			$data[$key]['Lesson']['is_show_buy_button'] = $isShowBuyButton;			
			$rank = 0;$count = 0;
			foreach($lesson['Lesson']['RateLesson'] as $le){    			
				$rank =  $rank + $le['rate'];
				++$count;
			}
			if ($count != 0) {
				$rank = $rank / $count;
			}			    		
			$data[$key]['RateLesson'] = $rank;
			$data[$key]['Author'] = $data[$key]['Lesson']['Author'];
			unset($data[$key]['Lesson']['RateLesson']);  		
			unset($data[$key]['LessonTransaction']);
		}			
		if(empty($data)){
			$data = 0;
		}
		$this->set(compact('data'));
    	// print_r($data);
		// debug($data);
	}

	function buy($coma_id = null){
		$result = 0;
		$this->layout = null;		
		if ($this->Auth->loggedIn()){			
			if ($this->Auth->user('user_type') == 2){				
				if ($coma_id != null){
					$this->loadModel('ComaTransaction');
					$data = array(
						'coma_id' => $coma_id,
						'student_id' => $this->Auth->user('user_id'),
						'money' => Configure::read('customizeConfig.money_per_lesson'),
						'rate' => Configure::read('customizeConfig.teacher_profit_percentage')
						);					
					$this->ComaTransaction->create($data);
					if ($this->ComaTransaction->save()){
						$result = 1;
					}																	
				}
			}
		}
		$this->set('result',$result);
	}
	/**
	 * @khaclinh
	 */
	function DoTest() {
		if (! $this->request->is ( "post" )) {

		} else {

			$values = $this->request->data['testfilegettest'];
			$values = str_replace(".js",".tsv",$values);
			$this->set('testfilegettest',$values);
			$finalTest = $this->Data->readTsv(TSV_DATA_DIR.DS.$values);
			$totques=count($this->request->data['hid']);
			$temp = 0;$mark = 0;
			$markGET = 0;
			$markTotal = 0;

			$flagChooseCheck = 0;
			$choosedNONE = "ignored";
			for($i = 0;$i<$totques;$i++){

				$markTotal += intval($finalTest['Question'.$i]['markNumber']);
				if(!isset($this->request->data['Question'.$i])) {
					$mark++;
					if($flagChooseCheck == 0)
						$choosed = array($i => $choosedNONE);
					else {
						$choosed += array($i => $choosedNONE);
						// $choosed = array_merge($choosed, array($i => $choosedNONE));

					}
					$flagChooseCheck = 1;
				}
				else {
					if($flagChooseCheck == 0)
						$choosed = array($i => $this->request->data['Question'.$i]);
					else {
						$choosed += array($i => $this->request->data['Question'.$i]);
						// $choosed = array_merge($choosed, array($i => $this->request->data['Question'.$i]));

					}
					$flagChooseCheck = 1;
					// echo 'Question '.$i.' answer:'.$this->request->data['Question'.$i];
					if(strcmp($this->request->data['Question'.$i],$finalTest['Question'.$i]['mark']) == 0){

						$markGET += intval($finalTest['Question'.$i]['markNumber']);
						$temp++;
					}
				}
			}
			
			
			$userType = $this->Auth->User('role');
			if($userType != "R1"){
				$aUser = $this->Auth->user();
				$values = str_replace(".tsv","",$values);
			$dataResult = array(
				'file_id' => $values,
				'score' => $markGET,
				'scorefull' => $markTotal,
				'choiced' => $mark,
				'total_ques' => $totques,
				'hit' => $temp,
				'result' => serialize($choosed),
				'user_id' => $aUser['user_id'],
				'test_time' => DboSource::expression('NOW()')
				);
			$this->TestResult->create($dataResult);
			$this->TestResult->save();
			$this->redirect(array(
				'controller' => 'Lesson',
				'action' => 'result?view='.$this->TestResult->getLastInsertID(),
				));
			}
			else{//if admin test,view result only
				$this->set('testfilegettest',$values);
				
				$this->set('hit',$temp);
				$this->set('total',$totques);
				$this->set('time',1);
				$this->set('mark',$mark);
				$this->set('markGET',$markGET);
				$this->set('markTotal',$markTotal);
				
				$this->set('finalTest',$finalTest);
				$this->set('choosedEnd',$choosed);
			}
		}

	}
	
	
	function Result(){
		$values = $this->params['url']['view'];
		echo "values:".$values;
		$result = $this->TestResult->find('first',array(
			'conditions' => array(
				'TestResult.result_id' => $values
				)
			));
		print_r($result);
		$this->set('testfilegettest',$result['TestResult']['file_id'].'.tsv');

		$finalTest = $this->Data->readTsv(TSV_DATA_DIR.DS.$result['TestResult']['file_id'].'.tsv');

		$this->set('hit',$result['TestResult']['hit']);
		$this->set('total',$result['TestResult']['total_ques']);
		$this->set('time',600);
		$this->set('mark',$result['TestResult']['choiced']);
		$this->set('markGET',$result['TestResult']['score']);
		$this->set('markTotal',$result['TestResult']['scorefull']);

		$this->set('finalTest',$finalTest);
		$choosed = unserialize($result['TestResult']['result']);
		$this->set('choosedEnd',$choosed);

	}
	

	function ViewTestResult() {
		$this->layout = null;
		$this->set('qid',$this->params['url']['qid']);
		$values = $this->params['url']['test_id'];
		$finalTest = $this->Data->readTsv(TSV_DATA_DIR.DS.$values);
		$this->set('finalTest',$finalTest);
		$this->set('choosedEnd',$this->params['url']['aParam']);
		$this->set('total',count($finalTest));
		/*$this->set('hit',$this->request->params['named']['hit']);
			$this->set('total',$this->request->params['named']['total']);
		$this->set('time',$this->request->params['named']['time']);
		$this->set('mark',$this->request->params['named']['mark']);
		$values = $this->request->data['testcompareneed'];
		print_r($values);*/
	}
	
	function Exam(){
		// 		$this->set('testfile',$id);
		// 		$this->set('testfile',$this->request->params['pass']['0']);
		//print_r($this->params['url']);
		$id = $this->params['url']['id'];
		if ($id == null){
			return;
		}
		$dulieu = $this->Data->find('first', array(
			'conditions' => array(
				'Data.file_id' => $id
				)
			));

		$str = "";
		if(count($dulieu) != 0){
			//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
			//token process

			$token = md5(FILL_CHARACTER.date('y/m/d h:m:s').$id);
			$this->set('token', $token);
			$user = $this->Auth->user();
			if ($user['role'] == 'R1'){
				$user_id = $user['admin_id'];
			}
			else{
				$user_id = $user['user_id'];
			}
			$this->Session->write('Token.'.$id.'.'.$user_id, $token);
			//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
			$this->set('testID',$id);
			$this->set('testfile',$dulieu['Data']['path']);
			$tsvPath = str_replace(".js",".tsv",$dulieu['Data']['path']);
			$finalTest = $this->Data->readTsv(TSV_DATA_DIR.DS.$tsvPath);
			if(isset($finalTest)) {
				$this->set("ques_no",count($finalTest));
			}
		} else {
			$str = "Error test data!!!";
		}
		$this->set("warningNotify",$str);
	}
	
	/**
	 * Get test history link
	 * 
	 */
	function testHistory($file_id){
		$userType = $this->Auth->User('role');
		$users = $this->Auth->user();
		if($userType == 'R2' || $userType == 'R1') $conditions = array('TestResult.file_id' => $file_id);
		if($userType == 'R3') $conditions = array('TestResult.file_id' => $file_id,
													'TestResult.user_id' => $users['user_id']
													);
		print_r($conditions);
		$testList = $this->TestResult->find('all',array(
			'conditions' => $conditions
		));
		
		if(isset($testList)){
			$i = 0;
			foreach($testList as $fKey => $fValue) {
				$userFind = $this->User->find('first',array(
					'conditions' => array(
						'User.user_id' =>	$fValue['TestResult']['user_id']
					)
				)
				
				);	
				if(isset($userFind)){
					if($i == 0)
						$dataList = array($i => array(
							'user_test' => $userFind['User']['username'],
							'result_id' => $fValue['TestResult']['result_id'],
							'test_time' => $fValue['TestResult']['test_time']
					));
						else 
							$dataList += array($i=>array(
									'user_test' => $userFind['User']['username'],
									'result_id' => $fValue['TestResult']['result_id'],
									'test_time' => $fValue['TestResult']['test_time']
							));
						$i++;
				}
			}
			//end for
			if(isset($dataList))
				$this->set('dataList',$dataList);
			else 
				$this->Session->setFlash(__('誰がテストを受けるのはいない'));
		}
	}
}

?>
