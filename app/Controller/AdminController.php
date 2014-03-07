<?php

class AdminController extends AppController {

    public $uses = array('User', 'Admin');
    public $helpers = array('Js');
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

    function index() {
        
    }

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->userModel = 'Admin';
        $this->Auth->allow('login', 'logout');
        $this->Auth->allow('CreateAdmin');
        $this->Auth->allow('Notification');
    }

    function CreateAdmin() {
        $error = array();
        $user_re_ex = '/^[A-Za-z]\w+$/';
        $pass_re_ex = '/^\w+$/';
        //If has data
        if ($this->request->isPost()) {
            $data = $this->request->data;
            /*
              Check username:
              0:  null
              1:  empty
              2:  not match form
              3:  min short
              4:  max long
              5:  is used
             */
            $check_admin = true;

            if (!isset($data['Admin']['username'])) {
                $error['username'][0] = 'Username is equal null.';
                $check_admin = false;
            }

            if (empty($data['Admin']['username'])) {
                $error['username'][1] = 'Username is empty.';
                $check_admin = false;
            } else {
                if (!preg_match($user_re_ex, $data['Admin']['username'])) {
                    $error['username'][2] = 'Username is not match form.';
                    $check_admin = false;
                }

                if (strlen($data['Admin']['username']) < 6) {
                    $error['username'][3] = 'Username is too short.';
                    $check_admin = false;
                }

                if (strlen($data['Admin']['username']) > 30) {
                    $error['username'][4] = 'Username is too long.';
                    $check_admin = false;
                }

                $res = $this->Admin->find('all', array(
                    'conditions' => array(
                        'Admin.username' => $data['Admin']['username']
                )));
                if (empty($res)) {
                    //chua ton tai
                    //$error['username'] ='Username chua ton tai!';
                } else {
                    $error['username'][5] = 'Username is exist.';
                    $check_admin = false;
                }
            }
            //=================================

            /*
              Check password:
              0:  null
              1:  empty
              2:  not match form
              3:  min short
              4:  max long
             */
            $check_admin_password = true;
            if (!isset($data['Admin']['password'])) {
                $error['password'][0] = 'Password is equal null.';
                $check_admin = false;
            }

            if (empty($data['Admin']['password'])) {
                $error['password'][1] = 'Password is empty.';
                $check_admin = false;
            } else {
                if (!preg_match($pass_re_ex, $data['Admin']['password'])) {
                    $error['password'][2] = 'Password is not match form.';
                    $check_admin = false;
                }

                if (strlen($data['Admin']['password']) < 8) {
                    $error['password'][3] = 'Password is too short.';
                    $check_admin = false;
                }

                if (strlen($data['Admin']['password']) > 30) {
                    $error['password'][4] = 'Password is too long.';
                    $check_admin = false;
                }
            }

            /*
              Check RetypePassword
              0:  null
              1:  empty
              2:  not match with password
             */
            if (!isset($data['retypepassword'])) {
                $error['retypepassword'][0] = 'Password is equal null.';
                $check_admin = false;
            }

            if (empty($data['retypepassword'])) {
                $error['retypepassword'][1] = 'Password is empty.';
                $check_admin = false;
            } else {
                if (strcmp($data['retypepassword'], $data['Admin']['password']) != 0) {
                    $error['retypepassword'][2] = 'Password and RetypePassword are not equal.';
                    $check_admin = false;
                }
            }

            //save data of user
            /*
             *   username,password
             */
            $data_admin = array(
                'username' => $data['Admin']['username'],
                'password' => $data['Admin']['password'],
            );
            if ($check_admin == true) {
                $this->Admin->create($data_admin);
                $this->Admin->save();
            }
        }
        $this->set('error', $error);
    }

    function Notification() {
        $data = $this->User->find('all');
        $this->set("data", $data);
    }

    function login() {

        if ($this->request->is('post')) {
            $data = $this->request->data['Admin'];
            $this->request->data['Admin']['password'] = (string) ($data['username'] . $data['password']);
            //debug($this->Admin->hashPassword($data));die;
            if ($this->Auth->login()) {
                // Login success
                $this->Session->setFlash(__("Login success"));
            } else {
                //Login fail
                $this->Session->setFlash(
                        __('Username or password is incorrect'), 'default', array(), 'auth'
                );
            }
        }
    }

    function logout() {
        $this->Auth->logout();
        $this->redirect(array(
            'controller' => 'Home',
            'action' => 'index'
        ));
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
                        'controller' => 'Admin',
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

    function ipManage() {
        
    }

    function statistic() {
        
    }

    function account() {
        
    }

    function userManage() {
        $this->autorender = false;
        //$this->layout = 'ajax';        
        $paginate = array(
            'limit' => 5,
            'fields' => array('User.firstname', 'User.lastname', 'User.username', 'User.date_of_birth', 'User.user_type', 'User.created')
        );
        $this->Paginator->settings = $paginate;
        $data = $this->Paginator->paginate('User');
        $this->set('data', $data);
    }

    function blockUser() {
        
    }

    function ip_manage() {
//     	$data = $this->
        $totalIp = array('1', '2', '3', '4', '5', '6', '7');
        $i = 1;
        $arrayItem;
        $arrayFinal;
        foreach ($totalIp as $item) {
            if ($i % 3 == 1)
                $arrayItem = array($item);
            else
                $arrayItem = array_merge($arrayItem, array($item));
            if ($i % 3 == 0) {
                if ($i / 3 <= 1) {

                    $arrayFinal = array('1' => $arrayItem);
                } else {

                    $ij = $i / 3;
                    $arrayFinal += array($ij => $arrayItem);
                }
            }
            $i++;
        }

        if ($i % 3 != 0) {
            $ij = $i / 3 + 1;
            if ($i / 3 == 0)
                $arrayFinal = array($ij => $arrayItem);
            else
                $arrayFinal += array($ij => $arrayItem);
        }
        $this->set("array_list", $arrayFinal);
    }

    //...
}
