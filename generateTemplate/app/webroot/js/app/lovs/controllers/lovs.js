'use strict';

/**
 * @ngdoc function
 * @name appviewproject0001App.controller:LovsCtrl
 * @description
 * # LovsCtrl
 * Controller of the appviewproject0001App
 */
angular.module('appviewproject0001App')
 .controller('LovsCtrl', 
[ '$rootScope', '$scope', '$http', '$location', '$log', '$state', '$stateParams', 'Notification', '$translate', '$injector',
function($rootScope, $scope, $http, $location, $log, $state, $stateParams, Notification, $translate, $injector)
{


        $scope.$on('findOneLoaded', function(event, data)
        {
            if( $state.current.name.indexOf('View') !== -1 ) {
                $rootScope.parentObj = data;
                $rootScope.parentObjName = data.name || '';
                $rootScope.parentObjType = 'Lov';
                $state.current.cObjType = 'Lov';
                $state.current.cObjName = data.name || '';
                $state.current.cObj = data;
            }

            
if(data.parentLov_id){
    $scope.selectedLov.selected = data.parent_id;
}

                            
event = null;
data = null;
        });


    $scope.getLovs = function(params, paramsObj) {

      var urlApi = $rootScope.api_url_base +'/lovs?';

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
                                        
{'orderShow': $translate.instant('lov-orderShow')} ,

                                
{'lovType': $translate.instant('lov-lovType')} ,

                                
{'name_': $translate.instant('lov-name_')} ,

                                
{'name_es_MX': $translate.instant('lov-name_es_MX')} ,

                                
{'name_en_US': $translate.instant('lov-name_en_US')} ,

                                
{'status': $translate.instant('lov-status')} ,

                                
{'parent_id': $translate.instant('lov-parent_id')} ,

                                {'actions': $translate.instant('lov-actions')}
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

    var Lovs = $injector.get('Lovs');

    $scope.lovs = [];
    $scope.find = function()
    {
        return Lovs.query(function(lovs)
        {
            $scope.lovs = lovs;
            $scope.$emit('findLoaded', { data: lovs });
            return $scope.lovs;
        });
    };

    $scope.lov = {};
    $scope.findOne = function()
    {
        return Lovs.get({
            lovId: $stateParams.lovId
        }, function(lov)
        {
            $scope.lov = lov;
            $scope.$emit('findOneLoaded', lov);
            return $scope.lov;
        });
    };

                                
        $scope.lovs = [];
        $scope.parentLov = {};
        $scope.selectedLov = {};

        
        $scope.findLovs = function($param)
            {
                if(typeof $param !== 'undefined' && $param !== ''){
                    return Lovs.query({
                          where: {
                              name: {
                                contains: $param
                            },
                            lov_lov_status : 'active'
                          }
                      },function(lovs)
                        {
                            $scope.lovs = lovs.items;
                            $scope.$emit('findLovsLoaded', { data: lovs });
                            return $scope.lovs;
                        });
                } else {
                    return Lovs.query({
                          where: {
                            lov_lov_status : 'active'
                          }
                      },function(lovs)
                        {
                            $scope.lovs = lovs.items;
                            $scope.$emit('findLovsLoaded', { data: lovs });
                            return $scope.lovs;
                        });
                }
            };

    


if( $state.current.name.indexOf('Create') !== -1 ) {
    $scope.parentObj = $rootScope.parentObj;
    $scope.parentObjName = $rootScope.parentObjName;
    $scope.parentObjType = $rootScope.parentObjType;

        
    if($scope.parentObjType ===  'Lov'){
        $scope.selectedLov.selected = $scope.parentObj;
    }

                            
}



    $scope.create = function(isValid)
    {
        if (isValid)
        {
            var lov = new Lovs({

                                
orderShow: this.orderShow,

                                
lovType: this.lovType,

                                
name_: this.name_,

                                
name_es_MX: this.name_es_MX,

                                
name_en_US: this.name_en_US,

                                
status: this.status,

                                
parent_id: $scope.selectedLov.selected ? $scope.selectedLov.selected.id : null,

                                            
forctrl: 'ok'
            });

            lov.$save(function(response)
            {
            $location.path('lovs/view/' + response.id);
                Notification.success({
                    title:'Lov',
                    message: 'Lov has been saved',
                    delay: 4000
                });
            });

        } else {
            $scope.submitted = true;
        }
    };

    $scope.update = function(isValid) {
      if (isValid) {
      var lov = $scope.lov;
                
lov.parent_id = $scope.selectedLov.selected ? $scope.selectedLov.selected.id : null;

                                        
        lov.$update(function() {
          $location.path('lovs/view/' + lov.id);
          Notification.success({
                    title:'Lov',
                    message: 'Lov has been updated',
                    delay: 4000
                });
        });

      } else {
        $scope.submitted = true;
      }
    };


}]);
