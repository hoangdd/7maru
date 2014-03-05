<?php
class AdminController extends AppController {
    public $uses = array('User');
    public $components = array(
        'Auth' => array(
            'authenticate' => array(
                'Form' => array(
                    'userModel' => 'Admin',
                    'fields' => array(
                        'username' => 'username',
                        'password' =>'password',
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
            'loginRedirect' =>array(
                'controller' => 'Admin',
                'action' => 'index'
            ),
            'authError' => 'You don\'t have permission to view this page',
        ),
        'Paginator',
        'RequestHandler'
        );

    public function beforeFilter(){
        parent::beforeFilter();
        $this->Auth->userModel = 'Admin';
        $this->Auth->allow('login','logout');
    }
	function index(){
         
	}
    
    function CreateAdmin(){

    }
    function Notification(){
        
    }
    
    function login(){
        if($this->request->is('post')){
            $data = $this->request->data['Admin'];
            $this->request->data['Admin']['password'] = $data['username'].$data['password'];
            if($this->Auth->login()){
                // Login success
                $this->Session->setFlash(__("Login success"));

                return $this->redirect($this->Auth->redirect());
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

    function logout(){
        $this->Auth->logout();
        $this->redirect(array(
            'controller' => 'Home',
            'action' => 'index'
        ));
    }

    function changePassword(){
    	
    }
    function ipManage(){
    }

    function statistic(){

    }

    function account(){

    }        
    function userManage(){
         $paginate = array(
        'limit' => 10,
        'fields' => array('User.firstname','User.lastname','User.username','User.date_of_birth','User.user_type','User.created')
             
    ); 
        $this->Paginator->settings = $paginate;
        // $this->Paginator->options(array(
        //     'update' => '#content',
        //     'evalScripts' => true
        //     ));
         $data = $this->Paginator->paginate('User');
        $this->set('data', $data);
    }
    function blockUser(){
        
    }
	//...
}
