<?php

class HomeController extends AppController {
	public $uses = array('User');

	public function beforeFilter(){
		parent::beforeFilter();
		$this->Auth->allow('index');
	}

	function index(){
		$this->layout = "intro";
		$user = $this->Auth->User();
		if(empty($user)){
			//not login
			$user = array('role' => 'R4');
		}
		$this->set('user', $user);
	}
}
