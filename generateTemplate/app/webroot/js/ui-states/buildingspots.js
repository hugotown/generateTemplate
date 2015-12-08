ObelitCRMApp.config(['$stateProvider', '$urlRouterProvider', function($stateProvider, $urlRouterProvider) {
	$stateProvider.state("buildingspots", {
	    url: "/buildingspots",
	    templateUrl: "view/buildingspots/index.html",
	    data: {pageTitle: 'Buildingspots', 
	    	pageSubTitle: '',
	    	tabPage: '/view/buildingspots/list.html'
	    }, 
	    resolve: {
	    deps: ['$ocLazyLoad', function($ocLazyLoad) {
	        return $ocLazyLoad.load([{
	            name: 'ObelitCRMApp',
	            insertBefore: '#ng_load_plugins_before', // load the above css files before '#ng_load_plugins_before'
	            files: [
	                'js/buildingspots.js',
					'js/requests.js',
					'js/users.js',
 
	            ]                    
	        }]);
	    }] 
	    }         
	}); 
    $stateProvider.state("buildingspots.list", {
        url: "/list",
        templateUrl: '',
	    data: {pageTitle: 'Buildingspots', 
	    	pageSubTitle: '',
	    },
        views: {
            // the child views will be defined here (absolutely named)
            '': { templateUrl: '/view/buildingspots/list.html' },
        }	    
    });	

    $stateProvider.state("buildingspots.add", {
        url: "/add",
        templateUrl: '',
	    data: {pageTitle: 'Buildingspots', 
	    	pageSubTitle: '',
	    },
        views: {
            // the child views will be defined here (absolutely named)
            '': { templateUrl: '/view/buildingspots/add.html' },
        }
    });    

    $stateProvider.state("buildingspots.edit", {
        url: "/edit/:id",
        templateUrl: '',
	    data: {pageTitle: 'Buildingspots', 
	    	pageSubTitle: '',
	    },
        views: {
            // the child views will be defined here (absolutely named)
            '': { templateUrl: '/view/buildingspots/edit.html' },
        }
    });


	
	
    $stateProvider.state("buildingspots.edit.requests", {
        url: "/requests",
        templateUrl: '',
	    data: {pageTitle: 'Buildingspots', 
	    	pageSubTitle: '',
	    },
        views: {
            // the child views will be defined here (absolutely named)
            'editTab': { templateUrl: '/view/requests/list.html' },
        }
    }); 
	
    $stateProvider.state("buildingspots.edit.users", {
        url: "/users",
        templateUrl: '',
	    data: {pageTitle: 'Buildingspots', 
	    	pageSubTitle: '',
	    },
        views: {
            // the child views will be defined here (absolutely named)
            'editTab': { templateUrl: '/view/users/list.html' },
        }
    }); 
	

   

}]);