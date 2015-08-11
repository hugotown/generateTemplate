'use strict';

project0001App.config(['$stateProvider',
function($stateProvider) {
    $stateProvider.state('workareas', {
        url: '/workareas',
        templateUrl: '/js/app/workareas/views/home.html'
    });
    $stateProvider.state('workareasList', {
        url: '/workareas/list',
        templateUrl: '/js/app/workareas/views/list.html'
    });
    $stateProvider.state('workareasView', {
        url: '/workareas/view/:workareaId',
        templateUrl: '/js/app/workareas/views/view.html'
    });
    $stateProvider.state('workareasCreate', {
        url: '/workareas/create',
        templateUrl: '/js/app/workareas/views/add.html'
    });
    $stateProvider.state('workareasEdit', {
        url: '/workareas/edit/:workareaId',
        templateUrl: '/js/app/workareas/views/edit.html'
    });
}
]);