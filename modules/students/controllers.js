'use strict';
 
angular.module('University')
 
/* .controller('StudentController',
    ['$scope',
    function ($scope) {
      
    }]); */

.controller('StudentController',
    ['$scope', '$http', function ($scope, $http) {
            $http.get("api/students.php")
                .success(function(data){
                    $scope.data = data;
                })
                .error(function() {
                    $scope.data = "error in fetching data";
                });
        }]);

angular.module('University')

.controller('AddstudentController',
    ['$scope', '$http', function ($scope, $http) {

        $scope.submitForm = function() {
             /* $http({
                    url: "api/addstudentpost.php",
                    method: "POST",
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                    data: $.param($scope.formdata)
                }).success(function(data, status, headers, config) {
                    $scope.status = status;
                }).error(function(data, status, headers, config) {
                    $scope.status = status;
                }); 
                */

                $http({
                    method: 'POST',
                    url: 'api/addstudentpost.php',
                    data: "message=a",
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                });
            }; 
        }]);
