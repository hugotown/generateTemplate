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
class AppModel extends Model {
	
    public $actsAs = array('RestrictedView','Containable');

    public function beforeFind($qry)
    {
        $this->bindModel(
            array('belongsTo' => array(
                    'CreatedBy' => array(
                        'className' => 'User',
                        'foreignKey' => 'created_by'
                    ),
                    'UpdatedBy' => array(
                        'className' => 'User',
                        'foreignKey' => 'updated_by'
                    ),
                )
            )
        );
    } 

    public function beforeSave($options = array()) {

        $loggedUser = CakeSession::read('Auth.User');

        //debug($this->name);

        if (isset($loggedUser)) {

            if (!(isset($this->data[$this->name]['updated_by']))) {
                $this->data[$this->name]['updated_by'] = $loggedUser["User"]["id"];
            }
            if (!(isset($this->data[$this->name]['created_by']))) {
                $this->data[$this->name]['created_by'] = $loggedUser["User"]["id"];
            }
            if (!(isset($this->data[$this->name]['owner']))) {
                $this->data[$this->name]['owner'] = $loggedUser["User"]["id"];
            }
        }

        return true;
    }    
}
