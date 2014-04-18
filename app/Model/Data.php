<?php
class Data extends AppModel {
	public $useTable = 'files';
	public $primaryKey  = 'file_id';
	public $hasMany = array(
		'Comment' => array(
			'foreignKey' => 'file_id',
			'dependent' => true
			)             
		);
	public function beforeSave($option = array()){

		//generate ids 
		$data = $this->data['Data'];		
		$date = getdate();
		$idString = $data['tmp_name'].rand().$date[0];
		$data['file_id'] = hash('crc32', (string)$idString);

		$fileinfo = pathinfo($data['name']);
		// PATHINFO_DIRNAME | PATHINFO_BASENAME | PATHINFO_EXTENSION | PATHINFO_FILENAME

		$ret = $this->__convertAndSave($data['file_id'], $data['tmp_name'], $fileinfo['extension']);
		if($ret == false) return false; //fail
		$data['path'] = $ret;
		$data['coma_id'] = $this->data['Data']['coma_id'];
		$data['file_name'] = $fileinfo['filename'];
		$data['type'] = $fileinfo['extension'];
		$this->data['Data'] = $data;
	}

	private function __convertAndSave($fid, $tmp, $ext){
		$fileType = Configure::read('srcFile');
		// @todo: if file exsist
		//pdf file
		if(in_array($ext, $fileType['pdf']['extension'])){
			if(move_uploaded_file($tmp, DATA_SRC_DIR.DS.$fid.'.'.$ext)){				
				 $this->__convertPdfToSwf(DATA_SRC_DIR.DS.$fid.'.'.$ext, SWF_DATA_DIR.DS.$fid.'.swf');
				// return VIDEO_DATA_DIR.DS.$fid.'.swf';	
				return $fid.'.swf';	
			}
		}

		// audio file
		if(in_array($ext, $fileType['audio']['extension'])){
			if(move_uploaded_file($tmp, AUDIO_DATA_DIR.DS.$fid.'.'.$ext)){
				// return VIDEO_DATA_DIR.DS.$fid.'.'.$ext;
				return $fid.'.'.$ext;
			}
		}

		//video file
		if(in_array($ext, $fileType['video']['extension'])){
			if( move_uploaded_file($tmp, VIDEO_DATA_DIR.DS.$fid.'.'.$ext)){
				// return VIDEO_DATA_DIR.DS.$fid.'.'.$ext;
				return $fid.'.'.$ext;
			}
		}

		//microsoft office > pdf > swf
		if(in_array($ext, $fileType['microsoftOffiece']['extension'])){
			if(move_uploaded_file($tmp, DATA_SRC_DIR.DS.$fid.'.'.$ext)){
				//pdf src file
				$msfile = DATA_SRC_DIR.DS.$fid.'.'.$ext;
				$pdffile = DATA_SRC_DIR.DS.$fid.'.pdf';

				if( $ext == 'doc' || $ext == 'docx'){
					//doc file
					$this->__convertDocToPdf($msfile, $pdffile);

				}else if( $ext == 'ppt' || $ext == 'pptx'){
					//powerpoint file
					$this->__convertPptToPdf($msfile, $pdffile);
				}
				$this->__convertPdfToSwf($pdffile, SWF_DATA_DIR.DS.$fid.'.swf');
				// return VIDEO_DATA_DIR.DS.$fid.'.swf';	
				return $fid.'.swf';	
			}
		}

		//tsv file
		if(in_array($ext, $fileType['tsv']['extension'])){
			// debug($tmp);
			// debug(TSV_DATA_DIR.DS.$fid.'.'.$ext);
			if( move_uploaded_file($tmp, TSV_DATA_DIR.DS.$fid.'.'.$ext)){
				$data = $this->readTsv(TSV_DATA_DIR.DS.$fid.'.'.$ext);
				$jsFileName = HTML_DATA_DIR.DS.$fid.'.js';
				// debug($jsFileName);
				$this->__tsvToJs($jsFileName, $data);
				// return HTML_DATA_DIR.DS.$fid.'.js';
				return $fid.'.js';
			}
		}

		// @todo : microsoft office files
		//not supported
		return false;
	}

