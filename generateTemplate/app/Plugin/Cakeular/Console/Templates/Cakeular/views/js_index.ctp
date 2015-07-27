<?php $pluralHumanName = Inflector::classify($pluralHumanName); ?>
<?php $singularHumanName = Inflector::classify($singularHumanName); ?>
<?php $pluralVar = strtolower($pluralVar); ?>
<?php $singularVar = strtolower($singularVar); ?>

project0001App.controller('<?php echo $pluralHumanName; ?>Controller', function($rootScope, $scope, $http, $location, $state, $stateParams, $previousState, $log)
{


});