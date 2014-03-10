<?php
class AdminController extends AppController {
	public $uses = array (
		'User',
		'Admin',
		'AdminIp',
        'Notification'
		);
	public $components = array (
		'Auth' => array(
			'authenticate' => array(
				'Form' => array(
					'userModel' => 'Admin',
					'fields' => array(
						'username' => 'username',
						'password' => 'password',
						),
					'passwordHasher' => array(
						'className' => 'Simple',
						'hashType' => 'sha1'
						)
					)
				),
			'loginAction' => array(
				'controller' => 'Admin',
				'action' => 'login',
				),
			'loginRedirect' => array(
				'controller' => 'Admin',
				'action' => 'index'
				),
			'authError' => 'You don\'t have permission to view this page',
			),
		'Paginator',
		'RequestHandler' 
		);
	// public $components = array('Paginator','RequestHandler');
	function index() {
	}
	public function beforeFilter() {
		parent::beforeFilter ();
		$this->Auth->userModel = 'Admin';
		$this->Auth->allow ( 'login', 'logout', 'ip_manage', 'account', 'index' );
		$this->Auth->allow ( 'login', 'logout' );
		$this->Auth->allow ( 'CreateAdmin' );
		$this->Auth->allow ( 'Notification' );
	}
    
	function CreateAdmin() {
		$error = array ();
		$user_re_ex = '/^[A-Za-z]\w+$/';
		$pass_re_ex = '/^\w+$/';
		// If has data
		if ($this->request->isPost ()) {
			$data = $this->request->data;
			/*
			 * Check username: 0: null 1: empty 2: not match form 3: min short 4: max long 5: is used
			 */
			$check_admin = true;
			
			if (! isset ( $data ['Admin'] ['username'] )) {
				$error ['username'] [0] = 'Username is equal null.';
				$check_admin = false;
			}
			
			if (empty ( $data ['Admin'] ['username'] )) {
				$error ['username'] [1] = 'Username is empty.';
				$check_admin = false;
			} else {
				if (! preg_match ( $user_re_ex, $data ['Admin'] ['username'] )) {
					$error ['username'] [2] = 'Username is not match form.';
					$check_admin = false;
				}
				
				if (strlen ( $data ['Admin'] ['username'] ) < 6) {
					$error ['username'] [3] = 'Username is too short.';
					$check_admin = false;
				}
				
				if (strlen ( $data ['Admin'] ['username'] ) > 30) {
					$error ['username'] [4] = 'Username is too long.';
					$check_admin = false;
				}
				
				$res = $this->Admin->find ( 'all', array (
					'conditions' => array (
						'Admin.username' => $data ['Admin'] ['username'] 
						) 
					) );
				if (empty ( $res )) {
					// chua ton tai
					// $error['username'] ='Username chua ton tai!';
				} else {
					$error ['username'] [5] = 'Username is exist.';
					$check_admin = false;
				}
			}
			// =================================
			
			/*
			 * Check password: 0: null 1: empty 2: not match form 3: min short 4: max long
			 */
			$check_admin_password = true;
			if (! isset ( $data ['Admin'] ['password'] )) {
				$error ['password'] [0] = 'Password is equal null.';
				$check_admin = false;
			}
			
			if (empty ( $data ['Admin'] ['password'] )) {
				$error ['password'] [1] = 'Password is empty.';
				$check_admin = false;
			} else {
				if (! preg_match ( $pass_re_ex, $data ['Admin'] ['password'] )) {
					$error ['password'] [2] = 'Password is not match form.';
					$check_admin = false;
				}
				
				if (strlen ( $data ['Admin'] ['password'] ) < 8) {
					$error ['password'] [3] = 'Password is too short.';
					$check_admin = false;
				}
				
				if (strlen ( $data ['Admin'] ['password'] ) > 30) {
					$error ['password'] [4] = 'Password is too long.';
					$check_admin = false;
				}
			}
			
			/*
			 * Check RetypePassword 0: null 1: empty 2: not match with password
			 */
			if (! isset ( $data ['retypepassword'] )) {
				$error ['retypepassword'] [0] = 'Password is equal null.';
				$check_admin = false;
			}
			
			if (empty ( $data ['retypepassword'] )) {
				$error ['retypepassword'] [1] = 'Password is empty.';
				$check_admin = false;
			} else {
				if (strcmp ( $data ['retypepassword'], $data ['Admin'] ['password'] ) != 0) {
					$error ['retypepassword'] [2] = 'Password and RetypePassword are not equal.';
					$check_admin = false;
				}
			}
			
			// save data of user
			/*
			 * username,password
			 */
			$data_admin = array (
				'username' => $data ['Admin'] ['username'],
				'password' => $data ['Admin'] ['password'] 
				);
			if ($check_admin == true) {
				$this->Admin->create ( $data_admin );
				$this->Admin->save ();
			}
		}
		$this->set ( 'error', $error );
	}
    
