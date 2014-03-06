<?php

class ComaCategory extends AppModel {
    public function saveComaCategory($lesson_id, $categories){
        $dataArr = array();
        foreach($categories as $category){
            $saveData = array(
                'ComaCategory' => array(
                    'coma_id' => $lesson_id,
                    'category_id' => $category
                )
            );
            $dataArr[] = $saveData;
        }
        $this->saveMany($dataArr);
    }
}
