<?php

class LessonTransaction extends AppModel {
	public $useTable = 'coma_transactions';
	/**
    * ゆーざーは授業を買ったか、そして、その授業は今勉強できるかどうかをチェックする。
    *
    */
    public $primaryKey =  'transaction_id';
    public function had_active_transaction($user_id, $coma_id){
        $limit = Configure::read('customizeConfig.limit_learn_day');
        $conditions = array(
            'coma_id' => $coma_id,
            'student_id' => $user_id,
            'ADDDATE(created,INTERVAL '.$limit.' DAY) >= NOW()'
            );
        $result = $this->find('first',array('conditions' => $conditions));
        if (!$result){
            return false;
        }
        return true;
    }

}
