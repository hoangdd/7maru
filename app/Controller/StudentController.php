<?php
class StudentController extends AppController {

	function index(){

	}

	function Register(){
        if($this->request->isPost()){
            $this->log($this->request->data);
        }
	}


	function Profile(){

	}

	function EditProfile(){

	}

	function Destroy(){

	}

	function Statistic(){

	}

	function BuyLesson(){
		
	}
    function Test(){
    	
    }
    
    function DoTest() {
		
	}
	
	function ViewTestResult(){

	}

	function ChangePassword(){
		
	}
}
