ObelitCRMApp.config(['$stateProvider', '$urlRouterProvider', function($stateProvider, $urlRouterProvider) {
	$stateProvider.state("requests", {
	    url: "/requests",
	    templateUrl: "view/requests/index.html",
	    data: {pageTitle: 'Requests', 
	    	pageSubTitle: '',
	    	tabPage: '/view/requests/list.html'
	    }, 
	    resolve: {
	    deps: ['$ocLazyLoad', function($ocLazyLoad) {
	        return $ocLazyLoad.load([{
	            name: 'ObelitCRMApp',
	            insertBefore: '#ng_load_plugins_before', // load the above css files before '#ng_load_plugins_before'
	            files: [
	                'js/requests.js',
 
	            ]                    
	        }]);
	    }] 
	    }         
	}); 
    $stateProvider.state("requests.list", {
        url: "/list",
        templateUrl: '',
	    data: {pageTitle: 'Requests', 
	    	pageSubTitle: '',
	    },
        views: {
            // the child views will be defined here (absolutely named)
            '': { templateUrl: '/view/requests/list.html' },
        }	    
    });	

    $stateProvider.state("requests.add", {
        url: "/add",
        templateUrl: '',
	    data: {pageTitle: 'Requests', 
	    	pageSubTitle: '',
	    },
        views: {
            // the child views will be defined here (absolutely named)
            '': { templateUrl: '/view/requests/add.html' },
        }
    });    

    $stateProvider.state("requests.edit", {
        url: "/edit/:id",
        templateUrl: '',
	    data: {pageTitle: 'Requests', 
	    	pageSubTitle: '',
	    },
        views: {
            // the child views will be defined here (absolutely named)
            '': { templateUrl: '/view/requests/edit.html' },
        }
    });


	

   

}]);