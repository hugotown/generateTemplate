
project0001App
.controller('LovsController', function ($rootScope, $scope, $http, $location, $log, $state, $stateParams, Notification, $translate, $injector)
{

    $scope.prepareData = function()
    {
        var path = $location.path();
        if(path.indexOf('list') !== -1)
        {
        $log.info('list mode');
            $scope.ngtLovsResource = {
                header: [
                                { orderShow : $translate.instant('orderShow') }
                			, { lovType : $translate.instant('lovType') }
                			, { name_ : $translate.instant('name_') }
                			, { name_es_MX : $translate.instant('name_es_MX') }
                			, { name_en_US : $translate.instant('name_en_US') }
                			, { status : $translate.instant('status') }
                			, { parent_id : $translate.instant('parent_id') }
                			, { actions : $translate.instant('Actions') }
                ]
                , rows: [],
                sortBy: "",
                sortOrder: "",
                pagination: {}
            };

            $scope.lovFilters = '';
            $scope.ngTitemsPerPage = 10;
            $scope.ngTlistItemsPerPage = [10, 20, 40, 80];
            $scope.find();
            
        }
        if(path.indexOf('create') !== -1)
        {

        $log.info('create mode');
					    $scope.findLovs();

            
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

    var Lovs = $injector.get('Lovs');

    $scope.find = function()
    {
        Lovs.query(function(lovs)
        {
            $scope.lovs = lovs;
            $scope.$emit('findLoaded', { data: lovs });
            $scope.ngtLovsResource.rows = $scope.lovs;
            $scope.ngtLovsResource.pagination = {
                page: 1,
                size: $scope.lovs.length
            };
        });
    };

    $scope.findOne = function()
    {
        Lovs.get({
            lovId: $stateParams.lovId
        }, function(lov)
        {
            $scope.lov = lov;
        });
    };

				
	$scope.lovs = [];
	$scope.parentLov = {};
	var Lovs = $injector.get('Lovs');
	    $scope.findLovs = function()
	    {
	        Lovs.query(function(lovs)
	        {
	            $scope.lovs = lovs;
	            $scope.$emit('findLovsLoaded', { data: lovs });
	        });
	    };


});
