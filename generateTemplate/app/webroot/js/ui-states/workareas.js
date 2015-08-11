ObelitCRMApp.config(['$stateProvider', '$urlRouterProvider', function($stateProvider, $urlRouterProvider) {
	$stateProvider.state("workareas", {
	    url: "/workareas",
	    templateUrl: "view/workareas/index.html",
	    data: {pageTitle: 'Workareas', 
	    	pageSubTitle: '',
	    	tabPage: '/view/workareas/list.html'
	    }, 
	    resolve: {
	    deps: ['$ocLazyLoad', function($ocLazyLoad) {
	        return $ocLazyLoad.load([{
	            name: 'ObelitCRMApp',
	            insertBefore: '#ng_load_plugins_before', // load the above css files before '#ng_load_plugins_before'
	            files: [
	                'js/workareas.js',
					'js/workstations.js',
 
	            ]                    
	        }]);
	    }] 
	    }         
	}); 
    $stateProvider.state("workareas.list", {
        url: "/list",
        templateUrl: '',
	    data: {pageTitle: 'Workareas', 
	    	pageSubTitle: '',
	    },
        views: {
            // the child views will be defined here (absolutely named)
            '': { templateUrl: '/view/workareas/list.html' },
        }	    
    });	

    $stateProvider.state("workareas.add", {
        url: "/add",
        templateUrl: '',
	    data: {pageTitle: 'Workareas', 
	    	pageSubTitle: '',
	    },
        views: {
            // the child views will be defined here (absolutely named)
            '': { templateUrl: '/view/workareas/add.html' },
        }
    });    

    $stateProvider.state("workareas.edit", {
        url: "/edit/:id",
        templateUrl: '',
	    data: {pageTitle: 'Workareas', 
	    	pageSubTitle: '',
	    },
        views: {
            // the child views will be defined here (absolutely named)
            '': { templateUrl: '/view/workareas/edit.html' },
        }
    });


	
	
    $stateProvider.state("workareas.edit.workstations", {
        url: "/workstations",
        templateUrl: '',
	    data: {pageTitle: 'Workareas', 
	    	pageSubTitle: '',
	    },
        views: {
            // the child views will be defined here (absolutely named)
            'editTab': { templateUrl: '/view/workstations/list.html' },
        }
    }); 
	

   

}]);