<?php

class LessonTransaction extends AppModel {
	public $useTable = 'coma_transactions';
	/**
    * ゆーざーは授業を買ったか、そして、その授業は今勉強できるかどうかをチェックする。
    *
    */
    public function had_active_transaction($user_id, $coma_id){
        $transaction = $this->query("Select * from 7maru_coma_transactions WHERE coma_id = '$coma_id' AND student_id = '$user_id'");
        if($transaction){
        	return true;
        	//@TODO Kiem tra xem da het thoi gian hoc hay chua????s
        }
    }

}
