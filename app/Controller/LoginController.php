<?php

//App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
class LoginController extends AppController {

    public $helpers = array("Html", 'Session');
    public $uses = array('User');

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
            $this->request->data['User']['password'] = (string)($data['username'] . $data['password']);
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
            } else {
            //Login fail
                $this->Session->setFlash(
                    __('Username or password is incorrect'), 'default', array(), 'auth'
                    );
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

}
