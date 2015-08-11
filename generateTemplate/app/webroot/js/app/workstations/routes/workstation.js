'use strict';

project0001App.config(['$stateProvider',
function($stateProvider) {
    $stateProvider.state('workstations', {
        url: '/workstations',
        templateUrl: '/js/app/workstations/views/home.html'
    });
    $stateProvider.state('workstationsList', {
        url: '/workstations/list',
        templateUrl: '/js/app/workstations/views/list.html'
    });
    $stateProvider.state('workstationsView', {
        url: '/workstations/view/:workstationId',
        templateUrl: '/js/app/workstations/views/view.html'
    });
    $stateProvider.state('workstationsCreate', {
        url: '/workstations/create',
        templateUrl: '/js/app/workstations/views/add.html'
    });
    $stateProvider.state('workstationsEdit', {
        url: '/workstations/edit/:workstationId',
        templateUrl: '/js/app/workstations/views/edit.html'
    });
}
]);