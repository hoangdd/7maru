<?php

class LoginController extends AppController {

    public $helpers = array("Html");
    public $uses = array('User');

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow(array('index'));
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
//        $data = array();
////        var_dump($_SESSION);
//        if ($this->request->is('post')) {
//            $this->User->set($this->request->data);
//            if ($this->User->validates()) {
//                // it validated logic
//                if (isset($_POST['ok'])) {
//                    $username = $_POST['username'];
//                    $password = $_POST['password'];
//
//                    $data['res'] = $this->User->find('first', array(
//                        'conditions' => array(
//                            'User.username' => $username,
//                        ),
//                    ));
//                    $_sessionUsername = $data['res']['User']['username'];
//
//                    //var_dump($data['res']);die;
//                    if (!empty($data['res'])) {
//                        if ($data['res']['User']['password'] === $password) {
//                            $this->Session->write('username', $_sessionUsername);
//                            $this->redirect("../Home/index");
//                        }
//                    } else {
//                        //debug($res);
//                        $data['errorLogin'] = 'Username or password invalid';
//                    }
//                }
//            } else {
//                // didn't validate logic
//                $data['errors'] = $this->User->validationErrors;
//            }
//        }
//        $this->set('data', $data);
        if ($this->request->is('post')) {
           //$this->render('sql');
            $hashPass =  $this->Auth->password($this->request->data['User']['username'].$this->request->data['User']['password']);                        
            $user = $this->User->find('all',array(
                    'conditions' => array(
                            'username' => $this->request->data['User']['username'],
                            'password' => $hashPass
                        )
                ))   ;            
            if (!empty($user)) {              
                return $this->redirect($this->Auth->redirect());
            }else{
            $this->Session->setFlash(__('Invalid username or password, try again'));}
        }
    }

    //---------- Logout 
    function logout() {
//        $this->Session->delete('username');
//        $this->redirect("index");
        return $this->redirect($this->Auth->logout());
    }

}
