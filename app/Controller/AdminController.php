<?php
class AdminController extends AppController {
	public $uses = array (
		'User',
		'Admin',
		'AdminIp' 
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
		$this->Auth->allow();
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
		$list_user = $this->User->find ( 'all' );
		$this->set ( "data", $list_user );
        
        //check submit
        if($this->request->is('post')){
            $data = $this->request->data;
            
            $data_public = array(
                'user_id'   =>  'all',
                'content'    =>  $data['publicpost'],
            );
            
            $data_private   = array(
                'user_id'       =>  '',
                'privatepost'   =>  $data['privatepost'],
            );
            if(isset($data_public)){
                $this->Admin->create($data_teacher);
                $result = $this->Teacher->save();
            }else if(isset($data_private)){
                
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
            $this->loadModel('ComaTransaction');                    
            $this->loadModel('User');     
            $this->loadModel('Student');           
            $this->Student->primaryKey = 'student_id';
            $this->User->primaryKey = 'user_id';
            $conditions = array('MONTH(ComaTransaction.created) = '.$month,'YEAR(ComaTransaction.created) = '. $year,'ComaTransaction.student_id = User.user_id');
            $this->ComaTransaction->bindModel(array(
                'belongsTo' => array(
                    'User' => array(
                        'className' => 'User',
                        'foreignKey' => false,                             
                        'order'=>'ComaTransaction.created DESC',
                        'conditions' => $conditions
                        )
                    )
                ), false);
            $this->User->bindModel(array(
             'hasOne' => array(
                'Student' => array(
                    'className' => 'Student',
                    'foreignKey' => false, 
                    'conditions'  => array('User.foreign_id = Student.student_id')
                    )
                )
             ), false);            
            $data = $this->ComaTransaction->find('all',array('conditions' => $conditions,'recursive' => 2));                    
            $this->set('data',$data);         
            return $data;                
    }
	function userManage() {
		$paginate = array (
			'limit' => 10,
			'fields' => array (
				'User.firstname',
				'User.lastname',
				'User.username',
				'User.date_of_birth',
				'User.user_type',
				'User.created' 
				) 
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
	function send(){
		// lay du lieu gui len
		$data = $this->request->data['ids'];

		// chuyen sau thanh mang
		$id_array = explode(',', $data);

		if( !empty($data)){
			echo 'ok';
		}else{
			echo 'error';
		}
		die;
	}

	function formatToWriteAccountFile($data){
        $_SERER_CODE = "ELS-UBT-GWK54M78";
        debug($data);
        $today = getdate();                
        $dateOfTran = getdate();
        $tab = "    ";
        // get row to write
        $row = array();
        $row[0] = array($_SERER_CODE,$dateOfTran['year'],$dateOfTran['mon'],$today['year'],$today['mon'],'admin','admin');
        $i = 1;
        $money = 20000;
        foreach ($data as $dt):
            $row[$i] = array($dt['User']['username'],$dt['User']['firstname'].$dt['User']['lastname'],$money,$dt['User']['address'],$dt['User']['phone_number'],$dt['User']['Student']['credit_account']);
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
        file_put_contents("export.tsv", $str);
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
 
}
