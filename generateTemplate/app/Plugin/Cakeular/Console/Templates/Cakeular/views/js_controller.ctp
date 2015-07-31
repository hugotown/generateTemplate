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
            
        }
        if(path.indexOf('view') !== -1)
        {
        $log.info('view mode');
            $scope.findOne();
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
            $scope.$emit('findOneLoaded', { data: <?php echo $singularVar; ?> });
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
	        });
	    };

        $scope.find<?php echo $otherPluralHumanName; ?>();

    $scope.selected<?php echo $otherSingularHumanName; ?> = {};
    $scope.search<?php echo $otherSingularHumanName; ?> = '';
    $scope.get<?php echo $otherPluralHumanName; ?> = function(query)
    {
        var createFilterFor<?php echo $otherPluralHumanName; ?> = function(query)
        {
            return function filterFn(<?php echo $otherPluralVar; ?>) {
                return (<?php echo $otherPluralVar; ?>.name.indexOf(query) === 0);
            };
        };
        var results = query ? $scope.<?php echo $otherPluralVar; ?>.filter( createFilterFor<?php echo $otherPluralHumanName; ?>(query) ) : $scope.<?php echo $otherPluralVar; ?>;
        return results;
    };
    $scope.search<?php echo $otherSingularHumanName; ?>Change = function(text) {
        //$log.info('<?php echo $otherSingularVar; ?> changed to ' + text);
    };
    $scope.selected<?php echo $otherSingularHumanName; ?>Change = function(item) {
        if(item){
            if(item.<?php echo $otherSingularHumanName; ?>){
                $log.info(item.<?php echo $otherSingularHumanName; ?>);
            }
        }
    };
<?php
	}
}
?>


    $scope.create = function(isValid)
    {
        if (isValid)
        {
            var <?php echo $singularVar; ?> = new <?php echo Inflector::humanize($pluralVar); ?>({
                createdBy: 1
                , updatedBy: 1
                , createdAt: moment().format('YYYY-MM-DD')
                , updatedAt: moment().format('YYYY-MM-DD')
                , name: this.name
                , role: this.role
                , employeeNumber: this.employeeNumber
                , workarea: this.workarea
                , description: this.description
                , status: "active"//$scope.lovStatus.selected ? $scope.lovStatus.selected.id : null,
                , parent_id: $scope.selectedParentWorkstation.Workstation ? $scope.selectedParentWorkstation.Workstation.id : null
                , store_id: $scope.selectedStore.Store ? $scope.selectedStore.Store.id : null
            });
            $log.info('<?php echo $singularVar; ?> to save');
            $log.info(<?php echo $singularVar; ?>);

            <?php echo $singularVar; ?>.$save(function(response)
            {
                $log.info('response save <?php echo $singularVar; ?>');
                $log.info(response);
                Notification.success({
                    title:'<?php echo $singularHumanName; ?>',
                    message: '<?php echo $singularHumanName; ?> has been saved',
                    delay: 4000
                });
            });

            this.name = '';
            this.role = '';
            this.employeeNumber = '';
            this.workarea = null;
            this.description = '';
            this.status = 'active';
            $scope.selectedParentWorkstation = {};
            $scope.selectedStore = {};
        } else {
            $scope.submitted = true;
        }
    };



});
