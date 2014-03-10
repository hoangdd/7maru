<?php
class AdminController extends AppController {
	public $uses = array (
			'User',
			'Admin',
			'AdminIp' 
	);
	public $components = array (
			'Auth' => array (
					'authenticate' => array (
							'Form' => array (
									'userModel' => 'Admin',
									'fields' => array (
											'username' => 'username',
											'password' => 'password' 
									),
									'passwordHasher' => array (
											'className' => 'Simple',
											'hashType' => 'sha1' 
									) 
							) 
					),
					'loginAction' => array (
							'controller' => 'Admin',
							'action' => 'login' 
					),
					'loginRedirect' => array (
							'controller' => 'Admin',
							'action' => 'index' 
					),
					'authError' => 'You don\'t have permission to view this page' 
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
		$data = $this->User->find ( 'all' );
		$this->set ( "data", $data );
	}
	function login() {
		if ($this->request->is ( 'post' )) {
			$data = $this->request->data ['Admin'];
			$this->request->data ['Admin'] ['password'] = ( string ) ($data ['username'] . $data ['password']);
			// debug($this->Admin->hashPassword($data));die;
			if ($this->Auth->login ()) {
				// Login success
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
	function account() {
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
		// $data = $this->AdminIp->find('all');
		// debug($data);
		// $data = $this->
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
// 				print_r ( $del );
// 				$this->redirect ( '/admin/ip_manage' );
				$this->AdminIp->delete ( intval ( $del ['AdminIp'] ['ip_id'] ) );
// 				$this->AdminIp->ip = intval($ip);
// 				$this->AdminIp->delete();
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
					if(!filter_var($ipRetrieved, FILTER_VALIDATE_IP)) {
						echo "Not a valid IP address!";
					}
					else{
						if ((strcmp ( strval($pre), $ipRetrieved ) != 0) && (count ( $specificallyThisOne ) != 0)) {
							echo $specificallyThisOne ['AdminIp'] ['ip_id'];
							$this->AdminIp->id = $specificallyThisOne ['AdminIp'] ['ip_id'];
							$this->AdminIp->saveField ( 'ip', $ipRetrieved );
	// 						$this->AdminIp->set ( 'ip_id', $specificallyThisOne ['AdminIp'] ['ip_id'] );
	// 						$this->AdminIp->read(null,$specificallyThisOne ['AdminIp'] ['ip_id']);
	// 						$this->AdminIp->set ( 'ip', $ipRetrieved );
	// 						$this->AdminIp->save ();
						}
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
		// debug($data);
		// print_r($data);
		$this->set ( 'data', $data );

		$temp = $this->request->query;
		// print_r($temp);
		
		// $totalIp = array('1','2','3','4','5','6','7');
		// $i = 1;$arrayItem;$arrayFinal;
		// foreach ($totalIp as $item) {
		// if($i%3 == 1) $arrayItem = array($item);
		// else $arrayItem = array_merge($arrayItem,array($item));
		// if($i%3 == 0) {
		// if($i/3 <= 1) {
		
		// $arrayFinal = array('1' => $arrayItem);
		// }
		// else {
		
		// $ij = $i/3;
		// $arrayFinal += array($ij => $arrayItem);
		// }
		// }
		// $i++;
		
		// }
		
		// if($i%3 != 0){
		// $ij = $i/3 + 1;
		// if($i/3 == 0) $arrayFinal = array($ij => $arrayItem);
		// else $arrayFinal += array($ij => $arrayItem);
		// }
		// $this->set("array_list",$arrayFinal);
	}
	function delip() {
		$ip = $this->params ['url'] ['ip'];
	}
	// ...
}
