ObelitCRMApp.config(['$stateProvider', '$urlRouterProvider', function($stateProvider, $urlRouterProvider) {
	$stateProvider.state("rolestates", {
	    url: "/rolestates",
	    templateUrl: "view/rolestates/index.html",
	    data: {pageTitle: 'Rolestates', 
	    	pageSubTitle: '',
	    	tabPage: '/view/rolestates/list.html'
	    }, 
	    resolve: {
	    deps: ['$ocLazyLoad', function($ocLazyLoad) {
	        return $ocLazyLoad.load([{
	            name: 'ObelitCRMApp',
	            insertBefore: '#ng_load_plugins_before', // load the above css files before '#ng_load_plugins_before'
	            files: [
	                'js/rolestates.js',
 
	            ]                    
	        }]);
	    }] 
	    }         
	}); 
    $stateProvider.state("rolestates.list", {
        url: "/list",
        templateUrl: '',
	    data: {pageTitle: 'Rolestates', 
	    	pageSubTitle: '',
	    },
        views: {
            // the child views will be defined here (absolutely named)
            '': { templateUrl: '/view/rolestates/list.html' },
        }	    
    });	

    $stateProvider.state("rolestates.add", {
        url: "/add",
        templateUrl: '',
	    data: {pageTitle: 'Rolestates', 
	    	pageSubTitle: '',
	    },
        views: {
            // the child views will be defined here (absolutely named)
            '': { templateUrl: '/view/rolestates/add.html' },
        }
    });    

    $stateProvider.state("rolestates.edit", {
        url: "/edit/:id",
        templateUrl: '',
	    data: {pageTitle: 'Rolestates', 
	    	pageSubTitle: '',
	    },
        views: {
            // the child views will be defined here (absolutely named)
            '': { templateUrl: '/view/rolestates/edit.html' },
        }
    });


	

   

}]);