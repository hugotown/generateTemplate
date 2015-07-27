ObelitCRMApp.config(['$stateProvider', '$urlRouterProvider', function($stateProvider, $urlRouterProvider) {
	$stateProvider.state("buildings", {
	    url: "/buildings",
	    templateUrl: "view/buildings/index.html",
	    data: {pageTitle: 'Buildings', 
	    	pageSubTitle: '',
	    	tabPage: '/view/buildings/list.html'
	    }, 
	    resolve: {
	    deps: ['$ocLazyLoad', function($ocLazyLoad) {
	        return $ocLazyLoad.load([{
	            name: 'ObelitCRMApp',
	            insertBefore: '#ng_load_plugins_before', // load the above css files before '#ng_load_plugins_before'
	            files: [
	                'js/buildings.js',
					'js/workstations.js',
 
	            ]                    
	        }]);
	    }] 
	    }         
	}); 
    $stateProvider.state("buildings.list", {
        url: "/list",
        templateUrl: '',
	    data: {pageTitle: 'Buildings', 
	    	pageSubTitle: '',
	    },
        views: {
            // the child views will be defined here (absolutely named)
            '': { templateUrl: '/view/buildings/list.html' },
        }	    
    });	

    $stateProvider.state("buildings.add", {
        url: "/add",
        templateUrl: '',
	    data: {pageTitle: 'Buildings', 
	    	pageSubTitle: '',
	    },
        views: {
            // the child views will be defined here (absolutely named)
            '': { templateUrl: '/view/buildings/add.html' },
        }
    });    

    $stateProvider.state("buildings.edit", {
        url: "/edit/:id",
        templateUrl: '',
	    data: {pageTitle: 'Buildings', 
	    	pageSubTitle: '',
	    },
        views: {
            // the child views will be defined here (absolutely named)
            '': { templateUrl: '/view/buildings/edit.html' },
        }
    });


	
	
    $stateProvider.state("buildings.edit.workstations", {
        url: "/workstations",
        templateUrl: '',
	    data: {pageTitle: 'Buildings', 
	    	pageSubTitle: '',
	    },
        views: {
            // the child views will be defined here (absolutely named)
            'editTab': { templateUrl: '/view/workstations/list.html' },
        }
    }); 
	

   

}]);