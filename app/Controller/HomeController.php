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
		$this->loadModel('Notification');
// 		$notifyNum = $this->Notification->find('count',array('conditions' => array('user_id' => $user['user_id'], 'viewed' => 0)));		
		$notifyNum = $this->Notification->find('count',array('conditions' => array('user_id' => $user['user_id'])));
		if(empty($user)){
			//not login
			$user = array('role' => 'R4');
		}
		$user['notify_num'] = $notifyNum;
		$this->set(compact('user'));
	}
}
