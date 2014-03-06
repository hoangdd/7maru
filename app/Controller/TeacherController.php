<?php
class TeacherController extends AppController {
    public $uses = array('User','Teacher');

	function index(){
		// home
	}
  
	function Register(){

        $error = array();
        //$user_re_ex='/^[A-Za-z]+\_[A-Za-z]+[0-9]$/'; 
        $user_re_ex = '/^[A-Za-z]\w+$/';
        //$pass_re_ex='/^.*(?=.{7,})(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9]).*$/';
        $pass_re_ex = '/^\w+$/';
        $email_re_ex ='[a-z0-9\\._]*[a-z0-9_]@[a-z0-9][a-z0-9\\-\\.]*[a-z0-9]\\.[a-z]{2,6}$';
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
            $check_user= true;
            
			if(!isset($data['username'])){
                $error['username'][0] ='Username is equal null.';
                $check_user = false;
			}
            
			if(empty($data['username'])){
                $error['username'][1] ='Username is empty.';
                $check_user = false;
			}	
            else{
                if(!preg_match($user_re_ex,$data['username'])){
                    $error['username'][2] ='Username is not match form.'; 
                    $check_user = false;
                }

                if(strlen($data['username']) < 6){
                    $error['username'][3] ='Username is too short.';
                    $check_user = false;
                }

                if(strlen($data['username']) > 30){
                    $error['username'][4] ='Username is too long.';
                    $check_user = false;
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
                    $check_user = false;
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
            $check_user_password = true;
            if(!isset($data['password'])){
                $error['password'][0] ='Password is equal null.';
                $check_user = false;
			}
            
			if(empty($data['password'])){
                $error['password'][1] ='Password is empty.';
                $check_user = false;
			}
            else{
                if(!preg_match($pass_re_ex,$data['password'])){
                    $error['password'][2] ='Password is not match form.'; 
                    $check_user = false;
                }

                if(strlen($data['password']) < 8){
                    $error['password'][3] ='Password is too short.';
                    $check_user = false;
                }

                if(strlen($data['password']) > 30){
                    $error['password'][4] ='Password is too long.';
                    $check_user = false;
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
                $check_user = false;
			}
            
			if(empty($data['retypepassword'])){
                $error['retypepassword'][1] ='Password is empty.';
                $check_user = false;
			}
            else{
                if(strcmp($data['retypepassword'],$data['password'])!=0){
                    $error['retypepassword'][2] ='Password and RetypePassword are not equal.';
                    $check_user = false;
                }
            }
            
            /*
                Check FirstName and LastName
                0:  null
                1:  empty
                2:  too long
            */
            if(!isset($data['firstname'])){
                $error['firstname'][0] ='First name is equal null.';
                $check_user = false;
			}
            
			if(empty($data['firstname'])){
                $error['firstname'][1] ='First name is empty.';
                $check_user = false;
			}	
            else{

                if(strlen($data['firstname']) > 30){
                    $error['firstname'][2] ='First name is too long.';
                    $check_user = false;
                }
            }
            //==================================
            if(!isset($data['lastname'])){
                $error['lastname'][0] ='Last name is equal null.';
                $check_user = false;
			}
            
			if(empty($data['lastname'])){
                $error['lastname'][1] ='Last name is empty.';
                $check_user = false;
			}	
            else{

                if(strlen($data['lastname']) > 30){
                    $error['lastname'][2] ='Last name is too long.';
                    $check_user = false;
                }
            }
            //check email
           if(!isset($data['mail'])){
                $error['mail'][0] ='Email is equal null.';
                $check_user = false;
			}
			if(empty($data['mail'])){
                $error['mail'][1] ='Email is empty.';
                $check_user = false;
			}
            //=================================
            
            $check_teacher = true;
            //check bank_account
            if(!isset($data['bank_account'])){
                $error['bank_account'][0] ='Bank account is equal null.';
                $check_teacher = false;
			}
			if(empty($data['bank_account'])){
                $error['bank_account'][1] ='Bank account is empty.';
                $check_teacher = false;
			}
            //=================================
            
            //check phone number
            
			if(!empty($data['phone_number'])){
                if(strlen($data['phone_number']) < 10){
                    $error['phone_number'][0] ='Phone number is too short.';
                }

                if(strlen($data['phone_number']) > 15){
                    $error['phone_number'][1] ='Phone number is too long.';
                }
            }
            //====================================
			//xong check
            
			// tien hanh luu du lieu vao Model
            
            //teacher
            
           
            //save data of teacher
            /*
            *   Bank_acount, office, description
            */
           
            if($check_teacher==true && $check_user==true){
                $data_teacher = array(
                    'username'      =>  $data['username'], //truyen username vao
                    'bank_account'  =>  $data['bank_account'],
                    'office'        =>  $data['office'],
                    'description'   =>  $data['description'],
                );
                $this->Teacher->create($data_teacher);
                
                //luu va tra lai ket qua
                $result = $this->Teacher->save();
            
                //save data of user
                /*
                *   username,firstname,lastname,date_of_birth,address,password,
                *   user_type,mail,phone_number
                */            
                //id tu sinh
                if(isset($result['Teacher']['teacher_id'])){
                    $data_user = array(
                        'foreign_id'=>  $result['Teacher']['teacher_id'],
                        'username'  =>  $data['username'],
                        'password'  =>  $data['password'],
                        'firstname'  => $data['firstname'],
                        'lastname'  =>  $data['lastname'],
                        'address'  =>   $data['address'],
                        //'image_profile' => $data['image_profile'],
                        'mail'  =>  $data['mail'],
                        'phone_number'  =>  $data['phone_number'],
                        'date_of_birth'  =>  $data['date_of_birth'],
                        'user_type' =>  1,
                    );

                    $this->User->create($data_user);
                    $this->User->save();
                }
            }
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
        // $this->loadModel(array('Student','Coma','Transaction','RateComa')); 
        // //get id
        // $id = $this->Auth->user('id');            
        // $options = array();    
        // //get data for today
        // $date = data('dd/mm/yyyy',time());
        // //get number of rates   

        // //get number of purchase

        
        // $dataOfDay = array();
        
        //get begin day
        //get data for all day        
	}
    function StatisticOption($begin = null, $end = null){
        $this->layout = null;
        if ($begin === null){            
            
        }
        if ($end === null){
            
        }
        //get data

    }
	function ChangePassword(){
	}
	
	function CreateLesson() {
        //vao day test thu, do~ phai dien
		    $data_teacher = array(
                'username'      =>  'hoangdd', //truyen username vao
                'bank_account'  =>  'HSNSM',
                'office'        =>  'bkhn',
                'description'   =>  'xxx',
            );
           
                $this->Teacher->create($data_teacher);
                
                //luu va tra lai ket qua
                $result = $this->Teacher->save();
                debug($result);
        die;
           
	}
	
	function  EditLession() {
	
	}

}
