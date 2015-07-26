ObelitCRMApp.config(['$stateProvider', '$urlRouterProvider', function($stateProvider, $urlRouterProvider) {
	$stateProvider.state("users", {
	    url: "/users",
	    templateUrl: "view/users/index.html",
	    data: {pageTitle: 'Users', 
	    	pageSubTitle: '',
	    	tabPage: '/view/users/list.html'
	    }, 
	    resolve: {
	    deps: ['$ocLazyLoad', function($ocLazyLoad) {
	        return $ocLazyLoad.load([{
	            name: 'ObelitCRMApp',
	            insertBefore: '#ng_load_plugins_before', // load the above css files before '#ng_load_plugins_before'
	            files: [
	                'js/users.js',
 
	            ]                    
	        }]);
	    }] 
	    }         
	}); 
    $stateProvider.state("users.list", {
        url: "/list",
        templateUrl: '',
	    data: {pageTitle: 'Users', 
	    	pageSubTitle: '',
	    },
        views: {
            // the child views will be defined here (absolutely named)
            '': { templateUrl: '/view/users/list.html' },
        }	    
    });	

    $stateProvider.state("users.add", {
        url: "/add",
        templateUrl: '',
	    data: {pageTitle: 'Users', 
	    	pageSubTitle: '',
	    },
        views: {
            // the child views will be defined here (absolutely named)
            '': { templateUrl: '/view/users/add.html' },
        }
    });    

    $stateProvider.state("users.edit", {
        url: "/edit/:id",
        templateUrl: '',
	    data: {pageTitle: 'Users', 
	    	pageSubTitle: '',
	    },
        views: {
            // the child views will be defined here (absolutely named)
            '': { templateUrl: '/view/users/edit.html' },
        }
    });


	

   

}]);