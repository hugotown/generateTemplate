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
        templateUrl: 'views/buildingspotsHome.html'
    });
    $stateProvider.state('buildingspotsList', {
        url: '/buildingspots/list',
        templateUrl: 'views/buildingspotsList.html'
    });
    $stateProvider.state('buildingspotsView', {
        url: '/buildingspots/view/:buildingspotId',
        templateUrl: 'views/buildingspotsView.html'
    });
    $stateProvider.state('buildingspotsCreate', {
        url: '/buildingspots/create',
        templateUrl: 'views/buildingspotsAdd.html'
    });
    $stateProvider.state('buildingspotsEdit', {
        url: '/buildingspots/edit/:buildingspotId',
        templateUrl: 'views/buildingspotsEdit.html'
    });
}
]);