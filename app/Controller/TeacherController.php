<?php

App:: uses('AppModel','Model','User', 'Teacher', 'Lesson', 'Comment', 'LessonCategory', 'LessonReference', 'LessonTransaction', 'RateLesson', 'ReportLesson');

class TeacherController extends AppController {

    public $uses = array('User', 'Teacher', 'Lesson', 'Comment', 'LessonCategory', 'LessonReference', 'LessonTransaction', 'RateLesson', 'ReportLesson');
    public $helpers = array('Html');

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow(); //Allow all
    }

    function index() {
        // home
    }

    function Register() {

        $error = array();
        //$user_re_ex='/^[A-Za-z]+\_[A-Za-z]+[0-9]$/'; 
        $user_re_ex = '/^[A-Za-z]\w+$/';
        //$pass_re_ex='/^.*(?=.{7,})(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9]).*$/';
        $pass_re_ex = '/^\w+$/';
        $email_re_ex = '[a-z0-9\\._]*[a-z0-9_]@[a-z0-9][a-z0-9\\-\\.]*[a-z0-9]\\.[a-z]{2,6}$';
        //データがある場合
        if ($this->request->is('post')) {
            $data = $this->request->data;

            /*
              ユーザ名前をチェック:
              0:  null
              1:  empty
              2:  not match form
              3:  too short
              4:  too long
              5:  was used
             */
            $check_user = true;
            if (!isset($data['username'])) {
                $error['username'][0] = 'Username is equal null.';

                $check_user = false;
            }

            if (empty($data['username'])) {
                $error['username'][1] = 'Username is empty.';
                $check_user = false;
            } else {
                if (!preg_match($user_re_ex, $data['username'])) {
                    $error['username'][2] = 'Username is not match form.';
                    $check_user = false;
                }

                if (strlen($data['username']) < 6) {
                    $error['username'][3] = 'Username is too short.';
                    $check_user = false;
                }

                if (strlen($data['username']) > 30) {
                    $error['username'][4] = 'Username is too long.';
                    $check_user = false;
                }

                $res = $this->User->find('first', array(
                    'conditions' => array(
                        'User.username' => $data['username']
                )));
                if (empty($res)) {
                    //存在しない
                } else {
                    $error['username'][5] = 'Username is exist.';

                    $check_user = false;
                }
            }
            //=================================

            /*
              パースワードをチェック:
              0:  null
              1:  empty
              2:  not match form
              3:  too short
              4:  too long
             */
            if (!isset($data['password'])) {
                $error['password'][0] = 'Password is equal null.';

                $check_user = false;
            }

            if (empty($data['password'])) {
                $error['password'][1] = 'Password is empty.';
                $check_user = false;
            } else {
                if (!preg_match($pass_re_ex, $data['password'])) {
                    $error['password'][2] = 'Password is not match form.';
                    $check_user = false;
                }

                if (strlen($data['password']) < 8) {
                    $error['password'][3] = 'Password is too short.';
                    $check_user = false;
                }

                if (strlen($data['password']) > 30) {
                    $error['password'][4] = 'Password is too long.';
                    $check_user = false;
                }
            }

            /*
              もう一度パースワードを確認する:
              0:  null
              1:  empty
              2:  not match with password
             */
            if (!isset($data['retypepassword'])) {
                $error['retypepassword'][0] = 'Password is equal null.';

                $check_user = false;
            }

            if (empty($data['retypepassword'])) {
                $error['retypepassword'][1] = 'Password is empty.';
                $check_user = false;
            } else {
                if (strcmp($data['retypepassword'], $data['password']) != 0) {
                    $error['retypepassword'][2] = 'Password and RetypePassword are not equal.';
                    $check_user = false;
                }
            }

            /*
              FirstName と LastNameをチェック：
              0:  null
              1:  empty
              2:  too long
             */
            if (!isset($data['firstname'])) {
                $error['firstname'][0] = 'First name is equal null.';

                $check_user = false;
            }

            if (empty($data['firstname'])) {
                $error['firstname'][1] = 'First name is empty.';
                $check_user = false;
            } else {

                if (strlen($data['firstname']) > 30) {
                    $error['firstname'][2] = 'First name is too long.';
                    $check_user = false;
                }
            }
            //==================================
            if (!isset($data['lastname'])) {
                $error['lastname'][0] = 'Last name is equal null.';
                $check_user = false;
            }

            if (empty($data['lastname'])) {
                $error['lastname'][1] = 'Last name is empty.';
                $check_user = false;
            } else {

                if (strlen($data['lastname']) > 30) {
                    $error['lastname'][2] = 'Last name is too long.';
                    $check_user = false;
                }
            }

            //verifycode_answerをチェック：
            if (!isset($data['verifycode_answer'])) {
                $error['verifycode_answer'][0] = 'Answer of verifycode is equal null.';
                $check_user = false;
            }

            if (empty($data['verifycode_answer'])) {
                $error['lastname'][1] = 'Answer of verifycode is empty.';
                $check_user = false;
            } else {

                if (strlen($data['verifycode_answer']) > 50) {
                    $error['verifycode_answer'][2] = 'Answer of verifycode is too long.';
                    $check_user = false;
                }
            }

            //Eメールをチェック
            if (!isset($data['mail'])) {
                $error['mail'][0] = 'Email is equal null.';

                $check_user = false;
            }
            if (empty($data['mail'])) {
                $error['mail'][1] = 'Email is empty.';
                $check_user = false;
            } else {
                $res = $this->User->find('all', array(
                    'conditions' => array(
                        'User.mail' => $data['mail']
                )));
                if (empty($res)) {
                    //存在しない
                } else {
                    $error['mail'][2] = 'Email was exist.';
                    $check_user = false;
                }
            }
            //=================================

            $check_teacher = true;
            //check bank_account
            if (!isset($data['bank_account'])) {
                $error['bank_account'][0] = 'Bank account is equal null.';
                $check_teacher = false;
            }
            if (empty($data['bank_account'])) {
                $error['bank_account'][1] = 'Bank account is empty.';
                $check_teacher = false;
            }
            //=================================
            //携帯電話の番号をチェック：
            if (!empty($data['phone_number'])) {
                if (strlen($data['phone_number']) < 10) {
                    $error['phone_number'][0] = 'Phone number is too short.';
                }

                if (strlen($data['phone_number']) > 15) {
                    $error['phone_number'][1] = 'Phone number is too long.';
                }
            }
            //====================================
            //自己のイメージをチェック：
            if (!empty($_FILES['profile_picture'])) {
                $configs = Configure::read('srcFile');
                $img_exts = $configs['image']['extension'];
                $profile_pic = $_FILES['profile_picture'];
                $ext = pathinfo($profile_pic['name'], PATHINFO_EXTENSION);
                if (!in_array($ext, $img_exts)) 
                {
                    $error['profile_picture'][0] = 'Unsupported image file';
                }
            }
            //====================================
            //先生のデーだをセーブ
            /*
             *   Bank_acount, office, description
             */
            if ($check_teacher == true && $check_user == true) {
                $data_teacher = array(
                    'username' => $data['username'], //ユーザ名を送る
                    'bank_account' => $data['bank_account'],
                    'office' => $data['office'],
                    'description' => $data['description'],
                );
                $this->Teacher->create($data_teacher);

                //セーブしたり、結果を出した
                $result = $this->Teacher->save();

                //ユーザのデータをセーブする
                /*
                 *   username,firstname,lastname,date_of_birth,address,password,
                 *   user_type,mail,phone_number,profile_picture
                 */
                //自動にteacher_idを作られる
                if (isset($result['Teacher']['teacher_id'])) {
                    $data_user = array(
                        'foreign_id' => $result['Teacher']['teacher_id'],
                        'username' => $data['username'],
                        'password' => $data['password'],
                        'firstname' => $data['firstname'],
                        'lastname' => $data['lastname'],
                        'address' => $data['address'],
                        'verifycode_question' => $data['verifycode_question'],
                        'verifycode_answer' => $data['verifycode_answer'],
                        'mail' => $data['mail'],
                        'phone_number' => $data['phone_number'],
                        'date_of_birth' => $data['date_of_birth'],
                        'user_type' => 1,
                        'profile_picture' => $profile_pic,
                    );

                    $this->User->create($data_user);
                    $this->User->save();
                }
            }
        }
        $this->set('error', $error);
    }

    function Profile() {
        if ($this->Auth->loggedIn()) {
            $pid = $this->Auth->User('user_id');
            $data = $this->User->find('first', array(
                'conditions' => array(
                    'User.user_id' => $pid,
                )
            ));
            $this->set("data", $data);
            if ($data['User']['user_type'] == 1) {
                $a = $data['User']['foreign_id'];
                $data1 = $this->Teacher->find('first', array(
                    'conditions' => array(
                        'Teacher.teacher_id' => $a,

                    )
                ));
                $this->set("data1", $data1);
                $this->loadModel("Coma");
                $data2 = $this->Coma->find('all', array(
                    'conditions' => array(
                        'Coma.author' => $pid,
                    )
                ));
                $this->set("data2", $data2);
            }
        }
    }


