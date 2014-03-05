<?php
class UserController extends AppController {

	function index(){
		$data = $this->User->find('all');
		debug($data);
		$this->set('data',$data);
	}
	function Comment() {
		
	}
}
