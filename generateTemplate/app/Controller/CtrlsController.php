<?php
	App::uses('AppController', 'Controller');

	/**
	 * Ctrls Controller
	 *
	 * @property Ctrl $Ctrl
	 * @property PaginatorComponent $Paginator
	 */
	class CtrlsController extends AppController {

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

								$this->Ctrl->recursive = -1;
								$ctrls = $this->Ctrl->find('all', array(
									'conditions' => array(
										'Ctrl.'. $parentField . ' LIKE ' => '%' . $parentValue . '%'
									)
								));
							}
							catch(Exception $ex) {
								$error = $this->Cakeular->error('failure',$ex->getMessage());
								$ctrls = array('Ctrl' => $error );
							}
						} 
		 				elseif($method != null)
						{
							try{
								$ctrls = $this->$method( $params );				
								$this->set(compact('ctrls'));
							}
							catch( Exception $ex ) {
								$error = $this->Cakeular->error( 'failure','Invalid Request Method : ' . $ex->getMessage() );
								$ctrls = array(
									'Ctrl' => $error
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
						    
						    //$ctrls = $this->Paginator->paginate('Ctrl');
						    
						    $conditions = array();

						    if($parentObj != '') {
						    	$conditions = array("`" . $parentObj . '`.`id` =' => $parentId);
						    }

	            			// CHANGE FOR THE DESIRED OUTPUT FIELDS ARRAY HERE...
						    $fields = array(
								'Ctrl.createdAt',
								'Ctrl.updatedAt',
								'Ctrl.createdBy',
								'Ctrl.updatedBy',
								'Ctrl.name',
								'Ctrl.lov_ctrl_status',
								'Ctrl.id',
							);
					        $this->paginate = array(
					            'fields' => $fields,
					            'conditions' => $conditions
					        );		
			       			$this->Table->emptyElements = 0;
			       			// Change fields here...
					        $this->Table->fields = array($fields);

						    $ctrls = $this->Table->getResponse();
						}

						$this->set(compact('ctrls','id'));
					} elseif(!$this->Ctrl->exists($id)){
						$error = $this->Cakeular->error('failure','The Ctrl was not found');
						$ctrl = array(
							'Ctrl' => $error
						);
						$this->set(compact('ctrl','id'));
					} else {
						$ctrl = $this->Ctrl->find('first', array('conditions' => array('Ctrl.' . $this->Ctrl->primaryKey => $id)));
						$this->set(compact('ctrl','id'));
					}
					break;
				case 'POST':
					if(!isset($this->request->data['body'])){
						$error = $this->Cakeular->error('failure','POST body is missing');
						$ctrls = array(
							'Ctrl' => $error
						);
						$this->set(compact('ctrls'));
						break;
					}
					$this->Ctrl->create();
					try {
						if ($this->Ctrl->save(json_decode($this->request->data['body'], true))) {
							$message = $this->Cakeular->message('success','The Ctrl was added');
							$ctrls = array(
								'Ctrl' => $message,
								'id' => $this->Ctrl->getLastInsertID()
							);
							$this->set(compact('ctrls'));
						} else {
							$error = $this->Cakeular->error('failure','The Ctrl was not saved');
							$ctrls = array(
								'Ctrl' => $error,
								'validationErrors' => $this->Ctrl->validationErrors
							);
							$this->set(compact('ctrls'));
						}
					}
					catch(Exception $ex) {
						$error = $this->Cakeular->error('failure',$ex->getMessage());
						$ctrls = array('Ctrl' => $error );
						$this->set(compact('ctrls','id'));
					}					
					break;
				case 'PUT':
					if(!$id){
						$error = $this->Cakeular->error('failure','ID parameter missing');
						$ctrls = array(
							'Ctrl' => $error
						);
						$this->set(compact('ctrls'));
						break;
					}
					if(!isset($this->request->data['body'])){
						$error = $this->Cakeular->error('failure','POST body is missing');
						$ctrls = array(
							'Ctrl' => $error
						);
						$this->set(compact('ctrls'));
						break;
					}
					try {
						if ($this->Ctrl->save(json_decode($this->request->data['body'], true))) {
							$message = $this->Cakeular->message('success','The Ctrl was updated');
							$ctrl = array(
								'Ctrl' => $message
							);
							$this->set(compact('ctrl','id'));
						} else {
							$error = $this->Cakeular->error('failure','The Ctrl was not saved');
							$ctrl = array(
								'Ctrl' => $error,
								'validationErrors' => $this->Ctrl->validationErrors
							);
							$this->set(compact('ctrl','id'));
						}
					}
					catch(Exception $ex) {
						$error = $this->Cakeular->error('failure',$ex->getMessage());
						$ctrl = array('Ctrl' => $error );
						$this->set(compact('ctrl','id'));
					}					
					break;
				case 'DELETE':
					if(!$id){
						$error = $this->Cakeular->error('failure','ID parameter missing');
						$ctrls = array(
							'Ctrl' => $error
						);
						$this->set(compact('ctrls'));
						break;
					}
					$this->Ctrl->id = $id;
					if ($this->Ctrl->delete()) {
						$message = $this->Cakeular->message('success','The Ctrl was deleted');
						$ctrl = array(
							'Ctrl' => $message
						);
					} else {
						$error = $this->Cakeular->error('failure','The Ctrl was not deleted');
						$ctrl = array(
							'Ctrl' => $error
						);
					}
					$this->set(compact('ctrl','id'));
					break;
				default:
					$error = $this->Cakeular->error('failure','Invalid Request Method');
					$ctrl = array(
						'Ctrl' => $error
					);
					$this->set(compact('ctrl'));
					break;
			}
			$this->layout = 'ajax';
		}

	}
