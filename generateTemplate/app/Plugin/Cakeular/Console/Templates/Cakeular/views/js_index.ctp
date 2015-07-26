<?php $pluralHumanName = Inflector::classify($pluralHumanName); ?>
<?php $singularHumanName = Inflector::classify($singularHumanName); ?>
<?php $pluralVar = strtolower($pluralVar); ?>
<?php $singularVar = strtolower($singularVar); ?>

ObelitCRMApp.controller('<?php echo $pluralHumanName; ?>Controller', function($rootScope, $scope, $http, $state, $location, $stateParams, $previousState, $log) {
	//console.log($state.current.data.tabPage);
	$scope.<?php echo $singularHumanName; ?>Tabs = [		
		{
			title: '<?php echo Inflector::pluralize($pluralHumanName); ?>',
			content: '<?php echo $pluralHumanName; ?>',
			page: $state.current.data.tabPage,
		},			
	];
	$scope.<?php echo $singularHumanName; ?>Tabs.activeTab = 0;
});

ObelitCRMApp.controller("<?php echo $pluralHumanName; ?>IndexController", function($rootScope, $scope, $http, $state, $location, $stateParams, $previousState, $alert, $log, ObelitCRMUtils) {

	$scope.navigate = function ( path ) {
	  $location.path( path );
	};

	$scope.aboutRecord = {};
	$scope.setAboutRecord = function(header, rows)
	{
		$scope.aboutRecord.header 	= header;
		$scope.aboutRecord.rows 	= rows.<?php echo $singularHumanName;?>;
		$scope.aboutRecord.created_by 	= rows.CreatedBy;
		$scope.aboutRecord.updated_by 	= rows.UpdatedBy;
	};

	$scope.getLovValues = function($type, $varName, $filter){
		
		var qryParams = {'type':$type,'filter':$filter};
        ObelitCRMUtils.getLOV({params: qryParams},function(response){
        	//console.log(response);
        	$scope[$varName] = response;
        	
        });
        return($scope.$varName);
	};

	$scope.setLovField = function($object, $field, $value){
		$object[$field] = $value;
		$scope.update<?php echo $singularHumanName; ?>($object);
	};
	
	$scope.predicate = 'id';
	$scope.name = "<?php echo $pluralHumanName; ?>IndexController";
	$scope.<?php echo $pluralVar ;?> = [];

<?php if (!empty($associations['belongsTo'])):
foreach ($associations['belongsTo'] as $alias => $details): ?>
<?php $otherSingularVar = Inflector::variable($alias); ?>
<?php $otherPluralHumanName = Inflector::humanize($details['controller']); ?>
<?php $otherSingularHumanName = Inflector::singularize($otherPluralHumanName); ?>
<?php $otherPluralVar = Inflector::variable($details['controller']); ?>
	$scope.<?php echo $details['controller']; ?> = [];

	$scope.get<?php echo $otherPluralHumanName; ?> = function(param) {
		$http.get('//' + $location.host() + '/api/<?php echo $details['controller']; ?>/?parent_field=name&parent_value=' + param).success(function(data) {

           	var values = [];
            angular.forEach(data, function(value, key) {
            	if (this.indexOf(value.<?php echo $otherSingularHumanName;?>) == -1) {
            		this.push(value.<?php echo $otherSingularHumanName;?>);
            	}
            }, values);

            $scope.<?php echo $otherPluralVar;?> = values;
		});
		return $scope.<?php echo $otherPluralVar;?>;
	};

	$scope.set<?php echo $singularHumanName;?><?php echo $otherSingularHumanName; ?> = function($object, <?php echo $otherSingularVar; ?>) {

		$object.<?php echo $otherSingularVar; ?>_id = <?php echo $otherSingularVar; ?>.id;
		$scope.update<?php echo $singularHumanName ;?>($object);
		return true;		
	};

	$scope.clear<?php echo $singularHumanName;?><?php echo $otherSingularHumanName; ?> = function($object) {

		$object.<?php echo $singularHumanName;?>.<?php echo $otherSingularVar; ?>_id = '';
		$object.<?php echo $otherSingularHumanName; ?> = null;
		$scope.update<?php echo $singularHumanName ;?>($object.<?php echo $singularHumanName;?>);
		return true;		
	};

<?php
endforeach;
endif; ?>

	$scope.update<?php echo $singularHumanName; ?> = function($object){
        $http({
        	url: '//' + $location.host() + '/api/<?php echo $pluralVar ;?>/' + $object.id,
        	method: "PUT",
        	data: 'body=' + JSON.stringify({<?php echo $singularHumanName; ?>:$object}),
        	headers: {'Content-Type': 'application/x-www-form-urlencoded'}
		}).success(function (data, status, headers, config) {
			if(data.<?php echo $singularHumanName; ?>.type != 'success'){
  				var myAlert = $alert({title: 'Error', 
  						content: data.<?php echo $singularHumanName; ?>.message, 
  						placement: 'top-right', 
  						type: 'danger',
  						duration: 5,
  						show: true});
			}
			else {
  				var myAlert = $alert({title: data.<?php echo $singularHumanName; ?>.message, 
  						content: '', 
  						placement: 'top-right', 
  						type: 'success',
  						duration: 5,
  						show: true});
				$scope.editingCustomField = undefined;
				$scope.editingField = undefined;	
			}
    	}).error(function (data, status, headers, config) {
        	alert(status + ' ' + data);
        });
	};

	$scope.delete<?php echo $singularHumanName; ?> = function ($object) {

		if(confirm("Are you sure to delete the <?php echo $singularHumanName; ?>: " + $object.id + "?")) {
			$http.delete('//' + $location.host() + '/api/<?php echo $pluralVar ;?>/'+ $object.id)
			.success(function(data) {
				if(data.<?php echo $singularHumanName; ?>.type != 'success'){
	  				var myAlert = $alert({title: 'Error', 
	  						content: data.<?php echo $singularHumanName; ?>.message, 
	  						placement: 'top-right', 
	  						type: 'danger',
	  						duration: 5,
	  						show: true});
				}
				else {
	  				var myAlert = $alert({title: data.<?php echo $singularHumanName; ?>.message, 
	  						content: '', 
	  						placement: 'top-right', 
	  						type: 'success',
	  						duration: 5,
	  						show: true});
				}
			}).error(function (data, status, headers, config) {
				alert('<?php echo $singularHumanName; ?> could not be deleted.')
			});
		}
	};

    $scope.editingCustomField = undefined;
    
    $scope.editCustomField = function($field) {
        $scope.editingCustomField = $field;
    };

	$scope.init = {
	  'count': 10,
	  'page': 1,
	  'sortBy': 'id',
	  'sortOrder': 'dsc',
	};

	$scope.get<?php echo $pluralHumanName; ?> = function (params, paramsObj) {
		//console.log("here", paramsObj);
		var parentParams = '';
		if($scope.$parent) {
			if($scope.$parent.parentObj) {
				parentParams =  "&parentObj=" + $scope.$parent.parentObj.name + "&parentId=" + $scope.$parent.parentObj.id;
			}
		}		
	  	var urlApi = '//' + $location.host() + '/api/<?php echo $pluralVar ;?>/?' + params + parentParams;
	  	return $http.get(urlApi).then(function (response) {
		  	//console.log(response.data);
		  	response.data.header.shift(); ///remove id of the header

		    return {
		      'rows': response.data.rows,
		      'header': response.data.header,
		      'pagination': response.data.pagination,
		      'sortBy': response.data['sort-by'],
		      'sortOrder': response.data['sort-order']
		    }
	  	});
	};	
	var ctrl = $scope.tabCtrl = this;
	$scope.$on('$stateChangeSuccess', function(toState) {
		if(!$scope.$parent.parentObj) {
			$rootScope.clearHistoryFlag =  true;
		}
		else {
			ctrl.selected = $state.current.name;
		}
	});
	$previousState.memo('caller');
});

