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
				'user_type' => 1
				),
			'fields' => array(
				'username','user_id'
				)
			));
		$this->set('keyword',$data['keyword']);
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
							$bindCondition = array(
								'Lesson.created >= ' => $q['time']['from'],
								'Lesson.created <= ' => $q['time']['to'],
							);
						}else{
							$bindCondition = array();
						}

						//author
						if( !empty($q['author'])){
							$bindCondition['Lesson.author'] = $q['author'];
						}
						debug($bindCondition);

						$order = array();
						//order
						if( !empty($q['order']) && $q['order'] != 'category' ){
							$order['Lesson'] = $q['order'];
						}else{
							$order['Lesson'] = '';
						}
						if( !empty($q['order']) && $q['order'] == 'Category.name' ){
							$order['Category'] = $q['order'];
						}else{
							$order['Category'] = '';
						}
						$this->Lesson->bindModel(array(
							'belongsTo' => array(
									'User' => array(
										'foreignKey' => 'author',
										)
								)
							));
						$this->LessonCategory->bindModel(array(
									'belongsTo' => array(
											'Lesson' => array(
													'foreignKey' => 'coma_id',
													'conditions' => $bindCondition,
													'order' => $order['Lesson']
												),
											'Category' => array(
													'foreignKey' => 'category_id',
													'order' => $order['Category']
												)
										)
								)
							);
						$conditions = array();
						$categories = explode(' ', $q['category']);


						//remove last empty element
						unset($categories[sizeof($categories)-1]);

						if( !empty($categories)){
							$conditions['LessonCategory.category_id'] = $categories;
						}
						$this->LessonCategory->recursive = 2;
						$data['Lesson'] = $this->LessonCategory->find('all', array(
								'conditions' => $conditions,
							));

						if( !empty($q['keyword'])){
							foreach ($data['Lesson'] as $key => $value) {
								//search
								$searchSet = $value['Lesson']['name'].'|'.$value['Lesson']['title'].'|'.$value['Lesson']['description'];
								if( strpos($searchSet, $q['keyword']) == false){
									unset($data['Lesson'][$key]);
								}
							}
						}
						if( !empty($q['rate'])){
							$rates = explode(' ', $q['rate']);

							//remove last empty element
							unset($rates[sizeof($rates)-1]);
							foreach ($data['Lesson'] as $key => $value) {
								//rate
								$r = $this->RateLesson->get_mean_rate($value['Lesson']['coma_id']);
								if( in_array($r, $rates)){
									$data[$key]['Lesson']['rate'] = $r;
								}else{
									unset($data[$key]);
								}
							}
						}
						debug($data['Lesson']);
						break;

					case 'teacher':
						# code...
						$data['User'] = $this->User->find('all', array(
								'conditions' => array(
									'user_type' => 1
									)
							));
						if( !empty($q['keyword'])){
							foreach ($data['User'] as $key => $value) {
								//search
								$searchSet = $value['User']['username'].'|'.$value['User']['lastname'].'|'.$value['User']['address'].'|'
								.$value['User']['phone_number'].'|'.$value['User']['mail'];
								if( strpos($searchSet, $q['keyword']) == false){
									unset($data['User'][$key]);
								}
							};
						}
						// debug($data['User']);

						break;

					case 'student':
						# code...
						break;

					default:
						# code...
						break;
				}
			}
		}
		$this->set('data', $data);
		if( empty($data['User'])&&empty($data['Lesson']) ){
			echo __('No result found');
			die;
		}
	}

	function tag( $id = null){

	}
}
