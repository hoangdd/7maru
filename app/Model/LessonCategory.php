<?php

class LessonCategory extends AppModel {
    public $useTable = 'coma_categories';
    public function saveLessonCategory($lesson_id, $categories){
        if($lesson_id == null || count($categories) == 0){

        } else {
            $dataArr = array();
            $ids = $this->find('list', array(
                'fields' => array('id'),
                ));
            $this->deleteAll(array('id' => $ids));
            foreach($categories as $category){

                //check if exsit
                $saveData = array(
                    'LessonCategory' => array(
                        'coma_id' => $lesson_id,
                        'category_id' => $category
                    )
                );
                $dataArr[] = $saveData;
            }
            $this->saveMany($dataArr);    
        }
        
    }
    public function get_Lesson_categories($coma_id){
        $tags = array();
        $categories = $this->findAllByComaId($coma_id);
        $this->log($categories,'hlog');
        // debug($categories);
        if($categories){
            foreach($categories as $category){
                $tags[] = $category['LessonCategory']['category_id'];
            }
        }
        // debug($tags);die();
        return $tags;
    }
}
