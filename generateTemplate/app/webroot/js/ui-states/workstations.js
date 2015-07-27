ObelitCRMApp.config(['$stateProvider', '$urlRouterProvider', function($stateProvider, $urlRouterProvider) {
	$stateProvider.state("workstations", {
	    url: "/workstations",
	    templateUrl: "view/workstations/index.html",
	    data: {pageTitle: 'Workstations', 
	    	pageSubTitle: '',
	    	tabPage: '/view/workstations/list.html'
	    }, 
	    resolve: {
	    deps: ['$ocLazyLoad', function($ocLazyLoad) {
	        return $ocLazyLoad.load([{
	            name: 'ObelitCRMApp',
	            insertBefore: '#ng_load_plugins_before', // load the above css files before '#ng_load_plugins_before'
	            files: [
	                'js/workstations.js',
					'js/users.js',
					'js/workstations.js',
 
	            ]                    
	        }]);
	    }] 
	    }         
	}); 
    $stateProvider.state("workstations.list", {
        url: "/list",
        templateUrl: '',
	    data: {pageTitle: 'Workstations', 
	    	pageSubTitle: '',
	    },
        views: {
            // the child views will be defined here (absolutely named)
            '': { templateUrl: '/view/workstations/list.html' },
        }	    
    });	

    $stateProvider.state("workstations.add", {
        url: "/add",
        templateUrl: '',
	    data: {pageTitle: 'Workstations', 
	    	pageSubTitle: '',
	    },
        views: {
            // the child views will be defined here (absolutely named)
            '': { templateUrl: '/view/workstations/add.html' },
        }
    });    

    $stateProvider.state("workstations.edit", {
        url: "/edit/:id",
        templateUrl: '',
	    data: {pageTitle: 'Workstations', 
	    	pageSubTitle: '',
	    },
        views: {
            // the child views will be defined here (absolutely named)
            '': { templateUrl: '/view/workstations/edit.html' },
        }
    });


	
	
    $stateProvider.state("workstations.edit.users", {
        url: "/users",
        templateUrl: '',
	    data: {pageTitle: 'Workstations', 
	    	pageSubTitle: '',
	    },
        views: {
            // the child views will be defined here (absolutely named)
            'editTab': { templateUrl: '/view/users/list.html' },
        }
    }); 
	
    $stateProvider.state("workstations.edit.workstations", {
        url: "/workstations",
        templateUrl: '',
	    data: {pageTitle: 'Workstations', 
	    	pageSubTitle: '',
	    },
        views: {
            // the child views will be defined here (absolutely named)
            'editTab': { templateUrl: '/view/workstations/list.html' },
        }
    }); 
	

   

}]);