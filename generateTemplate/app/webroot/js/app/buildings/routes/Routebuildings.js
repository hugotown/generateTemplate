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
        templateUrl: 'views/buildingsHome.html'
    });
    $stateProvider.state('buildingsList', {
        url: '/buildings/list',
        templateUrl: 'views/buildingsList.html'
    });
    $stateProvider.state('buildingsView', {
        url: '/buildings/view/:buildingId',
        templateUrl: 'views/buildingsView.html'
    });
    $stateProvider.state('buildingsCreate', {
        url: '/buildings/create',
        templateUrl: 'views/buildingsAdd.html'
    });
    $stateProvider.state('buildingsEdit', {
        url: '/buildings/edit/:buildingId',
        templateUrl: 'views/buildingsEdit.html'
    });
}
]);