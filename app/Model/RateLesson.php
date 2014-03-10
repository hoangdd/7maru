<?php

class RateLesson extends AppModel {
	public $useTable = 'rate_comas';
    public $primaryKey = 'rate_id';
    /**
    * 
    */
	public function get_rate_num($coma_id){
		$rates = $this->findAllByComaId($coma_id);
		return count($rates);
	}
	public function get_mean_rate($coma_id){
		$rates = $this->findAllByComaId($coma_id);
        // debug($rates);
        $sum = 0;
        foreach($rates as $rate){
            $sum += $rate['RateLesson']['rate'];
        }
        return $sum/count($rates);
	}
}
