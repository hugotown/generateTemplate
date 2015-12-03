'use strict';

/**
 * @ngdoc function
 * @name appviewproject0001App.route:ctrlsRoute
 * @description
 * # ctrlsRoute
 * Route of the ctrls appviewproject0001App
 */
angular.module('appviewproject0001App')
.config(['$stateProvider',
function($stateProvider) {
    $stateProvider.state('ctrls', {
        url: '/ctrls',
        templateUrl: 'views/ctrlsHome.html'
    });
    $stateProvider.state('ctrlsList', {
        url: '/ctrls/list',
        templateUrl: 'views/ctrlsList.html'
    });
    $stateProvider.state('ctrlsView', {
        url: '/ctrls/view/:ctrlId',
        templateUrl: 'views/ctrlsView.html'
    });
    $stateProvider.state('ctrlsCreate', {
        url: '/ctrls/create',
        templateUrl: 'views/ctrlsAdd.html'
    });
    $stateProvider.state('ctrlsEdit', {
        url: '/ctrls/edit/:ctrlId',
        templateUrl: 'views/ctrlsEdit.html'
    });
}
]);