	private function __convertPdfToSwf($src, $output){
		$command = Configure::read('command');
		$cmd = sprintf($command['pdf2swf'][0], $src, $output);
		return $this->__execute($cmd);
	}

	private function __convertDocToPdf($src, $output){
		$command = Configure::read('command');
		$cmd = sprintf($command['doc2pdf'][0], $src);
		$currentpath = $this->__execute('pwd');
		$this->__execute($cmd);

		//copy and rename
		$info = pathinfo($src);
		$newfile = $currentpath.DS.$info['filename'].".pdf";
		$this->__execute('cp '.$newfile.' '.$output);
		// $this->__execute('rm '.$newfile);
		return $output;
	}
	private function __convertPptToPdf($src, $output){
		$command = Configure::read('command');
		$cmd = sprintf($command['ppt2pdf'][0], $src);
		$this->__execute($cmd);

		//copy and rename
		$info = pathinfo($src);
		$newfile = $info['dirname(path)'].DS.$info['filename'].".pdf";
		$this->__execute('cp '.$newfile.' '.$output);
		$this->__execute('rm '.$newfile);
		return $output;
	}
	public function readTsv($nFileName) {

		$nRow = 1;
		$nFile = fopen ( $nFileName, "r" );
		$finalTest;
		if ($nFile !== FALSE) {
			$temp = 0;
			$temp_temp = 0;
			$arrayLen = 0;
			$indexItem = "Question";
			$questionNumber = 0;
			$questionContent;
			$optNumber = 0;
			$optionIndex = "Option";

			$result;

			$finalTest;
			$arrayOption;
			while ( ! feof ( $nFile ) ) {
				$nLineData = fgets ( $nFile );
				
				$temp_temp ++;
				if ($temp_temp > 4) {

					$flagQuestion = 0; // doc cau hoi
					// $nLineData = mb_convert_encoding($nLineData, "UTF-8");
					$nLineData = mb_convert_encoding ( $nLineData, "UTF-8", "JIS,SJIS, eucjp-win, sjis-win" );
					$nParsed = explode ( "\t", $nLineData );
					if (count ( $nParsed ) == 3 || count ( $nParsed ) == 4) {
						if (strcmp ( $nParsed [0], "" ) != 0) {
							if (strcmp ( $nParsed [1], "QS" ) == 0) {
								$indexItem = "Question" . $questionNumber;
								$questionContent = $nParsed [2];
							} else {

								if (strcmp ( $nParsed [1], "KS" ) == 0) {
									// $resultStrTemp = multiexplode(array("S(",")"),$nParsed[2]);
									// print_r($resultStrTemp);
									$resultStr = substr ( $nParsed [2], 2, - 1 );
									$markNumber = $nParsed[3];
									$result = intval ( $resultStr );
									$result = $result - 1;
									// $result = $nParsed[2];
									// echo $result;

									$arrTemp = array (
										"content" => $questionContent
										);
									$arrTemp += $arrayOption;
									$arrTemp += array (
										"mark" => $result,
										"markNumber" => $markNumber
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
									$optNumber = 0;
									$optionIndex = "Option";
								} else {

									$optionIndex = "Option" . $optNumber;
									if ($optNumber == 0) {
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

			$this->set ( "test_list", $finalTest );
				// 								$this->testList = $finalTest;
			$jsFilename = "test_store/".$nFileName.'js';
			// $this->tsvToJs($jsFilename,$finalTest);
			fclose ( $nFile );
			return $finalTest;
		}
	}

	private function __tsvToJs($filename,$finalTest){
		$AA = count($finalTest) - 1;
		$data='function Section (sectionName,sectionID,secQues,secTime,secMarks,secNegMark,consumedsecTime,consumedsecq)
			{
				this.sectionName=sectionName;
				this.sectionID=sectionID;
				this.secQues=secQues;
				this.secTime=secTime;
				this.secMarks=secMarks;
				this.secNegMark=secNegMark;
				this.consumedsecTime=consumedsecTime;
				this.consumedsecq=consumedsecq;
			}
	
			function Question(qname,type,qstring,response,img,fid,fname,b_time,diff,testids,sectionid,flag)
			{
				this.qname=qname;
				this.type=type;
				this.qstring=qstring;
				this.response=response;
				this.img=img;
				this.fid=fname;
				this.fname=fid;
				this.b_time=b_time;
				this.diff=diff;
				this.testids=testids;
				this.sectionid=sectionid
				this.flag=flag;
			}
			//document.write(a);
			var zin=1,top=0, mycount=0, waitTime=60 , qright=0, mycomment,nowtime;
			var global=new Array(3);
			var abc,xyz,tm;
			var tname = "Reading Comprehension";
			var tid = "src366";
			var cname = "RC: 1" ;
			var gg = "d";
			var recent, recent2, recdone=false, opera7, opera=CheckOpera56();
			P7_OpResizeFix();
			function P7_OpResizeFix(a) { //v1.1 by PVII
			if(!window.opera){return;}if(!document.p7oprX){
			 document.p7oprY=window.innerWidth;document.p7oprX=window.innerHeight;
			 document.onmousemove=P7_OpResizeFix;
			 }else{if(document.p7oprX){
			  var k=document.p7oprX-window.innerHeight;
			  var j=document.p7oprY - window.innerWidth;
			  if(k>1 || j>1 || k<-1 || j<-1){
			  document.p7oprY=window.innerWidth;document.p7oprX=window.innerHeight;
			  do_reposition();}}}
			}
			function cachewrite(s,idx){global[idx]+=s;}
			function CheckOpera56()
			{
			var version;
			if (navigator.userAgent.toLowerCase().indexOf(\'opera\') == -1) return false;
			version=parseInt(navigator.appVersion.toLowerCase());
			if (version>6) {opera7=true; return false;}
			if (version<5) return false;
			return true;
			}';
		$resTem = '<font face=Arial size=2>';
		$resTemEnd = '</font>';
			$direc = '<b><u>内容:</u></b>';
			$start = 'resp=new Array(';
					$res;$i=0;$j=1;$cot = 0;$startNumber = 1000;
					$quesControl = '';
					// print_r($finalTest);
					foreach ($finalTest as $key => $value){
					$rec = $start;
						foreach($value as $keyT => $valueT){
	
						if((strcmp($keyT,'content')!=0)&&(strcmp($keyT,'mark')!=0)&&(strcmp($keyT,'markNumber')!=0)){
						if($i != 0) {
						$rec .= ',';
						}
								$rec .= '"'.$resTem;
								$rec .= addslashes($valueT);
								$rec .= $resTemEnd.'"';
								$i=1;
						}
	
						}
						if($j == count($finalTest))
							$quesControl .= 'ques'.$cot;
						else $quesControl .= 'ques'.$cot.',';
	
						$rec .= ');comm="";valu="";ques'.$cot.' = new Question(';
						$rec .= '"'.$key.'",0,';
						$rec .= '"'.$resTem.$direc.$resTemEnd.'<p>'.$resTem;
						$rec .= '<b>'.addslashes($value['content']).'</b>';
						$rec .= $resTemEnd.'",';
	
						$rec .= 'resp,';
						$rec .= '"'.$startNumber.'",';
						$rec .= '"'.$startNumber.'",';
						$rec .= '"",';
						$rec .= '0,0,';
						$rec .= '"test_test","1",0);';
	
						$data .= $rec;
	
						$i=0;
						$j++;
						$cot++;
						$startNumber++;
	
					}//END FOR LOOP
	
					$data .= 'questions = new Array ('.$quesControl.');sectionArr0 = new Section(';
					$data .= '"Section 1",';
					$data .= '"1","'.$AA.'","600","1","0",0,0);';
					$data .= 'sectionArr = new Array (sectionArr0);';
	
					
					$fp = fopen($filename, 'w');
					fwrite($fp, $data);
					fclose($fp);
		}

	//execute command
	private function __execute($command) {
		// remove newlines and convert single quotes to double to prevent errors
		$command = str_replace(array("\n", "'"), array('', '"'), $command);

		// replace multiple spaces with one
		$command = preg_replace('#(\s){2,}#is', ' ', $command);

		// escape shell metacharacters
		$command = escapeshellcmd($command);

		// execute convert program
		$logFile = 'call_service';
		$this->log('_____________________________________________', $logFile);
		$this->log($command, $logFile);
		$ret = exec($command.' 2>&1');
		$this->log($ret, $logFile);
		return $ret;
	}
}
