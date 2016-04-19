/**
 *= require entrust_app
 */

app.controller('SelectAsyncController', function($scope, $http) {
  
  $scope.selectedRole = null;
  $scope.roles        = null;

  $scope.loadRoles = function() {
    return $http({
    	method:'GET',
    	url: 'http://'+document.location.host+'/index.php/entrust/api/cerberus/role/get_all'
    })
    .success(function(data, status, headers, config){
    	$scope.roles = data;
    });
  };  
});