//	function EditProfile(){
//        if($this->Auth->loggedIn()){ 
//            $pid=$this->Auth->User('user_id');
//            $data1=$this->User->find('first',array(
//                    'conditions' => array('User.user_id' => $pid,
//                        )
//            ));
//            $this->set("data1",$data1);
//            if($this->request->is('post')){
//                
//                $data=$this->request->data;
//                if( !empty($_FILES['profile_picture'])&&
//                    !empty($_FILES['profile_picture']['tmp_name'])&&
//                    !empty($_FILES['profile_picture']['name'])){
//                    $img_exts = Configure::read('srcFile')['image']['extension'];
//                    $profile_pic = $_FILES['profile_picture'];
//                    $ext = pathinfo($profile_pic['name'], PATHINFO_EXTENSION);
//                    if( !in_array($ext, $img_exts) ){
//                        $error['profile_picture'][0] ='Unsupported image file';  
//                    }
//                }
//                $a['User']['firstname']=$data['firstname'];
//                $a['User']['lastname']=$data['lastname'];
//                $a['User']['date_of_birth']=$data['date_of_birth'];
//                $a['User']['address']=$data['address'];
//                $a['User']['phone_number']=$data['phone_number'];
//                $a['User']['created']=$data['created'];
//                $a['User']['username']=$data1['User']['username'];
//                if( isset($profile_pic)){
//                    $a['User']['profile_picture']=$profile_pic;
//                }
//                $this->User->id=$pid;

    function EditProfile() {
        if ($this->Auth->loggedIn()) {
            if ($this->request->is('post')) {
                $pid = $this->Auth->User('user_id');
                $this->User->id = $pid;

                $this->User->read();
                $this->User->save($a);
                $pid1=$data1['User']['foreign_id'];
                $b['Teacher']['bank_account']=$data['bank_account'];
                $b['Teacher']['username']=$this->Auth->user('username');
                $this->Teacher->id=$pid1;
                $this->Teacher->read();
                $this->Teacher->save($b);
            }
        }
    }

    function LessonManage() {

        $lesson = $this->Lesson->find('all', array(
            'conditions' => array(
                'Lesson.author' => $this->Auth->user('user_id')
            )
        ));
        $this->set('lesson', $lesson);
   }
   function deleteLesson(){
        if ($this->request->is('ajax')) {

            $id = $this->request->data['id'];
            $this->LessonTransaction->deleteAll(array('LessonTransaction.coma_id' => $id), false);
            $this->LessonReference->deleteAll(array('LessonReference.coma_id' => $id), false);
            $this->LessonCategory->deleteAll(array('LessonCategory.coma_id' => $id), false);
            $this->RateLesson->deleteAll(array('RateLesson.coma_id' => $id), false);
            $this->ReportLesson->deleteAll(array('ReportLesson.coma_id' => $id), false);
            $this->Comment->deleteAll(array('Comment.coma_id' => $id), false);
            
            if ($this->Lesson->deleteAll(array('coma_id' => $id), false)) {
                echo "1";
            } else {
                echo "0";
            }
            die;
        }
   }

    function Statistic() {
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

    function StatisticOption($begin = null, $end = null) {
        $this->layout = null;
        if ($begin === null) {
            
        }
        if ($end === null) {
            
        }
        //get data
    }

    function CreateLesson() {
        //vao day test thu, do~ phai dien
        $data_teacher = array(
            'username' => 'hoangdd', //truyen username vao
            'bank_account' => 'HSNSM',
            'office' => 'bkhn',
            'description' => 'xxx',
        );

        $this->Teacher->create($data_teacher);

        //luu va tra lai ket qua
        $result = $this->Teacher->save();
        debug($result);
        die;
    }
	function ChangePassword(){
	}

	
	function  EditLession() {
	
	}
    function getDataStatistic(){
        if ($this->request->is('post')){
            $data = $this->request->data;
            $result = array(array('day','number'),array(1,2),array(2,3),array(3,4));
            $this->set('request',$request);
        }
    }
}
