<?php
class LessonController extends AppController {
	function index(){
		 App::uses('Utilities', 'Lib');
		 $util = new Utilities();
		 $this->set('util',$util);
	}

	function NewLesson(){

	}

	function Edit(){

	}

	function Destroy(){
		
	}
	function View(){
		
	}
}
