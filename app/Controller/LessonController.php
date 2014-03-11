<?php
define('FILE_DIR', WEBROOT_DIR.DS.'files'.DS.'data');
class LessonController extends AppController {

    var $components =  array('Session','Paginator');
    var $uses = array('Category','Lesson','LessonCategory','Data','Teacher','RateLesson','LessonTransaction');
    /**
    * 授業の総体情報を表示する。ユーザーはこのページを見るから、授業を買うかどうかを決定できる。
    *　$id: 授業のID
    */
	function Index($id){
		App::uses('Utilities', 'Lib');
		$util = new Utilities();
		$this->set('util',$util);
		
		//授業の見られる数を1回を増加する。
		
		$this->Lesson->increaseView($id);

		// データベースから、授業の情報を取得
		$lesson = $this->Lesson->findByComaId ($id);
		debug($lesson);
		$lesson = $lesson['Lesson'];
		
		// 授業のイメージリンクを準備する。
		$lesson['image'] = '/'.FILL_CHARACTER.'/img/data/cover';
		if($lesson['cover']){
			$subfix = preg_split('/\./', $lesson['cover']);
			$subfix = $subfix[count($subfix)-1];
		} else {
			$subfix = '';
		}
		$lesson['image'] .= '/'.$lesson['coma_id'].'.'.$subfix;
		
		//授業の評価された数を準備する。
		$lesson['ranker'] = $this->RateLesson->get_rate_num($lesson['coma_id']);
		
		//平均評価を数いる。
		$lesson['stars'] = $this->RateLesson->get_mean_rate($lesson['coma_id']);
		
		//授業の見られる数を準備する。
		
		// ユーザーはこの授業を買ったかどうかをチェックして、クライアントへ送信する。
		$user = $this->Auth->user();
		// debug($user);
		if($user && $this->LessonTransaction->had_active_transaction($user['user_id'],$lesson['coma_id'])){
			$lesson['buy_status'] = 1;
		} else {
			$lesson['buy_status'] = 0;
		}
		
		//　授業のカテゴリを全部GET
		
		$tags = $this->LessonCategory->get_Lesson_categories($lesson['coma_id']);
		$tags = $this->Category->get_all_category_name($tags);
		$lesson['tags'] = $tags;
		

		$this->set('lesson',$lesson);

		// $teacher = $this->Teacher->findByTeacherId($lesson['Lesson']['author']);
		// debug($teacher);
	}

