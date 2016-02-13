'use strict';

/**
 * @ngdoc function
 * @name appviewproject0001App.route:workstationsRoute
 * @description
 * # workstationsRoute
 * Route of the workstations appviewproject0001App
 */
angular.module('appviewproject0001App')
.config(['$stateProvider',
function($stateProvider) {
    $stateProvider.state('workstations', {
        url: '/workstations',
        templateUrl: 'views/workstationsHome.html',
        ncyBreadcrumb: {
            label: 'BREADCRUMB-WORKSTATIONS-HOME-LABEL'
        }
    });
    $stateProvider.state('workstationsList', {
        url: '/workstations/list',
        templateUrl: 'views/WORKSTATIONSList.html',
        ncyBreadcrumb: {
            parent: 'workstations',
            label: 'BREADCRUMB-WORKSTATIONS-LIST-LABEL'
        }
    });
    $stateProvider.state('workstationsView', {
        url: '/workstations/view/:workstationId',
        templateUrl: 'views/workstationsView.html',
        ncyBreadcrumb: {
            parent: 'workstationsList',
            label: 'BREADCRUMB-WORKSTATIONS-VIEW-LABEL'
        }
    });
    $stateProvider.state('workstationsCreate', {
        url: '/workstations/create',
        templateUrl: 'views/workstationsAdd.html',
        ncyBreadcrumb: {
            parent: 'workstationsList',
            label: 'BREADCRUMB-WORKSTATIONS-CREATE-LABEL'
        }
    });
    $stateProvider.state('workstationsEdit', {
        url: '/workstations/edit/:workstationId',
        templateUrl: 'views/workstationsEdit.html',
        ncyBreadcrumb: {
            parent: 'workstationsList',
            label: 'BREADCRUMB-WORKSTATIONS-EDIT-LABEL'
        }
    });
}
]);