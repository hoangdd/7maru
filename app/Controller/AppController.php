	<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
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
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
    public $components = array(
        'Session',
        'DebugKit.Toolbar',
        'Auth' => array(
            'authenticate' => array(
                'Form' => array(
                    'userModel' => 'User',
                    'fields' => array(
                        'username' => 'username',
                        'password' =>'password',
                    ),
                    'passwordHasher' => array(
                        'className' => 'Simple',
                        'hashType' => 'sha1'
                    )
                )
            ),
            'loginAction' => array(
                'controller' => 'Login',
                'action' => 'index',
            ),
            'loginRedirect' =>array(
                'controller' => 'Home',
                'action' => 'index'
            ),
            'authError' => 'You don\'t have permission to view this page',
        ),

    );
     public function beforeFilter() {
        parent::beforeFilter();
        if(!$this->__permission()){
            echo '403 Forbidden error.';

        }

    }
    private function __permission($user_role = null, $current_controller = null){
        $role = isset($user_role) ? $user_role : $this->Auth->user('role');

        if( !is_array($current_controller)){
            $current_controller = array();
        }
        $controller = array_merge($current_controller, array(
            'controller' => $this->name,
            'action' => $this->action,
        ));

        //string to lowwer
        $controller['controller'] = strtolower($controller['controller']);
        $controller['action'] = strtolower($controller['action']);

        

        if( empty($role)) $role = 'R4'; //guest

        $userRolesData = Configure::read('userRoles');
        $userRoles = $userRolesData[$role];

        if( empty($userRoles) ) return false; //invalid role;

        if( isset($userRoles['*']) && $userRoles['*']=='*') return true;

        if( empty($userRoles[$controller['controller']]) ) return false;

        if( $userRoles[$controller['controller']]=='*' ) return true;

        if( in_array($controller['action'], $userRoles[$controller['controller']]) )
            return true;

        return false;
    }
}
