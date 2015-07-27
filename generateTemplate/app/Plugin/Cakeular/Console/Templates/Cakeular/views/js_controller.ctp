<?php $pluralHumanName = Inflector::classify($pluralHumanName); ?>
<?php $singularHumanName = Inflector::classify($singularHumanName); ?>
<?php $pluralVar = strtolower($pluralVar); ?>
<?php $singularVar = strtolower($singularVar); ?>

project0001App
.controller('<?php echo Inflector::humanize($pluralVar); ?>Controller', function ($rootScope, $scope, $http, $location, $log, $state, $stateParams, Notification, $translate, $injector)
{

    $scope.prepareData = function()
    {
        var path = $location.path();
        if(path.indexOf('list') !== -1)
        {
        $log.info('list mode');
            $scope.ngt<?php echo Inflector::humanize($pluralVar); ?>Resource = {
                header: [
                <?php $sidxp = false; ?>
                <?php foreach ($fields as $key => $field)
                {
                	if($field !== "createdAt" && $field !== "updatedAt" 
                		&& $field !== "createdBy" && $field !== "updatedBy" && $field !== "id"  )
                	{
                		if($sidxp){
                			?>
, { <?php echo $field;?> : $translate.instant('<?php echo $field;?>') }
                			<?
                		} else {
                			?>
{ <?php echo $field;?> : $translate.instant('<?php echo $field;?>') }
                			<?
                			$sidxp = true;
                		}
                	}
                } ?>
, { actions : $translate.instant('Actions') }
                ]
                , rows: [],
                sortBy: "",
                sortOrder: "",
                pagination: {}
            };

            $scope.<?php echo $singularVar; ?>Filters = '';
            $scope.ngTitemsPerPage = 10;
            $scope.ngTlistItemsPerPage = [10, 20, 40, 80];
            $scope.find();
            
        }
        if(path.indexOf('create') !== -1)
        {

        $log.info('create mode');
<?php if (!empty($associations['belongsTo']))
{
	foreach ($associations['belongsTo'] as $alias => $details)
	{
		?>
	<?php $otherSingularVar = Inflector::variable($alias); ?>
	<?php $otherPluralHumanName = Inflector::humanize($details['controller']); ?>
	<?php $otherSingularHumanName = Inflector::singularize($otherPluralHumanName); ?>
	<?php $otherPluralVar = Inflector::variable($details['controller']); ?>
	    $scope.find<?php echo $otherPluralHumanName; ?>();

<?php
	}
}
?>
            
        }
        if (path.indexOf('edit') !== -1)
        {
        $log.info('edit mode');
            
        }
        if(path.indexOf('view') !== -1)
        {
        $log.info('view mode');
            $scope.findOne();
        }
    };

    var <?php echo Inflector::humanize($pluralVar); ?> = $injector.get('<?php echo Inflector::humanize($pluralVar); ?>');

    $scope.find = function()
    {
        <?php echo Inflector::humanize($pluralVar); ?>.query(function(<?php echo $pluralVar; ?>)
        {
            $scope.<?php echo strtolower($pluralVar); ?> = <?php echo $pluralVar; ?>;
            $scope.$emit('findLoaded', { data: <?php echo $pluralVar; ?> });
            $scope.ngt<?php echo Inflector::humanize($pluralVar); ?>Resource.rows = $scope.<?php echo $pluralVar; ?>;
            $scope.ngt<?php echo Inflector::humanize($pluralVar); ?>Resource.pagination = {
                page: 1,
                size: $scope.<?php echo $pluralVar; ?>.length
            };
        });
    };

    $scope.findOne = function()
    {
        <?php echo Inflector::humanize($pluralVar); ?>.get({
            <?php echo $singularVar; ?>Id: $stateParams.<?php echo $singularVar; ?>Id
        }, function(<?php echo $singularVar; ?>)
        {
            $scope.<?php echo $singularVar; ?> = <?php echo $singularVar; ?>;
        });
    };

<?php if (!empty($associations['belongsTo']))
{
	foreach ($associations['belongsTo'] as $alias => $details)
	{
		?>
	<?php $otherSingularVar = Inflector::variable($alias); ?>
	<?php $otherPluralHumanName = Inflector::humanize($details['controller']); ?>
	<?php $otherSingularHumanName = Inflector::singularize($otherPluralHumanName); ?>
	<?php $otherPluralVar = Inflector::variable($details['controller']); ?>

	$scope.<?php echo $otherPluralVar; ?> = [];
	$scope.<?php echo $otherSingularVar; ?> = {};
	var <?php echo $otherPluralHumanName; ?> = $injector.get('<?php echo $otherPluralHumanName; ?>');
	    $scope.find<?php echo $otherPluralHumanName; ?> = function()
	    {
	        <?php echo $otherPluralHumanName; ?>.query(function(<?php echo $otherPluralVar; ?>)
	        {
	            $scope.<?php echo $otherPluralVar; ?> = <?php echo $otherPluralVar; ?>;
	            $scope.$emit('find<?php echo $otherPluralHumanName; ?>Loaded', { data: <?php echo $otherPluralVar; ?> });
	            $log.info('find<?php echo $otherPluralHumanName; ?>Loaded');
	        });
	    };

<?php
	}
}
?>

});
