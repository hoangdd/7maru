<?php
class StudentController extends AppController {

	public $testList;
	public $uses = array (
			'User',
			'Student',
			'Data' ,
			'TestResult',
			'LessonTransaction'
			
	);

	public function beforeFilter() {
		parent::beforeFilter ();

		$this->Auth->userModel = 'Student';
		$this->Auth->allow('register','login');
// 		$this->Auth->allow ( 'dotest', 'viewtestresult','exam' );

// 		$this->Auth->allow();//Allow all
	}
	
	function index(){

	}

	function Register() {
		$error = array ();
		// $user_re_ex='/^[A-Za-z]+\_[A-Za-z]+[0-9]$/';
		$user_re_ex = '/^[A-Za-z]\w+$/';
		// $pass_re_ex='/^.*(?=.{7,})(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9]).*$/';
		$pass_re_ex = '/^\w+$/';
		$email_re_ex = '[a-z0-9\\._]*[a-z0-9_]@[a-z0-9][a-z0-9\\-\\.]*[a-z0-9]\\.[a-z]{2,6}$';
		//データがある場合
		if ($this->request->is('post')) {
			$data = $this->request->data;
			 /*
			   ユーザ名前をチェック:
				0:  null
				1:  empty
				2:  not match form
				3:  too short
				4:  too long
				5:  was used
			*/
			$check_user = true;
			
			if (!isset($data ['username'])) {
				$error['username'][0] = __('Username is equal null.');
				$check_user = false;
			}
			
			if (empty($data['username'])){
				$error['username'][1] = __('Username is empty.');
				$check_user = false;
			} else {
				if (!preg_match($user_re_ex,$data['username'])){
					$error['username'][2] = __('Username is not match form.');
					$check_user = false;
				}
				
				if (strlen($data['username'])< 2){
					$error['username'][3] = __('Username is too short.');
					$check_user = false;
				}
				
				if (strlen($data['username'])> 30){
					$error['username'][4] = __('Username is too long.');
					$check_user = false;
				}
				
				$res = $this->User->find ('all', array(
						'conditions' => array (
								'User.username' => $data ['username'] 
						) 
				) );
				if (empty($res)){
					// chua ton tai
					// $error['username'] ='Username chua ton tai!';
				} else {
					$error ['username'] [5] = __('Username is exist.');
					$check_user = false;
				}
			}
			 //=================================
			
			/*
			   パースワードをチェック:
				0:  null
				1:  empty
				2:  not match form
				3:  too short
				4:  too long
			*/
			if (!isset($data['password'])){
				$error['password'][0] = __('Password is equal null.');
				$check_user = false;
			}
			
			if (empty($data['password'])) {
				$error['password'][1] = __('Password is empty.');
				$check_user = false;
			} else {
				if (!preg_match($pass_re_ex,$data['password'])) {
					$error['password'][2] = __('Password is not match form.');
					$check_user = false;
				}
				
				if (strlen($data['password']) < 6) {
					$error['password'][3] = __('Password is too short.');
					$check_user = false;
				}
				
				if (strlen($data['password']) > 30) {
					$error['password'][4] = __('Password is too long.');
					$check_user = false;
				}
			}
			
			/*
				もう一度パースワードを確認する:
				0:  null
				1:  empty
				2:  not match with password
			*/
			if (!isset($data['retypepassword'])){
				$error['retypepassword'][0] = __('Password is equal null.');
				$check_user = false;
			}
			
			if (empty($data ['retypepassword'] )) {
				$error ['retypepassword'][1] = __('Password is empty.');
				$check_user = false;
			} else {
				if (strcmp($data['retypepassword'],$data['password'] )!= 0) {
					$error['retypepassword'][2] = __('Password and RetypePassword are not equal.');
					$check_user = false;
				}
			}
			
			 /*
				FirstName と LastNameをチェック：
				0:  null
				1:  empty
				2:  too long
			*/
			if (! isset ( $data ['firstname'] )) {
				$error ['firstname'] [0] = __('First name is equal null.');
				$check_user = false;
			}
			
			if (empty ( $data ['firstname'] )) {
				$error ['firstname'] [1] = __('First name is empty.');
				$check_user = false;
			} else {
				
				if (strlen ( $data ['firstname'] ) > 30) {
					$error ['firstname'] [2] = __('First name is too long.');
					$check_user = false;
				}
			}
			// ==================================
			if (! isset ( $data ['lastname'] )) {
				$error ['lastname'] [0] = __('Last name is equal null.');
				$check_user = false;
			}
			
			if (empty ( $data ['lastname'] )) {
				$error ['lastname'] [1] = __('Last name is empty.');
				$check_user = false;
			} else {
				
				if (strlen ( $data ['lastname'] ) > 30) {
					$error ['lastname'] [2] = __('Last name is too long.');
					$check_user = false;
				}
			}
			
			 //verifycode_answerをチェック：
			if(!isset($data['verifycode_answer'])){
				$error['verifycode_answer'][0] =__('Answer of verifycode is equal null.');
				$check_user = false;
			}
			
			if(empty($data['verifycode_answer'])){
				$error['lastname'][1] ='Answer of verifycode is empty.';
				$check_user = false;
			}	
			else{
				if(strlen($data['verifycode_answer']) > 50){
					$error['verifycode_answer'][2] ='Answer of verifycode is too long.';
					$check_user = false;
				}
			}
			
			 //Eメールをチェック
		   if(!isset($data['mail'])){
				$error['mail'][0] ='Email is equal null.';
				$check_user = false;
			}
			if(empty($data['mail'])){
				$error['mail'][1] ='Email is empty.';
				$check_user = false;
			}else{
				$res = $this->User->find('all',array(
					'conditions'=>array(
						'User.mail' => $data['mail']
					)));
				if(empty($res)){
					//存在しない
				}else{
					$error['mail'][2] ='Email was exist.';
					$check_user = false;
				}
			}
			// =================================
			
			$check_student = true;
			// check credit_account
			if (! isset ( $data ['credit_account'] )) {
				$error ['credit_account'] [0] = __('Credit account is equal null.');
				$check_student = false;
			}
			if (empty ( $data ['credit_account'] )) {
				$error ['credit_account'] [1] = __('Credit account is empty.');
				$check_student = false;
			}
			else{
				if(strlen($data['credit_account'])>28){
					$error ['credit_account'] [2] = __('Credit account is too long.');
					$check_student = false;
				}
				$credit_card_re_ex = '/^\w{8}-\w{4}-\w{4}-\w{4}-\w{4}$/';
				if (!preg_match($credit_card_re_ex,$data['credit_account'])) {
					$error['credit_account'][3] = __('Creadit card is not match form.');
					$check_student = false;
				}
			}
			// =================================
			
			//携帯電話の番号をチェック：
			if (! empty ( $data ['phone_number'] )) {
				if (strlen ( $data ['phone_number'] ) < 10) {
					$error ['phone_number'] [0] = 'Phone number is too short.';
				}
				
				if (strlen ( $data ['phone_number'] ) > 15) {
					$error ['phone_number'] [1] = 'Phone number is too long.';
				}
			}
			 //自己のイメージをチェック：				
			if ($_FILES['profile_picture']['error'] == 0) {
				$config = Configure::read('srcFile');
				$img_exts = $config['image']['extension'];
				$profile_pic = $_FILES['profile_picture'];
				$ext = pathinfo($profile_pic['name'], PATHINFO_EXTENSION);
				if( !in_array($ext, $img_exts) ){
				  $error['profile_picture'][0] ='Unsupported image file';  
				}				
			}
			else{
				$profile_pic = '';
			}
			if (!empty($data['date_of_birth'])){
                $data['date_of_birth'] =  date_create($data['date_of_birth']);        
                $data['date_of_birth'] = date_format($data['date_of_birth'],'Y-m-d');        
            }
			//====================================

			//学生のデーだをセーブ
			/*
			 * Credit_acount, level
			 */
			if ($check_student == true && $check_user == true) {
				$data_student = array (
					'username'      =>  $data['username'],
					'credit_account' => $data ['credit_account'],
					'level'          => $data ['level'] 
				);
				$this->Student->create ( $data_student );
				//セーブしたり、結果を出した
				$result = $this->Student->save ();				
			
			 //ユーザのデータをセーブする
				/*
				*   username,firstname,lastname,date_of_birth,address,password,
				*   user_type,mail,phone_number,profile_picture
				*/ 
				if($result){                   
					$data['foreign_id'] = $result['Student']['student_id'];
					$data['user_type'] = 2;
					$data['profile_picture'] = $profile_pic;					
					$data['comment'] = 0;
					$data['activated'] = 1;
					$data['approved'] = 0;
					$this->User->create($data);
					if ( !$this->User->save()){
                        $this->Student->delete($result['Student']['student_id']);
                        $this->Session->setFlash(__('Register failure'));                        
                    }
                    else{
                        $this->Session->setFlash(__('Register successful, waiting for approving by admin'));   
                        $this->redirect(array('controller' => 'Login','action' => 'index'));
                    }
				 }
			  }
		}
		
		$this->set('error', $error);
	}

