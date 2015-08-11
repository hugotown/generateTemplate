'use strict';

project0001App.config(['$stateProvider',
function($stateProvider) {
    $stateProvider.state('groups', {
        url: '/groups',
        templateUrl: '/js/app/groups/views/home.html'
    });
    $stateProvider.state('groupsList', {
        url: '/groups/list',
        templateUrl: '/js/app/groups/views/list.html'
    });
    $stateProvider.state('groupsView', {
        url: '/groups/view/:groupId',
        templateUrl: '/js/app/groups/views/view.html'
    });
    $stateProvider.state('groupsCreate', {
        url: '/groups/create',
        templateUrl: '/js/app/groups/views/add.html'
    });
    $stateProvider.state('groupsEdit', {
        url: '/groups/edit/:groupId',
        templateUrl: '/js/app/groups/views/edit.html'
    });
}
]);