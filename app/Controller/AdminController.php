<?php
class AdminController extends AppController {
    public $uses = array('User');
    public $components = array('Paginator','RequestHandler');
	function index(){

	}
    
    function CreateAdmin(){
        
    }
    function Notification(){
        
    }
    
    function login(){

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
