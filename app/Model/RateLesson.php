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
        $count = count($rates);
        if($count){
            $ratePoint = $sum/count($rates);
        }else{
            $ratePoint = 0;
        }
        return $ratePoint;
	}
    public function rate_Lesson($coma_id, $user_id, $ratePoint){
        $rate = $this->find('first',array(
            'conditions'=> array(
                'coma_id'=> $coma_id,
                'student_id'=> $user_id
                )
            )
        );

        if($rate){
            $record = $this->read(null,$rate['RateLesson']['rate_id']);
            $this->set('rate',$ratePoint);
            $this->save();
        } else {
            $this->create();
            $saveData = array(
                    'RateLesson' => array(
                        'coma_id' => $coma_id,
                        'student_id' => $user_id,
                        'rate' => $ratePoint
                    )
                );
            $this->save($saveData);
        }
    }
}
