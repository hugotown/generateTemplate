'use strict';

/**
 * @ngdoc function
 * @name appviewproject0001App.route:buildingsRoute
 * @description
 * # buildingsRoute
 * Route of the buildings appviewproject0001App
 */
angular.module('appviewproject0001App')
.config(['$stateProvider',
function($stateProvider) {
    $stateProvider.state('buildings', {
        url: '/buildings',
        templateUrl: 'views/buildingsHome.html',
        ncyBreadcrumb: {
            label: 'BREADCRUMB-BUILDINGS-HOME-LABEL'
        }
    });
    $stateProvider.state('buildingsList', {
        url: '/buildings/list',
        templateUrl: 'views/BUILDINGSList.html',
        ncyBreadcrumb: {
            parent: 'buildings',
            label: 'BREADCRUMB-BUILDINGS-LIST-LABEL'
        }
    });
    $stateProvider.state('buildingsView', {
        url: '/buildings/view/:buildingId',
        templateUrl: 'views/buildingsView.html',
        ncyBreadcrumb: {
            parent: 'buildingsList',
            label: 'BREADCRUMB-BUILDINGS-VIEW-LABEL'
        }
    });
    $stateProvider.state('buildingsCreate', {
        url: '/buildings/create',
        templateUrl: 'views/buildingsAdd.html',
        ncyBreadcrumb: {
            parent: 'buildingsList',
            label: 'BREADCRUMB-BUILDINGS-CREATE-LABEL'
        }
    });
    $stateProvider.state('buildingsEdit', {
        url: '/buildings/edit/:buildingId',
        templateUrl: 'views/buildingsEdit.html',
        ncyBreadcrumb: {
            parent: 'buildingsList',
            label: 'BREADCRUMB-BUILDINGS-EDIT-LABEL'
        }
    });
}
]);