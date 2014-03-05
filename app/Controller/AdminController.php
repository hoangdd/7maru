<?php
class AdminController extends AppController {
    public $uses = 'User';
	function index(){

	}
    
    function CreateAdmin(){
        
    }
    function Notification(){
        
    }
    
    function login(){

    }

    function changePassword(){
    	
    }
    function ipManage(){
    }

    function statistic(){

    }

    function account(){

    }        
    function userManage(){
        
    }
    function blockUser(){
        
    }
    function ip_manage() {
//     	$data = $this->
    	$totalIp = array('1','2','3','4','5','6','7');
    	$i = 1;$arrayItem;$arrayFinal;
    	foreach ($totalIp as $item) {
    		if($i%3 == 1) $arrayItem = array($item);
    		else $arrayItem = array_merge($arrayItem,array($item));
    		if($i%3 == 0) {
    			if($i/3 <= 1) {
    				
    				$arrayFinal = array('1' => $arrayItem);
    			}
    			else {
    				
    				$ij = $i/3;
    				$arrayFinal += array($ij => $arrayItem);
    			}
    		}
    		$i++;
    		
    	}
    	
    	if($i%3 != 0){
    		$ij = $i/3 + 1;
    		if($i/3 == 0) $arrayFinal = array($ij => $arrayItem);
    		else $arrayFinal += array($ij => $arrayItem);
    	}
    	$this->set("array_list",$arrayFinal);
    }
	//...
}
