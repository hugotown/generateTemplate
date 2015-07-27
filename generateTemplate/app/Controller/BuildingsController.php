<?php
	App::uses('AppController', 'Controller');

	/**
	 * Buildings Controller
	 *
	 * @property Building $Building
	 * @property PaginatorComponent $Paginator
	 */
	class BuildingsController extends AppController {

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

								$this->Building->recursive = -1;
								$buildings = $this->Building->find('all', array(
									'conditions' => array(
										'Building.'. $parentField . ' LIKE ' => '%' . $parentValue . '%'
									)
								));
							}
							catch(Exception $ex) {
								$error = $this->Cakeular->error('failure',$ex->getMessage());
								$buildings = array('Building' => $error );
							}
						} 
		 				elseif($method != null)
						{
							try{
								$buildings = $this->$method( $params );				
								$this->set(compact('buildings'));
							}
							catch( Exception $ex ) {
								$error = $this->Cakeular->error( 'failure','Invalid Request Method : ' . $ex->getMessage() );
								$buildings = array(
									'Building' => $error
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
						    
						    //$buildings = $this->Paginator->paginate('Building');
						    
						    $conditions = array();

						    if($parentObj != '') {
						    	$conditions = array("`" . $parentObj . '`.`id` =' => $parentId);
						    }

	            			// CHANGE FOR THE DESIRED OUTPUT FIELDS ARRAY HERE...
						    $fields = array(
								'Building.createdAt',
								'Building.updatedAt',
								'Building.createdBy',
								'Building.updatedBy',
								'Building.name',
								'Building.alias',
								'Building.taxNumber',
								'Building.manager',
								'Building.status',
								'Building.description',
								'Building.id',
							);
					        $this->paginate = array(
					            'fields' => $fields,
					            'conditions' => $conditions
					        );		
			       			$this->Table->emptyElements = 0;
			       			// Change fields here...
					        $this->Table->fields = array($fields);

						    $buildings = $this->Table->getResponse();
						}

						$this->set(compact('buildings','id'));
					} elseif(!$this->Building->exists($id)){
						$error = $this->Cakeular->error('failure','The Building was not found');
						$building = array(
							'Building' => $error
						);
						$this->set(compact('building','id'));
					} else {
						$building = $this->Building->find('first', array('conditions' => array('Building.' . $this->Building->primaryKey => $id)));
						$this->set(compact('building','id'));
					}
					break;
				case 'POST':
					if(!isset($this->request->data['body'])){
						$error = $this->Cakeular->error('failure','POST body is missing');
						$buildings = array(
							'Building' => $error
						);
						$this->set(compact('buildings'));
						break;
					}
					$this->Building->create();
					try {
						if ($this->Building->save(json_decode($this->request->data['body'], true))) {
							$message = $this->Cakeular->message('success','The Building was added');
							$buildings = array(
								'Building' => $message,
								'id' => $this->Building->getLastInsertID()
							);
							$this->set(compact('buildings'));
						} else {
							$error = $this->Cakeular->error('failure','The Building was not saved');
							$buildings = array(
								'Building' => $error,
								'validationErrors' => $this->Building->validationErrors
							);
							$this->set(compact('buildings'));
						}
					}
					catch(Exception $ex) {
						$error = $this->Cakeular->error('failure',$ex->getMessage());
						$buildings = array('Building' => $error );
						$this->set(compact('buildings','id'));
					}					
					break;
				case 'PUT':
					if(!$id){
						$error = $this->Cakeular->error('failure','ID parameter missing');
						$buildings = array(
							'Building' => $error
						);
						$this->set(compact('buildings'));
						break;
					}
					if(!isset($this->request->data['body'])){
						$error = $this->Cakeular->error('failure','POST body is missing');
						$buildings = array(
							'Building' => $error
						);
						$this->set(compact('buildings'));
						break;
					}
					try {
						if ($this->Building->save(json_decode($this->request->data['body'], true))) {
							$message = $this->Cakeular->message('success','The Building was updated');
							$building = array(
								'Building' => $message
							);
							$this->set(compact('building','id'));
						} else {
							$error = $this->Cakeular->error('failure','The Building was not saved');
							$building = array(
								'Building' => $error,
								'validationErrors' => $this->Building->validationErrors
							);
							$this->set(compact('building','id'));
						}
					}
					catch(Exception $ex) {
						$error = $this->Cakeular->error('failure',$ex->getMessage());
						$building = array('Building' => $error );
						$this->set(compact('building','id'));
					}					
					break;
				case 'DELETE':
					if(!$id){
						$error = $this->Cakeular->error('failure','ID parameter missing');
						$buildings = array(
							'Building' => $error
						);
						$this->set(compact('buildings'));
						break;
					}
					$this->Building->id = $id;
					if ($this->Building->delete()) {
						$message = $this->Cakeular->message('success','The Building was deleted');
						$building = array(
							'Building' => $message
						);
					} else {
						$error = $this->Cakeular->error('failure','The Building was not deleted');
						$building = array(
							'Building' => $error
						);
					}
					$this->set(compact('building','id'));
					break;
				default:
					$error = $this->Cakeular->error('failure','Invalid Request Method');
					$building = array(
						'Building' => $error
					);
					$this->set(compact('building'));
					break;
			}
			$this->layout = 'ajax';
		}

	}
