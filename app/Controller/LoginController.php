<?php

//App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
class LoginController extends AppController {

    public $helpers = array("Html", 'Session');
    public $uses = array('User');      
    public $components = array(
        'Session',
        'DebugKit.Toolbar',        
        'Auth' => array(
            'authenticate' => array(
                'Form' => array(
                    'userModel' => 'User',
                    'fields' => array(
                        'username' => 'username',
                        'password' =>'password',
                    ),
                    'passwordHasher' => array(
                        'className' => 'Simple',
                        'hashType' => 'sha1'
                    ),
                    'scope' => array('User.approved' => 1,'User.activated' => 1)
                ),              
            ),
            'loginAction' => array(
                'controller' => 'Login',
                'action' => 'index',
            ),
            'logoutRedirect' => array(
                'controller' => 'Login', 
                'action' => 'index'
            ),
            'loginRedirect' =>array(
                'controller' => 'Home',
                'action' => 'index'
            )
            //'authError' => 'You don\'t have permission to view this page',
        ),
    );
    public function beforeFilter() {        
        parent::beforeFilter();
        $this->Auth->autoRedirect = false;
        $this->Auth->allow('confirmVerifycode');
        $this->Auth->allow('Login/index');
        $this->Auth->allow('logout');
        
    }
    function index() {        
        //check loggedIn();                
        if($this->Auth->loggedIn()){
            $this->redirect(array(
                'controller' => 'home',
                'action' => 'index',
                ));
        }  
        if ($this->request->is('post')) {                       
            //$clientIp = $this->request[] 
            $this->_initalBlockStage();              
            $isCheckIp = true;   
            if (!isset($_SESSION['isValidIp'])){
                $_SESSION['isValidIp'] = array();
            }                
			if (isset($this->request->data['User'])){                
                    $data = $this->request->data['User'];
                    $isCheckIp = true;
                    if (!isset($_SESSION['isValidIp'][$data['username']])){
                         $_SESSION['isValidIp'][$data['username']] = true;
                    }  
                    if (!$_SESSION['isValidIp'][$data['username']]){
                        $this->redirect(array('controller' => 'login','action' => 'confirmVerifycode',$data['username'],2));
                    }
                    $errorLoginTimes = Configure::read('customizeConfig.error_login_times');                
                     
                     if(empty($data['username'])){
                        return;
                     }
                      $isBlock = 0;                
                if (!empty($data['username'])){                    
                    $this->_initalBlockStage($data['username']);
                    //check if is blocking then redirect to confirm verifycode page                
                   if ($_SESSION['count_to_block'][$data['username']] >= $errorLoginTimes){
                        $blockTime = Configure::read('customizeConfig.block_time');
                        $remain_block = $blockTime-(time() - $_SESSION['start_block_time'][$data['username']]);                        
                        //check remain block time
                        if ($remain_block < 0 ){
                            $this->redirect(array('controller' => 'login','action' => 'confirmVerifycode',$data['username'],1));
                        }
                        else{
                            $isBlock = $remain_block;                        
                        }
                    }
                }
                // set remain time block to show 
                $this->set(compact('isBlock'));
                $this->set('username',$data['username']);
                if ($isBlock > 0){
                    return;
                }                

            //}
            if (!empty($data['username'])){                            
                $this->request->data['User']['password'] = (string)($data['username'] . $data['password'].FILL_CHARACTER);
            }            

            if ($this->Auth->login()) {   
                //check IP                
                // Login success                 
                $this->_resetBlockStage($data['username']);
                $userType = $this->Auth->user('user_type');                
                if( $userType==1 || $userType=='1'){
                    //check IP
                    // if not confirm successfully verifycode                     
                    $clientIp = $this->request->clientIp();
                    $login_ip = $this->Auth->user('login_ip');
                    $isCheckIp = true;
                    if (empty($login_ip)){                      
                        $clientIp = $this->request->clientIp();                        
                        $this->User->id = $this->Auth->user('user_id');
                        $this->User->saveField('login_ip', $clientIp,array('callbacks' => false));
                    }                                    
                    else {                        
                        if (!$this->_isValidIp($clientIp, $this->Auth->user('login_ip'))){
                            $_SESSION['isValidIp'][$data['username']] = false;                            
                            $this->Session->setFlash(__('Login with invalid IP'));                              
                            $this->Auth->logout();
                            $this->redirect(array('controller' => 'login','action' => 'confirmVerifycode',$data['username'],2));  

                        }               
                    } 
                    $this->Session->write('Auth.User.role', 'R2');                                                                            
                }else if( $userType==2 || $userType=='2'){ 
                    $this->Session->write('Auth.User.role', 'R3');
                }
                $this->Session->setFlash(__("Login success"));                    
                return $this->redirect($this->Auth->loginRedirect);
            } 
            else {
            //Login fail                                
                $this->Session->setFlash(__('Username or password is incorrect'), 'default', array(), 'auth');          
                //increase count block
                ++$_SESSION['count_to_block'][$data['username']];
                // fail many times enough to block
                if ($_SESSION['count_to_block'][$data['username']] == $errorLoginTimes){
                    $_SESSION['start_block_time'][$data['username']] = time();                     
                    $blockTime = Configure::read('customizeConfig.block_time');                                                
                    $this->set('isBlock',$blockTime);                    
                }
            }    
        }
        else{
            die;
        }
    }    
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
                    if (strlen($new) < 2) {
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
            $user = $this->User->find('first', array(
                'conditions' => array(
                    'User.user_id' => $this->Auth->User('user_id'),
                    ),
                ));

            /* Check current password to password in database
             * If valid then update new Password
             */

            if ($this->Auth->password($this->Auth->user('username') . $current.FILL_CHARACTER) === $user['User']['password']) {
                $hashNewPassword = $this->Auth->password($this->Auth->user('username') . $new.FILL_CHARACTER);
                $this->User->id = $this->Auth->user('user_id');
                $updatePassword = $this->User->saveField('password',$hashNewPassword,array('callbacks' => false));
                if ($updatePassword) {
                    $this->Session->setFlash(__('Change password').__('Successfully') );
                    if ($this->Auth->user('user_type')==1) {
                        # code...
                        $this->redirect(array(
                            'controller' => 'Teacher',
                            'action' => 'Profile',
                            ));
                    }elseif ($this->Auth->user('user_type')==2){
                        # code...
                        $this->redirect(array(
                            'controller' => 'Student',
                            'action' => 'Profile',
                            ));
                    }
                } else {
                    $this->Session->setFlash('The user could not be saved. Please, try again.');
                }
            } else {
                $error['current'] = 'Current password invalid';
            }

            $this->set('error', $error);
        }
    }

