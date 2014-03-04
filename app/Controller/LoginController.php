<?php

class LoginController extends AppController {

    public $helpers = array("Html",'Session');
    public $uses = array('User');
    public function beforeFilter(){
        parent::beforeFilter();
        $this->Auth->allow('index');
    }
    function changePassword() {
        //var_dump($Articles);
        // debug($this->request->data);
        $data = array();
        $_sessionUsername = $this->Session->read('username');
        if ($_sessionUsername) {
            if ($this->request->is('post')) {
                //   debug($this->request->data);
                //$this->User->set($this->request->data);
                if (isset($_POST['ok'])) {
                    $currentPassword = $_POST['currentPassword'];
                    $newPassword = $_POST['newPassword'];
                    //debug($newPassword);die;
                    $data['res'] = $this->User->find('first', array(
                        'conditions' => array(
                            'User.username' => $_sessionUsername,
                        ),
                    ));

                    if ($currentPassword === $data['res']['User']['password']) {
                        if ($_POST['newPassword'] === $_POST['confirmPassword']) {

//                            $user_id = '123';
                            $updatePassword = $this->User->updateAll(
                                    array('User.password' => "'" . $newPassword . "'"), array('User.username' => $_sessionUsername)
                            );
                            echo 'x';
                            die;
                            if ($updatePassword) {
                                debug($updatePassword);
                                $data['errorCurrentPassword'][0] = 'The user has been saved';
                                //$this->redirect('../Home/index');
                            } else {
                                $data['errorCurrentPassword'][1] = 'The user could not be saved. Please, try again.';
                            }
                        } else {
                            $data['errorCurrentPassword'][2] = 'Password do not match';
                        }
                    } else {
                        $data['errorCurrentPassword'][3] = 'Current password invalid';
                    }
                }
            } else {
                // didn't validate logic
                $data['errors'] = $this->User->validationErrors;
            }
        } else {
            $this->redirect('/login/index');
        }
    }

    function index() {
        if($this->request->is('post')){
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

    //---------- Logout 
    function logout() {
        $this->Auth->logout();
        $this->redirect(array(
            'controller' => 'Home',
            'action' => 'index'
            ));
    }

}
