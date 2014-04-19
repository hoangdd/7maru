<?php
class UserController extends AppController {
	public $primaryKey = 'user_id';
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

	function notify(){
		if ($this->Auth->loggedIn()){
			$this->loadModel('Notification');
			$userId = $this->Auth->user('user_id');
			$notifies = $this->Notification->find('all',array(
				'conditions' => array(
						'user_id' => $userId						
					),
				'order' => 'created DESC'
			));
			$this->set(compact('notifies'));
		}
		else{
			$this->Session->setFlash(__('Error'));
			$this->redirect(array('controller' => 'home','action' => 'index'));
		}
	}

	function changeStateNotify($notify_id = null){
		if ($notify_id == null){
			return;
		}
		$this->loadModel('Notification');
		$this->Notification->id = $notify_id;
		$result = $this->Notification->saveField('viewed',1);
		if ($result){
			echo "1";
		}
		else
			echo "0";
		die;
	}

	function getContentNotify($notify_id = null){
		if ($notify_id == null){
			return;
		}
		$this->loadModel('Notification');
		$notify = $this->Notification->find('first',array(
				'conditions' => array(
						'user_id' => $userId						
					),
				'fields' => array('content')
			));
		if ($notify){
			echo $notify['Notification']['content'];
		}
		else
			echo "0";
		die;
	}

	function delete($user_id = null){
		if ($user_id == null){
			if ($this->Auth->loggedIn()){
				$user_id = $this->Auth->user('user_id');				
				$result = $this->deleteUser($user_id);
				if ($result)	{
					$this->Session->setFlash(__('Delete').__('Successfull'));
					$this->redirect(array('controller' => 'login','action' => 'logout'));					
				}
				else{
					$this->Session->setFlash(__('Delete').__('Error'));
					$this->redirect();		
				}					
			}
			die;
		}	
		if ($this->request->is('get')){
			if ($this->Auth->loggedIn()){
				$user = $this->Auth->User();
				if ($user['role'] !== 'R1'){
					die;
				}
				$result = $this->deleteUser($user_id);
				if ($result){
					echo 1;die;
				}
				else{
					echo 0;die;
				}
			}
		}
		die;
	}

	private function deleteUser($user_id){
		return $this->User->delete($user_id,true);		
	}
}
