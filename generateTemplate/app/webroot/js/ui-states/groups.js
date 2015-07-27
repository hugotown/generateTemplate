ObelitCRMApp.config(['$stateProvider', '$urlRouterProvider', function($stateProvider, $urlRouterProvider) {
	$stateProvider.state("groups", {
	    url: "/groups",
	    templateUrl: "view/groups/index.html",
	    data: {pageTitle: 'Groups', 
	    	pageSubTitle: '',
	    	tabPage: '/view/groups/list.html'
	    }, 
	    resolve: {
	    deps: ['$ocLazyLoad', function($ocLazyLoad) {
	        return $ocLazyLoad.load([{
	            name: 'ObelitCRMApp',
	            insertBefore: '#ng_load_plugins_before', // load the above css files before '#ng_load_plugins_before'
	            files: [
	                'js/groups.js',
					'js/users.js',
 
	            ]                    
	        }]);
	    }] 
	    }         
	}); 
    $stateProvider.state("groups.list", {
        url: "/list",
        templateUrl: '',
	    data: {pageTitle: 'Groups', 
	    	pageSubTitle: '',
	    },
        views: {
            // the child views will be defined here (absolutely named)
            '': { templateUrl: '/view/groups/list.html' },
        }	    
    });	

    $stateProvider.state("groups.add", {
        url: "/add",
        templateUrl: '',
	    data: {pageTitle: 'Groups', 
	    	pageSubTitle: '',
	    },
        views: {
            // the child views will be defined here (absolutely named)
            '': { templateUrl: '/view/groups/add.html' },
        }
    });    

    $stateProvider.state("groups.edit", {
        url: "/edit/:id",
        templateUrl: '',
	    data: {pageTitle: 'Groups', 
	    	pageSubTitle: '',
	    },
        views: {
            // the child views will be defined here (absolutely named)
            '': { templateUrl: '/view/groups/edit.html' },
        }
    });


	
	
    $stateProvider.state("groups.edit.users", {
        url: "/users",
        templateUrl: '',
	    data: {pageTitle: 'Groups', 
	    	pageSubTitle: '',
	    },
        views: {
            // the child views will be defined here (absolutely named)
            'editTab': { templateUrl: '/view/users/list.html' },
        }
    }); 
	

   

}]);