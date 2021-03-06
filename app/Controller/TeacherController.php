<?php
class TeacherController extends AppController {
    public $uses = array('User', 'Teacher', 'Lesson', 'Comment', 'LessonCategory', 'LessonReference', 'LessonTransaction', 'RateLesson', 'ReportLesson','Data','BlockStudent');
    public $helpers = array('Html'); 
    public $components = array('Paginator');   
    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('register','login'); //Allow all
    }

    function index() {
        // home
    }

    function Register() {

        $error = array();
        $fill_box = array('username','email','firstname','lastname',
            'bank_account','phone_number','verifycode_question','verifycode_answer');
        //$user_re_ex='/^[A-Za-z]+\_[A-Za-z]+[0-9]$/'; 
        $user_re_ex = '/^[A-Za-z]\w+$/';
        //$pass_re_ex='/^.*(?=.{7,})(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9]).*$/';
        $pass_re_ex = '/^\w+$/';
        $email_re_ex = '[a-z0-9\\._]*[a-z0-9_]@[a-z0-9][a-z0-9\\-\\.]*[a-z0-9]\\.[a-z]{2,6}$';
        //データがある場合
        if ($this->request->is('post')) {
            $data = $this->request->data;
            // debug($data);
            // die(var_dump($_FILES));
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

                if (strlen($data['username']) < 2) {
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
                    $error['username'][5] = __('Username is existed');
                    $check_user = false;
                }

                $fill_box['username'] = $data['username'];
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

                if (strlen($data['password']) < 6) {
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
                $fill_box['firstname'] = $data['firstname'];
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

                $fill_box['lastname'] = $data['lastname'];
            }

            //verifycode question
            if (!isset($data['verifycode_question'])) {
                $error['verifycode_question'][0] = 'Question of verifycode is equal null.';
                $check_user = false;
            }

            if (empty($data['verifycode_question'])) {
                $error['verifycode_question'][1] = 'Question of verifycode is empty.';
                $check_user = false;
            } else {

                if (strlen($data['verifycode_question']) > 50) {
                    $error['verifycode_question'][2] = 'Question of verifycode is too long.';
                    $check_user = false;
                }
                $fill_box['verifycode_question'] = $data['verifycode_question'];
            }

            //verifycode_answerをチェック：
            if (!isset($data['verifycode_answer'])) {
                $error['verifycode_answer'][0] = 'Answer of verifycode is equal null.';
                $check_user = false;
            }

            if (empty($data['verifycode_answer'])) {
                $error['verifycode_answer'][1] = 'Answer of verifycode is empty.';
                $check_user = false;
            } else {

                if (strlen($data['verifycode_answer']) > 50) {
                    $error['verifycode_answer'][2] = 'Answer of verifycode is too long.';
                    $check_user = false;
                }
                $fill_box['verifycode_answer'] = $data['verifycode_answer'];
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
                    $error['mail'][2] = __('Email was existed');
                    $check_user = false;
                }
                $fill_box['email'] = $data['mail'];
            }
            //=================================

            $check_teacher = true;
            //check bank_account
            if (!isset($data['bank_account'])) {
                $error['bank_account'][0] = __('Bank account is equal null.');
                $check_teacher = false;
            }
            if (empty($data['bank_account'])) {
                $error['bank_account'][1] = __('Bank account is empty.');
                $check_teacher = false;
            }
            else{
                if(strlen($data['bank_account'])>18){
                    $error ['bank_account'] [2] = __('Bank account is too long.');
                    $check_teacher = false;
                }
                $bank_account_re_ex = '/^\w{4}-\w{3}-\w{1}-\w{7}$/';
                if (!preg_match($bank_account_re_ex,$data['bank_account'])) {
                    $error['bank_account'][3] = __('Bank account is not match form.');
                    $check_teacher = false;
                }
                $fill_box['bank_account'] = $data['bank_account'];
            }
            //=================================
            //携帯電話の番号をチェック：
            if (!empty($data['phone_number'])) {
                if (strlen($data['phone_number']) < 10) {
                    $error['phone_number'][0] = __('Phone number is too short');
                }

                if (strlen($data['phone_number']) > 15) {
                    $error['phone_number'][1] = __('Phone number is too long');
                }
                $fill_box['phone_number'] = $data['phone_number'];
            }

            //====================================
            //自己のイメージをチェック：  
            // if( !empty($_FILES['profile_picture'])){
            //(debug($_FILES)); die;
            if ( !empty($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] == 0) {
                $configs = Configure::read('srcFile');
                $img_exts = $configs['image']['extension'];
                $profile_pic = $_FILES['profile_picture'];
                $ext = pathinfo($profile_pic['name'], PATHINFO_EXTENSION);
                if (!in_array($ext, $img_exts)) 
                {
                    $error['profile_picture'][0] = 'Unsupported image file';
                }
            }else{
                 $profile_pic ='';
            }

            if (!empty($data['date_of_birth'])){
                $data['date_of_birth'] =  date_create($data['date_of_birth']);        
                $data['date_of_birth'] = date_format($data['date_of_birth'],'Y-m-d');        
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
               // $this->log($data_teacher,'hlog');
                $this->loadModel('Teacher');
                $data_teacher = $this->Teacher->create($data_teacher);
                $this->log($data_teacher,'hlog');
                //セーブしたり、結果を出した
                if (!$result = $this->Teacher->save($data_teacher)){
                   $this->Session->setFlash(__('Save Fail'));                   
                }
                //$this->log($result,'hlog');
                //ユーザのデータをセーブする
                /*
                 *   username,firstname,lastname,date_of_birth,address,password,
                 *   user_type,mail,phone_number,profile_picture
                 */
                //自動にteacher_idを作られる
                if (!empty($result['Teacher']['teacher_id'])) {                    
                    $data['foreign_id'] = $result['Teacher']['teacher_id'];
                    $data['profile_picture'] = $profile_pic;
                    $data['user_type'] = 1;                  
                    $data['approved'] = 0;
                    $data['activated'] = 1;
                    $data['comment'] = 0;
                    $this->User->create($data);  
                    if ( !$this->User->save()){
                        $this->Teacher->delete($result['Teacher']['teacher_id']);                        
                        $this->Session->setFlash(__('Register failure'));                        
                    }
                    else{
                        $this->Session->setFlash(__('Register successful, waiting for approving by admin'));   
                        $this->redirect(array('controller' => 'Login','action' => 'index'));
                    }
                }
            }
        }
        $this->set('error', $error);
        $this->set('fill_box', $fill_box);
    }

    function CheckUsername(){
        $this->loadModel('Register');
         if ($this->request->is('post')) {
             // lay du lieu gui len
            $value = $this->request->data['value'];
            // chuyen sau thanh mang
            $data = $this->request->data;
            $res = $this->User->find('first', array(
                    'conditions' => array(
                        'User.username' => $value
                )));           
            if (isset($res) && !empty($res)) {
                    //存在しない
                echo "exist";
            } else {
                echo "ok";
            }
        }
        die;
    }

    function Profile($id = null) {
        if ($this->Auth->loggedIn()) {

            if ($id!= null){
                $pid = $id;
                if ($this->Auth->user('role') == 'R1'){
                    $this->layout = 'admin';
                }
                $result = $this->User->find('all',
                    array(
                        'conditions' => array(
                             'user_id' => $pid,
                             'activated' => 1
                            )
                        )
                    );
                if (!$result){
                    echo __("This user is deleted");
                    die;
                }
            }elseif ($this->Auth->user('role') !== 'R1' ){                     
                $pid=$this->Auth->User('user_id');                
            }else{
                echo '403 Forbidden error.';
                die;
            }
            $isOther = true;

            $canViewEmail = false; // co dc xem email vs sdt ko?

            $user_id = $this->Auth->User('user_id');
            if( $id == null || $id == $user_id){
                //neu la chinh no
                $canLike = false;
                $canComment =  true;
                $canViewEmail = true;

            }elseif($this->Auth->user('role') == 'R3'){
                $canLike = $this->__checkStudentCanCommentAndLike($user_id, $id);
                $canComment = $canLike;

            }else{
                if($this->Auth->user('role') == 'R1'){
                    $canViewEmail = true;
                }
                $canLike = false;
                $canComment = false;
            }
            $this->set(compact('canLike', 'canComment'));
            $user = $this->Auth->User();
            if (isset($user['user_id']) && $pid == $user['user_id']){
                $isOther = false;
            }
            $data = $this->User->find('first', array(
                    'conditions' => array(
                    'User.user_id' => $pid,
                    'user_type' => '1'
                    /*@hoangdd */
                )
            ));
            /*@hoangdd- bo sung truong hop user_id -> student*/
            if ( empty($data)){
                $this->Session->setFlash(__('Forbidden error'));
                echo '403 Forbidden error.';
                die;
            }

            //only student can like
            if( $canLike ){
                $this->loadModel('Like');
                $student_id = $this->Auth->user('user_id');
                $teacher_id = $id;
                $likes = $this->Like->find('all', array(
                    'conditions' => array(
                        'student_id' => $student_id,
                        'teacher_id' => $teacher_id,
                        )
                    ));
                $this->set(compact('likes', 'teacher_id', 'student_id'));
            }
            $this->loadModel('CommentTeacher');
            $this->CommentTeacher->bindModel(array(
                'belongsTo' => array(
                    'User' => array(
                        'foreignKey' => 'student_id',
                        )
                    )
                ));
            $comments = $this->CommentTeacher->find('all', array(
                'conditions' => array(
                    'teacher_id' => $pid,
                    )
                ));
            $this->set('comments', $comments);
            
            $this->set('isOther',$isOther);
            $this->set('canViewEmail',$canViewEmail);
            if ($data['User']['user_type'] == 1) {
                //
                $data['User']['date_of_birth'] =  date_create($data['User']['date_of_birth']);        
                $data['User']['date_of_birth'] = date_format($data['User']['date_of_birth'],'d/m/Y');    
                //
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
                $this->set("data", $data);
                $this->set("data2", $data2);
            }
        }
    }

    function blockStudent(){
        //Set Block Student List
        $this->BlockStudent->bindModel(array(
            'belongsTo' => array(
                'User' => array(
                    'foreignKey' => 'student_id'
                )
            ) 
        ));

        $stdBlockList = $this->BlockStudent->findAllByTeacherId($this->Auth->user('user_id'),array(),array('BlockStudent.created' => 'desc'),10);
        $this->set('stdBlockList',$stdBlockList);
    }

    function unblockStudent($id){
        if ($this->request->is('get')) {  
            $block = $this->BlockStudent->find('first',array(
                'conditions' => array(
                    'teacher_id' => $this->Auth->user('user_id'),
                    'student_id' =>$id
                    )
            ));      
            
            if ($this->BlockStudent->delete($block['BlockStudent']['id'])){
                echo '1';die;
            } else {
                echo '0';die;
            }

        }
    }

    function addBlockStudent($id){
        if ($this->request->is('get')) {
            $data = array(
                'teacher_id' => $this->Auth->user('user_id'),
                'student_id' => $id
                );
            $this->BlockStudent->create();
            /*$this->BlockStudent->set(array(
                'teacher_id' => $this->Auth->user('user_id'),
                'student_id' => $id
            )); */
            if ($this->BlockStudent->save($data)){
                echo '1';die;
            } else {
                echo '0';die;
            }

        }
    }
    
    function EditProfile($id = null) {
        if ($this->Auth->loggedIn()) {               
            if ($this->Auth->user('role') === "R1"){
                $this->layout = ('admin');
                    if ($id != null){
                        $pid = $id;
                    }
                    else{
                        $this->Session->setFlash(__('Forbidden error'));
                        die;
                    }
                }
            else{
                    $pid = $this->Auth->User('user_id');                    
                } 
            $userData = $this->User->find('first',
                    array(
                        'conditions' => array(
                            'User.user_id' => $pid
                            )
                        )
                    );     
            if ($this->request->is('post')) {                                                                                            
                $fields = array('mail','firstname','lastname','phone_number','address','date_of_birth');
                if ($_FILES['profile_picture']['error'] == 0){
                    $this->request->data['profile_picture'] = $_FILES['profile_picture'];
                    array_push($fields,'profile_picture');
                }                
                $data = $this->User->create($this->request->data);
				$data['User']['user_id'] = $pid;				
                $teacherData = $data['User']['bank_account'];
                unset($data['User']['bank_account']);  		
				$result = $this->User->save($data,true,$fields);            
                if ($result){
                    $teacherData = array(
                            'Teacher' => array(
                                'teacher_id' => $userData['User']['foreign_id'],
                                'bank_account' => $teacherData,
								'username' => $userData['User']['username']
                                )
                        );
                    if ($this->Teacher->save($teacherData)){                    
                        $this->Session->setFlash(__('Edit successful'));
                        $this->redirect(array('controller' => 'Teacher', 'action' => 'profile',$id));
                    }
                }               
			}        
                //get data                            
                $teacherData = $this->Teacher->find('first',
                    array(
                        'conditions' => array(
                            'Teacher.teacher_id' => $userData['User']['foreign_id']
                            )
                        )
                );                 
                               
                $this->set('teacherData',$teacherData['Teacher']);
                $this->set('userData',$userData['User']);                            
        }
    }

    function LessonManage() {
      $this->Lesson->bindModel(array(
      'hasMany' => array(
        'RateLesson' => array(
            'className' => 'RateLesson',
            'foreignKey' => 'coma_id'
            )
        )
      )
      );   

        $pagination = array(
            'limit' => 5,
            'contain' => array(
                'RateLesson' => array(                    
                    'fields' => array(      
                            'AVG(RateLesson.rate) as rate',                                
                        )
                    )
                ),
            'conditions' =>  array(
                'Lesson.author' => $this->Auth->user('user_id'),
                'is_block !=' => 2
            ),
            'order' => array('Lesson.name' => 'asc')
        );
        
        $this->Paginator->settings = $pagination;
        $lesson = $this->Paginator->paginate('Lesson'); 
        
        foreach ($lesson as $index=>$ls):
            $lesson[$index]['Lesson']['rate'] = 0;
            if (isset($ls['RateLesson'][0]['RateLesson'][0]['rate'])){
                $lesson[$index]['Lesson']['rate'] = $ls['RateLesson'][0]['RateLesson'][0]['rate'];
            }
            unset($lesson[$index]['RateLesson']);
        endforeach;     
        $this->set('lesson', $lesson);
   }

   function deleteLesson(){
        if ($this->request->is('ajax')) {            
            $id = $this->request->data['id'];              
            $this->Data->updateAll(
                array(
                    'is_block' => 2
                ),
                array(
                    'coma_id' => $id
                )
            );    
            $this->Lesson->id = $id;
            if($this->Lesson->saveField('is_block',2)){
                echo "1|";
                //die;
            }else{
                echo "0|";
                // echo json_encode(array("res"=> 1));
                //die;
            }
            die;
       }
       
   }

    function Statistic() {
        App::uses('Utilities', 'Lib');
        $util = new Utilities();
        $this->set('util',$util);
        $this->User->id = $this->Auth->user('user_id');
        $registerDate = $this->Auth->user('created');      
        $begin =  date_create($registerDate);        
        $begin = date_format($begin,'Y-m-d');                
        //$defaultBegin = date("yyyy-mm-dd",$registerDate);
        $end = date('Y-m-d'); 
        //get Top 3 lesson
        //get Lesson of the teacher
        $lessons = $this->Lesson->find('all',array(
            'conditions' => array(
                'author' => $this->Auth->user('user_id')
            )
        ));                
        foreach($lessons as $index=>$lesson){
            //get number of sale
            $result = $this->LessonTransaction->find('all',array(
                'conditions' => array(
                    'coma_id' => $lesson['Lesson']['coma_id']                    
                ),
                'fields' => array('SUM(money*rate/100) as buy_num')
            ));                                    
            $lessons[$index]['buy_num'] = 0;
            if (isset($result[0][0]['buy_num'])){
                 $lessons[$index]['buy_num'] = $result[0][0]['buy_num'];
            }

            //get number of rank lesson
            $result = $this->RateLesson->find('all',array(
                'conditions' => array(
                    'coma_id' => $lesson['Lesson']['coma_id']                    
                ),
                'fields' => array('AVG(rate) as rate')
            ));                                    
            $lessons[$index]['rate'] = 0;
            if (isset($result[0][0]['rate'])){
                 $lessons[$index]['rate'] = $result[0][0]['rate'];
            }

        };                
        uasort($lessons, function($a,$b){
            return ($a['buy_num'] < $b['buy_num']);
        });
        $top3BoughtLesson = array_slice($lessons,0,3);
        uasort($lessons, function($a,$b){
            return ($a['rate'] < $b['rate']);
        });
        $top3FavouriteLesson = array_slice($lessons,0,3);
        $dataToChart = $this->getDataStatistic($begin,$end);        
        $this->set(compact(array('begin','end','dataToChart','top3BoughtLesson','top3FavouriteLesson')));

        //get bill list
        $this->LessonTransaction->bindModel(array(
            'belongsTo' => array(
                'Lesson' => array(
                    'foreignKey' => 'coma_id',
                ),
                'User' => array(
                    'foreignKey' => 'student_id'
                )
            )    
        ));
        $billList = $this->LessonTransaction->find('all',array(
            'conditions' => array(
                'Lesson.author' => $this->Auth->user('user_id')
            ),
            'order' => array('LessonTransaction.created' => 'desc')
        ));
        // debug($billList);die;
        $this->set('billList',$billList);
    }
    function CreateLesson() {
        //vao day test thu, do~ phai dien
        // $data_teacher = array(
        //     'username' => 'hoangdd', //truyen username vao
        //     'bank_account' => 'HSNSM',
        //     'office' => 'bkhn',
        //     'description' => 'xxx',
        // );

        // $this->Teacher->create($data_teacher);

        // //luu va tra lai ket qua
        // $result = $this->Teacher->save();
        // // debug($result);
        // die;
        $this->redirect(array('controller' => 'Lesson', 'action'=>'create'));
    }
	function ChangePassword(){
	}

    function getDataStatistic($begin = null,$end = null){                        
        ///<summary>
        ///get period 
        ///<summary>
        $this->User->id = $this->Auth->user('user_id');
        $registerDate = $this->Auth->user('created');      
        $defaultBegin =  date_create($registerDate);        
        $defalutBegin = date_format($defaultBegin,'Y-m-d');                
     //   $defaultBegin = date("yyyy-mm-dd",$registerDate);
        $defaultEnd = date('Y-m-d');          
        if ($begin == null) $begin = $defaultBegin;
        if ($end == null) $end = $defaultEnd;
        if ($this->request->is('post')){
            $begin = $this->request->data['begin'];
            $begin = date_create($begin);
            $begin = date_format($begin,'Y-m-d');
            $end = $this->request->data['end'];
            $end = date_create($end);
            $end = date_format($end,'Y-m-d');
        }            
        ///<summary>
        ///get data for begin to end
        ///<summary>
         $dataToChart = array();
        /**
        * get money statistic
        */    
        $dataToChart['Money'] = array(array('day','buy_num'));
        $this->Lesson->bindModel(array(
                'hasMany' => array(
                    'LessonTransaction' => array(
                        'className' => 'LessonTransaction',
                        'foreignKey' => 'coma_id',                                         
                    )                   
                )                        
            )
        );   
        $this->LessonTransaction->bindModel(array(
            'belongsTo' => array(
                'Lesson' => array(
                    'className' => 'Lesson',                    
                    'foreignKey' => 'coma_id'
                )
            )
        ))     ;             
        $moneyArray = $this->LessonTransaction->find('all',array(
            'conditions' => array(
                'Lesson.author' => $this->Auth->user('user_id'),
                'DATE(LessonTransaction.created) <=' => $end,
                'DATE(LessonTransaction.created) >=' => $begin
            ),  
            'fields' => array('SUM(money*rate/100) as buy_num','DATE(LessonTransaction.created) as date'),             
            'recursive' => 1,
            'group' => 'date',
            'order' => 'date'
        ));        
        foreach($moneyArray as $m){
            $dataToChart['Money'][] = array($m[0]['date'],(int)$m[0]['buy_num']);
        }       
        
        /**
        * get the most bought category and the most favorite categorys
        */        
        $this->loadModel('Category');
        $this->Category->primaryKey = 'category_id';
        $this->Category->bindModel(array(
            'hasMany' => array(
                'LessonCategory' => array(
                    'foreignKey' => 'category_id',                    
                )                
            )
        ));
        $this->LessonCategory->bindModel(array(
                'belongsTo' => array(
                    'Lesson' => array(
                        'foreignKey' => 'coma_id',
                        'conditions'=>array(
                        'Lesson.author' => $this->Auth->user('user_id'),                
                    ),                        
                    )
                )
            )
        );
         $this->Lesson->bindModel(array(
                'hasMany' => array(
                    'LessonTransaction' => array(
                        'className' => 'LessonTransaction',
                        'foreignKey' => 'coma_id', 
                        'conditions'  => array(
                           'DATE(LessonTransaction.created) <=' => $end,
                           'DATE(LessonTransaction.created) >=' => $begin,

                        )                        
                    ),
                    'RateLesson' => array(
                        'className' => 'RateLesson',
                        'foreignKey' => 'coma_id', 
                        'conditions'  => array(
                           'DATE(RateLesson.created) <=' => $end,
                           'DATE(RateLesson.created) >=' => $begin,

                        )                        
                    ),                              
                )                        
            )
        );   

        $mostBoughtArray = $this->Category->find('all',array(            
            'contain' => array(                
                'LessonCategory' => array(  
                    'fields'  => array(),
                    'Lesson' => array(
                        'fields' => array(),                       
                        'LessonTransaction' => array(
                            'fields' => array(
                                    //'DATE(created) as date',
                                    'SUM(money*rate/100) as buy_number'
                                )
                            )
                        )
                    )
                ),
            'recursive' => 4,   
            'fields' => array('name')
        ));        
        $favoriteCategoryArray = $this->Category->find('all',array(            
            'contain' => array(                
                'LessonCategory' => array(  
                    'fields'  => array(),
                    'Lesson' => array(
                        'fields' => array(),                       
                        'RateLesson' => array(
                            'fields' => array(
                                //'DATE(created) as date',
                                //'RateLesson.rate',
                                'RateLesson.rate',                                
                                )
                            )
                        )
                    )
                ),
            'recursive' => 4,            
            'fields' => array('name'),           
        ));  
        //debug($favoriteCategoryArray);
        $dataToChart['most_bought'] = array();      
        foreach($mostBoughtArray as $index => $f){
            $num = 0;                    
            foreach($f['LessonCategory'] as $category){
                if (isset($category['Lesson']['LessonTransaction'][0]['LessonTransaction'][0]['buy_number'])){
                    $num += $category['Lesson']['LessonTransaction'][0]['LessonTransaction'][0]['buy_number'];
                }
            }  
            if ($num != 0){
                $dataToChart['most_bought'][] = array($f['Category']['name'],(int)$num);            
            }
        }
        $dataToChart['favourite_category'] = array();      
        foreach($favoriteCategoryArray as $index => $f){
            $num = 0;       
            $count = 0;             
            foreach($f['LessonCategory'] as $category){
                if (isset($category['Lesson']['RateLesson'])){
                    foreach($category['Lesson']['RateLesson'] as $RateLesson){
                        $num += $RateLesson['rate'];
                        $count++;                        
                    }
                }
            };           
            if($count != 0){
                //print_r($num);print_r($count);
                $dataToChart['favourite_category'][] = array($f['Category']['name'],(double)$num/$count);            
            }
        }
        //==================
        // get top 10 category
        //==================
        $limit = 10;
        usort($dataToChart['most_bought'],function($a,$b){ return ($a[1] < $b[1] ); });
        $dataToChart['most_bought'] = array_slice($dataToChart['most_bought'], 0,$limit);
        $dataToChart['most_bought'] = array_merge(array(array('category','buy_num')),$dataToChart['most_bought']);
        usort($dataToChart['favourite_category'],function($a,$b){return ($a[1] < $b[1] ); });
        $dataToChart['favourite_category'] = array_slice($dataToChart['favourite_category'], 0,$limit);
        $dataToChart['favourite_category'] = array_merge(array(array('category','rate')),$dataToChart['favourite_category']);
        if($this->request->is('post')){
            echo json_encode($dataToChart);
            die;
        }
        return $dataToChart;
    }

    function reportTitle($coma_id = null){
        if ($coma_id == null){      
            die;
        }        
        $this->loadModel('ReportLesson');
        $data = array(
                'coma_id' => $coma_id,
                'user_id' => $this->Auth->user('user_id'),
                'report_reason' => 'tittle'
            );
        $this->ReportLesson->create($data);
        if ($this->ReportLesson->save()){
            echo "1";
            die;
        }
        else{
            echo "0";
            die;
        }

    }

    function block(){
        if ($this->Auth->loggedIn()){
            $teacherId = $this->Auth->user('user_id');
            if ($this->request->is('post')){

            }
        }
    }
    //giong studentController checkStudentCancomment and Like
    private function __checkStudentCanCommentAndLike($student_id, $teacher_id){
        $this->loadModel('Lesson');
        $lesson_ids = $this->Lesson->find('list', array(
            'conditions' => array(
                'author' => $teacher_id,
                ),
            'fields' => array('coma_id')
            ));
        $transactions = $this->LessonTransaction->find('all', array(
            'conditions' => array(
                'coma_id' => $lesson_ids, 
                'student_id' => $student_id,
                )
            ));
        if( empty($transactions)){
            return false;
        }else{
            return true;
        }
    }
}
