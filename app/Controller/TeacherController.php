<?php
class TeacherController extends AppController {
    public $uses = array('User');

	function index(){
		// home
	}
  
	function Register(){

        $error = array();
        $user_re_ex='/^[A-Za-z]+\.[A-Za-z]+[0-9]{0,2}$/';
        //$pass_re_ex='/^.*(?=.{7,})(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9]).*$/';
        $pass_re_ex = '/^\w+$/';
		//If has data
		if($this->request->is('post')){
			$data = $this->request->data;
           /*
               Check username:
                0:  null
                1:  empty
                2:  not match form
                3:  min short
                4:  max long
                5:  is used
            */
    
			if(!isset($data['username'])){
                $error['username'][0] ='Username is equal null.';
			}
            
			if(empty($data['username'])){
                $error['username'][1] ='Username is empty.';
			}	
            else{
                if(!preg_match($user_re_ex,$data['username'])){
                    $error['username'][2] ='Username is not match form.'; 
                }

                if(strlen($data['username']) < 6){
                    $error['username'][3] ='Username is too short.';
                }

                if(strlen($data['username']) > 30){
                    $error['username'][4] ='Username is too long.';
                }

                $res = $this->User->find('all',array(
                    'conditions'=>array(
                        'User.username' => $data['username']
                    )));
                if(empty($res)){
                    //chua ton tai
                    //$error['username'] ='Username chua ton tai!';
                }else{
                    $error['username'][5] ='Username is exist.';
                }
            }
            //=================================
            
            /*
               Check password:
                0:  null
                1:  empty
                2:  not match form
                3:  min short
                4:  max long
            */
            if(!isset($data['password'])){
                $error['password'][0] ='Password is equal null.';
			}
            
			if(empty($data['password'])){
                $error['password'][1] ='Password is empty.';
			}
            else{
                if(!preg_match($pass_re_ex,$data['password'])){
                    $error['password'][2] ='Password is not match form.'; 
                }

                if(strlen($data['password']) < 8){
                    $error['password'][3] ='Password is too short.';
                }

                if(strlen($data['password']) > 30){
                    $error['password'][4] ='Password is too long.';
                }
            }
            
            /*
                Check RetypePassword
                0:  null
                1:  empty
                2:  not match with password
            */
            if(!isset($data['retypepassword'])){
                $error['retypepassword'][0] ='Password is equal null.';
			}
            
			if(empty($data['retypepassword'])){
                $error['retypepassword'][1] ='Password is empty.';
			}
            else{
                if(strcmp($data['retypepassword'],$data['password'])!=0){
                    $error['retypepassword'][2] ='Password and RetypePassword are not equal.';
                }
            }
            
            /*
                Check Name
                0:  null
                1:  empty
                2:  too long
            */
            if(!isset($data['name'])){
                $error['username'][0] ='Your name is equal null.';
			}
            
			if(empty($data['name'])){
                $error['name'][1] ='Your name is empty.';
			}	
            else{

                if(strlen($data['name']) > 30){
                    $error['name'][2] ='Your name is too long.';
                }
            }
            
            //=================================
			//xong check
			// tien hanh luu du lieu vao Model
			// $this->Teacher->create($data);
			// $this->Teacher->save();
       
		}
        $this->set('error', $error);
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
