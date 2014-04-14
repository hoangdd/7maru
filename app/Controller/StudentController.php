<?php
class StudentController extends AppController {

	public $testList;
	public $uses = array (
			'User',
			'Student',
			'Data' 
			
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
				
				if (strlen($data['username'])< 6){
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
				
				if (strlen($data['password']) < 8) {
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
				$error ['credit_account'] [0] = 'Credit account is equal null.';
				$check_student = false;
			}
			if (empty ( $data ['credit_account'] )) {
				$error ['credit_account'] [1] = 'Credit account is empty.';
				$check_student = false;
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
			if( !empty($_FILES['profile_picture'])){
				$config = Configure::read('srcFile');
				$img_exts = $config['image']['extension'];
				$profile_pic = $_FILES['profile_picture'];
				$ext = pathinfo($profile_pic['name'], PATHINFO_EXTENSION);
				if( !in_array($ext, $img_exts) ){
				  $error['profile_picture'][0] ='Unsupported image file';  
				}				
			}
			else{

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
					$data['content'] = 0;
					$data['activated'] = 1;
					$data['approved'] = 0;
					$this->User->create($data);
					if ( !$this->User->save()){
                        $this->Student->delete($result['Student']['student_id']);
                        $this->Session->setFlash(__('Register failure'));                        
                    }
                    else{
                        $this->Session->setFlash(__('Register successful, waiting for approving by admin'));   
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
			if ($this->Auth->User('admin_id') && $id!= null){
				$data = $this->User->find('first', array(
					'conditions' => array(
					'User.user_id' => $id,
				)
			));	
			}
			else{				
				$pid=$this->Auth->User('user_id');
				$data = array();
				$data['User'] = $this->Auth->User();				
			}
			if (!$data){
				$this->Session->setFlash(__('Forbidden error'));
			}
		$this->set("data",$data);
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

	function EditProfile() {	
		if ($this->Auth->loggedIn()) {
			if ($this->request->is('post')) {               
				$pid = $this->Auth->User('user_id');                
				$this->request->data['profile_picture'] = $_FILES['profile_picture'];
				$data = $this->User->create($this->request->data);
				$data['User']['user_id'] = $this->Auth->user('user_id');
				$studentData = $data['User']['credit_account'];
				unset($data['credit_account']);
				$result = $this->User->save($data,true,array('mail','firstname','lastname','date_of_birth','phone_number','profile_picture'));				
				if ($result){
					$studentData = array(
						'Student' => array(
							'credit_account' => $studentData,
							'student_id' => $this->Auth->user('foreign_id'),
							'username' => $this->Auth->user('username')
						)
					);
					if ($this->Student->save($studentData)){
						$this->Session->setFlash(__('Edit successful'));
					}
				   // $this->redirect(array('controller' => 'Teacher', 'action' => 'profile'));
				}
			}   
		}				
			//get data                 
			$studentData = $this->Student->find('first',
				array(
					'conditions' => array(
						'Student.student_id' => $this->Auth->User('foreign_id')
						)
					)
			);            
			$this->loadModel('User');
			$userData = $this->User->find('first',
				array(
					'conditions' => array(
						'User.user_id' => $this->Auth->User('user_id')
						)
					)
				);                
			$this->set('studentData',$studentData['Student']);
			$this->set('userData',$userData['User']);                            
	}

	function Destroy() {
	}

	function Statistic() {
	}

	function BuyLesson() {
	}

	function Test() {
	}

	function DoTest(){
		
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
			
			
			$reTemp = $totques;
			$this->set('hit',$temp);
			$this->set('total',$reTemp);
			$this->set('time',600);
			$this->set('mark',$mark);
			$this->set('markGET',$markGET);
			$this->set('markTotal',$markTotal);
			
			$this->set('finalTest',$finalTest);
			$this->set('choosedEnd',$choosed);
			
			/*echo $mark;
			echo $temp;
			
			$this->ViewTestResult($temp, 5);
			$this->redirect ( '/student/viewtestresult/?hit='.$temp.'&total='.$reTemp.'&time='.$timeTemp );
			$this->redirect ( array (

			
				$this->redirect ( array (

					'controller' => 'student',
					'action' => 'viewtestresult',
					'hit' => $temp,
					'total' => $reTemp,

					'mark' => $mark,
					'time' => 10
			) );
			*/
		}
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
	print_r($this->params['url']);		
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
		        $this->set('testID',$id);
			$this->set('testfile',$dulieu['Data']['path']);
			
		} else {
			$str = "Error test data!!!";
		}
		$this->set("warningNotify",$str);
	}

	function ChangePassword() {
	}
}
