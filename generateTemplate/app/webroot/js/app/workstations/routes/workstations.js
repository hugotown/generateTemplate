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
        templateUrl: 'views/workstationsHome.html'
    });
    $stateProvider.state('workstationsList', {
        url: '/workstations/list',
        templateUrl: 'views/workstationsList.html'
    });
    $stateProvider.state('workstationsView', {
        url: '/workstations/view/:workstationId',
        templateUrl: 'views/workstationsView.html'
    });
    $stateProvider.state('workstationsCreate', {
        url: '/workstations/create',
        templateUrl: 'views/workstationsAdd.html'
    });
    $stateProvider.state('workstationsEdit', {
        url: '/workstations/edit/:workstationId',
        templateUrl: 'views/workstationsEdit.html'
    });
}
]);