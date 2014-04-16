<?php
class SearchController extends AppController {
    public $uses = array('User','Category' ,'LessonCategory');
    public $helpers = array('Html','Form');

    // search
	function index(){
		$q = $this->request->query;
		$this->set('categories', $this->Category->find('all'));
		if( !empty($q)){
			debug($q);
			die;
		}
	}

	function tag( $id = null){

	}
}
