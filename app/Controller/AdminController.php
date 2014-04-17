<?php

class AdminController extends AppController {

    public $uses = array(
        'User',
        'Admin',
        'AdminIp',
        'Notification',
        'Category',
    	'IpOfAdmin',
    	'AdminLevel'
    		
    );
    public $components = array(
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
                'controller' => 'admin',
                'action' => 'login',
            ),
            'loginRedirect' => array(
                'controller' => 'admin',
                'action' => 'acceptNewUser'
            ),
            'logoutRedirect' => array(
                'controller' => 'admin',
                'action' => 'login'
            )            
        ),
        'Paginator',
        'RequestHandler'
    );
    public $layout = 'admin';

    // public $components = array('Paginator','RequestHandler');
    function index() {        
    }

    public function beforeFilter() {
        // parent::beforeFilter ();
        $this->Auth->userModel = 'Admin';        
        $this->Auth->allow('login', 'logout');     
    }

    function CreateAdmin() {
        $error = array();
        $user_re_ex = '/^[A-Za-z]\w+$/';
        $pass_re_ex = '/^\w+$/';
        // If has data
        if ($this->request->isPost()) {
            $data = $this->request->data;            
            /*
             * Check username: 0: null 1: empty 2: not match form 3: min short 4: max long 5: is used
             */
            $check_admin = true;

            if (!isset($data ['Admin'] ['username'])) {
                $error ['username'] [0] = 'Username is equal null.';
                $check_admin = false;
            }

            if (empty($data ['Admin'] ['username'])) {
                $error ['username'] [1] = 'Username is empty.';
                $check_admin = false;
            } else {
                // if (!preg_match($user_re_ex, $data ['Admin'] ['username'])) {
                //     $error ['username'] [2] = 'Username is not match form.';
                //     $check_admin = false;
                // }

                if (strlen($data ['Admin'] ['username']) < 2) {
                    $error ['username'] [3] = 'Username is too short.';
                    $check_admin = false;
                }

                if (strlen($data ['Admin'] ['username']) > 30) {
                    $error ['username'] [4] = 'Username is too long.';
                    $check_admin = false;
                }

                $res = $this->Admin->find('all', array(
                    'conditions' => array(
                        'Admin.username' => $data ['Admin'] ['username']
                    )
                        ));
                if (empty($res)) {
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
            if (!isset($data ['Admin'] ['password'])) {
                $error ['password'] [0] = 'Password is equal null.';
                $check_admin = false;
            }

            if (empty($data ['Admin'] ['password'])) {
                $error ['password'] [1] = 'Password is empty.';
                $check_admin = false;
            } else {
                if (!preg_match($pass_re_ex, $data ['Admin'] ['password'])) {
                    $error ['password'] [2] = 'Password is not match form.';
                    $check_admin = false;
                }

                if (strlen($data ['Admin'] ['password']) < 2) {
                    $error ['password'] [3] = 'Password is too short.';
                    $check_admin = false;
                }

                if (strlen($data ['Admin'] ['password']) > 30) {
                    $error ['password'] [4] = 'Password is too long.';
                    $check_admin = false;
                }
            }

            /*
             * Check RetypePassword 0: null 1: empty 2: not match with password
             */
            if (!isset($data ['retypepassword'])) {
                $error ['retypepassword'] [0] = 'Password is equal null.';
                $check_admin = false;
            }

            if (empty($data ['retypepassword'])) {
                $error ['retypepassword'] [1] = 'Password is empty.';
                $check_admin = false;
            } else {
                if (strcmp($data ['retypepassword'], $data ['Admin'] ['password']) != 0) {
                    $error ['retypepassword'] [2] = 'Password and RetypePassword are not equal.';
                    $check_admin = false;
                }
            }
            if (!isset($data ['Admin'] ['ip'])) {
            	$error ['ip'] [0] = 'ip is equal null.';
            	$check_admin = false;
            }
            
            if (empty($data ['Admin'] ['ip'])) {
            	$error ['ip'] [1] = 'IP is empty.';
            	$check_admin = false;
            } else {
            	 if (!filter_var($data['Admin']['ip'], FILTER_VALIDATE_IP)) {
            		$error ['ip'] [2] = 'IP is not correct';
            		$check_admin = false;
            	}
            }
            

            // save data of user
            /*
             * username,password
             */            
            if ($check_admin == true) {
                //$this->Admin->create($data);               
                if ($this->Admin->save($data)){
                    $data_admin_ip = array(
                        'ip' => $data['Admin']['ip']
                    );
                    $this->AdminIp->create($data_admin_ip);
                    $this->AdminIp->save();
                    $data_ipOfAdmin = array (
                        'admin_id'  => $this->Admin->getLastInsertId(),
                        'ip_id' => $this->AdminIp->getLastInsertId()
                    );                    
                    $this->IpOfAdmin->save($data_ipOfAdmin);                    
                    // $aa = $this->Auth->User();
                    // $data_admin_admin = array(
                    //     'admin_super' => 
                    //         $aa['admin_id'],
                    //     'admin_sub' => $this->Admin->getLastInsertId()
                    // );
                    // $this->AdminLevel->create($data_admin_admin);
                    // $this->AdminLevel->save();
                    $this->Session->setFlash(__('Create Admin Successfully'));
                    $this->redirect(array('controller' => 'Admin','action' => 'adminManage'));
                }

            }
        }
        $this->set('error', $error);
    }
    
    

    function Notification() {
        //load list user
        $list_user = $this->User->find('all', array('order' => array(
                'User.username' => 'asc')
                ));
        $this->set("data", $list_user);

        //luu csdl post public
        if ($this->request->is('post')) {
            $data = $this->request->data;
            $data_public = array(
                'user_id' => 'all',
                'content' => $data['publicpost'],
            );
            if (isset($data_public)) {
                $this->Notification->create($data_public);
                $this->Notification->save();
            }
        }
    }

    function login() {
        //check loggedIn();
        $this->layout='default';
        if ($this->Auth->loggedIn()) {
            $this->redirect(array(
                'controller' => 'admin',
                'action' => 'acceptNewUser',
            ));
        }
        if ($this->request->is('post')) {
            $data = $this->request->data ['Admin'];
            $this->request->data ['Admin'] ['password'] = (string) ($data ['username'] . $data ['password']);
            $clientIp = $this->request->clientIp();            
            if ($this->Auth->login()) {
                // Login success                
                $result = $this->AdminIp->find('all',array('conditions' => array('ip' => $clientIp)));
                if (!$result){
                    $this->Session->setFlash(__("Login with invalid IP"));
                    $this->logout();
                }                
                $this->Session->write('Auth.User.role', 'R1');                
                $this->Session->setFlash(__("Login success"));
                $this->redirect('acceptNewUser');
            } else {
                // Login fail
                $this->Session->setFlash(__('Username or password is incorrect'), 'default', array(), 'auth');                
            }
        }
    }

    function logout() {
        $this->redirect($this->Auth->logout());        
    }

    function changePassword() {
        if ($this->request->is('post')) {

            // Get data from view via $data
            $data = $this->request->data;

            $current = $data['current-pw'];
            $new = $data['new-pw'];
            $confirm = $data['confirm-pw'];
            $error = array();
            //$error[] = $this->User->validationErrors;
            //Check NULL data requested

            if (empty($current)) {
                $error['current'] = 'This field is required';
            }
            if (empty($new)) {
                $error['new'] = 'This field is required';
            }
            if (empty($confirm)) {
                $error['confirm'] = 'This field is required';
            }

            if (empty($current) || empty($new) || empty($confirm)) {
                $this->set('error', $error);
                return;
            }

            // Check $new validate ?
            if ($this->User->validates(array('fieldList' => array('password' => $new)))) {
                // Check matching between $new and $confirm
                if ($new != $confirm) {
                    $error['confirm'] = 'Password do not match';
                    $this->set('error', $error);
                    return;
                }else{
                    if (strlen($new) < 8) {
                        $error['new'] = 'Password is too short.';
                        $this->set('error', $error);
                        return;
                    }

                    if (strlen($new) > 30) {
                        $error['new'] = 'Password is too long.';
                        $this->set('error', $error);
                        return;
                    }
                }
            } else {
                $error['new'] = 'Password format is wrong';
                $this->set('error', $error);
                return;
            }

            // Access to table User with user_id got from Session, Auth
            $admin = $this->Admin->find('first', array(
                'conditions' => array(
                    'Admin.admin_id' => $this->Auth->user('admin_id'),
                    ),
                ));
            /* Check current password to password in database
             * If valid then update new Password
             */

            if ($this->Auth->password($this->Auth->user('username') . $current) === $admin['Admin']['password']) {
                $hashNewPassword = $this->Auth->password($this->Auth->user('username') . $new);
                $updatePassword = $this->Admin->updateAll(
                    array(
                        'Admin.password' => "'" . $hashNewPassword . "'"
                        ), array(
                        'Admin.admin_id' => $this->Auth->User('admin_id')
                        )
                        );
                if ($updatePassword) {
                    $this->Session->setFlash('The user has been saved');
                    $this->redirect(array(
                        'controller' => 'Admin',
                        'action' => 'acceptNewUser',
                        ));
                } else {
                    $this->Session->setFlash('The password could not be saved. Please, try again.');
                }
            } else {
                $error['current'] = 'Current password invalid';
            }

            $this->set('error', $error);
        }
    }
    function acceptNewUser() {
        $paginate = array(
            'limit' => 10,
            'fields' => array(
                'User.user_id',
                'User.firstname',
                'User.lastname',
                'User.username',
                'User.date_of_birth',
                'User.user_type',
                'User.created'
            )
        );
        $this->Paginator->settings = $paginate;
        $data = $this->Paginator->paginate('User');
        $dataNewUser = $this->User->find('all', array(
            'conditions' => array(
                'approved' => '0'
            ),
            'recursive' => 2
        ));
        $this->set('data', $dataNewUser);
    }
    
    function approveUser($id,$value){
        //$this->layout = null;
        if ($this->request->is('get')) {            
            if ($this->User->updateAll(
                            array(
                        'User.approved' => $value
                            ), array(
                        'User.user_id' => $id
                            )
                    )) {
                echo '1';die;
            } else {
                echo '0';die;
            }

        }
    }
    function account() {
        if ($this->request->is('post')) {
            $month = $this->request->data['month'];
            $year = $this->request->data['year'];
        } else {
            $today = getdate();
            //get month now()            
            $month = $today['mon'];
            $year = $today['year'];
        }
        //get data        
        $data = json_encode($this->getDataForAccount($month, $year));
        $this->set('data', $data);
        $this->set('month', $month);
        $this->set('year', $year);
    }

    public function getDataForAccount($month = null, $year = null) {
        if (($month == null ) && ($year == null)) {
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
        $conditions = array('MONTH(LessonTransaction.created) = ' . $month, 'YEAR(LessonTransaction.created) = ' . $year);
        $this->LessonTransaction->bindModel(array(
            'belongsTo' => array(
                'User' => array(
                    'className' => 'User',
                    'foreignKey' => 'student_id',                   
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
            $this->Lesson->Author->bindModel(array(
            	'belongsTo' => array(
            		'Teacher' => array(
            			'className' => 'Teacher', 
            			'foreignKey' => 'foreign_id'            			
            			//'conditions' => array('LessonTransaction.Coma.Author.foreign_id = Teacher.teacher_id')
            			)
            		)
            	),true)  ;                  
            $this->User->bindModel(array(
             'belongsTo' => array(
                'Student' => array(
                    'className' => 'Student',
                    'foreignKey' => 'foreign_id'                    
                    )
             	)
             ), true);            
            $data = $this->LessonTransaction->find('all',array('conditions' => $conditions,'recursive' => 3, 'order' => 'LessonTransaction.created DESC'));                    
            $student = array();
            $teacher = array();                        
            //get student and teacher account record monthly
            foreach($data as $dt):
                $rate = $dt['LessonTransaction']['rate'];
            	if (!isset($student[$dt['User']['user_id']])){
            		$student[$dt['User']['user_id']] = array();
            		$student[$dt['User']['user_id']]['money'] = $dt['LessonTransaction']['money'] *(100 - $rate)/100;
            		$student[$dt['User']['user_id']]['info'] = $dt['User'];
            	}
            	else{
            		$student[$dt['User']['user_id']]['money'] = $student[$dt['User']['user_id']]['money']+ $dt['LessonTransaction']['money'] *(100 - $rate)/100;
            	}
            	if (!isset($teacher[$dt['Lesson']['Author']['user_id']])){
            		$teacher[$dt['Lesson']['Author']['user_id']] = array();
            		$teacher[$dt['Lesson']['Author']['user_id']]['money'] = $dt['LessonTransaction']['money'] *$rate /100;
            		$teacher[$dt['Lesson']['Author']['user_id']]['info'] = $dt['Lesson']['Author'];
            	}
            	else{
            		$teacher[$dt['Lesson']['Author']['user_id']]['money'] += $dt['LessonTransaction']['money']*$rate/100 ;
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
        if ($this->request->is('ajax') && (isset($this->request->data['type']))) {
            if (isset($this->request->data['stt'])) {
                $stt = trim($this->request->data['stt']);
                $updateStt = $stt == '1' ? 0 : 1;
                $username = trim($this->request->data['username']);
                $arrayStt = array(
                    '0' => 'Block',
                    '1' => 'Active'
                );
                $updateBlock = $this->User->updateAll(
                        array(
                    'User.block' => "'" . $updateStt . "'"
                        ), array(
                    'User.username' => $username
                        )
                );
                if ($updateBlock) {
                    $return = (array(
                        'msg' => 'success',
                        'stt' => $arrayStt[$updateStt],
                        'value' => $updateStt
                    ));
                } else {
                    $return = (array(
                        'msg' => 'error'
                    ));
                }
                echo json_encode($return);
                die;
            }
            if (isset($this->request->data['cmt'])) {
                $cmt = $this->request->data['cmt'];
                $updateCmt = $cmt == 'true' ? 1 : 0;
                //var_dump($updateCmt);die;
                $username = trim($this->request->data['username']);
                $updateComment = $this->User->updateAll(
                        array(
                    'User.comment' => "'" . $updateCmt . "'"
                        ), array(
                    'User.username' => $username
                        )
                );
                $return = $updateComment ? array('msg' => 'success', 'stt' => $updateCmt) : array('msg' => 'error');
                echo json_encode($return);
                die;
            }
        } else {
            $this->autorender = false;
            $paginate = array(
                'limit' => 3,
                'fields' => array('User.firstname', 'User.lastname', 'User.username, User.comment, User.block')
            );
            $this->Paginator->settings = $paginate;
            // var_dump($this->paginate);die;
            $data = $this->Paginator->paginate('User');
            //$data = $this->User->find('all');
            $this->set('data', $data);
        }
    }

    function ipManage() {
        $enter = "";
        $modFlag = 0;
        $pre;
        if (count($this->params ['url']) != 0) {
            $getParam = $this->params ['url'];
            if (strcmp($getParam ['mod'], "delete") == 0) {
                $id = $getParam ['ip'];
                $del = $this->AdminIp->find('first', array(
                    'conditions' => array(
                        'AdminIp.ip' => $id
                    )
                        ));
                $this->AdminIp->delete(intval($del ['AdminIp'] ['ip_id']));
            }
            if (strcmp($getParam ['mod'], "edit") == 0) {
                $enter = $getParam ['ip'];
                $modFlag = 1;
            }
        }
        if ($this->request->is("post")) {

            if (isset($this->request->data ['add'])) {
                // yes button was clicked
                $retrieveData = $this->request->data ['AdminIp'];
                $ipRetrieved = $retrieveData ['Ipinput'];

                if (isset($this->request->data ['AdminIp'] ['Hidden'])) {
                    $pre = $this->request->data ['AdminIp'] ['Hidden'];
                    $specificallyThisOne = $this->AdminIp->find('first', array(
                        'conditions' => array(
                            'AdminIp.ip' => $pre
                        )
                            ));
                    if (!filter_var($ipRetrieved, FILTER_VALIDATE_IP)) {
                        echo "Not a valid IP address!";
                    } else {
                        if ((strcmp(strval($pre), $ipRetrieved) != 0) && (count($specificallyThisOne) != 0)) {
                            echo $specificallyThisOne ['AdminIp'] ['ip_id'];
                            $this->AdminIp->id = $specificallyThisOne ['AdminIp'] ['ip_id'];
                            $this->AdminIp->saveField('ip', $ipRetrieved);
                            // 						$this->AdminIp->set ( 'ip_id', $specificallyThisOne ['AdminIp'] ['ip_id'] );
                            // 						$this->AdminIp->read(null,$specificallyThisOne ['AdminIp'] ['ip_id']);
                            // 						$this->AdminIp->set ( 'ip', $ipRetrieved );
                            // 						$this->AdminIp->save ();
                        }


                        if ((strcmp(strval($pre), $ipRetrieved) != 0) && (count($specificallyThisOne) != 0)) {
                            echo $specificallyThisOne ['AdminIp'] ['ip_id'];
                            $this->AdminIp->id = $specificallyThisOne ['AdminIp'] ['ip_id'];
                            $this->AdminIp->saveField('ip', $ipRetrieved);
                        }
                    }
                } else {
                    $specificallyThisOne = $this->AdminIp->find('first', array(
                        'conditions' => array(
                            'AdminIp.ip' => $ipRetrieved
                        )
                            ));

                    if ((count($specificallyThisOne) == 0)&&filter_var($ipRetrieved, FILTER_VALIDATE_IP)) {
                        $this->AdminIp->set('ip', $ipRetrieved);
                        $this->AdminIp->save();
                    }
                }
            }
        }
        $this->set('enter', $enter);
        $this->set('modFlag', $modFlag);
        $pagination = array(
            'limit' => 3,
            'fields' => array(
                'AdminIp.ip'
            )
        );
        $this->Paginator->settings = $pagination;
        $data = $this->Paginator->paginate('AdminIp');
        $this->set('data', $data);

        $temp = $this->request->query;
    }
    
    function delip() {
        $ip = $this->params ['url'] ['ip'];
    }

    function check_notification() {
        $this->layout = false;
        $this->loadModel('Notification');
        if ($this->request->is('post')) {
            // lay du lieu gui len
            $id_array = $this->request->data['ids'];

            // chuyen sau thanh mang
            $data = $this->request->data;            
            $data_private = array();            
            foreach ($id_array as $user_id):
                $record = array('Notification' => array('user_id' => $user_id, 'content' => $data['privatepost']));
                $data_private[] = $record;
            endforeach;
            if (isset($data_private)) {
                // $this->Notification->create($data_private);                                
                if ($this->Notification->saveMany($data_private))
                    echo "1";
                else
                    echo "0";
            }
        }
        die;
    }

    function ReferenceManage(){

       $this->loadModel('Lesson');
       //$this->loadModel('LessonReference');
       $this->loadModel('User');         
       $this->loadModel('Data');
         $this->Data->bindModel(array(
             'belongsTo' => array(               
               'Lesson' => array(
                    'foreignKey' => 'coma_id'
                )
             )
         ), true);
         $this->Lesson->bindModel(array(
             'belongsTo' => array(               
               'Author' => array(
                    'className' => 'User',
                    'foreignKey' => 'author'
                )
             )
         ), true);
        $data = $this->Data->find('all',array('recursive' => 3,'order' => 'Data.created DESC'));
        $this->set('reference',$data);        
       /*$paginate = array (
           'limit' => 10,
           'fields' => array (
               'LessonReference.name',
               'LessonReference.link',
               'LessonReference.created' 
               ) 
           );
       $this->Paginator->settings = $paginate;
       $data = $this->Paginator->paginate ( 'User' );
       $this->set ( 'data', $data );*/
   }

    function formatToWriteAccountFile($data) {
        $_SERER_CODE = "ELS-UBT-GWK54M78";
        $_STUDENT_PAY_MONEY = Configure::read('customizeConfig.money_per_lesson');
    	$_TEACHER_PROFIT = $_STUDENT_PAY_MONEY*Configure::read('customizeConfig.teacher_profilt_percentage');    
    	$teacher = $data['teacher'];
    	$student = $data['student'];        
        $today = getdate();    
        if ($today['mon']< 10 ) $today['mon'] = '0'.$today['mon'];        
        $tab = "    ";
        // get row to write
        $row = array();
        $row[0] = array($_SERER_CODE,$data['year'],$data['month'],$today['year'],$today['mon'],$this->Auth->user('admin_id'),$this->Auth->user('username'));
        $i = 1;
        $money = $_STUDENT_PAY_MONEY;
        foreach ($student as $dt):
            $row[$i] = array($dt['info']['username'], $dt['info']['firstname'] . $dt['info']['lastname'], $dt['count'] * $_STUDENT_PAY_MONEY, $dt['info']['address'], $dt['info']['phone_number'], $dt['info']['Student']['credit_account']);
            $i++;
        endforeach;
        foreach ($teacher as $dt):
            $row[$i] = array($dt['info']['username'], $dt['info']['firstname'] . $dt['info']['lastname'], $dt['count'] * $_TEACHER_PROFIT, $dt['info']['address'], $dt['info']['phone_number'], $dt['info']['Teacher']['bank_account']);
            $i++;
        endforeach;
        $end = array("END__END__END" . $data['year'] . $data['month']);
        $row[$i++] = $end;
        $str = "";
        $tab = "\t";
        $newLine = "\n";
        foreach ($row as $r):
            foreach ($r as $c):
                $str = $str . $c . $tab;
            endforeach;
            $str = $str . $newLine;
        endforeach;
        $filename = "ELS-UBT-".$data['year']."-".$data['month'].".tsv";

        file_put_contents($filename, $str);
        return $str;
    }

    function exportAccountFile() {
        if ($this->request->is('post')) {
            $data = $this->request->data;
            $str = $this->formatToWriteAccountFile($data);
            //Write to file 
            die;
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
        $this->User->id = $userId;
		$this->User->saveField('password',$result['User']['original_password']);            
        $this->redirect('userManage');
	}
	function resetVerifycode($userId){
		$this->loadModel('User');				
		$result  = $this->User->find('first',array(
			'conditions' => array('user_id' => $userId),
			'fields' => array('original_verifycode_answer','original_verifycode_question')
		));
        $this->User->id = $userId;
		$this->User->saveField('verifycode_answer',$result['User']['original_verifycode_answer']);
		$this->User->saveField('verifycode_question',$result['User']['original_verifycode_question']);
        $this->redirect('userManage');
	}

    function addCategory(){
        if($this->request->is('post')){
            $data = $this->request->data;
            // $data[0] = $data;
            debug($data);
            $category = $this->Category->findByName($data['Category']['name']);
            if($category){
                $this->Session->setFlash(__('This Category already Created!!!'));
            } else {
                // $this->Category->create();
                $this->Category->Save($data);
                $this->Session->setFlash(__('Successfully Created'));
            }
        }
    }
    function editCategory($id){
        $category = $this->Category->findByCategoryId($id);
        if($category){
            $this->set('Category',$category);
            debug($category);
        } else {
            throw new NotFoundException();
        }
        if($this->request->is('post')){
            $data = $this->request->data;
            debug($data);
            $category = $this->Category->findByName($data['Category']['name']);
            if($category){
                $this->Session->setFlash(__('This Category already Created!!!'));
            } else {
                // $this->Category->();
                $this->Category->Save($data);
                $this->Session->setFlash(__('Successfully Created'));
            }
        }
    }

    ///<summary>
    /// code by @dac
    ///<summary>
    function editUserProfile($userId){
        $this->loadModel('User');
        $result  = $this->User->find('first',array(
            'conditions' => array('user_id' => $userId)            
        ));
        if ($this->request->is('post')){                                  
            $this->request->data['profile_picture'] = $_FILES['profile_picture'];
            $data = $this->User->create($this->request->data);            
            $data['User']['user_id'] = $userId;            
            $isSaved = $this->User->save($data,true,array('mail','firstname','lastname','date_of_birth','phone_number','profile_picture'));
            if ($isSaved){
                if ($result['User']['user_type'] == 1){
                    $teacherData = array(
                        'Teacher' => array(
                            'teacher_id' => $result['User']['foreign_id'],
                            'bank_account' => $data['User']['account_number'],
                            'username' => $result['User']['username']
                            )
                        );
                        $this->loadModel('Teacher');            
                    if ($this->Teacher->save($teacherData)){                    
                        $this->Session->setFlash(__('Edit successful'));
 //                   $this->redirect(array('controller' => 'Teacher', 'action' => 'profile'));
                    }
                }
                else{
                    $studentData = array(
                        'Student' => array(
                            'student_id' => $result['User']['foreign_id'],
                            'credit_account' => $data['User']['account_number'],
                            'username' => $result['User']['username']
                            )
                        );  
                        $this->loadModel('Student');
                    if ($this->Student->save($studentData)){                    
                        $this->Session->setFlash(__('Edit successful'));                        
                    }
                }
                $this->redirect('#');
            }           
        }        
        if ($result['User']['user_type'] == 1){
            $this->loadModel('Teacher');
            $number = $this->Teacher->find('first',array('conditions' => array('teacher_id' => $result['User']['foreign_id'])));
            $accountNumber = $number['Teacher']['bank_account'];
        }
        else{
            $this->loadModel('Student');
            $number = $this->Student->find('first',array('conditions' => array('student_id' => $result['User']['foreign_id'])));
            $accountNumber = $number['Student']['credit_account'];
        }
        $result['User']['account_number'] = $accountNumber;
        $this->set('userData',$result['User']);
    }

    function statistic() {
        // App::uses('Utilities', 'Lib');
        // $util = new Utilities();
        // $this->set('util',$util);
        // $begin =  date_create('2014/01/01');        
        // $begin = date_format($begin,'Y-m-d');                        
        // $end = date('Y-m-d');         

        //================================
        //get Top 5 the most bought lesson 
        //================================
        $this->loadModel('LessonTransaction');
        $topLesson = $this->LessonTransaction->find('all',array(            
            'fields' => array('COUNT(transaction_id) as buy_num','coma_id'),
            'group' => 'coma_id',
            'order' => 'buy_num',
            'limit' => 5
        ));       
        //get rank of top lesson
        $this->loadModel('RateLesson');
        foreach($topLesson as $index => $lesson):
            $coma_id = $lesson['LessonTransaction']['coma_id'];
           $result = $this->RateLesson->find('all',array(
            'conditions' => array(
                'coma_id' => $coma_id
            ),
            'fields' => array('AVG(rate) as rate')
            ));                                               
           if (isset($result[0][0]['rate'])){
               $topLesson[$index]['rate'] = $result[0][0]['rate'];
           }       
           $topLesson[$index]['coma_id'] = $coma_id;
           unset($topLesson[$index]['LessonTransaction']);
           $topLesson[$index]['buy_num'] = $lesson[0]['buy_num'];
           unset($topLesson[$index][0]);
        endforeach;        

        //================================
        //get Top 5 teacher  
        //================================        
        $this->User->bindModel(array(
                'hasMany' => array(
                    'Lesson' => array(
                        'className' => 'Lesson',
                        'foreignKey' => 'author',                                         
                    )                   
                )                        
            )
        );   
        $this->loadModel('Lesson');
        $this->Lesson->bindModel(array(
            'hasMany' => array(
                'LessonTransaction' => array(
                    'className' => 'LessonTransaction',                    
                    'foreignKey' => 'coma_id'                    
                )
            )
        ));                     
        $topTeacher = $this->User->find('all',array(
            'contain' => array(                                  
                'Lesson' => array(             
                    'fields' => array(),
                    'LessoPnTransaction' => array(
                            'fields' => array('transaction_id')
                        )
                    )                
                ),
            'conditions' => array(
                'user_type' => 1
            ),            
            'fields' =>  array('username','profile_picture'),
            'recursive' => 3
        ));                
        foreach($topTeacher as $index => $money){
            $buy_num = 0;
            foreach($money['Lesson'] as $m){
                $buy_num = $buy_num + $m['LessonTransaction'].count();
            }
            $topTeacher[$index]['User']['buy_num'] = $buy_num;
            unset($topTeacher[$index]['Lesson']);            
        }        
        $this->set(compact(array('topTeacher','topLesson','topStudent')));  
    }

    function blockLesson($coma_id = null){
        if ($coma_id === null){
            echo "0";
            die;
        }else{
            $this->loadModel('Lesson');
            $this->Lesson->id = $coma_id;            
            $result = $this->Lesson->saveField('is_block',1);
            if ($result){
                echo "1";
            }
            else{
                echo "0";
            }
            die;
        }
    }

    function unBlockLesson($coma_id = null){
        if ($coma_id === null){
            echo "0";
            die;
        }else{
            $this->loadModel('Lesson');
            $this->Lesson->id = $coma_id;            
            $result = $this->Lesson->saveField('is_block',0);
            if ($result){
                echo "1";
            }
            else{
                echo "0";
            }
            die;
        }
    }

    function blockFile($file_id = null){
        if ($file_id === null){
            echo "0";
            die;
        }else{
            $this->loadModel('Data');
            $this->Data->id = $file_id;            
            $result = $this->Data->saveField('is_block',1,array('callbacks' => false));
            if ($result){
                echo "1";
            }
            else{
                echo "0";
            }
            die;
        }
    }

    function unBlockFile($file_id = null){
        if ($file_id === null){
            echo "0";
            die;
        }else{
            $this->loadModel('Data');
            $this->Data->id = $file_id;            
            $result = $this->Data->saveField('is_block',0,array('callbacks' => false));
            if ($result){
                echo "1";
            }
            else{
                echo "0";
            }
            die;
        }
    }

function deleteFile($file_id = null){
        if ($file_id === null){
            echo "0";
            die;
        }else{
            $this->loadModel('Data');
            $result = $this->Data->delete($file_id);
            if ($result){
                echo "1";
            }
            else{
                echo "0";
            }
            die;
        }
    }

    function deleteLesson($coma_id = null){
        if ($coma_id === null){
            echo "0";
            die;
        }else{
            $this->loadModel('Lesson');
            $result = $this->Lesson->delete($coma_id);
            if ($result){
                echo "1";
            }
            else{
                echo "0";
            }
            die;
        }
    }

    function changeConfig(){
        $this->loadModel('Config');
        if ($this->request->is('post')){
            $configs = $this->request->data;                        
            //format data array
            $data = array();
            $index = 0;
            foreach ($configs as $key=>$value):
                $data[$index]['Config']['config_id'] = $key;
                $data[$index]['Config']['value'] = $value;
                $index++;
            endforeach;        
            $fieldList = array('value');                    
            if ($this->Config->saveMany($data,array('fields' => $fieldList) ) ){
                $this->Session->setFlash(__('Successfully'));
            }
            $data = $configs;
        }
        if (!isset($data) || empty($data) ){
            $data = $this->Config->find('all',array('fields' => array('config_id','value')));
            //format data
            $dataToShow = array();
            foreach ($data as $d):
                $dataToShow[$d['Config']['config_id']] = $d['Config']['value'];
            endforeach;   
            $data = $dataToShow;         
        }
        $this->set(compact('data'));
    }
    
    function adminManage(){
        $paginate = array (
            'limit' => 5,
            'fields' => array (  
                'admin_id',
                'first_name',
                'last_name',
                'username'                
                )            
            );
        $this->Paginator->settings = $paginate;
        // $this->Paginator->options(array(
        // 'update' => '#content',
        // 'evalScripts' => true
        // ));
        $data = $this->Paginator->paginate ( 'Admin' );
        $this->set ( 'data', $data );
    }

    function deleteAdmin($id = null){
        if ($id === null){
            echo "0";
            die;
        }
        $result = $this->Admin->delete($id);
        if ($result){
            echo "1";
        }
        else{
            echo "0";
        }
        die;
    }

    function editAdmin($id = null){
        if ($id == null){
            return;
        }
        $error = array();
        $user_re_ex = '/^[A-Za-z]\w+$/';
        $pass_re_ex = '/^\w+$/';
        // If has data
        if ($this->request->isPost()) {
            $data = $this->request->data;            
            /*
             * Check username: 0: null 1: empty 2: not match form 3: min short 4: max long 5: is used
             */
            $check_admin = true;

            if (!isset($data ['Admin'] ['username'])) {
                $error ['username'] [0] = 'Username is equal null.';
                $check_admin = false;
            }

            if (empty($data ['Admin'] ['username'])) {
                $error ['username'] [1] = 'Username is empty.';
                $check_admin = false;
            } else {
                // if (!preg_match($user_re_ex, $data ['Admin'] ['username'])) {
                //     $error ['username'] [2] = 'Username is not match form.';
                //     $check_admin = false;
                // }

                if (strlen($data ['Admin'] ['username']) < 2) {
                    $error ['username'] [3] = 'Username is too short.';
                    $check_admin = false;
                }

                if (strlen($data ['Admin'] ['username']) > 30) {
                    $error ['username'] [4] = 'Username is too long.';
                    $check_admin = false;
                }               
            }
            // =================================

            /*
             * Check password: 0: null 1: empty 2: not match form 3: min short 4: max long
            */            

            // save data of user
            /*
             * username,password
             */            
            if ($check_admin == true) {
                //$this->Admin->create($data);
                //$this->Admin->id = $id; 
                $data['Admin']['admin_id'] = $id;
                $fields = array('first_name','last_name');                
                if ($this->Admin->save($data,array('fieldList' => $fields))){
                    $this->Session->setFlash(__('Edit Admin Successfully'));
                    $this->redirect('adminManage');
                }
                else{
                    $this->Session->setFlash(__('Error'));
                }
            }            
        }
        else{            
            $data = $this->Admin->findByAdminId($id);         
        }
        $this->set(compact('data'));
        $this->set('error', $error);            
    }  

    function changePasswordAdmin($id = null){
        if ($id === null){
            return;
        }
        $data = $this->Admin->findByAdminId($id);
        $username = $data['Admin']['username'];
        $this->set(compact('username'));
        if ($this->request->is('post')){
            $data = $this->request->data;
            $this->Admin->id = $id;
            if ($this->Admin->save($data))
                $this->Session->setFlash(__('Successfully'));
            else{ 
                $this->Session->setFlash(__('Error'));
            }
        }
    }
    ///==================
    /// end code by @dac
    ///==================
}

?>
