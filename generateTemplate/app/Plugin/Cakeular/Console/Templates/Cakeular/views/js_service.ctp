<?php $pluralHumanName = Inflector::classify($pluralHumanName); ?>
<?php $singularHumanName = Inflector::classify($singularHumanName); ?>
<?php $pluralVar = strtolower($pluralVar); ?>
<?php $singularVar = strtolower($singularVar); ?>
'use strict';

/**
 * @ngdoc service
 * @name frontappApp.<?php echo Inflector::humanize($pluralVar); ?>
 * @description
 * # <?php echo Inflector::humanize($pluralVar); ?>
 * Service in the frontappApp.
 */
//<?php echo Inflector::humanize($pluralVar); ?> service used for <?php echo $pluralVar; ?> REST endpoint
angular.module('frontappApp')
.service('<?php echo Inflector::humanize($pluralVar); ?>',
['$resource', 'appSettings',
function($resource, appSettings)
{
    return $resource( appSettings.backendUrl + '/<?php echo $pluralVar; ?>/:<?php echo $singularVar; ?>Id', {
        <?php echo $singularVar; ?>Id: '@id'
    }, {
        get: {
            method:'GET', isArray:false
        },
        query:{
            method:'GET', isArray:false
        },
        update: {
            method: 'PUT'
        }
    });
}]);