ObelitCRMApp.controller("<?php echo $pluralHumanName; ?>AddController", function($rootScope, $scope, $http, $location, $stateParams, $alert, $log, ObelitCRMUtils) 
{

	$scope.<?php echo $pluralVar ;?> = [];
	$scope.<?php echo $pluralVar ;?>.<?php echo $pluralHumanName; ?> = {};

	$scope.getLovValues = function($type, $varName, $filter){
		
		var qryParams = {'type':$type,'filter':$filter};
        ObelitCRMUtils.getLOV({params: qryParams},function(response){
        	//console.log(response);
        	$scope[$varName] = response;
        	
        });
        return($scope.$varName);
	};

	$scope.setLovField = function($object, $field, $value){
		$object[$field] = $value;
	};		

	$scope.name = "<?php echo $pluralHumanName; ?>AddController";
<?php if (!empty($associations['belongsTo'])):
foreach ($associations['belongsTo'] as $alias => $details): ?>
<?php $otherSingularVar = Inflector::variable($alias); ?>
<?php $otherPluralHumanName = Inflector::humanize($details['controller']); ?>
<?php $otherSingularHumanName = Inflector::singularize($otherPluralHumanName); ?>
<?php $otherPluralVar = Inflector::variable($details['controller']); ?>
	$scope.<?php echo $details['controller']; ?> = [];

	$scope.get<?php echo $otherPluralHumanName; ?> = function(param) {

		$http.get('//' + $location.host() + '/api/<?php echo $details['controller']; ?>/?parent_field=name&parent_value=' + param).success(function(data) {
			$scope.<?php echo $details['controller']; ?> = data;
		});
		return $scope.<?php echo $details['controller']; ?>;
	};

	$scope.selected<?php echo $otherSingularHumanName; ?> = {};	

	$scope.Parent<?php echo $otherSingularHumanName; ?> = null;
	if($rootScope.parentStateParams) {

		if('<?php echo $otherSingularHumanName; ?>' == $rootScope.parentStateParams.name) {
			$http.get('//' + $location.host() + '/api/<?php echo $otherPluralHumanName; ?>/' + $rootScope.parentStateParams.id).success(function(data) {
				//console.log(data);
				$scope.selected<?php echo $otherSingularHumanName; ?>.selected = data;
				$scope.Parent<?php echo $otherSingularHumanName; ?> = data.<?php echo $otherSingularHumanName; ?>;
				$rootScope.parentStateParams = null;
			});
		}
	}	

<?php
endforeach;
endif; ?>
	
	$scope.save<?php echo $singularHumanName ;?> = function($object){

<?php if (!empty($associations['belongsTo'])):
foreach ($associations['belongsTo'] as $alias => $details): ?>
<?php $otherSingularVar = Inflector::variable($alias); ?>
<?php $otherPluralHumanName = Inflector::humanize($details['controller']); ?>
<?php $otherSingularHumanName = Inflector::singularize($otherPluralHumanName); ?>
<?php $otherPluralVar = Inflector::variable($details['controller']); ?>
		$object.<?php echo $otherSingularVar; ?>_id = (($scope.selected<?php echo $otherSingularHumanName; ?>.selected) ? $scope.selected<?php echo $otherSingularHumanName; ?>.selected.<?php echo $otherSingularHumanName; ?>.id:'');
<?php
endforeach;
endif; ?>

        $http({
        	url: '//' + $location.host() + '/api/<?php echo $pluralVar ;?>/',
        	method: "POST",
        	data: 'body=' + JSON.stringify({<?php echo $singularHumanName; ?>:$object}),
        	headers: {'Content-Type': 'application/x-www-form-urlencoded'}
		}).success(function (data, status, headers, config) {
			if(data.<?php echo $singularHumanName; ?>.type != 'success'){
  				var myAlert = $alert({title: 'Error', 
  						content: data.<?php echo $singularHumanName; ?>.message, 
  						placement: 'top-right', 
  						type: 'danger',
  						duration: 5,
  						show: true});
			}
			else {
  				var myAlert = $alert({title: data.<?php echo $singularHumanName; ?>.message, 
  						content: '', 
  						placement: 'top-right', 
  						type: 'success',
  						duration: 5,
  						show: true});
  				$location.path("/<?php echo $pluralVar ;?>/edit/" + data["id"]);
			}
    	}).error(function (data, status, headers, config) {
        	alert(status + ' ' + data);
        });
	}

	//console.log($rootScope.parentStateParams);

});