	function Notification() {
        //load list user
		$list_user = $this->User->find ( 'all',array('order'=>array(
            'User.username' => 'asc')
        ) );
		$this->set ( "data", $list_user );
        
        //luu csdl post public
        if($this->request->is('post')){
            $data = $this->request->data;
            $data_public = array(
                'user_id'   =>  'all',
                'content'    =>  $data['publicpost'],
            );
            if(isset($data_public)){
                $this->Notification->create($data_public);
                $this->Notification->save();
            }
        }
	}
    
	function login() {
        //check loggedIn();
		if($this->Auth->loggedIn()){
			$this->redirect(array(
				'controller' => 'home',
				'action' => 'index',
				));
		}
		if ($this->request->is ( 'post' )) {
			$data = $this->request->data ['Admin'];
			$this->request->data ['Admin'] ['password'] = ( string ) ($data ['username'] . $data ['password']);
			// debug($this->Admin->hashPassword($data));die;
			if ($this->Auth->login ()) {
				// Login success
				$this->Session->write('Auth.User.role', 'R1');
				$this->Session->setFlash ( __ ( "Login success" ) );
			} else {
				// Login fail
				$this->Session->setFlash ( __ ( 'Username or password is incorrect' ), 'default', array (), 'auth' );
			}
		}
	}
	function logout() {
		$this->Auth->logout ();
		$this->redirect ( array (
			'controller' => 'Home',
			'action' => 'index' 
			) );
	}
	function changePassword() {
	}
	function ipManage() {
	}
	function statistic() {
	}
	function account(){
        if ($this->request->is('post')){
            $month = $this->request->data['month'];
            $year = $this->request->data['year'];
        }
        else {
            $today = getdate();        
            //get month now()            
            $month = $today['mon'];
            $year = $today['year'];        
        }        
        //get data        
        $data = json_encode($this->getDataForAccount($month,$year));
        $this->set('data',$data);
        $this->set('month',$month);
        $this->set('year',$year);
    }     
     public function getDataForAccount($month = null,$year = null){        
            if (($month == null ) && ($year == null)){
                 $today = getdate();        
                //get month now()            
                $month = $today['mon'];
                $year = $today['year'];        
            }            
            $this->loadModel('LessonTransaction');                    
            $this->loadModel('User');     
            $this->loadModel('Student');   
            $this->loadModel('Teacher');
            $this->loadModel('Lesson');                        
            $this->Student->primaryKey = 'student_id';
            $this->User->primaryKey = 'user_id';
            $this->Teacher->primaryKey = 'teacher_id';
            $this->Lesson->primaryKey = 'coma_id';            
            $conditions = array('MONTH(LessonTransaction.created) = '.$month,'YEAR(LessonTransaction.created) = '. $year);
            $this->LessonTransaction->bindModel(array(
                'belongsTo' => array(
                    'User' => array(
                        'className' => 'User',
                        'foreignKey' => 'student_id',                             
                        'order'=>'LessonTransaction.created DESC'
                        //'conditions' => array('LessonTransaction.student_id = User.user_id')
                        ),
                    'Lesson' => array(
                    		'className' => 'Lesson',
                    		'foreignKey' => 'coma_id',
                    		//'conditions' => array('LessonTransaction.coma_id = Coma.coma_id')
                    	)
                    )
                ), true);
            
            $this->Lesson->bindModel(array(
            	'belongsTo' => array(
            		'Author' => array(
            			'className' => 'User',
            			'foreignKey' => 'author',                                                     
                        //'conditions' => array('User.user_id = LessonTransaction.Lesson.author')
            			)
            		)
            	), true);
            $this->LessonTransaction->Lesson->Author->bindModel(array(
            	'belongsTo' => array(
            		'Teacher' => array(
            			'className' => 'Teacher', 
            			'foreignKey' => 'foreign_id'            			
            			//'conditions' => array('LessonTransaction.Coma.Author.foreign_id = Teacher.teacher_id')
            			)
            		)
            	),true)  ;                  
            $this->LessonTransaction->User->bindModel(array(
             'belongsTo' => array(
                'Student' => array(
                    'className' => 'Student',
                    'foreignKey' => 'foreign_id'                    
                    )
             	)
             ), true);            
            $data = $this->LessonTransaction->find('all',array('conditions' => $conditions,'recursive' => 3));                    
            $student = array();
            $teacher = array();            
            //get student and teacher account record monthly
            foreach($data as $dt):
            	if (!isset($student[$dt['User']['user_id']])){
            		$student[$dt['User']['user_id']] = array();
            		$student[$dt['User']['user_id']]['count'] = 1;
            		$student[$dt['User']['user_id']]['info'] = $dt['User'];
            	}
            	else{
            		++$student[$dt['User']['user_id']]['count'];
            	}
            	if (!isset($teacher[$dt['Lesson']['Author']['user_id']])){
            		$teacher[$dt['Lesson']['Author']['user_id']] = array();
            		$teacher[$dt['Lesson']['Author']['user_id']]['count'] = 1;
            		$teacher[$dt['Lesson']['Author']['user_id']]['info'] = $dt['Lesson']['Author'];
            	}
            	else{
            		++$teacher[$dt['Lesson']['Author']['user_id']]['count'];
            	}
            endforeach;            
            $accountData = array('teacher' => $teacher,'student' => $student);            
            $accountData['month'] = $month;
            $accountData['year'] = $year;
            $this->set('data',$accountData);         
            return $accountData;                
    }	