    function changeVerifycode() {
        
        if ($this->request->is('post')) {

            // Get data from view via $data
            $data = $this->request->data;

            $current = $data['current-pw'];
            $newAnswer = $data['new-answer'];
            $newQuestion = $data['new-question'];            
            $error = array();
            //$error[] = $this->User->validationErrors;
            //Check NULL data requested

            if (empty($current)) {
                $error['current'] = 'This field is required';
            }
            // if (empty($new)) {
            //     $error['new'] = 'This field is required';
            // }
            // if (empty($confirm)) {
            //     $error['confirm'] = 'This field is required';
            // }

            if (empty($current) || empty( $newAnswer) || empty($newQuestion) ) {
                $this->set('error', $error);
                return;
            }

            // Check $new validate ?
            // if ($this->User->validates(array('fieldList' => array('password' => $new)))) {
            //     // Check matching between $new and $confirm
            //     if ($new != $confirm) {
            //         $error['confirm'] = 'Password do not match';
            //         $this->set('error', $error);
            //         return;
            //     }else{
            //         if (strlen($new) < 2) {
            //             $error['new'] = 'Password is too short.';
            //             $this->set('error', $error);
            //             return;
            //         }

            //         if (strlen($new) > 30) {
            //             $error['new'] = 'Password is too long.';
            //             $this->set('error', $error);
            //             return;
            //         }
            //     }
            // } else {
            //     $error['new'] = 'Password format is wrong';
            //     $this->set('error', $error);
            //     return;
            // }

            // Access to table User with user_id got from Session, Auth
            $user = $this->User->find('first', array(
                'conditions' => array(
                    'User.user_id' => $this->Auth->User('user_id'),
                    ),
                ));

            /* Check current password to password in database
             * If valid then update new Password
             */

            if ($this->Auth->password($this->Auth->user('username') . $current.FILL_CHARACTER) === $user['User']['password']) {
                $hashNewQuestion = $this->Auth->password($this->Auth->user('new_question') . $newQuestion.FILL_CHARACTER);
                $hashNewQuestion = $this->Auth->password($this->Auth->user('new_answer') . $newAnswer.FILL_CHARACTER);
                $this->User->id = $this->Auth->user('user_id');
                $this->User->saveField('verifycode_question',$hashNewQuestion,array('callbacks' => false));
                $result = $this->User->saveField('verifycode_answer',$hashNewQuestion,array('callbacks' => false));

                // $updatePassword = $this->User->updateAll(
                //     array(
                //         'User.password' => "'" . $hashNewPassword . "'"
                //         ), array(
                //         'User.user_id' => $this->Auth->User('user_id')
                //         )
                //         );
                if ($result) {
                    $this->Session->setFlash(__('Successfully'));
                    $this->redirect(array(
                        'controller' => 'Home',
                        'action' => 'index',
                        ));
                } else {
                    $this->Session->setFlash('The user could not be saved. Please, try again.');
                }
            } else {
                $error['current'] = 'Current password invalid';
            }

            $this->set('error', $error);
        }
    }
    
