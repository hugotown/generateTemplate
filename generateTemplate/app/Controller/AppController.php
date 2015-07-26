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
App::import('Vendor', 'JWT', array('file' => __DIR__ . '/JWT/jwt.php'));

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{    
	public $components = array(
		'Session',
        'Auth' => array(
            'authorize' => array(
                'Actions' => array('actionPath' => 'controllers')
            )
        ),
        'Cakeular.Cakeular'
	);

	public function beforeFilter()
	{
		parent::beforeFilter();

    	//$this->log('controller name');

    	if($this->params->action == 'api') {

    		$method = isset($this->request->query["method"]) ? $this->request->query["method"]:null;
    		$controller = $this->params->controller;

    		$token = $this->request->header('token');
    		
    		if($token) {
    			$tokenData = JWT::decode($token, Configure::read('Security.salt'));
    			$this->Auth->authorize = array('Controller');
				
				$this->loadModel('User');
				$user = $this->User->find('first', array(
				    'conditions' => array('User.id' => 1),
				));

				$user["tokenData"] = $tokenData;

    			$this->Auth->login($user);
    		}
    		else {
	    		if ( $method =='login' && $controller == 'users' 
	    			|| $method=='recoveryPassword' && $controller == 'users'
	    			|| $method == 'recoveryRestorePassword' && $controller == 'users'
	    			)
	    		{
	    			$this->Auth->authorize = array('Controller');
	          		$this->Auth->loginAction = array('plugin' => null,'prefix' => null,'admin' => false, 'controller' => $controller, 'action' => 'api');
	    		} 
	    		else{
					$loggedUser = $this->Session->read('Auth.User');
					if (!$loggedUser) {
						$this->log( "There is no session..." );
						$this->layout = 'ajax';
						throw new ForbiddenException();
						//throw new BadRequestException();
						
					}  
					$this->Auth->authorize = array('Controller');			
	    		}
    		}

    	}	
	}

	public function isAuthorized($user) {
		//$this->log('isAuthorized');
		//$this->log($this->action);
		//$this->log($this->request->method());
		//$this->log($this->request);
		//$this->log($user);

		if(isset($user["tokenData"])) {

			$tokenCtrl 	=  Inflector::pluralize($user["tokenData"]->type);
			$controller =  strtolower($this->params->controller);

			//debug($user["tokenData"]->readonly_ctrls);

			if( $controller == 'utils' ||
				(($controller == 'users' || in_array($controller, $user["tokenData"]->readonly_ctrls)) 
					&& ($this->request->method()) == 'GET')) {
				$permissions = array(1=>1);	
			}
			else {

				if((strtolower($this->params->controller) == strtolower($tokenCtrl)))
				{
					//TODO: check perms at record level for POST & PUT methods...
					if(($this->request->method()) == 'GET') {
						if(isset($this->params->pass[0])) {
							if( $this->params->pass[0] == $user["tokenData"]->id) {
								$permissions = array(1=>1);
							}
						}
					}
					elseif (in_array($this->request->method(), array('POST', 'PUT'))) {
						$permissions = array(1=>1);
					}

				}
			}
		}
		else {

			$smethod = "get";
			if("" !== $this->request->method() )
			{
				$smethod = $this->request->method();
			}

			$this->loadModel('GroupsCtrl');
			$this->GroupsCtrl->recursive = 1;

			$arrConditions = array(
					'Group.name =' => isset($user["Group"]["name"]) ? $user["Group"]["name"] : '',
					'LOWER(Ctrl.name) =' =>  strtolower( isset( $this->params->controller ) ? $this->params->controller : ''  ),
					'do'.strtolower( $smethod ).' =' => true
				);

			//$this->log('conditions');
			//$this->log($arrConditions);

			$permissions = $this->GroupsCtrl->find('all', array(
				'conditions' => $arrConditions
			));
		}

		//$this->log('is permission granted');
		//$this->log($permissions);

		if( empty( $permissions ) )
		{
			//throw new ForbiddenException();
			throw new MethodNotAllowedException();
		}
	    
	    return true;
	}
	
}
