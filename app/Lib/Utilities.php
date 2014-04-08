<?php 
/**
* 	PHP lib function
*	coded by Hoang Dac 
*/

//===================================================================
// function to convert 'Y-m-d' pattern date string to 'd-m-Y' pattern
//===================================================================
class Utilities{
	public function convertDate($dateString,$format = 'd-m-Y'){
		$date = date_create($dateString);				
		return date_format($date,$format);
	}
}
?>
