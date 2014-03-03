<?php
class AdminController extends AppController {
    public $uses = 'User';
    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow(array('index'));
        $this->Auth->allow(array('Notification'));
        $this->Auth->allow(array('CreateAdmin'));
    }
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
        
    }
    function blockUser(){
        
    }
	//...
}
