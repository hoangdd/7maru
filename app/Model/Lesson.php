<?php

class Lesson extends AppModel {
	public $useTable = 'comas';
    
	public $primaryKey = 'coma_id';
	public $hasMany = array(
		'Data' => array(
			'foreignKey' => 'coma_id',
			'dependent' => true,			
		),
		'LessonTransaction' => array(
			'foreignKey' => 'coma_id',
			'dependent' => true
		),
		'ReportLesson' => array(
			'foreignKey' => 'coma_id',
			'dependent' => true
		),
		'RateLesson' => array(
			'foreignKey' => 'coma_id',
			'dependent' => true
		),
		'LessonCategory' => array(
			'foreignKey' => 'coma_id',
			'dependent' => true
		),
		'LessonReference' => array(
			'foreignKey' => 'coma_id',
			'dependent' => true
		)		
	);
	public function deleteLesson($id){        
            $id = $this->request->data['id'];            
            if ($this->Lesson->delete($id, true)) {
                echo "1";
            } else {
                echo "0";
            }
            die;                   
   }
	public function increaseView($coma_id){
        $lesson = $this->read(null,$coma_id);
        $this->set('viewed',$lesson['Lesson']['viewed']+1);
        $this->save();
    }
	public  function beforeSave($option = array()){
		$data = $this->data['Lesson'];
		$this->log($this->data['Lesson'], 'hlog');
		if(	!empty($data['cover'])&&
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
		}else{
			//phan biet truong hop create va update
			if( empty($data['coma_id']))
				$data['cover'] = DEFAULT_COVER_IMAGE;
			else
				unset($data['cover']);
		}
		$this->data['Lesson'] = $data;
	}
}
