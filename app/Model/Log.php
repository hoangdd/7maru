<?php
include(APP . 'Config' . DS . 'log.php');
class Log extends AppModel {
	public static function saveLog($id = 0, $data = array()){

		//get log config
		$logs = Configure::read('logs');

		if( !empty($logs[$id])){
			//get current date
			$config = $logs[$id];

			//get datetime
			$date = date('_Y_m_d');

			if($config['file']){
				CakeLog::write($config['type'].$date, '
					-------------------------------------------------------------------------------------------
					'.$config['message'].'
					DATA: '.implode(" => ",$data).'
					-------------------------------------------------------------------------------------------
					');
			}
			if($config['database']){
				$log = array(
					'content' => $config['message'],
					'data' => implode(" => ",$config)
					);
				$this->create();
				$this->save(array('Log' => $log));
			}
			return true;
		}
		return false;
	}
}
