'use strict';

project0001App.config(['$stateProvider',
function($stateProvider) {
    $stateProvider.state('<?php echo strtolower($pluralVar);?>', {
        url: '/<?php echo strtolower($pluralVar);?>',
        templateUrl: '/js/app/<?php echo strtolower($pluralVar);?>/views/home.html'
    });
    $stateProvider.state('<?php echo strtolower($pluralVar);?>List', {
        url: '/<?php echo strtolower($pluralVar);?>/list',
        templateUrl: '/js/app/<?php echo strtolower($pluralVar);?>/views/list.html'
    });
    $stateProvider.state('<?php echo strtolower($pluralVar);?>View', {
        url: '/<?php echo strtolower($pluralVar);?>/view/:id',
        templateUrl: '/js/app/<?php echo strtolower($pluralVar);?>/views/view.html'
    });
    $stateProvider.state('<?php echo strtolower($pluralVar);?>Create', {
        url: '/<?php echo strtolower($pluralVar);?>/create',
        templateUrl: '/js/app/<?php echo strtolower($pluralVar);?>/views/add.html'
    });
    $stateProvider.state('<?php echo strtolower($pluralVar);?>Edit', {
        url: '/<?php echo strtolower($pluralVar);?>/edit/:id',
        templateUrl: '/js/app/<?php echo strtolower($pluralVar);?>/views/edit.html'
    });
}
]);