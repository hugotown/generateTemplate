ObelitCRMApp.config(['$stateProvider', '$urlRouterProvider', function($stateProvider, $urlRouterProvider) {
	$stateProvider.state("lovs", {
	    url: "/lovs",
	    templateUrl: "view/lovs/index.html",
	    data: {pageTitle: 'Lovs', 
	    	pageSubTitle: '',
	    	tabPage: '/view/lovs/list.html'
	    }, 
	    resolve: {
	    deps: ['$ocLazyLoad', function($ocLazyLoad) {
	        return $ocLazyLoad.load([{
	            name: 'ObelitCRMApp',
	            insertBefore: '#ng_load_plugins_before', // load the above css files before '#ng_load_plugins_before'
	            files: [
	                'js/lovs.js',
					'js/lovs.js',
 
	            ]                    
	        }]);
	    }] 
	    }         
	}); 
    $stateProvider.state("lovs.list", {
        url: "/list",
        templateUrl: '',
	    data: {pageTitle: 'Lovs', 
	    	pageSubTitle: '',
	    },
        views: {
            // the child views will be defined here (absolutely named)
            '': { templateUrl: '/view/lovs/list.html' },
        }	    
    });	

    $stateProvider.state("lovs.add", {
        url: "/add",
        templateUrl: '',
	    data: {pageTitle: 'Lovs', 
	    	pageSubTitle: '',
	    },
        views: {
            // the child views will be defined here (absolutely named)
            '': { templateUrl: '/view/lovs/add.html' },
        }
    });    

    $stateProvider.state("lovs.edit", {
        url: "/edit/:id",
        templateUrl: '',
	    data: {pageTitle: 'Lovs', 
	    	pageSubTitle: '',
	    },
        views: {
            // the child views will be defined here (absolutely named)
            '': { templateUrl: '/view/lovs/edit.html' },
        }
    });


	
	
    $stateProvider.state("lovs.edit.lovs", {
        url: "/lovs",
        templateUrl: '',
	    data: {pageTitle: 'Lovs', 
	    	pageSubTitle: '',
	    },
        views: {
            // the child views will be defined here (absolutely named)
            'editTab': { templateUrl: '/view/lovs/list.html' },
        }
    }); 
	

   

}]);