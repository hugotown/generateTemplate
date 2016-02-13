'use strict';

/**
 * @ngdoc function
 * @name appviewproject0001App.controller:CtrlsCtrl
 * @description
 * # CtrlsCtrl
 * Controller of the appviewproject0001App
 */
angular.module('appviewproject0001App')
 .controller('CtrlsCtrl', 
[ '$rootScope', '$scope', '$http', '$location', '$log', '$state', '$stateParams', 'Notification', '$translate', '$injector',
function($rootScope, $scope, $http, $location, $log, $state, $stateParams, Notification, $translate, $injector)
{


        $scope.$on('findOneLoaded', function(event, data)
        {
            if( $state.current.name.indexOf('View') !== -1 ) {
                $rootScope.parentObj = data;
                $rootScope.parentObjName = data.name || '';
                $rootScope.parentObjType = 'Ctrl';
                $state.current.cObjType = 'Ctrl';
                $state.current.cObjName = data.name || '';
                $state.current.cObj = data;
            }

            
event = null;
data = null;
        });


    $scope.getCtrls = function(params, paramsObj) {

      var urlApi = $rootScope.api_url_base +'/ctrls?';

      if(typeof paramsObj.count !== 'undefined'){
          var skip = (paramsObj.count * (paramsObj.page - 1));
          urlApi += 'limit=' + paramsObj.count + '&skip=' + skip;
      }

      if(typeof paramsObj.sortBy !== 'undefined'){
        urlApi += '&sort=' + paramsObj.sortBy + ' ' + ((paramsObj.sortOrder === 'dsc') ? 'DESC' : 'ASC');
      }

      if(typeof paramsObj.filters !== 'undefined' ){
        urlApi += '&where={';

        if(typeof paramsObj.filters.name !== 'undefined'){
            urlApi += '"name": {"contains":"' + paramsObj.filters.name + '"}';
        }

        urlApi += '}';
      }

      return $http.get(urlApi).then(function (r) {
          var data = {
              'rows': r.data.items,
              'header': [
                                        
{'name': $translate.instant('ctrl-name')} ,

                                
{'lov_ctrl_status': $translate.instant('ctrl-lov_ctrl_status')} ,

                                {'actions': $translate.instant('ctrl-actions')}
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

    var Ctrls = $injector.get('Ctrls');

    $scope.ctrls = [];
    $scope.find = function()
    {
        return Ctrls.query(function(ctrls)
        {
            $scope.ctrls = ctrls;
            $scope.$emit('findLoaded', { data: ctrls });
            return $scope.ctrls;
        });
    };

    $scope.ctrl = {};
    $scope.findOne = function()
    {
        return Ctrls.get({
            ctrlId: $stateParams.ctrlId
        }, function(ctrl)
        {
            $scope.ctrl = ctrl;
            $scope.$emit('findOneLoaded', ctrl);
            return $scope.ctrl;
        });
    };



$scope.lovCtrlStatus = {};

    

if( $state.current.name.indexOf('Create') !== -1 ) {
    $scope.parentObj = $rootScope.parentObj;
    $scope.parentObjName = $rootScope.parentObjName;
    $scope.parentObjType = $rootScope.parentObjType;

        
}



    $scope.create = function(isValid)
    {
        if (isValid)
        {
            var ctrl = new Ctrls({

                                
name: this.name,

                                
lov_ctrl_status: ($scope.lovCtrlStatus.selected) ? $scope.lovCtrlStatus.selected.name_ : '',

                                    
forctrl: 'ok'
            });

            ctrl.$save(function(response)
            {
            $location.path('ctrls/view/' + response.id);
                Notification.success({
                    title:'Ctrl',
                    message: 'Ctrl has been saved',
                    delay: 4000
                });
            });

        } else {
            $scope.submitted = true;
        }
    };

    $scope.update = function(isValid) {
      if (isValid) {
      var ctrl = $scope.ctrl;
                
ctrl.lov_ctrl_status = ($scope.lovCtrlStatus.selected) ? $scope.lovCtrlStatus.selected.name_ : '';

                            
        ctrl.$update(function() {
          $location.path('ctrls/view/' + ctrl.id);
          Notification.success({
                    title:'Ctrl',
                    message: 'Ctrl has been updated',
                    delay: 4000
                });
        });

      } else {
        $scope.submitted = true;
      }
    };


}]);