	function Profile($id = null){
		//$sql="SELECT *FROM 7maru_users WHERE user_id=".$pid;
			// $data=$this->User->query($sql);
						
		if($this->Auth->loggedIn()){			
			if ($id!= null){
                $pid = $id;        
            }
            else if ($this->Auth->user('role') !== 'R1' ){            	
                $pid=$this->Auth->User('user_id');                            
            }
            else{
            	die;
            }
           $user = $this->Auth->User();
           $isOther = true;
            if (isset($user['user_id']) && $pid == $user['user_id']){
                $isOther = false;
            }            
            $data = $this->User->find('first', array(
                    'conditions' => array(
                    'User.user_id' => $pid,
                    'user_type' => '2'
                    /*@hoangdd */
                )
            ));
			if ( empty($data)){
				$this->Session->setFlash(__('Forbidden error'));
				echo '403 Forbidden error.';
                die;
			}			
		$this->set("data",$data);
		$this->set('isOther',$isOther);
		if($data['User']['user_type']==2){
			$a=$data['User']['foreign_id'];
			$data1=$this->Student->find('first',array(
				'conditions' => array(
					'Student.student_id' => $a,
					)
				));
			$this->set("data1",$data1);
			$this->loadModel("ComaTransaction");
			$data2=$this->ComaTransaction->find('all',array(
				'conditions' => array(
					'ComaTransaction.student_id' => $a,
					)
				));
			$this->loadModel("Coma");
			$arr = array();
			for($i=0;$i<count($data2);$i++){
				$temp=$data2[$i]['ComaTransaction']['coma_id'];
				$arr[]=$data3=$this->Coma->find('first',array(
					'conditions' => array(
						'Coma.coma_id' => $temp,
						)
					));
			}
			$this->set("arr",$arr);
		  }
		}
		
	}

