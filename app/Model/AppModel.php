<?php
/**
 * Application model for CakePHP.
 *
 * This file is application-wide model file. You can put all
 * application-wide model-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Model
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Model', 'Model');

/**
 * Application model for Cake.
 *
 * Add your application-wide methods in the class below, your models
 * will inherit them.
 *
 * @package       app.Model
 */
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
class AppModel extends Model {

	public $tablePrefix = '7maru_';
	public $actsAs = array('Containable');
	//hash password with #sha1 -> return string[40]
	protected static function _hashPassword($inputString = null){
		if( !empty($inputString)){
			$hasher = new SimplePasswordHasher(array('hashType' =>'sha1'));
			return $hasher->hash((string)$inputString);
		}else{
			return false;
		}
	}

	//generate id -> return string[8]
	protected function _generateId($inputString = null){
		if( !empty($inputString)){
			return  hash('crc32', (string)$inputString);
		}else{
			return false;
		}
	}

}
