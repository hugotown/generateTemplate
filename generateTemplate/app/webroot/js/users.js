
ObelitCRMApp.controller('UserController', function($rootScope, $scope, $http, $state, $location, $stateParams, $previousState, $log) {
	//console.log($state.current.data.tabPage);
	$scope.UserTabs = [		
		{
			title: 'Users',
			content: 'User',
			page: $state.current.data.tabPage,
		},			
	];
	$scope.UserTabs.activeTab = 0;
});

ObelitCRMApp.controller("UserIndexController", function($rootScope, $scope, $http, $state, $location, $stateParams, $previousState, $alert, $log, ObelitCRMUtils) {

	$scope.navigate = function ( path ) {
	  $location.path( path );
	};

	$scope.aboutRecord = {};
	$scope.setAboutRecord = function(header, rows)
	{
		$scope.aboutRecord.header 	= header;
		$scope.aboutRecord.rows 	= rows.User;
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
		$scope.updateUser($object);
	};
	
	$scope.predicate = 'id';
	$scope.name = "UserIndexController";
	$scope.users = [];

	$scope.groups = [];

	$scope.getGroups = function(param) {
		$http.get('//' + $location.host() + '/api/groups/?parent_field=name&parent_value=' + param).success(function(data) {

           	var values = [];
            angular.forEach(data, function(value, key) {
            	if (this.indexOf(value.Group) == -1) {
            		this.push(value.Group);
            	}
            }, values);

            $scope.groups = values;
		});
		return $scope.groups;
	};

	$scope.setUserGroup = function($object, group) {

		$object.group_id = group.id;
		$scope.updateUser($object);
		return true;		
	};

	$scope.clearUserGroup = function($object) {

		$object.User.group_id = '';
		$object.Group = null;
		$scope.updateUser($object.User);
		return true;		
	};

	$scope.workstations = [];

	$scope.getWorkstations = function(param) {
		$http.get('//' + $location.host() + '/api/workstations/?parent_field=name&parent_value=' + param).success(function(data) {

           	var values = [];
            angular.forEach(data, function(value, key) {
            	if (this.indexOf(value.Workstation) == -1) {
            		this.push(value.Workstation);
            	}
            }, values);

            $scope.workstations = values;
		});
		return $scope.workstations;
	};

	$scope.setUserWorkstation = function($object, workstation) {

		$object.workstation_id = workstation.id;
		$scope.updateUser($object);
		return true;		
	};

	$scope.clearUserWorkstation = function($object) {

		$object.User.workstation_id = '';
		$object.Workstation = null;
		$scope.updateUser($object.User);
		return true;		
	};


	$scope.updateUser = function($object){
        $http({
        	url: '//' + $location.host() + '/api/users/' + $object.id,
        	method: "PUT",
        	data: 'body=' + JSON.stringify({User:$object}),
        	headers: {'Content-Type': 'application/x-www-form-urlencoded'}
		}).success(function (data, status, headers, config) {
			if(data.User.type != 'success'){
  				var myAlert = $alert({title: 'Error', 
  						content: data.User.message, 
  						placement: 'top-right', 
  						type: 'danger',
  						duration: 5,
  						show: true});
			}
			else {
  				var myAlert = $alert({title: data.User.message, 
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

	$scope.deleteUser = function ($object) {

		if(confirm("Are you sure to delete the User: " + $object.id + "?")) {
			$http.delete('//' + $location.host() + '/api/users/'+ $object.id)
			.success(function(data) {
				if(data.User.type != 'success'){
	  				var myAlert = $alert({title: 'Error', 
	  						content: data.User.message, 
	  						placement: 'top-right', 
	  						type: 'danger',
	  						duration: 5,
	  						show: true});
				}
				else {
	  				var myAlert = $alert({title: data.User.message, 
	  						content: '', 
	  						placement: 'top-right', 
	  						type: 'success',
	  						duration: 5,
	  						show: true});
				}
			}).error(function (data, status, headers, config) {
				alert('User could not be deleted.')
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

	$scope.getUser = function (params, paramsObj) {
		//console.log("here", paramsObj);
		var parentParams = '';
		if($scope.$parent) {
			if($scope.$parent.parentObj) {
				parentParams =  "&parentObj=" + $scope.$parent.parentObj.name + "&parentId=" + $scope.$parent.parentObj.id;
			}
		}		
	  	var urlApi = '//' + $location.host() + '/api/users/?' + params + parentParams;
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

ObelitCRMApp.controller("UserAddController", function($rootScope, $scope, $http, $location, $stateParams, $alert, $log, ObelitCRMUtils) 
{

	$scope.users = [];
	$scope.users.User = {};

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

	$scope.name = "UserAddController";
	$scope.groups = [];

	$scope.getGroups = function(param) {

		$http.get('//' + $location.host() + '/api/groups/?parent_field=name&parent_value=' + param).success(function(data) {
			$scope.groups = data;
		});
		return $scope.groups;
	};

	$scope.selectedGroup = {};	

	$scope.ParentGroup = null;
	if($rootScope.parentStateParams) {

		if('Group' == $rootScope.parentStateParams.name) {
			$http.get('//' + $location.host() + '/api/Groups/' + $rootScope.parentStateParams.id).success(function(data) {
				//console.log(data);
				$scope.selectedGroup.selected = data;
				$scope.ParentGroup = data.Group;
				$rootScope.parentStateParams = null;
			});
		}
	}	

	$scope.workstations = [];

	$scope.getWorkstations = function(param) {

		$http.get('//' + $location.host() + '/api/workstations/?parent_field=name&parent_value=' + param).success(function(data) {
			$scope.workstations = data;
		});
		return $scope.workstations;
	};

	$scope.selectedWorkstation = {};	

	$scope.ParentWorkstation = null;
	if($rootScope.parentStateParams) {

		if('Workstation' == $rootScope.parentStateParams.name) {
			$http.get('//' + $location.host() + '/api/Workstations/' + $rootScope.parentStateParams.id).success(function(data) {
				//console.log(data);
				$scope.selectedWorkstation.selected = data;
				$scope.ParentWorkstation = data.Workstation;
				$rootScope.parentStateParams = null;
			});
		}
	}	

	
	$scope.saveUser = function($object){

		$object.group_id = (($scope.selectedGroup.selected) ? $scope.selectedGroup.selected.Group.id:'');
		$object.workstation_id = (($scope.selectedWorkstation.selected) ? $scope.selectedWorkstation.selected.Workstation.id:'');

        $http({
        	url: '//' + $location.host() + '/api/users/',
        	method: "POST",
        	data: 'body=' + JSON.stringify({User:$object}),
        	headers: {'Content-Type': 'application/x-www-form-urlencoded'}
		}).success(function (data, status, headers, config) {
			if(data.User.type != 'success'){
  				var myAlert = $alert({title: 'Error', 
  						content: data.User.message, 
  						placement: 'top-right', 
  						type: 'danger',
  						duration: 5,
  						show: true});
			}
			else {
  				var myAlert = $alert({title: data.User.message, 
  						content: '', 
  						placement: 'top-right', 
  						type: 'success',
  						duration: 5,
  						show: true});
  				$location.path("/users/edit/" + data["id"]);
			}
    	}).error(function (data, status, headers, config) {
        	alert(status + ' ' + data);
        });
	}

	//console.log($rootScope.parentStateParams);

});

ObelitCRMApp.controller("UserEditController", function($rootScope, $scope, $http, $location, $state, $stateParams, $previousState, $alert, $log, ObelitCRMUtils, uniqueID, $filter) {

	// Favorites handling
	$scope.favorite = undefined;

	$scope.initFavorite = function() {
		var objParams = {
			'dyn_model':'Favorite', 
			'type_search':'all', 
			'search_options': {
				"conditions": [
				"Favorite.objectId =" + $scope.users.User.id,
				"Favorite.type = 'User'",  
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
				'type': 'User',
				'objectId':$scope.users.User.id,
				'objectName': $scope.users.User.name,
				'name': uniqueID.getID(12),
				'link': "#/users/edit/",
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

	$scope.name = "UserEditController";
	
		$scope.groups = [];

	$scope.selectedGroup = {};
	$scope.getGroups = function(param) {

		$http.get('//' + $location.host() + '/api/groups/?parent_field=name&parent_value=' + param).success(function(data) {
			$scope.groups = data;
		});
		return $scope.groups;
	};
	$scope.workstations = [];

	$scope.selectedWorkstation = {};
	$scope.getWorkstations = function(param) {

		$http.get('//' + $location.host() + '/api/workstations/?parent_field=name&parent_value=' + param).success(function(data) {
			$scope.workstations = data;
		});
		return $scope.workstations;
	};
	$scope.users = [];
	$scope.parentObj = {'name':'User','id':$stateParams.id};
	$rootScope.parentStateParams = $scope.parentObj;

	$http.get('//' + $location.host() + '/api/users/' + $stateParams.id).success(function(data) {
        $scope.users = data;
		$scope.initFavorite();
		$scope.selectedGroup.selected = [];
		$scope.selectedGroup.selected["Group"] = data.Group;
		$scope.selectedWorkstation.selected = [];
		$scope.selectedWorkstation.selected["Workstation"] = data.Workstation;
    });

	$scope.updateUser = function($object){
		$object.group_id = (($scope.selectedGroup.selected) ? $scope.selectedGroup.selected.Group.id:'');
		$object.workstation_id = (($scope.selectedWorkstation.selected) ? $scope.selectedWorkstation.selected.Workstation.id:'');
        $http({
        	url: '//' + $location.host() + '/api/users/' + $object.id,
        	method: "PUT",
        	data: 'body=' + JSON.stringify({User:$object}),
        	headers: {'Content-Type': 'application/x-www-form-urlencoded'}
		}).success(function (data, status, headers, config) {
			if(data.User.type != 'success'){
  				var myAlert = $alert({title: 'Error', 
  						content: data.User.message, 
  						placement: 'top-right', 
  						type: 'danger',
  						duration: 5,
  						show: true});
			}
			else {
  				var myAlert = $alert({title: data.User.message, 
  						content: '', 
  						placement: 'top-right', 
  						type: 'success',
  						duration: 5,
  						show: true});
			}		
			if(data.User.type != 'success'){
				alert('User could not be updated.');
			}
    	}).error(function (data, status, headers, config) {
        	alert(status + ' ' + data);
        });
	};
	$scope.deleteUser = function ($object) {

		if(confirm("Are you sure to delete the User: " + $object.id + "?")) {
			$http.delete('//' + $location.host() + '/api/users/'+ $object.id)
			.success(function(data) {
				if(data.User.type != 'success'){
	  				var myAlert = $alert({title: 'Error', 
	  						content: data.User.message, 
	  						placement: 'top-right', 
	  						type: 'danger',
	  						duration: 5,
	  						show: true});
				}
				else {
	  				var myAlert = $alert({title: data.User.message, 
	  						content: '', 
	  						placement: 'top-right', 
	  						type: 'success',
	  						duration: 5,
	  						show: true});
	  				$location.path("/users");
				}			
			}).error(function (data, status, headers, config) {
				alert('User could not be deleted.')
			});
		}
	};


	

	var ctrl = $scope.tabCtrl = this;
    $scope.$on('$stateChangeSuccess', function(toState) {
		ctrl.selected = $state.current.name;
    });
    $previousState.memo('caller');
    ctrl.previous = $previousState.get(); 

});
