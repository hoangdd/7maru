<?php
class StudentController extends AppController {
	public $testList;
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
    	$nFileName = "testfile.tsv"; //Hidden due to security reasons.
    	$nRow = 1;
    	
    	$nFile = fopen($nFileName, "r");
    	
    	
    	if ($nFile !== FALSE) {
    		$temp = 0;$temp_temp=0;$arrayLen = 0;$indexItem = "Question";$questionNumber = 1;$questionContent;$optNumber = 1;
    		$optionIndex = "Option";
    	
    		$result;
    	
    		$finalTest;
    		$arrayOption;
    		while (!feof($nFile)) {
    			$nLineData = fgets($nFile);
    			$temp_temp++;
    			if($temp_temp>4) {
    	
    	
    				//echo "$nLineData ketthuc<br>"; //Debug, Works Fine.
    				$flagQuestion = 0;//doc cau hoi
//     				$nLineData = mb_convert_encoding($nLineData, "UTF-8");
    				$nLineData = mb_convert_encoding($nLineData, "UTF-8","JIS,SJIS, eucjp-win, sjis-win");
    				
    				$nParsed = explode("\t", $nLineData, -1);
    				if((strcmp($nParsed[0],"") != 0) && (count($nParsed) == 3)) {
    					if(strcmp($nParsed[1],"QS")==0) {
    						$indexItem = "Question ".$questionNumber;
    						$questionContent = $nParsed[2];
    					} else {
    						 
    						if(strcmp($nParsed[1],"KS")==0) {
    							//$resultStrTemp = multiexplode(array("S(",")"),$nParsed[2]);
    							//print_r($resultStrTemp);
    							$resultStr = substr($nParsed[2],2,-1);
    							$result = intval($resultStr);
    							//	                                $result = $nParsed[2];
    							//echo $result;
    							 
    							$arrTemp = array(
    									"content" => $questionContent
    							);
    							$arrTemp += $arrayOption;
    							$arrTemp += array("mark" => $result);
    							 
    							$arrResult = array(
    									$indexItem => $arrTemp
    									 
    							);
    							if($temp == 0) {$finalTest = $arrResult; $temp++;}
    							else $finalTest += $arrResult;
    							 
    							$questionNumber++;
    							$indexItem = "Question";
    							$optNumber = 1;
    							$optionIndex = "Option";
    						} else {
    							 
    							$optionIndex = "Option".$optNumber;
    							if($optNumber == 1) {
    								$arrayOption = array($optionIndex => $nParsed[2]);
    								 
    							}
    							else {
    								$arrayOption += array($optionIndex => $nParsed[2]);
    							}
    							$optNumber++;
    						}
    					}
    					//echo "$nLineData ketthuc<br>"; //Debug, Works Fine.
    					//echo "$nParsed[2] <br>";
    				}
    				 
    				//echo "Parsed Line - " & $nParsed[0] & "<br>"; //Debug, Outputs Junk (eg Line 4 = @P)
    				//echo "<br> Parsed Line - $nParsed[0] <br>"; //Debug, Outputs Proper (eg Line 4 = #START)
    				 
    			}
    			}
    	
    			//print_r($finalTest);
    			$this->set("test_list",$finalTest);
    			$this->testList = $finalTest;	
    			fclose($nFile);
    			return $finalTest;
    		}
    		return null;
	}
	

	function ViewTestResult(){
		if(!$this->request->is("post")) {
			
		}else{
			$data = $this->request->data['Student'];
// 			print_r($data);
			$this->testList = $this->DoTest();
			if($this->testList != null)
			//print_r($this->testList);
			$temp = 0;
			foreach ($data as $q => $m) {
				$str = "Option".$this->testList[$q]['mark'];
				if(strcmp($str,$m) == 0) $temp++;
			}
			echo $temp;
		}
	}

	function ChangePassword(){
		
	}

}
