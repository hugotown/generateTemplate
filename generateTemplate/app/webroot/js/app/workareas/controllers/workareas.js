'use strict';

/**
 * @ngdoc function
 * @name appviewproject0001App.controller:WorkareasCtrl
 * @description
 * # WorkareasCtrl
 * Controller of the appviewproject0001App
 */
angular.module('appviewproject0001App')
 .controller('WorkareasCtrl', 
[ '$rootScope', '$scope', '$http', '$location', '$log', '$state', '$stateParams', 'Notification', '$translate', '$injector',
function($rootScope, $scope, $http, $location, $log, $state, $stateParams, Notification, $translate, $injector)
{

        $scope.$on('findOneLoaded', function(event, data)
        {
            if (data.lov_workarea_status && data.lov_workarea_status !== '') {
    var lovWorkareaStatuses = $scope.findLovs('equals', '', 'WORKAREA_STATUS', 'lovWorkareaStatuses', data.lov_workarea_status);
    lovWorkareaStatuses.$promise.then(function(datapromise) {
        if (datapromise.items[0]) {
            $scope.lovWorkareaStatus.selected = datapromise.items[0];
        }
    });
}
                                event = null;
            data = null;
        });


    $scope.getWorkareas = function(params, paramsObj) {

      var urlApi = $rootScope.api_url_base +'/workareas?';

      if(typeof paramsObj.count !== 'undefined'){
          var skip = (paramsObj.count * (paramsObj.page - 1));
          urlApi += 'limit=' + paramsObj.count + '&skip=' + skip;
      }

      if(typeof paramsObj.sortBy !== 'undefined'){
        urlApi += '&sort=' + paramsObj.sortBy + ' ' + ((paramsObj.sortOrder === 'dsc') ? 'DESC' : 'ASC');
      }

      if(typeof paramsObj.filters !== 'undefined' && paramsObj.filters !== ''){
        urlApi += '&where={"name": {"contains":"' + paramsObj.filters + '"}}';
      }

      return $http.get(urlApi).then(function (r) {
          var data = {
              'rows': r.data.items,
              'header': [
                                        {name: $translate.instant('name')} ,
                                {description: $translate.instant('description')} ,
                                {lov_workarea_status: $translate.instant('lov_workarea_status')} ,
                                {Actions: $translate.instant('Actions')}
              ],
              'pagination': {
                  'count': paramsObj.count,
                  'page': paramsObj.page,
                  'pages': Math.ceil(r.data.info.total / paramsObj.count),
                  'size': r.data.info.total
              },
              'sortBy': paramsObj.sortBy,
              'sortOrder': paramsObj.sortOrder
          };
          return data;
      });
  };


    var Workareas = $injector.get('Workareas');

    $scope.workareas = [];
    $scope.find = function()
    {
        return Workareas.query(function(workareas)
        {
            $scope.workareas = workareas;
            $scope.$emit('findLoaded', { data: workareas });
            return $scope.workareas;
        });
    };

    $scope.workarea = {};
    $scope.findOne = function()
    {
        return Workareas.get({
            workareaId: $stateParams.workareaId
        }, function(workarea)
        {
            $scope.workarea = workarea;
            $scope.$emit('findOneLoaded', workarea);
            return $scope.workarea;
        });
    };


$scope.lovWorkareaStatus = {};
    
var Lovs = $injector.get('Lovs');
$scope.findLovs = function($typeSearch, $fieldLang, $type, $svar, $param) {
    var whereStmnt = {
        lovType: $type,
        status: 'active'
    };
    switch ($typeSearch) {
        case 'contains':
            if ($param !== '' && $fieldLang !== '') {
                whereStmnt[$fieldLang] = {
                    contains: $param
                };
            }
            break;
        default:
            if ($param !== '') {
                whereStmnt.name_ = $param;
            }
            break;
    }
    return Lovs.query({
        where: whereStmnt,
        sort: 'orderShow ASC'
    }, function(lovs) {
        $scope[$svar] = lovs.items;
        return $scope[$svar];
    });
};


    $scope.create = function(isValid)
    {
        if (isValid)
        {
            var workarea = new Workareas({

                                name: this.name,
                                description: this.description,
                                lov_workarea_status: ($scope.lovWorkareaStatus.selected) ? $scope.lovWorkareaStatus.selected.name_ : '',

                                                    forctrl: 'ok'
            });

            workarea.$save(function(response)
            {
            $location.path('workareas/view/' + response.id);
                Notification.success({
                    title:'Workarea',
                    message: 'Workarea has been saved',
                    delay: 4000
                });
            });

        } else {
            $scope.submitted = true;
        }
    };

    $scope.update = function(isValid) {
      if (isValid) {
      var workarea = $scope.workarea;
                workarea.lov_workarea_status = ($scope.lovWorkareaStatus.selected) ? $scope.lovWorkareaStatus.selected.name_ : '';

                            
        workarea.$update(function() {
          $location.path('workareas/view/' + workarea.id);
          Notification.success({
                    title:'Workarea',
                    message: 'Workarea has been updated',
                    delay: 4000
                });
        });

      } else {
        $scope.submitted = true;
      }
    };


}]);
