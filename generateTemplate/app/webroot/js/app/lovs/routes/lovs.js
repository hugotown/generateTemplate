'use strict';

/**
 * @ngdoc function
 * @name appviewproject0001App.route:lovsRoute
 * @description
 * # lovsRoute
 * Route of the lovs appviewproject0001App
 */
angular.module('appviewproject0001App')
.config(['$stateProvider',
function($stateProvider) {
    $stateProvider.state('lovs', {
        url: '/lovs',
        templateUrl: 'views/lovsHome.html'
    });
    $stateProvider.state('lovsList', {
        url: '/lovs/list',
        templateUrl: 'views/lovsList.html'
    });
    $stateProvider.state('lovsView', {
        url: '/lovs/view/:lovId',
        templateUrl: 'views/lovsView.html'
    });
    $stateProvider.state('lovsCreate', {
        url: '/lovs/create',
        templateUrl: 'views/lovsAdd.html'
    });
    $stateProvider.state('lovsEdit', {
        url: '/lovs/edit/:lovId',
        templateUrl: 'views/lovsEdit.html'
    });
}
]);