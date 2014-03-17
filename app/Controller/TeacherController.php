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
                        'original_verifycode_question' => $data['verifycode_question'],
                        'verifycode_answer' => $data['verifycode_answer'],
                        'original_verifycode_answer' => $data['verifycode_answer'],
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



    function EditProfile() {
        if ($this->Auth->loggedIn()) {            
            if ($this->request->is('post')) {               
                $pid = $this->Auth->User('user_id');                
                $this->request->data['profile_picture'] = $_FILES['profile_picture'];
                $data = $this->User->create($this->request->data);
				$data['User']['user_id'] = $this->Auth->user('user_id');				
                $teacherData = $data['User']['bank_account'];
                unset($data['User']['bank_account']);  		
				$result = $this->User->save($data,true,array('mail','firstname','lastname','date_of_birth','phone_number','profile_picture'));				
                if ($result){
                    $teacherData = array(
                            'Teacher' => array(
                                'teacher_id' => $this->Auth->User('foreign_id'),
                                'bank_account' => $teacherData,
								'username' => $this->Auth->user('username')
                                )
                        );
                    if ($this->Teacher->save($teacherData)){                    
                        $this->Session->setFlash(__('Edit successful'));
 //                   $this->redirect(array('controller' => 'Teacher', 'action' => 'profile'));
                    }
                }               
			}        
                //get data                 
                $teacherData = $this->Teacher->find('first',
                    array(
                        'conditions' => array(
                            'Teacher.teacher_id' => $this->Auth->User('foreign_id')
                            )
                        )
                );                           
                $userData = $this->User->find('first',
                    array(
                        'conditions' => array(
                            'User.user_id' => $this->Auth->User('user_id')
                            )
                        )
                    );                
                $this->set('teacherData',$teacherData['Teacher']);
                $this->set('userData',$userData['User']);                            
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
                    'coma_id' => $lesson['Lesson']['coma_id'],
                    'DATE(created) <='  => $end,
                    'DATE(created) >='  => $begin
                ),
                'fields' => array('COUNT(transaction_id) as buy_num')
            ));                                    
            $lessons[$index]['buy_num'] = 0;
            if (isset($result[0][0]['buy_num'])){
                 $lessons[$index]['buy_num'] = $result[0][0]['buy_num'];
            }

            //get number of rank lesson
            $result = $this->RateLesson->find('all',array(
                'conditions' => array(
                    'coma_id' => $lesson['Lesson']['coma_id'],
                    'DATE(created) <='  => $end,
                    'DATE(created) >='  => $begin
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

	
	function  EditLession() {
	
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
            'fields' => array('COUNT(transaction_id) as buy_num','DATE(LessonTransaction.created) as date'),             
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
                                    'COUNT(LessonTransaction.transaction_id) as buy_number'
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
        if($this->request->is('post')){
            echo json_encode($dataToChart);
            die;
        }
        return $dataToChart;
    }
}
