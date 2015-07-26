<?php

class TableComponent extends Component{
    
    private $model;
    private $controller;
    public $conditionsByValidate = 0;
    public $emptyElements = 0;
    public $fields = array();
    public $columnsStyle = array();
    
    public function initialize(Controller $controller){
        $this->controller = $controller;
        $modelName = $this->controller->modelClass;
        $this->model = $this->controller->{$modelName};
    }
    
    public function getResponse($controller = null, $model=null){
        
        if($model != null){  
            if(is_string($model)){
                $this->model = $this->controller->{$model};
            }
            else{
                $this->model = $model;
                unset($model);
            }
        }

        $conditions = isset($this->controller->paginate['conditions']) ? $this->controller->paginate['conditions'] : null;

        $isFiltered = false;
        //debug($conditions);
        if( !empty($conditions) ){
            $isFiltered = true;
        }
        
        // check for ORDER BY in GET request
        if(isset($this->controller->request->query) && isset($this->controller->request->query['sort-by'])){
            $orderBy = $this->getOrderByStatements();
            if(!empty($orderBy)){
                $this->controller->paginate = array_merge($this->controller->paginate, array('order'=>$orderBy));
            }
        }
        
        // check for WHERE statement in GET request
        if(isset($this->controller->request->query) && !empty($this->controller->request->query['sSearch'])){
            $conditions = $this->getWhereConditions();

            if( !empty($this->controller->paginate['contain']) ){
                $this->controller->paginate = array_merge_recursive($this->controller->paginate, array('contain'=>$conditions));
            }
            else{
                $this->controller->paginate = array_merge_recursive($this->controller->paginate, array('conditions'=>$conditions));
            }
            $isFiltered = true;
        }
        $this->model->recursive = 1;


        $total          = $this->model->find('count');
        $pageSize       = intval($this->controller->request->query["count"]);
        $currentPage    = intval($this->controller->request->query["page"]);        
        $parameters     = $this->controller->paginate;

        $parameters['offset'] = ($currentPage == 1) ? 0:intval($pageSize * ($currentPage-1));
        $parameters['limit'] = $pageSize;
        //debug($parameters);

        $filteredTotal = $total;
        if($isFiltered){
            $countParams =  $parameters;
            unset($countParams["fields"]);
            unset($countParams["offset"]);
            unset($countParams["limit"]);
            unset($countParams["order"]);
            //debug($countParams);
            $filteredTotal = $this->model->find('count',$countParams);
            //debug($filteredTotal);
            //if($currentPage > 1) {
                //debug($filteredTotal);
                //$filteredTotal = $filteredTotal - ((($currentPage-1) * $pageSize));
              //  debug($filteredTotal);
            //}
        }
        
        array_push($parameters["fields"], 'UpdatedBy.username');
        array_push($parameters["fields"], 'CreatedBy.username');
        /*debug($parameters);
        $db = $this->model->getDataSource();
        $parsed = $db->buildStatement($parameters, $this->model);  
        debug($parsed);*/   
        

        $data = $this->model->find('all', $parameters);

        //debug($data);

        $tableHeader =  array();
        
        foreach($this->fields[0] as $x => $column){
            list($table, $field) = explode('.', $column);
            $fieldObj =  array("key" =>$table . "." .$field, "name" => $table . "." .$field);

            if( !in_array($field, array('updated', 'created', 'updated_by','created_by','assigned_user')) 
                && !in_array($table, array('UpdatedBy','CreatedBy'))
                && (strpos($field, '_id') === FALSE)) {
                array_push($tableHeader, array("key" =>$table . "." .$field, "name" => $table . "." .$field));   
            }
            
        }
        array_push($tableHeader, array("key" =>"actions", "name" => "actions"));


        $pagination = array('count' => $pageSize, 
                'page' => $currentPage,
                'pages' => round($filteredTotal / $pageSize),
                'size' => $filteredTotal
        );
        
        $results = array('rows' => $data, 
                'pagination' => $pagination,
                'header' => $tableHeader,
                'sort-by' => (isset($this->controller->request->query['sort-by']) ? $this->controller->request->query['sort-by']:'id') ,
                'sort-order' => (isset($this->controller->request->query['sort-order']) ? $this->controller->request->query['sort-order']:'asc')
        );

        return($results);
    }
    
