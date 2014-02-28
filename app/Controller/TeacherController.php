<?php
class TeacherController extends AppController {

	function index(){
		// home
	}
  
	function Register(){

		//Neu co' du lieu gui den
		if($this->request->is('post')){
			$data = $this->request->data;


			//xu li check

			//kiem tra bang NULL
			if(isset($data['username'])){
				return;
			}


			//kiem tra xau rong
			if(isset($data['username'])){
				return;
			}			




			//xong check
			// tien hanh luu du lieu vao Model
			// $this->Teacher->create($data);
			// $this->Teacher->save();
		}


	}

	function Profile(){

	}

	function EditProfile(){

	}
	
	function LessonManage(){

	}

	function Statistic(){

	}
	function ChangePassword(){
	}
	
	function CreateLesson() {
		
	}
	
	function  EditLession() {
	
	}

}
