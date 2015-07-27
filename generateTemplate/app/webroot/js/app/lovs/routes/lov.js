'use strict';

project0001App.config(['$stateProvider',
function($stateProvider) {
    $stateProvider.state('lovs', {
        url: '/lovs',
        templateUrl: '/js/app/lovs/views/home.html'
    });
    $stateProvider.state('lovsList', {
        url: '/lovs/list',
        templateUrl: '/js/app/lovs/views/list.html'
    });
    $stateProvider.state('lovsView', {
        url: '/lovs/view/:id',
        templateUrl: '/js/app/lovs/views/view.html'
    });
    $stateProvider.state('lovsCreate', {
        url: '/lovs/create',
        templateUrl: '/js/app/lovs/views/add.html'
    });
    $stateProvider.state('lovsEdit', {
        url: '/lovs/edit/:id',
        templateUrl: '/js/app/lovs/views/edit.html'
    });
}
]);