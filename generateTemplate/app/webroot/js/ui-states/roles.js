ObelitCRMApp.config(['$stateProvider', '$urlRouterProvider', function($stateProvider, $urlRouterProvider) {
	$stateProvider.state("roles", {
	    url: "/roles",
	    templateUrl: "view/roles/index.html",
	    data: {pageTitle: 'Roles', 
	    	pageSubTitle: '',
	    	tabPage: '/view/roles/list.html'
	    }, 
	    resolve: {
	    deps: ['$ocLazyLoad', function($ocLazyLoad) {
	        return $ocLazyLoad.load([{
	            name: 'ObelitCRMApp',
	            insertBefore: '#ng_load_plugins_before', // load the above css files before '#ng_load_plugins_before'
	            files: [
	                'js/roles.js',
					'js/users.js',
 
	            ]                    
	        }]);
	    }] 
	    }         
	}); 
    $stateProvider.state("roles.list", {
        url: "/list",
        templateUrl: '',
	    data: {pageTitle: 'Roles', 
	    	pageSubTitle: '',
	    },
        views: {
            // the child views will be defined here (absolutely named)
            '': { templateUrl: '/view/roles/list.html' },
        }	    
    });	

    $stateProvider.state("roles.add", {
        url: "/add",
        templateUrl: '',
	    data: {pageTitle: 'Roles', 
	    	pageSubTitle: '',
	    },
        views: {
            // the child views will be defined here (absolutely named)
            '': { templateUrl: '/view/roles/add.html' },
        }
    });    

    $stateProvider.state("roles.edit", {
        url: "/edit/:id",
        templateUrl: '',
	    data: {pageTitle: 'Roles', 
	    	pageSubTitle: '',
	    },
        views: {
            // the child views will be defined here (absolutely named)
            '': { templateUrl: '/view/roles/edit.html' },
        }
    });


	
	
    $stateProvider.state("roles.edit.users", {
        url: "/users",
        templateUrl: '',
	    data: {pageTitle: 'Roles', 
	    	pageSubTitle: '',
	    },
        views: {
            // the child views will be defined here (absolutely named)
            'editTab': { templateUrl: '/view/users/list.html' },
        }
    }); 
	

   

}]);