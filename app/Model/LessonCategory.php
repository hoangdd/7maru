<?php

class LessonCategory extends AppModel {
    public $useTable = 'coma_categories';
    public function saveLessonCategory($lesson_id, $categories){
        $dataArr = array();
        foreach($categories as $category){
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
    public function get_Lesson_categories($coma_id){
        $tags = array();
        $categories = $this->findAllByComaId($coma_id);
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