    function userManage() {
		$paginate = array (
			'limit' => 5,
			'fields' => array (
				'User.user_id',	
				'User.firstname',
				'User.lastname',
				'User.username',
				'User.date_of_birth',
				'User.user_type',
				'User.created' 
				),
			'conditions' => array('User.activated' => 1) 
			);
		$this->Paginator->settings = $paginate;
		// $this->Paginator->options(array(
		// 'update' => '#content',
		// 'evalScripts' => true
		// ));
		$data = $this->Paginator->paginate ( 'User' );
		$this->set ( 'data', $data );
	}
	function blockUser() {
	}
	function ip_manage() {
		$enter = "";
		$modFlag = 0;
		$pre;
		if (count ( $this->params ['url'] ) != 0) {
			$getParam = $this->params ['url'];
			if (strcmp ( $getParam ['mod'], "delete" ) == 0) {
				$id = $getParam ['ip'];
				$del = $this->AdminIp->find ( 'first', array (
					'conditions' => array (
						'AdminIp.ip' => $id 
						) 
					) );
				$this->AdminIp->delete ( intval ( $del ['AdminIp'] ['ip_id'] ) );
			}
			if (strcmp ( $getParam ['mod'], "edit" ) == 0) {
				$enter = $getParam ['ip'];
				$modFlag = 1;
			}
		}
		if ($this->request->is ( "post" )) {
			
			if (isset ( $this->request->data ['add'] )) {
				// yes button was clicked
				$retrieveData = $this->request->data ['AdminIp'];
				$ipRetrieved = $retrieveData ['Ipinput'];
				
				if (isset ( $this->request->data ['AdminIp'] ['Hidden'] )) {
					$pre = $this->request->data ['AdminIp'] ['Hidden'];
					$specificallyThisOne = $this->AdminIp->find ( 'first', array (
						'conditions' => array (
							'AdminIp.ip' => $pre 
							) 
						) );
					if ((strcmp ( strval($pre), $ipRetrieved ) != 0) && (count ( $specificallyThisOne ) != 0)) {
						echo $specificallyThisOne ['AdminIp'] ['ip_id'];
						$this->AdminIp->id = $specificallyThisOne ['AdminIp'] ['ip_id'];
						$this->AdminIp->saveField ( 'ip', $ipRetrieved );
					}
				} else {
					$specificallyThisOne = $this->AdminIp->find ( 'first', array (
						'conditions' => array (
							'AdminIp.ip' => $ipRetrieved 
							) 
						) );
					
					if (count ( $specificallyThisOne ) == 0) {
						$this->AdminIp->set ( 'ip', $ipRetrieved );
						$this->AdminIp->save ();
					}
				}
			}
		}
		$this->set ( 'enter', $enter );
		$this->set ( 'modFlag', $modFlag );
		$pagination = array (
			'limit' => 3,
			'fields' => array (
				'AdminIp.ip' 
				) 
			);
		$this->Paginator->settings = $pagination;
		$data = $this->Paginator->paginate ( 'AdminIp' );
		$this->set ( 'data', $data );
		$temp = $this->request->query;
	}
    
