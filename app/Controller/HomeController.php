<?php

class HomeController extends AppController {
	public $uses = array('User');

	public function beforeFilter(){
		parent::beforeFilter();
		$this->Auth->allow('index');
	}

	function index(){
		$this->layout = "intro";
	}
}
