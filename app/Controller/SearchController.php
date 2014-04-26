<?php
class SearchController extends AppController {
    public $uses = array('User','Category' ,'LessonCategory', 'Lesson', 'RateLesson');
    public $helpers = array('Html','Form');
    public $components = array('Auth');
   	public function beforeFilter(){
   		parent::beforeFilter();
   		$this->Auth->allow();
   	}
    // search
	function index(){
		$this->set('categories', $this->Category->find('all'));
		$data = $this->request->query;
		$teacher_list = $this->User->find('all', array(
			'conditions' => array(
				'user_type' => 1,
				'activated' => 1,
				'approved' => 1
				),
			'fields' => array(
				'username','user_id'
				)
			));
		$this->set('data',$data);
		$this->set('teacher_list',$teacher_list);
	}

	function ajaxSearch(){
		$this->layout = false;
		$q = $this->request->query;
		$data = array();
		if( !empty($q)){
			$types = explode(' ', $q['type']);
			foreach ($types as $type) {
				switch ($type) {
					case 'lesson':
						# code...
						if( !empty($q['time']['from']) && !empty($q['time']['to'])){
							$lessonConditions = array(
								'Lesson.created >= ' => $q['time']['from'],
								'Lesson.created <= ' => $q['time']['to'],
							);
						}else{
							$lessonConditions = array();
						}

						//author
						if( !empty($q['author'])){
							$authors = explode(' ', $q['author']);
							if( empty($authors[0])) unset($authors[0]);
							if( empty($authors[1])) unset($authors[1]);
							if( !empty($authors)){
								$lessonConditions['Lesson.author'] = $authors;
							}
						}

						$order = array();
						//order
						if( !empty($q['order']) && $q['order'] != 'category' ){
							$order['Lesson'] = $q['order'];
						}else{
							$order['Lesson'] = '';
						}
						if(!empty($q['order']) && $q['order'] == 'Category.name' ){
							$order['Category'] = $q['order'];
						}else{
							$order['Category'] = '';
						}
						
						$categories = explode(' ', $q['category']);
						//remove last empty element
						unset($categories[sizeof($categories)-1]);

						if( !empty($categories)){
							$lessonCategoryConditons['LessonCategory.category_id'] = $categories;
						}						
						$this->Lesson->bindModel(array(
							'hasMany' => array(
								'LessonCategory' => array(
									'foreignKey' => 'coma_id',
									'conditions' => $lessonCategoryConditons,
									'order' => $order['Category']
									),
								),
							'belongsTo' => array(
								'User' => array(
									'foreignKey' => 'author',
									)
								)
							)
						);
						$this->LessonCategory->bindModel(array(
									'belongsTo' => array(
											'Category' => array(
													'foreignKey' => 'category_id',
													'order' => 'name'
												),
										)
								)
							);
						$this->Lesson->recursive = 4;
						//them check user deleted
						$lessonConditions['Lesson.is_block'] = 0;
						$lessons = $this->Lesson->find('all', array(
							'conditions' => $lessonConditions,
							'order' => $order['Lesson'],
							));

						foreach ($lessons as $key => $value) {
							//search
							//them check user deleted
							if (empty($data['User'])) continue;

							$searchSet = strtolower($value['Lesson']['name'].'|'.$value['Lesson']['title'].'|'.$value['Lesson']['description']);
							if( empty($value['LessonCategory']) ){
								unset($data['Lesson'][$key]);
							}
							if( !empty($q['keyword'])){
								$keyword = strtolower($q['keyword']);
								if(strpos($keyword, '+') !==false){
									$flag = true;
									$keywords = explode('+', $keyword);
									foreach ($keywords as $v) {
										$newpos = strpos($searchSet, $v) ;
										if($newpos === false){
											$flag = false;
										}
									}
									if( !$flag ) unset($lessons[$key]);
								}elseif(strpos($keyword, '-') !==false){
									$keywords = explode('-', $keyword);
									$flag = false;
									foreach ($keywords as $v) {
										$newpos = strpos($searchSet, $v) ;
										if($newpos !== false){
											$flag = true;
											break;
										}
									}
									if( !$flag ) unset($lessons[$key]);
								}elseif( strpos($searchSet, $keyword) === false){
									unset($lessons[$key]);
								}
							}

							if( !empty($q['rate'])){
								$rates = explode(' ', $q['rate']);

							//remove last empty element
								unset($rates[sizeof($rates)-1]);
								if( !empty($data['Lesson'][$key]['Lesson'])){
									$r = $this->RateLesson->get_mean_rate($data['Lesson'][$key]['Lesson']['coma_id']);
									if( in_array($r, $rates)){
										$data['Lesson'][$key]['Lesson']['rate'] = $r;
									}else{
										unset($data['Lesson'][$key]);
									}
								}
							}
						}


						$this->set('lessons', $lessons);
						break;

					case 'teacher':
						# code...
						$data['User'] = $this->User->find('all', array(
								'conditions' => array(
									'user_type' => 1,
									'activated' => 1
									)
							));
							foreach ($data['User'] as $key => $value) {
								if( !empty($q['keyword'])){
									$searchSet = strtolower($value['User']['username'].'|'.$value['User']['lastname'].'|'.$value['User']['address'].'|'
									.$value['User']['phone_number'].'|'.$value['User']['mail']);
									$keyword = strtolower($q['keyword']);
									if(strpos($keyword, '+') !==false){
										$flag = true;
										// $pos = -1;
										$keywords = explode('+', $keyword);
										foreach ($keywords as $v) {
											$newpos = strpos($searchSet, $v) ;
											if($newpos === false){
												$flag = false;
											}else{
												// if( $newpos < $pos){
												// 	$flag = false;
												// }else{
												// 	$pos = $newpos;
												// }
											}
										}
										if( !$flag ) unset($data['User'][$key]);
									}elseif(strpos($keyword, '-') !==false){
										$keywords = explode('-', $keyword);
										$flag = false;
										foreach ($keywords as $v) {
											$newpos = strpos($searchSet, $v) ;
											if($newpos !== false){
												$flag = true;
												break;
											}
										}
										if( !$flag ) unset($data['User'][$key]);
									}elseif( strpos($searchSet, $keyword) === false){
										unset($data['User'][$key]);
									}
								}
							}
						// debug($data['User']);

						break;

					case 'category':
						# code...
						$data['Category'] = $this->Category->find('all');
						if( !empty($q['keyword'])){
							foreach ($data['Category'] as $key => $value) {
								//search
								if( !empty($q['keyword'])){
									$searchSet = strtolower($value['Category']['name'].'|'.$value['Category']['description']);
									$keyword = strtolower($q['keyword']);
									if(strpos($keyword, '+') !==false){
										$flag = true;
										$keywords = explode('+', $keyword);
										foreach ($keywords as $v) {
											$newpos = strpos($searchSet, $v) ;
											if($newpos === false){
												$flag = false;
												break;
											}
										}
										if( !$flag ) {
											unset($data['Category'][$key]);
										}
									}elseif(strpos($keyword, '-') !==false){
										$keywords = explode('-', $keyword);
										$flag = false;
										foreach ($keywords as $v) {
											$newpos = strpos($searchSet, $v) ;
											if($newpos !== false){
												$flag = true;
												break;
											}
										}
										if( !$flag ) unset($data['Category'][$key]);
									}elseif( strpos($searchSet, $keyword) === false){
										unset($data['Category'][$key]);
									}
								}
							};
						}
						// debug($data['Category']);
						break;

					default:
						# code...
						break;
				}
			}
		}
		$this->set('data', $data);
		if( empty($data['User'])&&empty($lessons)&&empty($data['Category']) ){
			echo __('No result found');
			die;
		}
	}

	function tag( $id = null){

	}
}