	function Create(){
		$categories =  $this->Category->find('all');
		$this->set('categories',$categories);
		if($this->request->is('post')){
			$data = $this->request->data;
			// debug($data);
			// debug($_FILES);
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
			if($_FILES['cover-image']['name']){
				//Check if image format is supported
				if(!preg_match('/\.(jpg|png|gif|tif|jpeg)$/',$_FILES['cover-image']['name'])){
					$error['image'] = 'Unsupported Image Format';
				} else if($_FILES['cover-image']['size'] > 2097152){
					$error['image'] = 'Image Size Too Big';
				}
			}
			if($_FILES['test']['name']){
				//Check if image format is supported
				if(!preg_match('/\.(csv|tsv)$/',$_FILES['test']['name'])){
					$error['test'] = 'Unsupported Test File Format';
				} else if($_FILES['test']['size'] > 5242880){
					$error['test'] = 'Test File Too Big';
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
				$this->Lesson->create();
				$saveData = array(
					'Lesson'=> array(
						'name'=> $data['name'],
						'description'=> $data['desc'],
						'author' => $this->Auth->user('user_id'),
						'cover' => $_FILES['cover-image']
						)
					);
				$lesson = $this->Lesson->save($saveData);
				// save Lesson Category
				if($lesson && isset($data['category'])){
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
					# code... 
					if(!(isset($value['error'])&&$value['error']!=0) ){
						$value['coma_id'] = $lesson['Lesson']['coma_id'];
						$this->Data->create(array('File' => $value));
						$this->Data->save();    
					} 
				}

				//Test file upload

				// save data   
					$testFile = $_FILES['test'];
					if(!(isset($testFile['error'])&&$testFile['error']!=0) ){
						$testFile['coma_id'] = $lesson['Lesson']['coma_id'];
						$testFile['isTest'] = true;
						$this->Data->create(array('File' => $testFile));
						$this->Data->save();    
					}
				}
			}
		}
	
	function Edit(){

	}

	function Destroy(){
		
	}
	function View($id){
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
					'foreignKey' => 'coma_id',
					'order' => array('File.type'),
					)
				),
			));
		$this->Lesson->User->bindModel(array(
			'belongsTo' => array(
				'Teacher' => array(
					'foreignKey' => 'foreign_id'
					)
				)
			));
		$this->Lesson->recursive = 2 ;
		$lesson = $this->Lesson->findByComaId($id);
		if( !empty($lesson)){
		//ok
		//@todo : check user has permission to view
			debug($lesson);
			$this->set('data', $lesson);

		}else{
		//invalid id
		}
	}
	
	function Comment(){
	}

	private function check_Document_File(){
	}

	public function viewContent($fid){
		$files = $this->Data->find('first', array(
			'conditions' => array('file_id' =>$fid)
			));
		debug($files);
    }
    
    function HotLesson($pageIndex) {
    	$page_limit = 4;
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
    			'fields' => array('AVG(RateLesson.rate) as RateLesson	 ','Lesson.*'),
    			'order' => array('AVG(RateLesson.rate)' => 'DESC'),
    			'group' => 'RateLesson.coma_id',
    			'recursive' => 3
    	   	);    
    	//$this->Paginator->settings = $pagination;
    	$data = $this->RateLesson->find ('all',$options);
    	foreach($data as $key=>$value){
    		$data[$key]['RateLesson'] = $data[$key]['0']['RateLesson'];
    		$data[$key]['Author'] = $data[$key]['Lesson']['Author'];
    		unset($data[$key]['Lesson']['Author']);
    		unset($data[$key]['0']);
    	}
    	debug($data);
    }
    
    function NewLesson($pageIndex) {
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
    	$page_limit = 3;
    	$options = array (
    			'limit' => $page_limit,    			
    			'offset' => ($pageIndex-1) * $page_limit,
    			'order' => array('Lesson.created' => 'DESC'),    			
    			'group' => 'Lesson.coma_id'    			
    	);
		    	
    	$data = $this->Lesson->find ( 'all',$options);
    	foreach($data as $key=>$lesson){
    		$rank = 0;$count = 0;
    		foreach($lesson['RateLesson'] as $le){    			
    			$rank =  $rank + $le['rate'];
    			++$count;
    		}
			if ($count != 0) {
					$rank = $rank / $count;
			}			    		
    		$data[$key]['RateLesson'] = $rank;    		
    	}    	
    	debug($data);
    }
    
    function RecentLesson() {
    	$this->loadModel('Lesson');
    	$this->loadModel('User');
    	$this->loadModel('LessonTransaction');
    	$this->loadModel('RateLesson');
    	$this->LessonTransaction->bindModel(array(
    		'belongsTo' => array(    		
    			'Lesson' => array(
    				'className' => 'Lesson',
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
    		),
    		'hasMany' => array(
    			'RateLesson' => array(
    				'foreignKey' => 'coma_id',    				
    			)
    		)
    	));
    	$page_limit = 4;
    	$options = array (
    			'limit' => $page_limit,    			
    			'order' => array('LessonTransaction.created' => 'DESC'),
    			'group' =>  'LessonTransaction.transaction_id',
    			'recursive' => 2
    	
    	);    	
    	$data = $this->LessonTransaction->find ( 'all',$options); 
    	foreach($data as $key=>$lesson){
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
    		unset($data[$key]['Lesson']['Author']);
    		unset($data[$key]['LessonTransaction']);
    	}    	   	
    	debug($data);
    }
    
    function Bestseller() {
//     	$data = $this->LessonTransaction->query("SELECT coma_id,COUNT(*) as count FROM 7maru_coma_transactions GROUP BY coma_id ORDER BY count ASC;");
    	$page_limit = 4;
		$pagination = array (				
				'fields' => array (
						'LessonTransaction.coma_id','Count(*) as count'),
				'order' => array('count' => 'DESC'),
				'group' =>  'LessonTransaction.coma_id',
				'limit' => $page_limit
				
		);
    	
//     	print_r($data);
		debug($data);
    }

}