ObelitCRMApp.controller("<?php echo $pluralHumanName; ?>EditController", function($rootScope, $scope, $http, $location, $state, $stateParams, $previousState, $alert, $log, ObelitCRMUtils, uniqueID, $filter) {

	// Favorites handling
	$scope.favorite = undefined;

	$scope.initFavorite = function() {
		var objParams = {
			'dyn_model':'Favorite', 
			'type_search':'all', 
			'search_options': {
				"conditions": [
				"Favorite.objectId =" + $scope.<?php echo $pluralVar ;?>.<?php echo $singularHumanName; ?>.id,
				"Favorite.type = '<?php echo $singularHumanName; ?>'",  
				"Favorite.owner = " + $rootScope.currentUser.User.id
				], 
			"recursive": -1
			}
		};

		$http.get('//' + $location.host() + '/api/utils/?method=queryModel&params='+JSON.stringify(objParams)).success(function(data) {
			
			//console.log("toggleFavorite", data);
			if(data.length > 0) {
				$scope.favorite = {'flag':true, 'id': data[0].Favorite.id};
			}
			else {
				$scope.favorite = {'flag':false, 'id': 0};
			}
		});
	};

	$scope.toggleFavorite = function() {	

		//console.log("toggleFavorite");

		if($scope.favorite.flag) {
			//favorited, needs deletion...
			$http.delete('//' + $location.host() + '/api/favorites/'+ $scope.favorite.id)
			.success(function(data) {
				if(data.Favorite.type != 'success'){
	  				var myAlert = $alert({title: 'Error', 
	  						content: data.Favorite.message, 
	  						placement: 'top-right', 
	  						type: 'danger',
	  						duration: 5,
	  						show: true});
				}
				else {
	  				var myAlert = $alert({title: data.Favorite.message, 
	  						content: '', 
	  						placement: 'top-right', 
	  						type: 'success',
	  						duration: 5,
	  						show: true});
	  				$scope.favorite = {'flag':false, 'id': 0};
	  				$rootScope.$emit("RefreshFavorites", true);
				}
			}).error(function (data, status, headers, config) {
				alert('Favorite could not be deleted.')
			});
		}
		else {
			//not favorited, needs creation...
			$scope.favoriteData = {
				'type': '<?php echo $singularHumanName; ?>',
				'objectId':$scope.<?php echo $pluralVar ;?>.<?php echo $singularHumanName; ?>.id,
				'objectName': $scope.<?php echo $pluralVar ;?>.<?php echo $singularHumanName; ?>.name,
				'name': uniqueID.getID(12),
				'link': "#/<?php echo $pluralVar ;?>/edit/",
			};

			var postData = {
				'Favorite': $scope.favoriteData,
			};
	        $http({
	        	url: '//' + $location.host() + '/api/favorites/',
	        	method: "POST",
	        	data: 'body=' + JSON.stringify(postData),
	        	headers: {'Content-Type': 'application/x-www-form-urlencoded'}
			}).success(function (data, status, headers, config) {
				//console.log(data);
				if(data.Favorite.type != 'success'){
	  				var myAlert = $alert({title: 'Error', 
	  						content: data.Favorite.message, 
	  						placement: 'top-right', 
	  						type: 'danger',
	  						duration: 5,
	  						show: true});
				}
				else {
						var myAlert = $alert({title: data.Favorite.message, 
  						content: '', 
  						placement: 'top-right', 
  						type: 'success',
  						duration: 5,
  						show: true});
  						$scope.favorite = {'flag':true, 'id': data.id};
  						$rootScope.$emit("RefreshFavorites", true);
				}			
	    	}).error(function (data, status, headers, config) {
				var myAlert = $alert({title: 'Error', 
						content: 'HTTP Error', 
						placement: 'top-right', 
						type: 'danger',
						duration: 5,
						show: true});
	        });	
		}
	}	
	// Favorites handling

	$scope.getLovValues = function($type, $varName, $filter){
		
		var qryParams = {'type':$type,'filter':$filter};
        ObelitCRMUtils.getLOV({params: qryParams},function(response){
        	//console.log(response);
        	$scope[$varName] = response;
        	
        });
        return($scope.$varName);
	};

	$scope.setLovField = function($object, $field, $value){
		$object[$field] = $value;
	};	

	$scope.name = "<?php echo $pluralHumanName; ?>EditController";
	
	<?php if (!empty($associations['belongsTo'])):
	foreach ($associations['belongsTo'] as $alias => $details): ?>
<?php $otherSingularVar = Inflector::variable($alias); ?>
<?php $otherPluralHumanName = Inflector::humanize($details['controller']); ?>
<?php $otherSingularHumanName = Inflector::singularize($otherPluralHumanName); ?>
<?php $otherPluralVar = Inflector::variable($details['controller']); ?>
	$scope.<?php echo $details['controller']; ?> = [];

	$scope.selected<?php echo $otherSingularHumanName; ?> = {};
	$scope.get<?php echo $otherPluralHumanName; ?> = function(param) {

		$http.get('//' + $location.host() + '/api/<?php echo $details['controller']; ?>/?parent_field=name&parent_value=' + param).success(function(data) {
			$scope.<?php echo $details['controller']; ?> = data;
		});
		return $scope.<?php echo $details['controller']; ?>;
	};
<?php
endforeach;
endif; ?>
	$scope.<?php echo $pluralVar ;?> = [];
	$scope.parentObj = {'name':'<?php echo $singularHumanName; ?>','id':$stateParams.id};
	$rootScope.parentStateParams = $scope.parentObj;

	$http.get('//' + $location.host() + '/api/<?php echo $pluralVar ;?>/' + $stateParams.id).success(function(data) {
        $scope.<?php echo $pluralVar ;?> = data;
		$scope.initFavorite();
<?php if (!empty($associations['belongsTo'])):
foreach ($associations['belongsTo'] as $alias => $details): ?>
<?php $otherSingularVar = Inflector::variable($alias); ?>
<?php $otherPluralHumanName = Inflector::humanize($details['controller']); ?>
<?php $otherSingularHumanName = Inflector::singularize($otherPluralHumanName); ?>
<?php $otherPluralVar = Inflector::variable($details['controller']); ?>
		$scope.selected<?php echo $otherSingularHumanName; ?>.selected = [];
		$scope.selected<?php echo $otherSingularHumanName; ?>.selected["<?php echo $otherSingularHumanName; ?>"] = data.<?php echo $otherSingularHumanName; ?>;
<?php
endforeach;
endif; ?>
    });

	$scope.update<?php echo $singularHumanName ;?> = function($object){
<?php if (!empty($associations['belongsTo'])):
foreach ($associations['belongsTo'] as $alias => $details): ?>
<?php $otherSingularVar = Inflector::variable($alias); ?>
<?php $otherPluralHumanName = Inflector::humanize($details['controller']); ?>
<?php $otherSingularHumanName = Inflector::singularize($otherPluralHumanName); ?>
<?php $otherPluralVar = Inflector::variable($details['controller']); ?>
		$object.<?php echo $otherSingularVar; ?>_id = (($scope.selected<?php echo $otherSingularHumanName; ?>.selected) ? $scope.selected<?php echo $otherSingularHumanName; ?>.selected.<?php echo $otherSingularHumanName; ?>.id:'');
<?php
endforeach;
endif; ?>
        $http({
        	url: '//' + $location.host() + '/api/<?php echo $pluralVar ;?>/' + $object.id,
        	method: "PUT",
        	data: 'body=' + JSON.stringify({<?php echo $singularHumanName; ?>:$object}),
        	headers: {'Content-Type': 'application/x-www-form-urlencoded'}
		}).success(function (data, status, headers, config) {
			if(data.<?php echo $singularHumanName; ?>.type != 'success'){
  				var myAlert = $alert({title: 'Error', 
  						content: data.<?php echo $singularHumanName; ?>.message, 
  						placement: 'top-right', 
  						type: 'danger',
  						duration: 5,
  						show: true});
			}
			else {
  				var myAlert = $alert({title: data.<?php echo $singularHumanName; ?>.message, 
  						content: '', 
  						placement: 'top-right', 
  						type: 'success',
  						duration: 5,
  						show: true});
			}		
			if(data.<?php echo $singularHumanName; ?>.type != 'success'){
				alert('<?php echo $singularHumanName; ?> could not be updated.');
			}
    	}).error(function (data, status, headers, config) {
        	alert(status + ' ' + data);
        });
	};
	$scope.delete<?php echo $singularHumanName; ?> = function ($object) {

		if(confirm("Are you sure to delete the <?php echo $singularHumanName; ?>: " + $object.id + "?")) {
			$http.delete('//' + $location.host() + '/api/<?php echo $pluralVar ?>/'+ $object.id)
			.success(function(data) {
				if(data.<?php echo $singularHumanName; ?>.type != 'success'){
	  				var myAlert = $alert({title: 'Error', 
	  						content: data.<?php echo $singularHumanName; ?>.message, 
	  						placement: 'top-right', 
	  						type: 'danger',
	  						duration: 5,
	  						show: true});
				}
				else {
	  				var myAlert = $alert({title: data.<?php echo $singularHumanName; ?>.message, 
	  						content: '', 
	  						placement: 'top-right', 
	  						type: 'success',
	  						duration: 5,
	  						show: true});
	  				$location.path("/<?php echo $pluralVar ?>");
				}			
			}).error(function (data, status, headers, config) {
				alert('<?php echo $singularHumanName; ?> could not be deleted.')
			});
		}
	};

<?php $defaultTab = ""; ?>
<?php if (empty($associations['hasMany'])): ?>
<?php $associations['hasMany'] = array(); ?>
<?php endif; ?>
<?php if (empty($associations['hasAndBelongsToMany'])): ?>
<?php $associations['hasAndBelongsToMany'] = array(); ?>
<?php endif; ?>

<?php $relations = array_merge($associations['hasMany'], $associations['hasAndBelongsToMany']); ?>
<?php if (!(empty($relations))): ?>	
	$scope.tabs = [
<?php foreach ($relations as $alias => $details): ?>
<?php $otherSingularVar = strtolower(Inflector::variable($alias)); ?>
<?php $otherPluralHumanName = Inflector::humanize($details['controller']); ?>
<?php $otherPluralVar = strtolower(Inflector::variable($details['controller'])); ?>
<?php if(array_key_exists($alias, $associations['hasAndBelongsToMany'])): ?>
<?php $otherPluralVar = $pluralVar . strtolower(Inflector::variable($details['controller'])); ?>
<?php endif; ?>	
		{
			heading: '<?php echo $otherPluralHumanName; ?>',
			route: '<?php echo $pluralVar ;?>.edit.<?php echo $otherPluralVar; ?>',
		},
<?php if ($defaultTab == "") { $defaultTab = $pluralVar . ".edit." . $otherPluralVar;} ?>			
<?php endforeach; ?>
	];
	$state.go('<?php echo $defaultTab; ?>');
	$scope.tabs.activeTab = 0;
<?php endif; ?>	

	var ctrl = $scope.tabCtrl = this;
    $scope.$on('$stateChangeSuccess', function(toState) {
		ctrl.selected = $state.current.name;
    });
    $previousState.memo('caller');
    ctrl.previous = $previousState.get(); 

});
