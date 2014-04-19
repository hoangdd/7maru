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
		'LessonTransaction'
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
					if ($_FILES['document']['name'][$i]) {
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
						if(!preg_match('/\.(pdf|mp3|mp4)$/',$_FILES['document']['name'][$i])){							
							$error['document'] = 'Unsupported Document Format';
						} else if($_FILES['document']['size'][$i] > MAX_DOCUMENT_FILE_SIZE * UNIT_SIZE){
							$error['document'] = __('Document Size Too Big');
						}						
					}
				}
				
			}			
			if(count($error)){
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
				}           				
				$this->log($test,'hlog');
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
	
	function Edit($id)
	{
		$this->Lesson->recursive = 2 ;
		$lesson = $this->Lesson->findByComaId($id);
		if(!$lesson){
			//throw 404
			throw new NotFoundException();
		} else {
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

			if(!empty($_FILES['test']['name'])){
				//Check if image format is supported
				if(!preg_match('/\.(csv|tsv)$/',$_FILES['test']['name'])){
					$error['test'] = __('Unsupported Test File Format');
				} else if($_FILES['test']['size'] > MAX_TEST_FILE_SIZE * UNIT_SIZE){
					$error['test'] = __('Test File Too Big');
				}

				//テストファイルの構造は正しいかどうかをチェックする。
				$fileReader = fopen($_FILES['test']['tmp_name'],'r');
				if($fileReader){
					while (($line = fgets($fileReader)) !== false) {

					}
				} else {
					$error['test'] = 'テストファイルの構造正しくない、テストファイルのテンプレートを使ってください。';
				}
			}
			// for($i = 0, $len = $);			
			if(!empty($_FILES['document']['name'][0])){
				//Check if image format is supported
				$len = count($_FILES['document']['name']);
				for($i = 0, $len; $i < $len; $i++){
					if($_FILES['document']['name'][$i]){
						if(!preg_match('/\.(pdf|mp3|mp4)$/',$_FILES['document']['name'][$i])){							
							$error['document'] = 'Unsupported Document Format';
						} else if($_FILES['document']['size'][$i] > MAX_DOCUMENT_FILE_SIZE * UNIT_SIZE){
							$error['document'] = __('Document Size Too Big');
						}						
					}
				}
			}			
			if(count($error)){
				$this->set('error',$error);
				// debug($error);
				$this->set('data',$data);				
			}else{
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
					$this->Session->setFlash(__('Create lesson successfully'));
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
				$testFile = $_FILES['test'];
				if(!(isset($testFile['error'])&&$testFile['error']!=0) ){
					$testFile['coma_id'] = $lesson['Lesson']['coma_id'];
					$testFile['isTest'] = true;					
					$this->Data->create(array('Data' => $testFile));
					$this->Data->save();    
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
	function View($id){
		//=======================================
		//check permisson
		//check student 
		$user = $this->Auth->user();
		if ($user['user_type'] == 2){			
			if (!$this->LessonTransaction->had_active_transaction($user['user_id'],$id)){
				$this->Session->setFlash(__('Forbidden error'));
				return;
			}
		}
		//check teacher
		else{
			$conditions = array(
					'coma_id' => $id,
					'author' => $user['user_id']
				);
			$result = $this->Lesson->find('first',array('conditions' => $conditions));
			if (!$result){
				$this->Session->setFlash(__('Forbidden error'));
				return;
			}
		}
		//=======================================
		$this->Lesson->bindModel(array(
			'belongsTo' =>array(
				'User' => array(
					'foreignKey' => 'author',
					)
				),
			'hasMany' => array(
				'RateLesson' => array(
					'foreignKey' => 'coma_id',					
					),
				'File' => array(
					'className' => 'Data',
					'foreignKey' => 'coma_id'
					)				
				),
			));
		$this->Lesson->recursive = 2 ;
		$lesson = $this->Lesson->findByComaId($id);
		if( !empty($lesson)){
		//ok
		//@todo : check user has permission to view
			// debug($lesson);
			$this->set('data', $lesson);

		}else{
		//invalid id
		}
	}
	
	private function check_Document_File(){
	}

	public function viewContent($fid = null){					
		if (!$fid) die;
		$file = $this->Data->find('first', array(
			'conditions' => array('file_id' =>$fid)
			));
		//check is block or not

	$lessonId = $file['Data']['coma_id'];
		$lesson = $this->Lesson->findByComaId($lessonId);		
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
		}
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
}

?>
