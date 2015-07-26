<?php
App::uses('ModelBehavior', 'Model');
App::import('Component', 'Session');
App::import('Model','TeamsUser');
App::import('Model','Employeeposition');

class RestrictedViewBehavior extends ModelBehavior {

	protected $_key = 'RestrictedView';
	
	public function setup(Model $Model, $settings = array()) {

		if($Model->alias != 'Employeepositions' && $Model->alias != 'Employeeposition' && $Model->alias != 'TeamsUser' && $Model->alias != "Session" && 
			$Model->alias != "LoyaltyprogramsAccount" && $Model->alias != "LoyaltyprogramCounter") {

			$loggedUser = CakeSession::read('Auth.User');
			if(isset($loggedUser)) {
				
				if (!isset($this->settings[$Model->alias])) {
					$this->settings[$Model->alias] = array(
							'userTeams' => $this->getUserTeams($loggedUser["User"]["id"]),
							'userPositions' => $this->getUserPositions($loggedUser["Employeeposition"]["id"]),
					);
				}
				$this->settings[$Model->alias] = array_merge(
						$this->settings[$Model->alias], (array)$settings);
			}
		}
	}

	public function beforeFind(Model $Model, $qry) {
		
		$loggedUser = CakeSession::read('Auth.User');

		//debug($loggedUser);
		if(!isset($qry['joins'])) {
			$qry['joins'] = array();
		}
		if(!isset($qry['conditions'])) {
			$qry['conditions'] = array();
		}
				
		if(isset($this->settings[$Model->alias])) {
			
			if(isset($this->settings[$Model->alias]["userTeams"])) {
				$teams 		= $this->settings[$Model->alias]["userTeams"];
				
				$condition =  array();
			
				if($Model->hasField("team_id")) {
					$condition["AND"][$Model->alias . ".team_id"] = $teams;
					//debug($qry);
				}	
				else {
					if($Model->hasField("account_id")) {
						$condition["AND"]["OR"]["Account.team_id"] = $teams;
						$condition["AND"]["OR"]["Account.id"] = '';
						//debug($qry);
					}
				}
				
				array_push($qry['conditions'],$condition);
				
			}
			if(isset($this->settings[$Model->alias]["userPositions"])) {
				
				$positions 	= $this->settings[$Model->alias]["userPositions"];
				$condition =  array();
				
				if($Model->hasField("assigned_user")) {
					
					$processRule = true;
					if(isset($Model->extRestrictedViewJoin)) {
					
						$extJoin =  $Model->extRestrictedViewJoin;
					
						if($extJoin["table"] == "dynamic") {
							$processRule = false;
						}
					}
					if($processRule) {
						$loggedUser = CakeSession::read('Auth.User');
						
						array_push($qry['joins'], 
								array('table' => 'users',
										'alias' => 'AssUser',
										'type' => 'LEFT',
										'conditions' => array(
												'AssUser.id = ' . $Model->alias . '.assigned_user',
										)
						));
						if($loggedUser["Employeeposition"]["id"] != 0 && ($loggedUser["Employeeposition"]["id"])) {
							array_push($qry['joins'],
									array('table' => 'employeepositions',
											'alias' => 'EmpPositions',
											'type' => 'INNER',
											'conditions' => array(
													'EmpPositions.id = AssUser.employeeposition_id',
											)
							));				
							$qry["conditions"]["AND"]["EmpPositions.id"] = $positions;	
						}
					}
				}				
			}
			if(isset($this->settings[$Model->alias]["userPositions"])) {
			
				$positions 	= $this->settings[$Model->alias]["userPositions"];
				$condition2 =  array();
				
				if(isset($Model->extRestrictedViewJoin)) {
					
					$extJoin =  $Model->extRestrictedViewJoin;
					
					if($extJoin["table"] == "dynamic") {
						
						$strPositions = implode(",", $positions);
						$strPositions = "'" . str_replace(",","','", $strPositions) . "'";
						
						$parentObjects = array("Servicerequest" => array("table"=>"servicerequests","fk"=>"assigned_user"),
								"Account" => array("table"=>"accounts","fk"=>"created_by"),
								"Opportunity" => array("table"=>"opportunities","fk"=>"owner"),
								"Quote" => array("table"=>"quotes","fk"=>"owner"),
								"Order" => array("table"=>"orders","fk"=>"owner"),
								"Survey" => array("table"=>"surveys","fk"=>"assigned_user")
						);
						
						$subQryExpr = " 0 < CASE";
						foreach($parentObjects as $obj=>$tbl) {
							$subQryExpr = $subQryExpr . " WHEN " . $Model->alias . "." . $extJoin["dynTableField"] . "= '" . $obj ."'";
							$subQryExpr = $subQryExpr . " THEN (SELECT COUNT(1) FROM " . $tbl["table"] ." as ParentTable INNER JOIN users ON (users.id=ParentTable." . $tbl["fk"] .")";
							$subQryExpr = $subQryExpr . " LEFT JOIN employeepositions ON (employeepositions.id= users.employeeposition_id)";
							$subQryExpr = $subQryExpr . " WHERE (employeepositions.id IN (" .$strPositions . ") OR employeepositions.id IS NULL)";
							$subQryExpr = $subQryExpr . " AND ParentTable.id=" . $Model->alias . "." . $extJoin["foreignKey"] .")";							
						}
						$subQryExpr = $subQryExpr . " ELSE 0 END";
						 
						$condition2["AND"]["OR"] = array();
						array_push($condition2["AND"]["OR"], $subQryExpr);
					}
					else {
						$conditionsSubQuery = array(
								$extJoin["table"].'.' . $extJoin["foreignKey"] . ' = ' . $extJoin["modelKey"],
						);						

						$conditionsSubQuery["AND"]["OwnerEmpPositions.id"] = $positions;
						
						$joinsSubQuery = array();
						
						array_push($joinsSubQuery,
								array('table' => 'users',
										'alias' => 'OwnerUser',
										'type' => 'LEFT',
										'conditions' => array(
												'OwnerUser.id = ' . $extJoin["table"] . '.user_id',
										)
						));
						
						array_push($joinsSubQuery,
								array('table' => 'employeepositions',
										'alias' => 'OwnerEmpPositions',
										'type' => 'LEFT',
										'conditions' => array(
												'OwnerEmpPositions.id = OwnerUser.employeeposition_id',
										)
						));
											
						$db = $Model->getDataSource();
						$subQuery = $db->buildStatement(
								array(
										'fields'     => array('COUNT(1)'),
										'table'      => $extJoin["table"],
										'alias'      => $extJoin["table"],
										'limit'      => null,
										'offset'     => null,
										'joins'      => $joinsSubQuery,
										'conditions' => $conditionsSubQuery,
										'order'      => null,
										'group'      => null
								),
								$Model
						);
						$subQuery = ' 0 <  (' . $subQuery . ') ';
						$subQueryExpression = $db->expression($subQuery);
						
						//debug($subQueryExpression);
	
						//$condition2["AND"]["OR"]["OwnerEmpPositions.id"] = $positions;
						$condition2["AND"]["OR"][$Model->alias . ".owner"] = $loggedUser["User"]["id"];
						array_push($condition2["AND"]["OR"], $subQueryExpression);
					}
				}
				
				if($Model->hasField("owner")) {
						
						array_push($qry['joins'], 
								array('table' => 'users',
										'alias' => 'Owner2User',
										'type' => 'LEFT',
										'conditions' => array(
												'Owner2User.id = ' . $Model->alias . '.owner',
										)
						));
						array_push($qry['joins'],
								array('table' => 'employeepositions',
										'alias' => 'Owner2EmpPositions',
										'type' => 'LEFT',
										'conditions' => array(
												'Owner2EmpPositions.id = Owner2User.employeeposition_id',
										)
						));
						
						if(!isset($Model->extRestrictedViewJoin)) {
							$condition2["AND"]["OR"]["Owner2EmpPositions.id"] = $positions;
							array_push($condition2["AND"]["OR"], array("Owner2EmpPositions.id" => ''));
						}
						else {
							$condition2["AND"]["OR"]["Owner2EmpPositions.id"] = $positions;
						}
				}
				
				array_push($qry['conditions'],$condition2);
			}
						
		}
		
		
		/*if($Model->alias == "Activity") {
			debug($qry);
			$db = $Model->getDataSource();
			$parsed = $db->buildStatement($qry,
					$Model
			);	
			debug($parsed);		
		}*/
		
		return($qry);
	}

	private function getUserTeams($userId) {
		
		
		$TeamsUser =new TeamsUser();
		
		$userTeams = $TeamsUser->find('list', array(
				'fields' => array('TeamsUser.team_id'),
				'conditions' => array('TeamsUser.user_id' => $userId),
		));
		
		return(array_values($userTeams));
		//return implode(",",array_values($userTeams));
	}
	
	private function getUserPositions($posId) {
		
		$Employeeposition =new Employeeposition();

		$positions = $Employeeposition->children($posId);
		//debug($posId);
		$positions = Set::combine( $positions, '{n}.Employeeposition.id', '{n}.Employeeposition.id' );
		$arrReturn = array_values($positions);
		
		array_push($arrReturn, $posId);

		return($arrReturn);
	}
}