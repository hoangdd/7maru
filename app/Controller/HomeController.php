<?php

class HomeController extends AppController {
	public $uses = array('User');

	public function beforeFilter(){
		parent::beforeFilter();
		$this->Auth->allow('index');
	}

	function index(){
		$this->layout = "intro";
		if ($this->Auth->loggedIn()){			
			$user = $this->Auth->User();
			if ($user['role'] !== 'R1'){
				$this->loadModel('Notification');
		 		$notifyNum = $this->Notification->find('count',array('conditions' => array('user_id' => $user['user_id'], 'viewed' => 0)));		
		 		$user['notify_num'] = $notifyNum;
	 		}
 		}
		//$notifyNum = $this->Notification->find('count',array('conditions' => array('user_id' => $user['user_id'])));
		if(empty($user)){
			//not login
			$user = array('role' => 'R4');
		}		
		$this->set(compact('user'));
	}
}
