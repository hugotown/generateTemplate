'use strict';

/**
 * @ngdoc function
 * @name appviewproject0001App.route:workareasRoute
 * @description
 * # workareasRoute
 * Route of the workareas appviewproject0001App
 */
angular.module('appviewproject0001App')
.config(['$stateProvider',
function($stateProvider) {
    $stateProvider.state('workareas', {
        url: '/workareas',
        templateUrl: 'views/workareasHome.html'
    });
    $stateProvider.state('workareasList', {
        url: '/workareas/list',
        templateUrl: 'views/workareasList.html'
    });
    $stateProvider.state('workareasView', {
        url: '/workareas/view/:workareaId',
        templateUrl: 'views/workareasView.html'
    });
    $stateProvider.state('workareasCreate', {
        url: '/workareas/create',
        templateUrl: 'views/workareasAdd.html'
    });
    $stateProvider.state('workareasEdit', {
        url: '/workareas/edit/:workareaId',
        templateUrl: 'views/workareasEdit.html'
    });
}
]);