	function EditProfile($id = null) {	
		// if($id != null){
		// 	$this->redirect(array('controller' => 'Student', 'action' => 'EditProfile'));
		// 	die();
		// }
		if ($this->Auth->loggedIn()) {						
			if ($this->Auth->user('role') === "R1"){
				if ($id != null){					
					$pid = $id;
				}
				else{
					$this->Session->setFlash(__('Forbidden error'));
					die;
				}
			}
			else{
				$pid = $this->Auth->User('user_id');
			} 
			$userData = $this->User->find('first',
				array(
					'conditions' => array(
						'User.user_id' => $pid
						)
					)
				);  				
			if ($this->request->is('post')) {               
				$fields = array('mail','firstname','lastname','phone_number','address','date_of_birth');
				if ($_FILES['profile_picture']['error'] == 0){
                    $this->request->data['profile_picture'] = $_FILES['profile_picture'];
                    array_push($fields,'profile_picture');
                } 
				$this->request->data['profile_picture'] = $_FILES['profile_picture'];
				$data = $this->User->create($this->request->data);
				$data['User']['user_id'] = $pid;
				$studentData = $data['User']['credit_account'];
				unset($data['credit_account']);
				$result = $this->User->save($data,true,$fields);				
				if ($result){
					$studentData = array(
						'Student' => array(
							'credit_account' => $studentData,
							'student_id' => $userData['User']['foreign_id'],
							'username' => $userData['User']['username']
						)
					);
					if ($this->Student->save($studentData)){
						$this->Session->setFlash(__('Edit successful'));
						$this->redirect(array('controller' => 'Student', 'action' => 'profile',$id));
					}
				   // $this->redirect(array('controller' => 'Teacher', 'action' => 'profile'));
				}
			}   
		}				
			//get data                 
			$studentData = $this->Student->find('first',
				array(
					'conditions' => array(
						'Student.student_id' => $userData['User']['foreign_id']
						)
					)
			);            			              
			$this->set('studentData',$studentData['Student']);
			$this->set('userData',$userData['User']);                            
	}

