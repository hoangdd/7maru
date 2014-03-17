<?php

class Category extends AppModel {
	public $primaryKey = 'category_id';
	function get_all_category_name($categories_id){
		$tags = array();
		foreach ($categories_id as $category_id) {
			$category = $this->findByCategoryId($category_id);
			if($category){
				$tags[] = $category['Category']['name'];
			}
		}
		return $tags;
	}
}
