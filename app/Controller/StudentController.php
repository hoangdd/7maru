<?php
class StudentController extends AppController {

	public $testList;
	public $uses = array (
			'User',
			'Student' 
	);
    
	function index(){

	}
	public function beforeFilter() {
		parent::beforeFilter ();
		$this->Auth->userModel = 'Student';
		$this->Auth->allow ( 'dotest', 'viewtestresult' );
	}
    
	function Register() {
		$error = array ();
		// $user_re_ex='/^[A-Za-z]+\_[A-Za-z]+[0-9]$/';
		$user_re_ex = '/^[A-Za-z]\w+$/';
		// $pass_re_ex='/^.*(?=.{7,})(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9]).*$/';
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
			
			if (!isset($data ['username'])) {
				$error['username'][0] = 'Username is equal null.';
				$check_user = false;
			}
			
			if (empty($data['username'])){
				$error['username'][1] = 'Username is empty.';
				$check_user = false;
			} else {
				if (!preg_match($user_re_ex,$data['username'])){
					$error['username'][2] = 'Username is not match form.';
					$check_user = false;
				}
				
				if (strlen($data['username'])< 6){
					$error['username'][3] = 'Username is too short.';
					$check_user = false;
				}
				
				if (strlen($data['username'])> 30){
					$error['username'][4] = 'Username is too long.';
					$check_user = false;
				}
				
				$res = $this->User->find ('all', array(
						'conditions' => array (
								'User.username' => $data ['username'] 
						) 
				) );
				if (empty($res)){
					// chua ton tai
					// $error['username'] ='Username chua ton tai!';
				} else {
					$error ['username'] [5] = 'Username is exist.';
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
			if (!isset($data['password'])){
				$error['password'][0] = 'Password is equal null.';
				$check_user = false;
			}
			
			if (empty($data['password'])) {
				$error['password'][1] = 'Password is empty.';
				$check_user = false;
			} else {
				if (!preg_match($pass_re_ex,$data['password'])) {
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
			if (!isset($data['retypepassword'])){
				$error['retypepassword'][0] = 'Password is equal null.';
				$check_user = false;
			}
			
			if (empty($data ['retypepassword'] )) {
				$error ['retypepassword'][1] = 'Password is empty.';
				$check_user = false;
			} else {
				if (strcmp($data['retypepassword'],$data['password'] )!= 0) {
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
			if (! isset ( $data ['firstname'] )) {
				$error ['firstname'] [0] = 'First name is equal null.';
				$check_user = false;
			}
			
			if (empty ( $data ['firstname'] )) {
				$error ['firstname'] [1] = 'First name is empty.';
				$check_user = false;
			} else {
				
				if (strlen ( $data ['firstname'] ) > 30) {
					$error ['firstname'] [2] = 'First name is too long.';
					$check_user = false;
				}
			}
			// ==================================
			if (! isset ( $data ['lastname'] )) {
				$error ['lastname'] [0] = 'Last name is equal null.';
				$check_user = false;
			}
			
			if (empty ( $data ['lastname'] )) {
				$error ['lastname'] [1] = 'Last name is empty.';
				$check_user = false;
			} else {
				
				if (strlen ( $data ['lastname'] ) > 30) {
					$error ['lastname'] [2] = 'Last name is too long.';
					$check_user = false;
				}
			}
            
             //verifycode_answerをチェック：
            if(!isset($data['verifycode_answer'])){
                $error['verifycode_answer'][0] ='Answer of verifycode is equal null.';
                $check_user = false;
			}
            
			if(empty($data['verifycode_answer'])){
                $error['lastname'][1] ='Answer of verifycode is empty.';
                $check_user = false;
			}	
            else{

                if(strlen($data['verifycode_answer']) > 50){
                    $error['verifycode_answer'][2] ='Answer of verifycode is too long.';
                    $check_user = false;
                }
            }
            
			 //Eメールをチェック
           if(!isset($data['mail'])){
                $error['mail'][0] ='Email is equal null.';
                $check_user = false;
			}
			if(empty($data['mail'])){
                $error['mail'][1] ='Email is empty.';
                $check_user = false;
			}else{
                $res = $this->User->find('all',array(
                    'conditions'=>array(
                        'User.mail' => $data['mail']
                    )));
                if(empty($res)){
                    //存在しない
                }else{
                    $error['mail'][2] ='Email was exist.';
                    $check_user = false;
                }
            }
			// =================================
			
			$check_student = true;
			// check credit_account
			if (! isset ( $data ['credit_account'] )) {
				$error ['credit_account'] [0] = 'Credit account is equal null.';
				$check_student = false;
			}
			if (empty ( $data ['credit_account'] )) {
				$error ['credit_account'] [1] = 'Credit account is empty.';
				$check_student = false;
			}
			// =================================
			
			//携帯電話の番号をチェック：
			if (! empty ( $data ['phone_number'] )) {
				if (strlen ( $data ['phone_number'] ) < 10) {
					$error ['phone_number'] [0] = 'Phone number is too short.';
				}
				
				if (strlen ( $data ['phone_number'] ) > 15) {
					$error ['phone_number'] [1] = 'Phone number is too long.';
				}
			}
             //自己のイメージをチェック：
            if( !empty($_FILES['profile_picture'])){
                $img_exts = Configure::read('srcFile')['image']['extension'];
                $profile_pic = $_FILES['profile_picture'];
                $ext = pathinfo($profile_pic['name'], PATHINFO_EXTENSION);
                if( !in_array($ext, $img_exts) ){
                  $error['profile_picture'][0] ='Unsupported image file';  
                }
            }
            //====================================

			//学生のデーだをセーブ
			/*
			 * Credit_acount, level
			 */
            if ($check_student == true && $check_user == true) {
                $data_student = array (
                    'username'      =>  $data['username'],
                    'credit_account' => $data ['credit_account'],
                    'level'          => $data ['level'] 
                );
				$this->Student->create ( $data_student );
                //セーブしたり、結果を出した
				$result = $this->Student->save ();
			
			
			 //ユーザのデータをセーブする
                /*
                *   username,firstname,lastname,date_of_birth,address,password,
                *   user_type,mail,phone_number,profile_picture
                */ 
			    if(isset($result['Student']['student_id'])){
                    $data_user = array(
                        'foreign_id'=>  $result['Student']['student_id'],
                        'username'  =>  $data['username'],
                        'password'  =>  $data['password'],
                        'firstname'  => $data['firstname'],
                        'lastname'  =>  $data['lastname'],
                        'address'  =>   $data['address'],
                        'verifycode_question' => $data['verifycode_question'],
                        'verifycode_answer' => $data['verifycode_answer'],
                        'mail'  =>  $data['mail'],
                        'phone_number'  =>  $data['phone_number'],
                        'date_of_birth'  =>  $data['date_of_birth'],
                        'user_type' =>  2,
                        'profile_picture' => $profile_pic,
                    );

                    $this->User->create($data_user);
                    $this->User->save();
			     }
		      }
        }
        $this->set('error', $error);
	}

	function Profile(){
		//$sql="SELECT *FROM 7maru_users WHERE user_id=".$pid;
        // $data=$this->User->query($sql);

        if($this->Auth->loggedIn()){
        	$pid=$this->Auth->User('user_id');
        	$data = $this->User->find('first', array(
        	'conditions' => array(
        		'User.user_id' => $pid,
        		)
        	));
        $this->set("data",$data);
        if($data['User']['user_type']==1){
        	$a=$data['User']['foreign_id'];
            $data1=$this->Student->find('first',array(
            	'conditions' => array(
            		'Student.student_id' => $a,
            		)
            	));
            $this->set("data1",$data1);
            $this->loadModel("ComaTransaction");
            $data2=$this->ComaTransaction->find('all',array(
                'conditions' => array(
                    'ComaTransaction.student_id' => $a,
                    )
                ));
            $this->loadModel("Coma");
            for($i=0;$i<count($data2);$i++){
                $temp=$data2[$i]['ComaTransaction']['coma_id'];
                $arr[]=$data3=$this->Coma->find('first',array(
                    'conditions' => array(
                        'Coma.coma_id' => $temp,
                        )
                    ));
            }
            $this->set("arr",$arr);
        }
        }
		$this->set ( 'error', $error );
    }
        
	function EditProfile() {
	}
	function Destroy() {
	}
	function Statistic() {
	}
	function BuyLesson() {
	}
	function Test() {
	}
	function DoTest() {
		$nFileName = "testfile.tsv"; // Hidden due to security reasons.
		$nRow = 1;
		
		$nFile = fopen ( $nFileName, "r" );
		
		$finalTest;
		
		if ($nFile !== FALSE) {
			$temp = 0;
			$temp_temp = 0;
			$arrayLen = 0;
			$indexItem = "Question";
			$questionNumber = 1;
			$questionContent;
			$optNumber = 1;
			$optionIndex = "Option";
			
			$result;
			
			$finalTest;
			$arrayOption;
			while ( ! feof ( $nFile ) ) {
				$nLineData = fgets ( $nFile );
				$temp_temp ++;
				if ($temp_temp > 4) {
					
					// echo "$nLineData ketthuc<br>"; //Debug, Works Fine.
					$flagQuestion = 0; // doc cau hoi
					                   // $nLineData = mb_convert_encoding($nLineData, "UTF-8");
					$nLineData = mb_convert_encoding ( $nLineData, "UTF-8", "JIS,SJIS, eucjp-win, sjis-win" );
					
					$nParsed = explode ( "\t", $nLineData, - 1 );
					if (count ( $nParsed ) == 3) {
						if (strcmp ( $nParsed [0], " " ) != 0) {
							if (strcmp ( $nParsed [1], "QS" ) == 0) {
								$indexItem = "Question " . $questionNumber;
								$questionContent = $nParsed [2];
							} else {
								
								if (strcmp ( $nParsed [1], "KS" ) == 0) {
									// $resultStrTemp = multiexplode(array("S(",")"),$nParsed[2]);
									// print_r($resultStrTemp);
									$resultStr = substr ( $nParsed [2], 2, - 1 );
									$result = intval ( $resultStr );
									// $result = $nParsed[2];
									// echo $result;
									
									$arrTemp = array (
											"content" => $questionContent 
									);
									$arrTemp += $arrayOption;
									$arrTemp += array (
											"mark" => $result 
									);
									
									$arrResult = array (
											$indexItem => $arrTemp 
									);
									if ($temp == 0) {
										$finalTest = $arrResult;
										$temp ++;
									} else
										$finalTest += $arrResult;
									
									$questionNumber ++;
									$indexItem = "Question";
									$optNumber = 1;
									$optionIndex = "Option";
								} else {
									
									$optionIndex = "Option" . $optNumber;
									if ($optNumber == 1) {
										$arrayOption = array (
												$optionIndex => $nParsed [2] 
										);
									} else {
										$arrayOption += array (
												$optionIndex => $nParsed [2] 
										);
									}
									$optNumber ++;
								}
							}
							// echo "$nLineData ketthuc<br>"; //Debug, Works Fine.
							// echo "$nParsed[2] <br>";
						}
					}
					
					// echo "Parsed Line - " & $nParsed[0] & "<br>"; //Debug, Outputs Junk (eg Line 4 = @P)
					// echo "<br> Parsed Line - $nParsed[0] <br>"; //Debug, Outputs Proper (eg Line 4 = #START)
				}
			}
			
			// print_r($finalTest);
			$this->set ( "test_list", $finalTest );
			$this->testList = $finalTest;
			fclose ( $nFile );
			// return $finalTest;
		}
		// return null;
		
		if (! $this->request->is ( "post" )) {
		} else {
			
			$data = $this->request->data ['Student'];
			print_r ( $data );
			// $this->testList = $this->DoTest();
			// if($this->testList != null)
			// //print_r($this->testList);
			$temp = 0;
			foreach ( $data as $q => $m ) {
				if (strcmp ( $q, "timer" ) != 0) {
					$str = "Option" . $finalTest [$q] ['mark'];
					if (strcmp ( $str, $m ) == 0)
						$temp ++;
				}
				else $timeTemp = $m;
			}
// 			echo $temp;
			$reTemp = count($data) - 1;
			$timeTemp = 
// 			$this->ViewTestResult($temp, 5);
// 			$this->redirect ( '/student/viewtestresult/?hit='.$temp.'&total='.$reTemp.'&time='.$timeTemp );
			$this->redirect ( array (
					'controller' => 'student',
					'action' => 'viewtestresult',
					'hit' => $temp,
					'total' => $reTemp,
					'time' => $timeTemp 
			) );
			//
		}
	}
	function ViewTestResult() {
// 		print_r ($this->params['url']);
		print_r( $this->request->params);
		$this->set('hit',$this->request->params['named']['hit']);
		$this->set('total',$this->request->params['named']['total']);
		$this->set('time',$this->request->params['named']['time']);
// 		$this->set('hit',$this->params['url']['hit']);
// 		$this->set('total',$this->params['url']['total']);
// 		$this->set('time',$this->params['url']['time']);
// 		$this->set ( 'hit', $this->request->params->url['hit'] );
// 		$this->set ( 'total', $this->request->params->url['total'] );
	}
	function ChangePassword() {
	}
}
