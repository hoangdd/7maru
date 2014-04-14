<?php
class UserController extends AppController {

	public $helpers = array('Html', 'Session');
	function index(){
		$data = $this->User->find('all');
		$this->set('data',$data);
	}
	function Comment() {
		// comment test
		$this->loadModel('Log');
		debug(Log::saveLog(2));
		die;
		$this->loadModel('Comment');
		$this->loadModel('User');
		$this->Comment->bindModel(array(
			'belongsTo' => array(
					'User' => array(
						'foreignKey' => 'user_id',
						)
				)
			));
		$comments = $this->Comment->find('all');
		$this->set('comments',$comments);
	}

	function createComment(){
		if($this->request->is('ajax')){
			$this->loadModel('Comment');
			$user_id = $this->Auth->user('user_id');
			$file_id = $this->request->data['file_id'];
			$content = $this->request->data['content'];
			if( empty($user_id) || empty($file_id) || empty($content)){
				//invalid
				echo '0';
				die;
			}
			$this->Comment->create(array(
				'user_id' => $user_id,
				'file_id' => $file_id,
				'content' => $content
				));
			$ret = $this->Comment->save();
			if(isset($ret['Comment']['comment_id'])){
				// success
				$this->layout = false;
				$this->set('comment', $ret['Comment']);
				$this->set('user', $this->Auth->user());
			}else{
				//fail
				echo 0;
				die;
			}
		} else die;
	}
	function editComment(){
		if($this->request->is('ajax')){
			$this->loadModel('Comment');
			$user_id = $this->Auth->user('user_id');
			$comment = $this->Comment->read(null, $this->request->data['comment_id']);
			$content = $this->request->data['content'];
			$this->log($comment, 'hlog');
			if( empty($user_id) || empty($comment['Comment']) || empty($content) || $comment['Comment']['user_id'] != $user_id){
				//invalid
				echo '0';
				die;
			}
			$comment['Comment']['content'] = $content;
			$ret = $this->Comment->save($comment);
			if(isset($ret['Comment']['comment_id'])){
				// success
				echo 1;
			}else{
				//fail
				echo 0;
			}
		}
		die;
	}
	function deleteComment(){
		if($this->request->is('ajax')){
			$user_id = $this->Auth->user('user_id');
			$this->loadModel('Comment');
			$comment = $this->Comment->read(null, $this->request->data['comment_id']);
			$this->log($comment, 'hlog');
			if( empty($user_id) || empty($comment['Comment']) || $comment['Comment']['user_id'] != $user_id){
				// invalid
				echo '0';
				die;
			}
			if($this->Comment->delete($comment['Comment']['comment_id']))
				echo 1;
			else
				echo 0;
		}
		die;
	}
}