    private function getOrderByStatements(){
        
        $orderBy = '';


        $orderByField       = $this->controller->request->query['sort-by'];
        $orderByDirection   = $this->controller->request->query['sort-order'] === 'asc' ? 'asc' : 'desc';
        
        $orderBy = '('  . $orderByField . ') '. $orderByDirection;
        
        return $orderBy;
    }

    private function getWhereConditions(){
        
        if( !isset($this->controller->paginate['fields']) && empty($this->fields) ){
            throw new Exception("Field list is not set. Please set the fields so I know how to build where statement.");
        }
        
        $conditions = array();
		
        if(!empty($this->filterFields)) {
        	$fields = $this->filterFields;
        }
        else {	
        	$fields = !empty($this->fields) ? $this->fields : $this->controller->paginate['fields'];
        }
        
        $sSearch = $this->controller->request->query['sSearch'];

		//first we obtain all "full" search values...
        $fullMatches = array();
        preg_match_all('/"([^"]+)"/', $sSearch, $fullMatches);
		
        if(empty($fullMatches) ==  false) {
        	foreach($fullMatches[0] as $match) {
        		$sSearch = str_replace($match,"",$sSearch);
        	} 	
        }
        $simpleMatches = split(" ", $sSearch);
        $allMatches = array_filter(array_merge($simpleMatches,$fullMatches[1]));
        
        $allConditions = array();
        foreach($allMatches as $searchObj) {
        	
        	$conditions = array();
        	
	        foreach($fields[0] as $x => $column){
	            
	                list($table, $field) = explode('.', $column);
	                
	                // attempt using definitions in $model->validate to build intelligent conditions
	                if( $this->conditionsByValidate == 1 && array_key_exists($column,$this->model->validate) ){
	
	                    if( !empty($this->controller->paginate['contain']) ){
	                        if(array_key_exists($table, $this->controller->paginate['contain']) && in_array($field, $this->controller->paginate['contain'][$table]['fields'])){
	                            $conditions[$table]['conditions'][] = $this->conditionByDataType($column);
	                        }
	                    }
	                    else{
	                        $conditions['OR'][] = $this->conditionByDataType($column);
	                    }
	                }
	                else{
	                    
	                    if( !empty($this->controller->paginate['contain']) ){
	
	                        if(array_key_exists($table, $this->controller->paginate['contain']) && in_array($field, $this->controller->paginate['contain'][$table]['fields'])){
	                            $conditions[$table]['conditions'][] = $column.' LIKE "%'.$searchObj.'%"';
	                        }
	                    }
	                    else{

	                        $conditions['OR'][] = array(
	                            $column.' LIKE' => '%'.$searchObj.'%'
	                        );
	                    }
	                }
	        }

	        $allConditions["AND"][] = $conditions;
        }

        //debug($allConditions);
        return $allConditions;
    }
       
    private function conditionByDataType($field){
        foreach($this->model->validate[$field] as $rule => $j){
            switch($rule){
                case 'boolean':
                case 'numeric':
                case 'naturalNumber':
                    $condition = array($field => $this->controller->request->query['sSearch']);
                    break;
            }
        }
        return $condition;
    }

    private function getDataRecursively($data,$key=null){
        $fields = array();

        // note: the chr() function is used to produce the arrays index to make sorting via ksort() easier.
       //debug($data);
        // loop through cake query result
        foreach($data as $x => $i){
            // go recursive
            if(is_array($i)){
                if(!array_key_exists($x,$this->model->hasMany)){
                	
                	$chfields = $this->getDataRecursively($i,$x);
                	$fields = array_merge($fields,$chfields);
                }
            }
            // check if component was given fields explicitely
            else if( !empty($this->fields) ){
                if(in_array("$key.$x", $this->fields)){
                    $index = array_search("$key.$x",$this->fields);
                    //echo "$key.$x = $index = $i \n";
                    // index needs to be a string so array_merge handles it properly
                    $fields[chr($index)] = "$i";
                }
                else{
                    //echo "$key.$x (NOT FOUND) \n";
                }
            }
            // dimension is not multi-dimensionable so add to $fields
            else if(isset($this->controller->paginate['fields'])){
                if(in_array("$key.$x", $this->controller->paginate['fields'])){
                    $index = array_search("$key.$x", $this->controller->paginate['fields']);
                    // index needs to be a string so array_merge handles it properly
                    $fields[chr($index)] = "$i";
                }
            }
            // will try to include all results but this will likely not work for you
            else{
                $fields["$key.$x "] = "$i";
            }
        }
        ksort($fields);
        //debug($fields);
        return $fields;
    }
        
}