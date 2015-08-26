ObelitCRMApp.config(['$stateProvider', '$urlRouterProvider', function($stateProvider, $urlRouterProvider) {
	$stateProvider.state("rolesctrls", {
	    url: "/rolesctrls",
	    templateUrl: "view/rolesctrls/index.html",
	    data: {pageTitle: 'Rolesctrls', 
	    	pageSubTitle: '',
	    	tabPage: '/view/rolesctrls/list.html'
	    }, 
	    resolve: {
	    deps: ['$ocLazyLoad', function($ocLazyLoad) {
	        return $ocLazyLoad.load([{
	            name: 'ObelitCRMApp',
	            insertBefore: '#ng_load_plugins_before', // load the above css files before '#ng_load_plugins_before'
	            files: [
	                'js/rolesctrls.js',
 
	            ]                    
	        }]);
	    }] 
	    }         
	}); 
    $stateProvider.state("rolesctrls.list", {
        url: "/list",
        templateUrl: '',
	    data: {pageTitle: 'Rolesctrls', 
	    	pageSubTitle: '',
	    },
        views: {
            // the child views will be defined here (absolutely named)
            '': { templateUrl: '/view/rolesctrls/list.html' },
        }	    
    });	

    $stateProvider.state("rolesctrls.add", {
        url: "/add",
        templateUrl: '',
	    data: {pageTitle: 'Rolesctrls', 
	    	pageSubTitle: '',
	    },
        views: {
            // the child views will be defined here (absolutely named)
            '': { templateUrl: '/view/rolesctrls/add.html' },
        }
    });    

    $stateProvider.state("rolesctrls.edit", {
        url: "/edit/:id",
        templateUrl: '',
	    data: {pageTitle: 'Rolesctrls', 
	    	pageSubTitle: '',
	    },
        views: {
            // the child views will be defined here (absolutely named)
            '': { templateUrl: '/view/rolesctrls/edit.html' },
        }
    });


	

   

}]);