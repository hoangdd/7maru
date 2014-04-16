<?php 
	class Config extends AppModel{
		public $primaryKey = 'config_id';

		public function loadConfig(){
			$config = $this->find('all');			
			//format array
			$customizeConfig = array();
			foreach($config as $c){
				$customizeConfig[$c['Config']['config_id']] = $c['Config']['value'];
			}
			Configure::write('customizeConfig',$customizeConfig);
		}

		public function write($key,$value){
			$this->id = $key;
			$this->saveField('value',$value);
			//Configure::write('7maru_config.'.$key,$value);
		}
	}

?>