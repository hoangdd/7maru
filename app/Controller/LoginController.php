<?php

class LoginController extends AppController {

    public $helpers = array("Html",'Session');
    public $uses = array('User');
    public function beforeFilter(){
        parent::beforeFilter();
        $this->Auth->allow('index');
    }

    function index() {
        if($this->request->is('post')){
            $data = $this->request->data['User'];
            $this->request->data['User']['password'] = $data['username'].$data['password'];
            if($this->Auth->login()){
                // Login success
                $this->Session->setFlash(__("Login success"));
                $this->redirect($this->Auth->redirectUrl());
            }else{
                //Login fail
                $this->Session->setFlash(
                    __('Username or password is incorrect'),
                    'default',
                    array(),
                    'auth'
                );
            }
        }
    }

    function changePassword() {      
       if ($this->request->is('post')) {

            $data = $this->request->data;
            $current = $this->User->hashPassword($data['current-pw']);
            $new = $data['new-pw'];
            $confirm = $data['confirm-pw'];
            
            $error[] = $this->User->validationErrors;
            

            if( $new!=$confirm ) {
                $error[] = 'Password do not match';
                return;
            }

            $user = $this->User->find('first', array(
                'conditions' => array(
                    'User.username' => $this->Auth->User('username'),
                ),
            ));

            if ( $current === $user['User']['password'] ) {
                    $updatePassword = $this->User->updateAll(
                        array(
                            'User.password' => "'" . $new . "'"
                            ), 
                        array(
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
                        $error[] = 'The user could not be saved. Please, try again.';
                    }
            } else {
                $error[] = 'Current password invalid';
            }
            // didn't validate logic
            $this->set('error', $error);
        }
            
    }

    

    //---------- Logout 
    function logout() {
        $this->Auth->logout();
        $this->redirect(array(
            'controller' => 'Home',
            'action' => 'index'
            ));
    }

}
