'use strict';

/**
 * @ngdoc function
 * @name appviewproject0001App.route:buildingspotsRoute
 * @description
 * # buildingspotsRoute
 * Route of the buildingspots appviewproject0001App
 */
angular.module('appviewproject0001App')
.config(['$stateProvider',
function($stateProvider) {
    $stateProvider.state('buildingspots', {
        url: '/buildingspots',
        templateUrl: 'views/buildingspotsHome.html',
        ncyBreadcrumb: {
            label: 'BREADCRUMB-BUILDINGSPOTS-HOME-LABEL'
        }
    });
    $stateProvider.state('buildingspotsList', {
        url: '/buildingspots/list',
        templateUrl: 'views/BUILDINGSPOTSList.html',
        ncyBreadcrumb: {
            parent: 'buildingspots',
            label: 'BREADCRUMB-BUILDINGSPOTS-LIST-LABEL'
        }
    });
    $stateProvider.state('buildingspotsView', {
        url: '/buildingspots/view/:buildingspotId',
        templateUrl: 'views/buildingspotsView.html',
        ncyBreadcrumb: {
            parent: 'buildingspotsList',
            label: 'BREADCRUMB-BUILDINGSPOTS-VIEW-LABEL'
        }
    });
    $stateProvider.state('buildingspotsCreate', {
        url: '/buildingspots/create',
        templateUrl: 'views/buildingspotsAdd.html',
        ncyBreadcrumb: {
            parent: 'buildingspotsList',
            label: 'BREADCRUMB-BUILDINGSPOTS-CREATE-LABEL'
        }
    });
    $stateProvider.state('buildingspotsEdit', {
        url: '/buildingspots/edit/:buildingspotId',
        templateUrl: 'views/buildingspotsEdit.html',
        ncyBreadcrumb: {
            parent: 'buildingspotsList',
            label: 'BREADCRUMB-BUILDINGSPOTS-EDIT-LABEL'
        }
    });
}
]);