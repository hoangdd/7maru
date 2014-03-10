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
            'loginRedirect' =>array(
                'controller' => 'Home',
                'action' => 'index'
            ),
            'authError' => 'You don\'t have permission to view this page',
        ),
    );
    public function beforeFilter() {        
        parent::beforeFilter();
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
            $data = $this->request->data['User'];
            $matchinghis->request->data['User']['password'] = (string)($data['username'] . $data['password'].FILL_CHARACTER);                                 
            if (isset($_SESSION['countFail'])){
                if ($_SESSION['countFail'] >= 3){

                //check verifycode and password
                    $answer = $this->Auth->password($this->request->data['User']['username'].$this->request->data['answer'].FILL_CHARACTER);                    
                    $question = $this->Auth->password($this->request->data['User']['username'].$this->request->data['question'].FILL_CHARACTER);            
                    debug($answer);
                    debug($question);
                    $result = $this->User->find('all',array('verifycode_answer' => $answer,'verifycode_question' => $question));
                    if ($result == null){                        
                     $this->Session->setFlash(__('Verifycode is incorrect'), 'default', array(), 'verifycode');
                     return;                   
                 }
                 unset($_SESSION['countFail']);
             }
            }
            if ($this->Auth->login()) {                              
                // Login success                
                $userType = $this->Auth->user('user_type');
                if( $userType==1 || $userType=='1'){    
                    $this->Session->write('Auth.User.role', 'R2');
                }else if( $userType==2 || $userType=='2'){ 
                    $this->Session->write('Auth.User.role', 'R3');
                }
                $this->Session->setFlash(__("Login success"));
                $this->redirect($this->Auth->redirectUrl());
                unset($_SESSION['countFail']);
            } else {
            //Login fail
                $this->Session->setFlash(
                    __('Username or password is incorrect'), 'default', array(), 'auth'
                    );          
                if (!isset($_SESSION['countFail'])){
                    $_SESSION['countFail']= 1;     
                }                               
                else{
                    ++$_SESSION['countFail'];                    
                }
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
            $user = $this->User->find('first', array(
                'conditions' => array(
                    'User.user_id' => $this->Auth->User('user_id'),
                    ),
                ));

            /* Check current password to password in database
             * If valid then update new Password
             */

            if ($this->Auth->password($this->Auth->user('username') . $current) === $user['User']['password']) {
                $hashNewPassword = $this->Auth->password($this->Auth->user('username') . $new);
                $updatePassword = $this->User->updateAll(
                    array(
                        'User.password' => "'" . $hashNewPassword . "'"
                        ), array(
                        'User.user_id' => $this->Auth->User('user_id')
                        )
                        );
                if ($updatePassword) {
                    $this->Session->setFlash('The user has been saved');
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
        $this->Auth->logout();
        $this->redirect(array(
            'controller' => 'Home',
            'action' => 'index'
            ));
    }

    function checkVerifycode($username = null,$verifycode = null){
        if ( $username ==null || $verifycode == null ){            
            $_SESSION['verifycode'] = false;
            return false;        
        }
        else{
            $hash = $this->Auth->password($username.$verifycode);
            $result = $this->User->find('all',array(
                'conditions' => array(
                        'User.username' => 'username',
                        'User.verifycode' => $hash
                    )
                ));
            if ($result){
                $_SESSION['verifycode'] = true;
            }
            $_SESSION['verifycode'] = false;
        }

    }
}
