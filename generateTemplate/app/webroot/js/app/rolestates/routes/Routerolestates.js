'use strict';

/**
 * @ngdoc function
 * @name appviewproject0001App.route:rolestatesRoute
 * @description
 * # rolestatesRoute
 * Route of the rolestates appviewproject0001App
 */
angular.module('appviewproject0001App')
.config(['$stateProvider',
function($stateProvider) {
    $stateProvider.state('rolestates', {
        url: '/rolestates',
        templateUrl: 'views/rolestatesHome.html',
        ncyBreadcrumb: {
            label: 'BREADCRUMB-ROLESTATES-HOME-LABEL'
        }
    });
    $stateProvider.state('rolestatesList', {
        url: '/rolestates/list',
        templateUrl: 'views/ROLESTATESList.html',
        ncyBreadcrumb: {
            parent: 'rolestates',
            label: 'BREADCRUMB-ROLESTATES-LIST-LABEL'
        }
    });
    $stateProvider.state('rolestatesView', {
        url: '/rolestates/view/:rolestateId',
        templateUrl: 'views/rolestatesView.html',
        ncyBreadcrumb: {
            parent: 'rolestatesList',
            label: 'BREADCRUMB-ROLESTATES-VIEW-LABEL'
        }
    });
    $stateProvider.state('rolestatesCreate', {
        url: '/rolestates/create',
        templateUrl: 'views/rolestatesAdd.html',
        ncyBreadcrumb: {
            parent: 'rolestatesList',
            label: 'BREADCRUMB-ROLESTATES-CREATE-LABEL'
        }
    });
    $stateProvider.state('rolestatesEdit', {
        url: '/rolestates/edit/:rolestateId',
        templateUrl: 'views/rolestatesEdit.html',
        ncyBreadcrumb: {
            parent: 'rolestatesList',
            label: 'BREADCRUMB-ROLESTATES-EDIT-LABEL'
        }
    });
}
]);