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
            $scope.find();
            var DTOptionsBuilder = $injector.get('DTOptionsBuilder');
            var DTColumnDefBuilder = $injector.get('DTColumnDefBuilder');
            $scope.dtOptions = DTOptionsBuilder.newOptions()
            .withOption('rowCallback', function(nRow, aData, iDisplayIndex, iDisplayIndexFull){
                // Unbind first in order to avoid any duplicate handler
                $('td', nRow).unbind('click');
                $('td', nRow).bind('click', function() {
                    $scope.$apply(function() {
                        console.log('some click handler', aData);
                    });
                });
                return nRow;
            })
            .withOption("oLanguage", {
                "sLengthMenu": "_MENU_ " + $translate.instant("records per page"),
                "oPaginate": {
                    "sPrevious": ""+$translate.instant("Previous"),
                    "sNext": ""+$translate.instant("Next")
                },
                "sSearch": $translate.instant("Search")+":",
                "sEmptyTable": $translate.instant("No data available on table")+"...",
                "sInfo": $translate.instant("Showing records")+" _START_ "+ $translate.instant("to") + " _END_",
                "sInfoEmpty": "",
                "sInfoFiltered": "("+$translate.instant("Filtered of")+" _MAX_)"
            })
            .withDOM('<lf<"table-scrollable"t>ip>')
            .withBootstrap()
            // Add ColVis compatibility
            .withColVis()
            // Add Table tools compatibility
            .withTableTools('/bower_components/datatables-tabletools/swf/copy_csv_xls_pdf.swf')
            .withTableToolsButtons([{
                'sExtends': 'csv'
            },{
                'sExtends': 'pdf'
            }])
            .withBootstrapOptions({
                TableTools: {
                    classes: {
                        container: 'btn-group',
                        buttons: {
                            normal: 'btn btn-default'
                        }
                    }
                },
                ColVis: {
                    classes: {
                        container: 'btn-group',
                        masterButton: 'btn btn-default'
                    }
                },
                pagination: {
                    classes: {
                        ul: 'pagination pagination-sm'
                    }
                }
            });
            $scope.dtColumnDefs = [
                <?php $sidxp = false; $countIdx = 0; ?>
                <?php foreach ($fields as $key => $field)
                {
                    if($field !== "createdAt" && $field !== "updatedAt" && $field !== "createdBy" && $field !== "updatedBy" && $field !== "id"  )
                    {
                        if($sidxp){
                            ?>
, DTColumnDefBuilder.newColumnDef(<?php echo $countIdx; ?>).withTitle("<?php echo $field; ?>")
                            <?
                        } else {
                            ?>
DTColumnDefBuilder.newColumnDef(<?php echo $countIdx; ?>).withTitle("<?php echo $field; ?>")
                            <?
                            $sidxp = true;
                        }
                    $countIdx ++;
                    }
                } ?>
, DTColumnDefBuilder.newColumnDef(<?php echo ($countIdx); ?>).withTitle("Actions")
            ];
            
        }
        if(path.indexOf('create') !== -1)
        {

        $log.info('create mode');
            
        }
        if (path.indexOf('edit') !== -1)
        {
        $log.info('edit mode');
            $scope.findOne();

        $scope.$on('findOneLoaded', function(event, data)
        {
            <?php foreach ($fields as $key => $field)
            {
                foreach ($associations['belongsTo'] as $alias => $details)
                {
                    if($details['foreignKey'] == $field)
                    {
                        $otherSingularVar = Inflector::variable($alias);
                        $otherPluralHumanName = Inflector::humanize($details['controller']);
                        $otherSingularHumanName = Inflector::singularize($otherPluralHumanName);
                        $otherPluralVar = Inflector::variable($details['controller']);
                        ?>
if(data.<?php echo $otherSingularVar; ?>_id){
$scope.selected<?php echo $otherSingularHumanName; ?>.selected = data.<?php echo $otherSingularVar; ?>_id;
}

                    <?php
                    }
                }
            }
            ?>

    });
            
        }
        if(path.indexOf('view') !== -1)
        {
        $log.info('view mode');
            $scope.findOne();

        $scope.$on('findOneLoaded', function(event, data)
        {
            <?php foreach ($fields as $key => $field)
            {
                foreach ($associations['belongsTo'] as $alias => $details)
                {
                    if($details['foreignKey'] == $field)
                    {
                        $otherSingularVar = Inflector::variable($alias);
                        $otherPluralHumanName = Inflector::humanize($details['controller']);
                        $otherSingularHumanName = Inflector::singularize($otherPluralHumanName);
                        $otherPluralVar = Inflector::variable($details['controller']);
                        ?>
if(data.<?php echo $otherSingularVar; ?>_id){
$scope.selected<?php echo $otherSingularHumanName; ?>.selected = data.<?php echo $otherSingularVar; ?>_id;
}

                    <?php
                    }
                }
            }
            ?>

    });
        }
    };


    var <?php echo Inflector::humanize($pluralVar); ?> = $injector.get('<?php echo Inflector::humanize($pluralVar); ?>');

    $scope.<?php echo $pluralVar; ?> = [];
    $scope.find = function()
    {
        <?php echo Inflector::humanize($pluralVar); ?>.query(function(<?php echo $pluralVar; ?>)
        {
            $scope.<?php echo $pluralVar; ?> = <?php echo $pluralVar; ?>;
            $scope.$emit('findLoaded', { data: <?php echo $pluralVar; ?> });
        });
    };

    $scope.<?php echo $singularVar; ?> = {};
    $scope.findOne = function()
    {
        <?php echo Inflector::humanize($pluralVar); ?>.get({
            <?php echo $singularVar; ?>Id: $stateParams.<?php echo $singularVar; ?>Id
        }, function(<?php echo $singularVar; ?>)
        {
            $scope.<?php echo $singularVar; ?> = <?php echo $singularVar; ?>;
            $scope.$emit('findOneLoaded', <?php echo $singularVar; ?>);
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
    $scope.selected<?php echo $otherSingularHumanName; ?> = {};
    var <?php echo $otherPluralHumanName; ?> = $injector.get('<?php echo $otherPluralHumanName; ?>');
	    $scope.find<?php echo $otherPluralHumanName; ?> = function()
	    {
	        <?php echo $otherPluralHumanName; ?>.query(function(<?php echo $otherPluralVar; ?>)
	        {
	            $scope.<?php echo $otherPluralVar; ?> = <?php echo $otherPluralVar; ?>;
	            $scope.$emit('find<?php echo $otherPluralHumanName; ?>Loaded', { data: <?php echo $otherPluralVar; ?> });
	        });
	    };

        $scope.find<?php echo $otherPluralHumanName; ?>();

<?php
	}
}
?>


    $scope.create = function(isValid)
    {
        if (isValid)
        {
            var <?php echo $singularVar; ?> = new <?php echo Inflector::humanize($pluralVar); ?>({

                <?php $sidxp = false; $countIdx = 0; ?>
                <?php foreach ($fields as $key => $field)
                {
                    $fieldAlreadyPainted = false;
                    if($field !== "createdAt" && $field !== "updatedAt" && $field !== "createdBy" && $field !== "updatedBy" && $field !== "id"  )
                    {
                        if($sidxp)
                        {
                            foreach ($associations['belongsTo'] as $alias => $details)
                            {
                                if($details['foreignKey'] == $field)
                                {
                                $fieldAlreadyPainted = true;
                                $otherSingularVar = Inflector::variable($alias);
                                $otherPluralHumanName = Inflector::humanize($details['controller']);
                                $otherSingularHumanName = Inflector::singularize($otherPluralHumanName);
                                $otherPluralVar = Inflector::variable($details['controller']);
                                    ?>

, <?php echo $field; ?>: $scope.selected<?php echo $otherSingularHumanName ?>.selected ? $scope.selected<?php echo $otherSingularHumanName ?>.selected.id : null

                                    <?

                                }
                            }
                            if(!$fieldAlreadyPainted)
                            {
                                ?>

, <?php echo $field; ?>: this.<?php echo $field; ?>

                                <?php
                            }
                        } else {
                            foreach ($associations['belongsTo'] as $alias => $details)
                            {
                                if($details['foreignKey'] == $field)
                                {
                                $fieldAlreadyPainted = true;
                                $otherSingularVar = Inflector::variable($alias);
                                $otherPluralHumanName = Inflector::humanize($details['controller']);
                                $otherSingularHumanName = Inflector::singularize($otherPluralHumanName);
                                $otherPluralVar = Inflector::variable($details['controller']);
                                    ?>

 <?php echo $field; ?>: $scope.selected<?php echo $otherSingularHumanName ?>.selected ? $scope.selected<?php echo $otherSingularHumanName ?>.selected.id : null

                                    <?

                                }
                            }
                            if(!$fieldAlreadyPainted)
                            {
                                ?>

 <?php echo $field; ?>: this.<?php echo $field; ?>

                                <?php
                            }
                            $sidxp = true;
                        }
                    $countIdx ++;
                    }
                } ?>
            });
            $log.info('<?php echo $singularVar; ?> to save');
            $log.info(<?php echo $singularVar; ?>);

            <?php echo $singularVar; ?>.$save(function(response)
            {
                $log.info('response save <?php echo $singularVar; ?>');
                $log.info(response);
                $location.path('<?php echo $pluralVar; ?>/view/' + response.id);
                Notification.success({
                    title:'<?php echo $singularHumanName; ?>',
                    message: '<?php echo $singularHumanName; ?> has been saved',
                    delay: 4000
                });
            });

        } else {
            $scope.submitted = true;
        }
    };

    $scope.update = function(isValid) {
      if (isValid) {
      var <?php echo $singularVar; ?> = $scope.<?php echo $singularVar; ?>;
                <?php foreach ($fields as $key => $field)
                {
                    if($field !== "createdAt" && $field !== "updatedAt" && $field !== "createdBy" && $field !== "updatedBy" && $field !== "id"  )
                    {
                            foreach ($associations['belongsTo'] as $alias => $details)
                            {
                                if($details['foreignKey'] == $field)
                                {
                                $fieldAlreadyPainted = true;
                                $otherSingularVar = Inflector::variable($alias);
                                $otherPluralHumanName = Inflector::humanize($details['controller']);
                                $otherSingularHumanName = Inflector::singularize($otherPluralHumanName);
                                $otherPluralVar = Inflector::variable($details['controller']);
                                    ?>

 <?php echo $singularVar; ?>.<?php echo $field; ?> = $scope.selected<?php echo $otherSingularHumanName ?>.selected ? $scope.selected<?php echo $otherSingularHumanName ?>.selected.id : null

                                    <?

                                }
                            }
                    }
                } ?>

        <?php echo $singularVar; ?>.$update(function() {
          $location.path('<?php echo $pluralVar; ?>/view/' + <?php echo $singularVar; ?>.id);
          Notification.success({
                    title:'<?php echo $singularHumanName; ?>',
                    message: '<?php echo $singularHumanName; ?> has been updated',
                    delay: 4000
                });
        });

      } else {
        $scope.submitted = true;
      }
    };


});