	function delip() {
		$ip = $this->params ['url'] ['ip'];
	}
    
	function check_notification(){
        $this->loadModel('Notification');
        if($this->request->is('post')){
            // lay du lieu gui len
            $id_array = $this->request->data['ids'];

            // chuyen sau thanh mang
            $data = $this->request->data;
            $data_private = array();
            foreach($id_array as $user_id):                
                $record = array('Notification'=>array( 'user_id' => $user_id,'content' => $data['privatepost'] ));
                $data_private[] = $record;
            endforeach;
            if(isset($data_private)){
               // $this->Notification->create($data_private);                
                if ($this->Notification->saveMany($data_private)) echo "Send complete!";
            }
        }
        die;
	}

	function formatToWriteAccountFile($data){
        $_SERER_CODE = "ELS-UBT-GWK54M78";
        $_STUDENT_PAY_MONEY = 20000;
    	$_TEACHER_PROFIT = $_STUDENT_PAY_MONEY*60/100;    
    	$teacher = $data['teacher'];
    	$student = $data['student'];
        $today = getdate();    
        if ($today['mon']< 10 ) $today['mon'] = '0'.$today['mon'];        
        $tab = "    ";
        // get row to write
        $row = array();
        $row[0] = array($_SERER_CODE,$data['year'],$data['month'],$today['year'],$today['mon'],$this->Auth->user('admin_id'),$this->Auth->user('username'));
        $i = 1;
        $money = 20000;
        foreach ($student as $dt):
			$row[$i] = array($dt['info']['username'],$dt['info']['firstname'].$dt['info']['lastname'],$dt['count']*$_STUDENT_PAY_MONEY,$dt['info']['address'],$dt['info']['phone_number'],$dt['info']['credit_account']);
            $i++;
        endforeach;
        foreach ($teacher as $dt):
			$row[$i] = array($dt['info']['username'],$dt['info']['firstname'].$dt['info']['lastname'],$dt['count']*$_TEACHER_PROFIT,$dt['info']['address'],$dt['info']['phone_number'],$dt['info']['bank_account']);
            $i++;
        endforeach;
        $end = array("END__END__END".$dateOfTran['year'].$dateOfTran['mon']);
        $row[$i++] = $end;
        $str = "";
        $tab = "\t";
        $newLine = "\n";
        foreach($row as $r):
            foreach ($r as $c):
                $str = $str.$c.$tab;
            endforeach;
            $str = $str.$newLine;
        endforeach;
        $filename = "ELS-UBT-".$data['year']."-".$data['month'].".tsv";
        file_put_contents($filename, $str);
        return $str;
    }
    function exportAccountFile(){    
        if ($this->request->is('post')){
            $data = $this->request->data;                        
            $str = $this->formatToWriteAccountFile($data);            
            //Write to file 
            $this->set('str',$str);            
        }
    }
	/**
	* edit prifile user 
	*/

	function delete($userId){
		$this->loadModel('User');		
		$this->User->id = $userId;					
		 $this->User->saveField('activated',0);
		// $this->User->update()	
		 $this->redirect('userManage');
	}
	function resetPassword($userId){
		$this->loadModel('User');				
		$result  = $this->User->find('first',array(
			'conditions' => array('user_id' => $userId),
			'fields' => array('original_password')
		));		
		$this->User->setField('password',$result['User']['original_password']);
	}
	function resetVerifyCode($userId){
		$this->loadModel('User');				
		$result  = $this->User->find('first',array(
			'conditions' => array('user_id' => $userId),
			'fields' => array('original_verifycode_answer','original_verifycode_question')
		));
		$this->User->setField('verifycode_answer',$result['User']['original_verifycode_answer']);		
		$this->User->setField('verifycode_question',$result['User']['original_verifycode_question']);		
	}
}