    function logout() {
        $this->redirect($this->Auth->logout());
    }

    private function _isValidIp($orgIp, $newIp){
        return ($orgIp == $newIp);
    }

    private function _initalBlockStage($username = null){
        if ($username == null){
            if (!isset($_SESSION['count_to_block']))
                $_SESSION['count_to_block'] = array();
            if (!isset($_SESSION['start_block_time']))
                $_SESSION['start_block_time'] = array();
        }
        else{
            if (!isset($_SESSION['count_to_block'][$username]))
                $_SESSION['count_to_block'][$username] = 1;                        
        }
    }  

    private function _resetBlockStage($username){
        $_SESSION['count_to_block'][$username] = 1;
    }

    public function confirmVerifycode($username,$type){
        $this->set(compact('username'));
        if ($this->request->is('post')){
            $data = $this->request->data['User'];
            $answer = "";$question ="";    
            if (isset($data['username']) && isset($data['answer']) && isset($data['question'])){
                $username = $data['username'];
                $answer = $this->Auth->password($username.$data['answer'].FILL_CHARACTER);
                $question = $this->Auth->password($username.$data['question'].FILL_CHARACTER);                                                
                $result = $this->User->find('first',
                  array(
                     'conditions' => array(
                        'username' => $username,
                        'verifycode_answer' => $answer,
                        'verifycode_question' => $question
                        )));                                                  
                if ( ($result == null) || empty($result)){                                                            
                    $this->Session->setFlash(__('Verifycode is incorrect'));                                        
                }
                else{
                    if ($type == 1){
                        $this->_resetBlockStage($username);                        
                    }
                    else{                        
                        $_SESSION['isValidIp'][$username] = true;                        
                        $clientIp = $this->request->clientIp();                        
                        $this->User->id = $result['User']['user_id'];                        
                        $this->User->saveField('login_ip', $clientIp,array('callbacks' => false));
                    }
                    $this->redirect(array('controller' => 'Login','action' => 'index'));
                }
            }
        }
    }

}
