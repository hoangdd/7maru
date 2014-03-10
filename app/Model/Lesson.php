<?php

class Lesson extends AppModel {
	public $useTable = 'comas';
    public $primaryKey = 'coma_id';
//        public $belongsTo = array(
//            'User' => array(
//            'className' => 'User',
//            'foreignKey' => 'author',
    ////        )
    //    );
    
    public function increaseView($coma_id){
        $lesson = $this->read(null,$coma_id);
        $this->set('viewed',$lesson['Lesson']['viewed']+1);
        $this->save();
    }
}
