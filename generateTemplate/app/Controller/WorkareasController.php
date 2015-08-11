<?php
	App::uses('AppController', 'Controller');

	/**
	 * Workareas Controller
	 *
	 * @property Workarea $Workarea
	 * @property PaginatorComponent $Paginator
	 */
	class WorkareasController extends AppController {

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

								$this->Workarea->recursive = -1;
								$workareas = $this->Workarea->find('all', array(
									'conditions' => array(
										'Workarea.'. $parentField . ' LIKE ' => '%' . $parentValue . '%'
									)
								));
							}
							catch(Exception $ex) {
								$error = $this->Cakeular->error('failure',$ex->getMessage());
								$workareas = array('Workarea' => $error );
							}
						} 
		 				elseif($method != null)
						{
							try{
								$workareas = $this->$method( $params );				
								$this->set(compact('workareas'));
							}
							catch( Exception $ex ) {
								$error = $this->Cakeular->error( 'failure','Invalid Request Method : ' . $ex->getMessage() );
								$workareas = array(
									'Workarea' => $error
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
						    
						    //$workareas = $this->Paginator->paginate('Workarea');
						    
						    $conditions = array();

						    if($parentObj != '') {
						    	$conditions = array("`" . $parentObj . '`.`id` =' => $parentId);
						    }

	            			// CHANGE FOR THE DESIRED OUTPUT FIELDS ARRAY HERE...
						    $fields = array(
								'Workarea.id',
								'Workarea.createdBy',
								'Workarea.updatedBy',
								'Workarea.createdAt',
								'Workarea.updatedAt',
								'Workarea.name',
								'Workarea.description',
							);
					        $this->paginate = array(
					            'fields' => $fields,
					            'conditions' => $conditions
					        );		
			       			$this->Table->emptyElements = 0;
			       			// Change fields here...
					        $this->Table->fields = array($fields);

						    $workareas = $this->Table->getResponse();
						}

						$this->set(compact('workareas','id'));
					} elseif(!$this->Workarea->exists($id)){
						$error = $this->Cakeular->error('failure','The Workarea was not found');
						$workarea = array(
							'Workarea' => $error
						);
						$this->set(compact('workarea','id'));
					} else {
						$workarea = $this->Workarea->find('first', array('conditions' => array('Workarea.' . $this->Workarea->primaryKey => $id)));
						$this->set(compact('workarea','id'));
					}
					break;
				case 'POST':
					if(!isset($this->request->data['body'])){
						$error = $this->Cakeular->error('failure','POST body is missing');
						$workareas = array(
							'Workarea' => $error
						);
						$this->set(compact('workareas'));
						break;
					}
					$this->Workarea->create();
					try {
						if ($this->Workarea->save(json_decode($this->request->data['body'], true))) {
							$message = $this->Cakeular->message('success','The Workarea was added');
							$workareas = array(
								'Workarea' => $message,
								'id' => $this->Workarea->getLastInsertID()
							);
							$this->set(compact('workareas'));
						} else {
							$error = $this->Cakeular->error('failure','The Workarea was not saved');
							$workareas = array(
								'Workarea' => $error,
								'validationErrors' => $this->Workarea->validationErrors
							);
							$this->set(compact('workareas'));
						}
					}
					catch(Exception $ex) {
						$error = $this->Cakeular->error('failure',$ex->getMessage());
						$workareas = array('Workarea' => $error );
						$this->set(compact('workareas','id'));
					}					
					break;
				case 'PUT':
					if(!$id){
						$error = $this->Cakeular->error('failure','ID parameter missing');
						$workareas = array(
							'Workarea' => $error
						);
						$this->set(compact('workareas'));
						break;
					}
					if(!isset($this->request->data['body'])){
						$error = $this->Cakeular->error('failure','POST body is missing');
						$workareas = array(
							'Workarea' => $error
						);
						$this->set(compact('workareas'));
						break;
					}
					try {
						if ($this->Workarea->save(json_decode($this->request->data['body'], true))) {
							$message = $this->Cakeular->message('success','The Workarea was updated');
							$workarea = array(
								'Workarea' => $message
							);
							$this->set(compact('workarea','id'));
						} else {
							$error = $this->Cakeular->error('failure','The Workarea was not saved');
							$workarea = array(
								'Workarea' => $error,
								'validationErrors' => $this->Workarea->validationErrors
							);
							$this->set(compact('workarea','id'));
						}
					}
					catch(Exception $ex) {
						$error = $this->Cakeular->error('failure',$ex->getMessage());
						$workarea = array('Workarea' => $error );
						$this->set(compact('workarea','id'));
					}					
					break;
				case 'DELETE':
					if(!$id){
						$error = $this->Cakeular->error('failure','ID parameter missing');
						$workareas = array(
							'Workarea' => $error
						);
						$this->set(compact('workareas'));
						break;
					}
					$this->Workarea->id = $id;
					if ($this->Workarea->delete()) {
						$message = $this->Cakeular->message('success','The Workarea was deleted');
						$workarea = array(
							'Workarea' => $message
						);
					} else {
						$error = $this->Cakeular->error('failure','The Workarea was not deleted');
						$workarea = array(
							'Workarea' => $error
						);
					}
					$this->set(compact('workarea','id'));
					break;
				default:
					$error = $this->Cakeular->error('failure','Invalid Request Method');
					$workarea = array(
						'Workarea' => $error
					);
					$this->set(compact('workarea'));
					break;
			}
			$this->layout = 'ajax';
		}

	}