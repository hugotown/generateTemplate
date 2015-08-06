<?php
	App::uses('AppController', 'Controller');

	/**
	 * Users Controller
	 *
	 * @property User $User
	 * @property PaginatorComponent $Paginator
	 */
	class UsersController extends AppController {

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

								$this->User->recursive = -1;
								$users = $this->User->find('all', array(
									'conditions' => array(
										'User.'. $parentField . ' LIKE ' => '%' . $parentValue . '%'
									)
								));
							}
							catch(Exception $ex) {
								$error = $this->Cakeular->error('failure',$ex->getMessage());
								$users = array('User' => $error );
							}
						} 
		 				elseif($method != null)
						{
							try{
								$users = $this->$method( $params );				
								$this->set(compact('users'));
							}
							catch( Exception $ex ) {
								$error = $this->Cakeular->error( 'failure','Invalid Request Method : ' . $ex->getMessage() );
								$users = array(
									'User' => $error
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
						    
						    //$users = $this->Paginator->paginate('User');
						    
						    $conditions = array();

						    if($parentObj != '') {
						    	$conditions = array("`" . $parentObj . '`.`id` =' => $parentId);
						    }

	            			// CHANGE FOR THE DESIRED OUTPUT FIELDS ARRAY HERE...
						    $fields = array(
								'User.createdAt',
								'User.updatedAt',
								'User.createdBy',
								'User.updatedBy',
								'User.username',
								'User.email',
								'User.password',
								'User.name',
								'User.firstName',
								'User.lastName',
								'User.gender',
								'Group.name',
								'User.group_id',
								'Workstation.name',
								'User.workstation_id',
								'User.status',
								'User.id',
							);
					        $this->paginate = array(
					            'fields' => $fields,
					            'conditions' => $conditions
					        );		
			       			$this->Table->emptyElements = 0;
			       			// Change fields here...
					        $this->Table->fields = array($fields);

						    $users = $this->Table->getResponse();
						}

						$this->set(compact('users','id'));
					} elseif(!$this->User->exists($id)){
						$error = $this->Cakeular->error('failure','The User was not found');
						$user = array(
							'User' => $error
						);
						$this->set(compact('user','id'));
					} else {
						$user = $this->User->find('first', array('conditions' => array('User.' . $this->User->primaryKey => $id)));
						$this->set(compact('user','id'));
					}
					break;
				case 'POST':
					if(!isset($this->request->data['body'])){
						$error = $this->Cakeular->error('failure','POST body is missing');
						$users = array(
							'User' => $error
						);
						$this->set(compact('users'));
						break;
					}
					$this->User->create();
					try {
						if ($this->User->save(json_decode($this->request->data['body'], true))) {
							$message = $this->Cakeular->message('success','The User was added');
							$users = array(
								'User' => $message,
								'id' => $this->User->getLastInsertID()
							);
							$this->set(compact('users'));
						} else {
							$error = $this->Cakeular->error('failure','The User was not saved');
							$users = array(
								'User' => $error,
								'validationErrors' => $this->User->validationErrors
							);
							$this->set(compact('users'));
						}
					}
					catch(Exception $ex) {
						$error = $this->Cakeular->error('failure',$ex->getMessage());
						$users = array('User' => $error );
						$this->set(compact('users','id'));
					}					
					break;
				case 'PUT':
					if(!$id){
						$error = $this->Cakeular->error('failure','ID parameter missing');
						$users = array(
							'User' => $error
						);
						$this->set(compact('users'));
						break;
					}
					if(!isset($this->request->data['body'])){
						$error = $this->Cakeular->error('failure','POST body is missing');
						$users = array(
							'User' => $error
						);
						$this->set(compact('users'));
						break;
					}
					try {
						if ($this->User->save(json_decode($this->request->data['body'], true))) {
							$message = $this->Cakeular->message('success','The User was updated');
							$user = array(
								'User' => $message
							);
							$this->set(compact('user','id'));
						} else {
							$error = $this->Cakeular->error('failure','The User was not saved');
							$user = array(
								'User' => $error,
								'validationErrors' => $this->User->validationErrors
							);
							$this->set(compact('user','id'));
						}
					}
					catch(Exception $ex) {
						$error = $this->Cakeular->error('failure',$ex->getMessage());
						$user = array('User' => $error );
						$this->set(compact('user','id'));
					}					
					break;
				case 'DELETE':
					if(!$id){
						$error = $this->Cakeular->error('failure','ID parameter missing');
						$users = array(
							'User' => $error
						);
						$this->set(compact('users'));
						break;
					}
					$this->User->id = $id;
					if ($this->User->delete()) {
						$message = $this->Cakeular->message('success','The User was deleted');
						$user = array(
							'User' => $message
						);
					} else {
						$error = $this->Cakeular->error('failure','The User was not deleted');
						$user = array(
							'User' => $error
						);
					}
					$this->set(compact('user','id'));
					break;
				default:
					$error = $this->Cakeular->error('failure','Invalid Request Method');
					$user = array(
						'User' => $error
					);
					$this->set(compact('user'));
					break;
			}
			$this->layout = 'ajax';
		}

	}