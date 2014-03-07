<?php 
/**
* 	PHP lib function
*	coded by Hoang Dac 
*/

//===================================================================
// function to convert 'Y-m-d' pattern date string to 'd-m-Y' pattern
//===================================================================
class Utilities{
	public function convertDate($dateString){	
		$date = DateTime::createFromFormat('Y/m/d', $dateString);
		return $date->format('d-m-Y');
	}
}
?>
