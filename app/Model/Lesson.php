<?php

class Lesson extends AppModel {
	public $useTable = 'comas';
    
	public $primaryKey = 'coma_id';
	// public $belongsTo = array(
	// 	'User' => array(
	// 		'className' => 'User',
	// 		'foreignKey' => 'author',
	// 		)
	// 	);
	public function increaseView($coma_id){
        $lesson = $this->read(null,$coma_id);
        $this->set('viewed',$lesson['Lesson']['viewed']+1);
        $this->save();
    }
	public  function beforeSave($option = array()){
		$data = $this->data['Lesson'];

		if(!empty($data['cover'])&&
			!empty($data['cover']['tmp_name'])&&
			!empty($data['cover']['name'])
		){
			// save lesson cover image
			// cover name
			$nameStr = $data['cover']['tmp_name'].rand();
			$filename = crc32($nameStr);
			$ext = pathinfo($data['cover']['name'], PATHINFO_EXTENSION);
			move_uploaded_file($data['cover']['tmp_name'], LESSON_COVER_DIR.DS.$filename.'.'.$ext);
			$data['cover'] = $filename.'.'.$ext;
			$this->data['Lesson'] = $data;
		}
	}
}
