<?php

class HomeController extends AppController {
	public $uses = array('User');

	function index(){
		$this->layout = "intro";
	}
}
