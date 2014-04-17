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
	}

	function ajaxSearch(){
		$q = $this->request->query;
		if( !empty($q)){
			$types = explode(' ', $q['type']);
			foreach ($types as $type) {
				switch ($type) {
					case 'lesson':
						# code...
						$this->loadModel('Lesson');
						if( !empty($q['time']['from']) && !empty($q['time']['to'])){
							$bindCondition = array(
								'Lesson.created >= ' => $q['time']['from'],
								'Lesson.created <= ' => $q['time']['to'],
							);
						}else{
							$bindCondition = array();
						}
						$this->LessonCategory->bindModel(array(
									'belongsTo' => array(
											'Lesson' => array(
													'foreignKey' => 'coma_id',
													'conditions' => $bindCondition,	
												)
										)
								)
							);

						$conditions = array();

						$categories = explode(' ', $q['category']);

						//remove last empty element
						unset($categories[sizeof($categories)-1]);
						if( !empty($categories)){
							$conditions['category_id'] = $categories;
						}
					

						$data = $this->LessonCategory->find('all', array(
								'conditions' => $conditions,
							));
						foreach ($data as $key => $value) {
								//search
								$searchSet = $value['Lesson']['name'].'|'.$value['Lesson']['title'].'|'.$value['Lesson']['description'];
								if( strpos($searchSet, $q['keyword']) == false){
									unset($data[$key]);
								}
							};
						if( !empty($q['rate'])){
							$rates = explode(' ', $q['rate']);

							//remove last empty element
							unset($rates[sizeof($rates)-1]);
							foreach ($data as $key => $value) {
								//rate
								$r = $this->RateLesson->get_mean_rate($value['Lesson']['coma_id']);
								if( in_array($r, $rates)){
									$data[$key]['Lesson']['rate'] = $r;
								}else{
									unset($data[$key]);
								}
							}
						}
						debug($data);
						break;

					case 'teacher':
						# code...
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
		die;
	}

	function tag( $id = null){

	}
}
