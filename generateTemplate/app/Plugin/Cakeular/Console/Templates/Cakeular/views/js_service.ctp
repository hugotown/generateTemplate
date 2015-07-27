<?php $pluralHumanName = Inflector::classify($pluralHumanName); ?>
<?php $singularHumanName = Inflector::classify($singularHumanName); ?>
<?php $pluralVar = strtolower($pluralVar); ?>
<?php $singularVar = strtolower($singularVar); ?>
'use strict';

//<?php echo Inflector::humanize($pluralVar); ?> service used for <?php echo $pluralVar; ?> REST endpoint
project0001App.factory('<?php echo Inflector::humanize($pluralVar); ?>', ['$resource', function($resource)
{
    //var $resource = $injector.get('$resource');
    return $resource('/<?php echo $pluralVar; ?>/:<?php echo $singularVar; ?>Id', {
        <?php echo $singularVar; ?>Id: '@id'
    }, {
      update: {
        method: 'PUT'
      }
    });
}]);
