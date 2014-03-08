<?php
class UserController extends AppController {

	function index(){
		$data = $this->User->find('all');
		$this->set('data',$data);
	}
	function Comment() {
		
	}
}
