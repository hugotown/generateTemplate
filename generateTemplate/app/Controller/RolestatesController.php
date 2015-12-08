<?php
	App::uses('AppController', 'Controller');

	/**
	 * Rolestates Controller
	 *
	 * @property Rolestate $Rolestate
	 * @property PaginatorComponent $Paginator
	 */
	class RolestatesController extends AppController {

		/**
		 * Components
		 *
		 * @var array
		 */
		public $components = array('Paginator', 'Cakeular.Cakeular', 'Table');

		/**
		 * index method
		 *
		 * @return void
		 */
		public function index() {
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

								$this->Rolestate->recursive = -1;
								$rolestates = $this->Rolestate->find('all', array(
									'conditions' => array(
										'Rolestate.'. $parentField . ' LIKE ' => '%' . $parentValue . '%'
									)
								));
							}
							catch(Exception $ex) {
								$error = $this->Cakeular->error('failure',$ex->getMessage());
								$rolestates = array('Rolestate' => $error );
							}
						} 
		 				elseif($method != null)
						{
							try{
								$rolestates = $this->$method( $params );				
								$this->set(compact('rolestates'));
							}
							catch( Exception $ex ) {
								$error = $this->Cakeular->error( 'failure','Invalid Request Method : ' . $ex->getMessage() );
								$rolestates = array(
									'Rolestate' => $error
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
						    
						    //$rolestates = $this->Paginator->paginate('Rolestate');
						    
						    $conditions = array();

						    if($parentObj != '') {
						    	$conditions = array("`" . $parentObj . '`.`id` =' => $parentId);
						    }

	            			// CHANGE FOR THE DESIRED OUTPUT FIELDS ARRAY HERE...
						    $fields = array(
								'Rolestate.id',
								'Rolestate.createdAt',
								'Rolestate.updatedAt',
								'Rolestate.createdBy',
								'Rolestate.updatedBy',
								'Role.name',
								'Rolestate.role_id',
								'Rolestate.statename',
								'Rolestate.accessit',
								'Rolestate.lov_rolestate_status',
							);
					        $this->paginate = array(
					            'fields' => $fields,
					            'conditions' => $conditions
					        );		
			       			$this->Table->emptyElements = 0;
			       			// Change fields here...
					        $this->Table->fields = array($fields);

						    $rolestates = $this->Table->getResponse();
						}

						$this->set(compact('rolestates','id'));
					} elseif(!$this->Rolestate->exists($id)){
						$error = $this->Cakeular->error('failure','The Rolestate was not found');
						$rolestate = array(
							'Rolestate' => $error
						);
						$this->set(compact('rolestate','id'));
					} else {
						$rolestate = $this->Rolestate->find('first', array('conditions' => array('Rolestate.' . $this->Rolestate->primaryKey => $id)));
						$this->set(compact('rolestate','id'));
					}
					break;
				case 'POST':
					if(!isset($this->request->data['body'])){
						$error = $this->Cakeular->error('failure','POST body is missing');
						$rolestates = array(
							'Rolestate' => $error
						);
						$this->set(compact('rolestates'));
						break;
					}
					$this->Rolestate->create();
					try {
						if ($this->Rolestate->save(json_decode($this->request->data['body'], true))) {
							$message = $this->Cakeular->message('success','The Rolestate was added');
							$rolestates = array(
								'Rolestate' => $message,
								'id' => $this->Rolestate->getLastInsertID()
							);
							$this->set(compact('rolestates'));
						} else {
							$error = $this->Cakeular->error('failure','The Rolestate was not saved');
							$rolestates = array(
								'Rolestate' => $error,
								'validationErrors' => $this->Rolestate->validationErrors
							);
							$this->set(compact('rolestates'));
						}
					}
					catch(Exception $ex) {
						$error = $this->Cakeular->error('failure',$ex->getMessage());
						$rolestates = array('Rolestate' => $error );
						$this->set(compact('rolestates','id'));
					}					
					break;
				case 'PUT':
					if(!$id){
						$error = $this->Cakeular->error('failure','ID parameter missing');
						$rolestates = array(
							'Rolestate' => $error
						);
						$this->set(compact('rolestates'));
						break;
					}
					if(!isset($this->request->data['body'])){
						$error = $this->Cakeular->error('failure','POST body is missing');
						$rolestates = array(
							'Rolestate' => $error
						);
						$this->set(compact('rolestates'));
						break;
					}
					try {
						if ($this->Rolestate->save(json_decode($this->request->data['body'], true))) {
							$message = $this->Cakeular->message('success','The Rolestate was updated');
							$rolestate = array(
								'Rolestate' => $message
							);
							$this->set(compact('rolestate','id'));
						} else {
							$error = $this->Cakeular->error('failure','The Rolestate was not saved');
							$rolestate = array(
								'Rolestate' => $error,
								'validationErrors' => $this->Rolestate->validationErrors
							);
							$this->set(compact('rolestate','id'));
						}
					}
					catch(Exception $ex) {
						$error = $this->Cakeular->error('failure',$ex->getMessage());
						$rolestate = array('Rolestate' => $error );
						$this->set(compact('rolestate','id'));
					}					
					break;
				case 'DELETE':
					if(!$id){
						$error = $this->Cakeular->error('failure','ID parameter missing');
						$rolestates = array(
							'Rolestate' => $error
						);
						$this->set(compact('rolestates'));
						break;
					}
					$this->Rolestate->id = $id;
					if ($this->Rolestate->delete()) {
						$message = $this->Cakeular->message('success','The Rolestate was deleted');
						$rolestate = array(
							'Rolestate' => $message
						);
					} else {
						$error = $this->Cakeular->error('failure','The Rolestate was not deleted');
						$rolestate = array(
							'Rolestate' => $error
						);
					}
					$this->set(compact('rolestate','id'));
					break;
				default:
					$error = $this->Cakeular->error('failure','Invalid Request Method');
					$rolestate = array(
						'Rolestate' => $error
					);
					$this->set(compact('rolestate'));
					break;
			}
			$this->layout = 'ajax';
		}

	}
