ObelitCRMApp.config(['$stateProvider', '$urlRouterProvider', function($stateProvider, $urlRouterProvider) {
	$stateProvider.state("ctrls", {
	    url: "/ctrls",
	    templateUrl: "view/ctrls/index.html",
	    data: {pageTitle: 'Ctrls', 
	    	pageSubTitle: '',
	    	tabPage: '/view/ctrls/list.html'
	    }, 
	    resolve: {
	    deps: ['$ocLazyLoad', function($ocLazyLoad) {
	        return $ocLazyLoad.load([{
	            name: 'ObelitCRMApp',
	            insertBefore: '#ng_load_plugins_before', // load the above css files before '#ng_load_plugins_before'
	            files: [
	                'js/ctrls.js',
					'js/rolesctrls.js',
 
	            ]                    
	        }]);
	    }] 
	    }         
	}); 
    $stateProvider.state("ctrls.list", {
        url: "/list",
        templateUrl: '',
	    data: {pageTitle: 'Ctrls', 
	    	pageSubTitle: '',
	    },
        views: {
            // the child views will be defined here (absolutely named)
            '': { templateUrl: '/view/ctrls/list.html' },
        }	    
    });	

    $stateProvider.state("ctrls.add", {
        url: "/add",
        templateUrl: '',
	    data: {pageTitle: 'Ctrls', 
	    	pageSubTitle: '',
	    },
        views: {
            // the child views will be defined here (absolutely named)
            '': { templateUrl: '/view/ctrls/add.html' },
        }
    });    

    $stateProvider.state("ctrls.edit", {
        url: "/edit/:id",
        templateUrl: '',
	    data: {pageTitle: 'Ctrls', 
	    	pageSubTitle: '',
	    },
        views: {
            // the child views will be defined here (absolutely named)
            '': { templateUrl: '/view/ctrls/edit.html' },
        }
    });


	
	
    $stateProvider.state("ctrls.edit.rolesctrls", {
        url: "/rolesctrls",
        templateUrl: '',
	    data: {pageTitle: 'Ctrls', 
	    	pageSubTitle: '',
	    },
        views: {
            // the child views will be defined here (absolutely named)
            'editTab': { templateUrl: '/view/rolesctrls/list.html' },
        }
    }); 
	

   

}]);