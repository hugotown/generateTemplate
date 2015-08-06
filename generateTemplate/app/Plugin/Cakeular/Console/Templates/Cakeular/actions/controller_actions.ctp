<?php
/**
 * Bake Template for Controller action generation.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       Cake.Console.Templates.default.actions
 * @since         CakePHP(tm) v 1.3
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
?>	
<?php $pluralHumanName = Inflector::classify($pluralHumanName); ?>
<?php $singularHumanName = Inflector::classify($singularHumanName); ?>
<?php
		
		$modelObj = new $currentModelName();
		$schema = $modelObj->schema(true);
		$fields = array_keys($schema);
		//debug($fields);
?>

		/**
		 * <?php echo $admin ?>index method
		 *
		 * @return void
		 */
		public function <?php echo $admin ?>index() {
			$this->layout = 'Cakeular.angular';
		}

		/**
		 * JSON API method
		 * generated by mcred/Cakeular Plugin
		 *
		 * @link          https://github.com/mcred/Cakeular
		 *
		 * @return void
		 * @throws exception
		 */
		public function api($id = null) {
			$method = isset($this->request->query["method"]) ? $this->request->query["method"]:null;
			$params = isset($this->request->query["params"]) ? $this->request->query["params"]:null;
			
			switch ($this->request->method()) {
				case 'GET':
					if (!$id) {

						if( isset($this->request->query["parent_field"]) && isset($this->request->query["parent_value"]) ) {
							try {
								$parentField = $this->request->query["parent_field"];
								$parentValue = $this->request->query["parent_value"];

								$this-><?php echo $currentModelName; ?>->recursive = -1;
								$<?php echo $pluralName; ?> = $this-><?php echo $currentModelName; ?>->find('all', array(
									'conditions' => array(
										'<?php echo $currentModelName; ?>.'. $parentField . ' LIKE ' => '%' . $parentValue . '%'
									)
								));
							}
							catch(Exception $ex) {
								$error = $this->Cakeular->error('failure',$ex->getMessage());
								$<?php echo $pluralName; ?> = array('<?php echo $singularHumanName; ?>' => $error );
							}
						} 
		 				elseif($method != null)
						{
							try{
								$<?php echo $pluralName; ?> = $this->$method( $params );				
								$this->set(compact('<?php echo $pluralName; ?>'));
							}
							catch( Exception $ex ) {
								$error = $this->Cakeular->error( 'failure','Invalid Request Method : ' . $ex->getMessage() );
								$<?php echo $pluralName; ?> = array(
									'<?php echo $singularHumanName; ?>' => $error
								);
							}
						} else {
							$parentObj = '';
							if(isset($this->request->query["parentObj"])) {
						    	$parentObj 	= $this->request->query["parentObj"];
						    }
						    $parentId = '';
						    if(isset($this->request->query["parentId"])) {
						    	$parentId	= $this->request->query["parentId"];
						    }
						    $this->Paginator->settings = array(
						    	'page' => $this->request->query["page"],
						        'limit' => $this->request->query["count"]
						    );
						    
						    //$<?php echo $pluralName; ?> = $this->Paginator->paginate('<?php echo $currentModelName; ?>');
						    
						    $conditions = array();

						    if($parentObj != '') {
						    	$conditions = array("`" . $parentObj . '`.`id` =' => $parentId);
						    }

	            			// CHANGE FOR THE DESIRED OUTPUT FIELDS ARRAY HERE...
						    $fields = array(
<?php foreach ($fields as $field): ?>
<?php if(!in_array($field, array('updated_by','created_by'))): ?>
<?php if(strpos($field, '_id') !== FALSE): ?>
<?php list($table, $key) = explode('_', $field); ?>
								'<?php echo Inflector::classify($table); ?>.name',
								'<?php echo $currentModelName; ?>.<?php echo $field; ?>',
<?php else: ?>
								'<?php echo $currentModelName; ?>.<?php echo $field; ?>',
<?php endif; ?>
<?php endif; ?>
<?php endforeach; ?>
							);
					        $this->paginate = array(
					            'fields' => $fields,
					            'conditions' => $conditions
					        );		
			       			$this->Table->emptyElements = 0;
			       			// Change fields here...
					        $this->Table->fields = array($fields);

						    $<?php echo $pluralName; ?> = $this->Table->getResponse();
						}

						$this->set(compact('<?php echo $pluralName; ?>','id'));
					} elseif(!$this-><?php echo $currentModelName; ?>->exists($id)){
						$error = $this->Cakeular->error('failure','The <?php echo $singularHumanName; ?> was not found');
						$<?php echo $singularName; ?> = array(
							'<?php echo $singularHumanName; ?>' => $error
						);
						$this->set(compact('<?php echo $singularName; ?>','id'));
					} else {
						$<?php echo $singularName; ?> = $this-><?php echo $currentModelName; ?>->find('first', array('conditions' => array('<?php echo $currentModelName; ?>.' . $this-><?php echo $currentModelName; ?>->primaryKey => $id)));
						$this->set(compact('<?php echo $singularName; ?>','id'));
					}
					break;
				case 'POST':
					if(!isset($this->request->data['body'])){
						$error = $this->Cakeular->error('failure','POST body is missing');
						$<?php echo $pluralName; ?> = array(
							'<?php echo $singularHumanName; ?>' => $error
						);
						$this->set(compact('<?php echo $pluralName; ?>'));
						break;
					}
					$this-><?php echo $currentModelName; ?>->create();
					try {
						if ($this-><?php echo $currentModelName; ?>->save(json_decode($this->request->data['body'], true))) {
							$message = $this->Cakeular->message('success','The <?php echo $singularHumanName; ?> was added');
							$<?php echo $pluralName; ?> = array(
								'<?php echo $singularHumanName; ?>' => $message,
								'id' => $this-><?php echo $currentModelName; ?>->getLastInsertID()
							);
							$this->set(compact('<?php echo $pluralName; ?>'));
						} else {
							$error = $this->Cakeular->error('failure','The <?php echo $singularHumanName; ?> was not saved');
							$<?php echo $pluralName; ?> = array(
								'<?php echo $singularHumanName; ?>' => $error,
								'validationErrors' => $this-><?php echo $currentModelName; ?>->validationErrors
							);
							$this->set(compact('<?php echo $pluralName; ?>'));
						}
					}
					catch(Exception $ex) {
						$error = $this->Cakeular->error('failure',$ex->getMessage());
						$<?php echo $pluralName; ?> = array('<?php echo $singularHumanName; ?>' => $error );
						$this->set(compact('<?php echo $pluralName; ?>','id'));
					}					
					break;
				case 'PUT':
					if(!$id){
						$error = $this->Cakeular->error('failure','ID parameter missing');
						$<?php echo $pluralName; ?> = array(
							'<?php echo $singularHumanName; ?>' => $error
						);
						$this->set(compact('<?php echo $pluralName; ?>'));
						break;
					}
					if(!isset($this->request->data['body'])){
						$error = $this->Cakeular->error('failure','POST body is missing');
						$<?php echo $pluralName; ?> = array(
							'<?php echo $singularHumanName; ?>' => $error
						);
						$this->set(compact('<?php echo $pluralName; ?>'));
						break;
					}
					try {
						if ($this-><?php echo $currentModelName; ?>->save(json_decode($this->request->data['body'], true))) {
							$message = $this->Cakeular->message('success','The <?php echo $singularHumanName; ?> was updated');
							$<?php echo $singularName; ?> = array(
								'<?php echo $singularHumanName; ?>' => $message
							);
							$this->set(compact('<?php echo $singularName; ?>','id'));
						} else {
							$error = $this->Cakeular->error('failure','The <?php echo $singularHumanName; ?> was not saved');
							$<?php echo $singularName; ?> = array(
								'<?php echo $singularHumanName; ?>' => $error,
								'validationErrors' => $this-><?php echo $currentModelName; ?>->validationErrors
							);
							$this->set(compact('<?php echo $singularName; ?>','id'));
						}
					}
					catch(Exception $ex) {
						$error = $this->Cakeular->error('failure',$ex->getMessage());
						$<?php echo $singularName; ?> = array('<?php echo $singularHumanName; ?>' => $error );
						$this->set(compact('<?php echo $singularName; ?>','id'));
					}					
					break;
				case 'DELETE':
					if(!$id){
						$error = $this->Cakeular->error('failure','ID parameter missing');
						$<?php echo $pluralName; ?> = array(
							'<?php echo $singularHumanName; ?>' => $error
						);
						$this->set(compact('<?php echo $pluralName; ?>'));
						break;
					}
					$this-><?php echo $currentModelName; ?>->id = $id;
					if ($this-><?php echo $currentModelName; ?>->delete()) {
						$message = $this->Cakeular->message('success','The <?php echo $singularHumanName; ?> was deleted');
						$<?php echo $singularName; ?> = array(
							'<?php echo $singularHumanName; ?>' => $message
						);
					} else {
						$error = $this->Cakeular->error('failure','The <?php echo $singularHumanName; ?> was not deleted');
						$<?php echo $singularName; ?> = array(
							'<?php echo $singularHumanName; ?>' => $error
						);
					}
					$this->set(compact('<?php echo $singularName; ?>','id'));
					break;
				default:
					$error = $this->Cakeular->error('failure','Invalid Request Method');
					$<?php echo $singularName; ?> = array(
						'<?php echo $singularHumanName; ?>' => $error
					);
					$this->set(compact('<?php echo $singularName; ?>'));
					break;
			}
			$this->layout = 'ajax';
		}
