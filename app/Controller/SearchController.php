<?php
class SearchController extends AppController {
    public $uses = array('User');
    public $helpers = array('Html','Form');
	function index(){        
        $string = $this->request->query['string'];
        $this->set("string",$string);
	}
}
