<?php
	App::uses('AppController', 'Controller');

	/**
	 * Rolesctrls Controller
	 *
	 * @property Rolesctrl $Rolesctrl
	 * @property PaginatorComponent $Paginator
	 */
	class RolesctrlsController extends AppController {

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

								$this->Rolesctrl->recursive = -1;
								$rolesctrls = $this->Rolesctrl->find('all', array(
									'conditions' => array(
										'Rolesctrl.'. $parentField . ' LIKE ' => '%' . $parentValue . '%'
									)
								));
							}
							catch(Exception $ex) {
								$error = $this->Cakeular->error('failure',$ex->getMessage());
								$rolesctrls = array('Rolesctrl' => $error );
							}
						} 
		 				elseif($method != null)
						{
							try{
								$rolesctrls = $this->$method( $params );				
								$this->set(compact('rolesctrls'));
							}
							catch( Exception $ex ) {
								$error = $this->Cakeular->error( 'failure','Invalid Request Method : ' . $ex->getMessage() );
								$rolesctrls = array(
									'Rolesctrl' => $error
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
						    
						    //$rolesctrls = $this->Paginator->paginate('Rolesctrl');
						    
						    $conditions = array();

						    if($parentObj != '') {
						    	$conditions = array("`" . $parentObj . '`.`id` =' => $parentId);
						    }

	            			// CHANGE FOR THE DESIRED OUTPUT FIELDS ARRAY HERE...
						    $fields = array(
								'Rolesctrl.id',
								'Rolesctrl.createdAt',
								'Rolesctrl.updatedAt',
								'Rolesctrl.createdBy',
								'Rolesctrl.updatedBy',
								'Role.name',
								'Rolesctrl.role_id',
								'Ctrl.name',
								'Rolesctrl.ctrl_id',
								'Rolesctrl.getAction',
								'Rolesctrl.postAction',
								'Rolesctrl.putAction',
								'Rolesctrl.patchAction',
								'Rolesctrl.deleteAction',
								'Rolesctrl.copyAction',
								'Rolesctrl.headAction',
								'Rolesctrl.optionsAction',
								'Rolesctrl.linkAction',
								'Rolesctrl.unlinkAction',
								'Rolesctrl.purgeAction',
							);
					        $this->paginate = array(
					            'fields' => $fields,
					            'conditions' => $conditions
					        );		
			       			$this->Table->emptyElements = 0;
			       			// Change fields here...
					        $this->Table->fields = array($fields);

						    $rolesctrls = $this->Table->getResponse();
						}

						$this->set(compact('rolesctrls','id'));
					} elseif(!$this->Rolesctrl->exists($id)){
						$error = $this->Cakeular->error('failure','The Rolesctrl was not found');
						$rolesctrl = array(
							'Rolesctrl' => $error
						);
						$this->set(compact('rolesctrl','id'));
					} else {
						$rolesctrl = $this->Rolesctrl->find('first', array('conditions' => array('Rolesctrl.' . $this->Rolesctrl->primaryKey => $id)));
						$this->set(compact('rolesctrl','id'));
					}
					break;
				case 'POST':
					if(!isset($this->request->data['body'])){
						$error = $this->Cakeular->error('failure','POST body is missing');
						$rolesctrls = array(
							'Rolesctrl' => $error
						);
						$this->set(compact('rolesctrls'));
						break;
					}
					$this->Rolesctrl->create();
					try {
						if ($this->Rolesctrl->save(json_decode($this->request->data['body'], true))) {
							$message = $this->Cakeular->message('success','The Rolesctrl was added');
							$rolesctrls = array(
								'Rolesctrl' => $message,
								'id' => $this->Rolesctrl->getLastInsertID()
							);
							$this->set(compact('rolesctrls'));
						} else {
							$error = $this->Cakeular->error('failure','The Rolesctrl was not saved');
							$rolesctrls = array(
								'Rolesctrl' => $error,
								'validationErrors' => $this->Rolesctrl->validationErrors
							);
							$this->set(compact('rolesctrls'));
						}
					}
					catch(Exception $ex) {
						$error = $this->Cakeular->error('failure',$ex->getMessage());
						$rolesctrls = array('Rolesctrl' => $error );
						$this->set(compact('rolesctrls','id'));
					}					
					break;
				case 'PUT':
					if(!$id){
						$error = $this->Cakeular->error('failure','ID parameter missing');
						$rolesctrls = array(
							'Rolesctrl' => $error
						);
						$this->set(compact('rolesctrls'));
						break;
					}
					if(!isset($this->request->data['body'])){
						$error = $this->Cakeular->error('failure','POST body is missing');
						$rolesctrls = array(
							'Rolesctrl' => $error
						);
						$this->set(compact('rolesctrls'));
						break;
					}
					try {
						if ($this->Rolesctrl->save(json_decode($this->request->data['body'], true))) {
							$message = $this->Cakeular->message('success','The Rolesctrl was updated');
							$rolesctrl = array(
								'Rolesctrl' => $message
							);
							$this->set(compact('rolesctrl','id'));
						} else {
							$error = $this->Cakeular->error('failure','The Rolesctrl was not saved');
							$rolesctrl = array(
								'Rolesctrl' => $error,
								'validationErrors' => $this->Rolesctrl->validationErrors
							);
							$this->set(compact('rolesctrl','id'));
						}
					}
					catch(Exception $ex) {
						$error = $this->Cakeular->error('failure',$ex->getMessage());
						$rolesctrl = array('Rolesctrl' => $error );
						$this->set(compact('rolesctrl','id'));
					}					
					break;
				case 'DELETE':
					if(!$id){
						$error = $this->Cakeular->error('failure','ID parameter missing');
						$rolesctrls = array(
							'Rolesctrl' => $error
						);
						$this->set(compact('rolesctrls'));
						break;
					}
					$this->Rolesctrl->id = $id;
					if ($this->Rolesctrl->delete()) {
						$message = $this->Cakeular->message('success','The Rolesctrl was deleted');
						$rolesctrl = array(
							'Rolesctrl' => $message
						);
					} else {
						$error = $this->Cakeular->error('failure','The Rolesctrl was not deleted');
						$rolesctrl = array(
							'Rolesctrl' => $error
						);
					}
					$this->set(compact('rolesctrl','id'));
					break;
				default:
					$error = $this->Cakeular->error('failure','Invalid Request Method');
					$rolesctrl = array(
						'Rolesctrl' => $error
					);
					$this->set(compact('rolesctrl'));
					break;
			}
			$this->layout = 'ajax';
		}

	}