	function Destroy() {
	}

	function Statistic() {
		$user = $this->Auth->User();
		if($user && $user['user_id']){
			$bought_courses = $this->LessonTransaction->findAllByStudentId($user['user_id']);
			$this->loadModel('Lesson');
			$this->Lesson->bindModel(array(			
			'hasMany' => array(				
				'File' => array(
					'className' => 'Data',
					'foreignKey' => 'coma_id' 
					)				
				),
			));
			// $bought_courses['spentMoney'] = 0;
			$spentMoney = 0;
			foreach ($bought_courses as $index => $course) {
				$spentMoney += $course['LessonTransaction']['money'];
				
				if($this->LessonTransaction->had_active_transaction($user['user_id'], $course['LessonTransaction']['coma_id'])){
					$bought_courses[$index]['learn_able'] = true;
				} else {
					$bought_courses[$index]['learn_able'] = false;
				}

				$lesson = $this->Lesson->findByComaId($course['LessonTransaction']['coma_id']);
				//die(var_dump($lesson));
				$bought_courses[$index]['lesson'] = $lesson;
			}

			$this->loadModel('ReportLesson');
			$reported_lesson = $this->ReportLesson->findAllByUserId($user['user_id']);
			foreach ($reported_lesson as $index => $course) {
				$lesson = $this->Lesson->findByComaId($course['ReportLesson']['coma_id']);
				$reported_lesson[$index]['lesson'] = $lesson;
			}

			$this->loadModel('BlockStudent');
			$blockeds = $this->BlockStudent->findAllByStudentId($user['user_id']);
			foreach ($blockeds as $index => $course) {
				$lesson = $this->User->findByUserId($course['BlockStudent']['teacher_id']);
				$blockeds[$index]['Teacher'] = $lesson;
			}

			$this->loadModel('RateLesson');
			$rates = $this->RateLesson->findAllByStudentId($user['user_id']);
			foreach ($rates as $index => $course) {
				$lesson = $this->Lesson->findByComaId($course['RateLesson']['coma_id']);
				$rates[$index]['lesson'] = $lesson;
			}

			$this->loadModel('Comment');
			$comments = $this->Comment->findAllByUserId($user['user_id']);
			foreach ($comments as $index => $comment) {
				$file = $this->Comment->findByFileId($comment['Comment']['file_id']);
				$comments[$index]['file'] = $file;
			}

			$this->set('comments',$comments);
			$this->set('courses',$bought_courses);
			$this->set('reported_lessons',$reported_lesson);
			$this->set('spentMoney',$spentMoney);
			$this->set('blockeds', $blockeds);
			$this->set('rates',$rates);
		} else {
			$this->redirect(array('controller' => 'Login','action' => 'index'));
		}
	}

	function BuyLesson() {
	}



	function ChangePassword() {
	}

	function reportCopyright($coma_id ){
		if ($coma_id == null){      
            die;
        }        
        $this->loadModel('ReportLesson');
        $data = array(
                'coma_id' => $coma_id,
                'user_id' => $this->Auth->user('user_id') ,
                'report_reason' => 'copyright'             
            );
        $this->ReportLesson->create($data);
        if ($this->ReportLesson->save()){
            echo "1";
            die;
        }
        else{
            echo "0";
            die;
        }
	} 

