<?php $pluralHumanName = Inflector::classify($pluralHumanName); ?>
<?php $singularHumanName = Inflector::classify($singularHumanName); ?>
<?php $pluralVar = strtolower($pluralVar); ?>
<?php $singularVar = strtolower($singularVar); ?>
'use strict';

/**
 * @ngdoc service
 * @name appviewproject0001App.<?php echo Inflector::humanize($pluralVar); ?>

 * @description
 * # <?php echo Inflector::humanize($pluralVar); ?>
 
 * Service in the appviewproject0001App.
 */
//<?php echo Inflector::humanize($pluralVar); ?> service used for <?php echo $pluralVar; ?> REST endpoint
angular.module('appviewproject0001App')
.service('<?php echo Inflector::humanize($pluralVar); ?>',
['$resource', 'API_URL_BASE',
function($resource, API_URL_BASE)
{
    //var $resource = $injector.get('$resource');
    return $resource( API_URL_BASE.url + '/<?php echo $pluralVar; ?>/:<?php echo $singularVar; ?>Id', {
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