	function like(){
		if($this->request->is('ajax')){
			$data = $this->request->data;
			if( !empty($data['teacher_id']) && !empty($data['student_id'])){

				//check again
				$tea = $this->User->find('all', array(
					'conditions' => array(
						'user_id' => $data['teacher_id'],
						'user_type' => 1
						)
					));
				$std = $this->User->find('all', array(
					'conditions' => array(
						'user_id' => $data['student_id'],
						'user_type' => 2,
						)
					));

				if( !empty($tea) && !empty($std)){
					$this->loadModel('Like');
					$likes = $this->Like->find('all', array(
						'conditions' => array(
							'student_id' => $data['student_id'],
							'teacher_id' => $data['teacher_id'],
							)
						));
					if( !empty($likes) ){ //da co like
						echo '0';
						die;
					}
					$data = array(
						'student_id' => $data['student_id'],
						'teacher_id' => $data['teacher_id'],
						);
					$like = $this->Like->save($data);
					if( isset($like['Like'])){
						echo '1';
						die;
					}
				}
				echo 0;
			}
		}
		die;
	}
	function unlike(){
		if($this->request->is('ajax')){
			$data = $this->request->data;
			if( !empty($data['teacher_id']) && !empty($data['student_id'])){

				//check again
				$this->loadModel('Like');
				$like_ids = $this->Like->find('list', array(
					'conditions' => array(
						'student_id' => $data['student_id'],
						'teacher_id' => $data['teacher_id'],
						),
					'fields' => array('like_id'),
					));
				if( !empty($like_ids)){
					if($this->Like->deleteAll(array(
							'like_id' => $like_ids,
							))){
						echo '1';
						die;
					}
				}
				echo 0;
			}
		}
		die;
	}
	//comment nay la commet tren trang profile giao vien, khac voi comment len file bai giang -- @hoangdd
	//chi co hoc sinh da mua bai giang hoac chinh giao vien do comment
	function createComment(){
		if($this->request->is('ajax')){
			$this->loadModel('CommentTeacher');
			$user_id = $this->Auth->user('user_id');
			$teacher_id = $this->request->data['teacher_id'];
			$content = $this->request->data['content'];

			if( empty($user_id) || empty($teacher_id) || empty($content)){
				//invalid
				echo '0';
				die;
			}

			if( $user_id == $teacher_id && $this->Auth->user('role') == 'R2'){
				//chinh thang giao vien no comment
			}elseif($this->Auth->user('role') == 'R3'){
				//hoc sinh comment
				//recheck is student da mua bai giang
				if( !$this->__checkStudentCanCommentAndLike($user_id,$teacher_id)){
					//invalid
					echo '0';
					die;
				}
			}else{
				//invalid
				echo '0';
				die;
			}



			$ret = $this->CommentTeacher->save(array(
				'CommentTeacher' => array(
						'student_id' => $user_id,
						'teacher_id' => $teacher_id,
						'content' => $content
						)
				));
			if(isset($ret['CommentTeacher']['comment_id'])){
				// success
				$this->layout = false;

				$this->set('comment', $ret['CommentTeacher']);
				$this->set('user', $this->Auth->user());
			}else{
				//fail
				echo 0;
				die;
			}
		} else die;
	}
	function editComment(){
		if($this->request->is('ajax')){
			$this->loadModel('CommentTeacher');
			$user_id = $this->Auth->user('user_id');
			$comment = $this->CommentTeacher->read(null, $this->request->data['comment_id']);
			$content = $this->request->data['content'];

			if( empty($user_id) || empty($comment['CommentTeacher']) || empty($content) || $comment['CommentTeacher']['student_id'] != $user_id){
				//invalid
				echo '0';
				die;
			}

			$comment['CommentTeacher']['content'] = $content;
			$ret = $this->CommentTeacher->save($comment);
			if(isset($ret['CommentTeacher']['comment_id'])){
				// success
				echo 1;
			}else{
				//fail
				echo 0;
			}
		}
		die;
	}
	function deleteComment(){
		if($this->request->is('ajax')){
			$user_id = $this->Auth->user('user_id');
			$this->loadModel('CommentTeacher');
			$comment = $this->CommentTeacher->read(null, $this->request->data['comment_id']);
			if( empty($user_id) || empty($comment['CommentTeacher']) || $comment['CommentTeacher']['student_id'] != $user_id){
				// invalid
				echo '0';
				die;
			}
			if($this->CommentTeacher->delete($comment['CommentTeacher']['comment_id']))
				echo 1;
			else
				echo 0;
		}
		die;
	}

	//giong TeacherController checkStudentCancomment and Like
    private function __checkStudentCanCommentAndLike($student_id, $teacher_id){
		$this->loadModel('Lesson');
		$lesson_ids = $this->Lesson->find('list', array(
			'conditions' => array(
				'author' => $teacher_id,
				),
			'fields' => array('coma_id')
			));
		$transactions = $this->LessonTransaction->find('all', array(
			'conditions' => array(
				'coma_id' => $lesson_ids, 
				'student_id' => $student_id,
				)
			));
		if( empty($transactions)){
			return false;
		}else{
			return true;
		}
	}
	
}
