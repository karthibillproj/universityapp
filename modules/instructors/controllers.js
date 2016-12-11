'use strict';
 
angular.module('University')
 
/* .controller('StudentController',
    ['$scope',
    function ($scope) {
      
    }]); */

.controller('InstructorController',
    ['$scope', '$http', function ($scope, $http) {
            $http.get("api/instructors.php")
                .success(function(data){
                    $scope.data = data;
                })
                .error(function() {
                    $scope.data = "error in fetching data";
                });

                   $scope.deleteUser = function(instructors){
                    var conf = confirm('Are you sure to delete the instructor?');
                    if(conf === true){
                       var currentId = instructors.id;
                         $http.get("api/instructors.php?delete="+currentId)
                            .success(function(data){
                                var index = $scope.data.indexOf(instructors);
                                $scope.data.splice(index,1);
                                 $scope.messageSuccess('Instructor deleted succesffully');
                            })
                            .error(function() {
                                $scope.messageError('Instructor not deleted');
                            }); 
                    }
                };

                 $scope.messageSuccess = function(msg){
                    $('.alert-success > p').html(msg);
                    $('.alert-success').show();
                    $('.alert-success').delay(5000).slideUp(function(){
                        $('.alert-success > p').html('');
                    });
                };
                
                // function to display error message
                $scope.messageError = function(msg){
                    $('.alert-danger > p').html(msg);
                    $('.alert-danger').show();
                    $('.alert-danger').delay(5000).slideUp(function(){
                        $('.alert-danger > p').html('');
                    });
                };
        }]);

angular.module('University')

.controller('AddinstructorController',
    ['$scope', '$http', function ($scope, $http) {

         $http.get("api/getcourse.php")
                .success(function(data){
                    $scope.coursedata = data;
                })
                .error(function() {
                    $scope.coursedata = "error in fetching data";
                });

         $scope.instuctor = {};

        $scope.submitForm = function() {
                $http({
                    method: 'POST',
                    url: 'api/addinstructorpost.php',
                    data: $.param($scope.instructor),
                   headers : { 'Content-Type': 'application/x-www-form-urlencoded' }
                }) .success(function(data) {
                    console.log(data);
                        if (!data.success) {
                            $scope.errormessage = data.errors;
                        } else {
                            // if successful, bind success message to message
                            $scope.message = data.message;
                        }
                });
            };

        }]);
angular.module('University')
.controller('EditinstructorController',
    ['$scope', '$http', '$routeParams', function ($scope, $http, $routeParams) {
             var currentId = $routeParams.id;
              $http.get("api/getcourse.php")
                .success(function(data){
                   // $scope.coursedata = data;
                    $scope.courses = data;
                })
                .error(function() {
                    $scope.coursedata = "error in fetching data";
                });

                 $http.get("api/getcourse.php?instructorid="+currentId)
                .success(function(data){
                    //$scope.coursedata = data;
                   $scope.instructor.course = data;
                })
                .error(function() {
                    $scope.coursedata = "error in fetching data";
                });


                 $scope.instructor = {};
              $http.get("api/getinstructor.php?id="+currentId)
                .success(function(data){
                    $scope.instructor.instructorid = data.instructorid;
                    $scope.instructor.first_name = data.first_name;
                    $scope.instructor.last_name = data.last_name;
                    $scope.instructor.email = data.email;
                    $scope.instructor.qualification = data.qualification; 
                })
                .error(function() {
                    $scope.errormessage = "error in fetching data";
                });

              $scope.submitForm = function() {
                $http({
                    method: 'POST',
                    url: 'api/addinstructorpost.php',
                    data: $.param($scope.instructor),
                   headers : { 'Content-Type': 'application/x-www-form-urlencoded' }
                }) .success(function(data) {
                    console.log(data);
                        if (!data.success) {
                            $scope.errormessage = data.errors;
                        } else {
                            // if successful, bind success message to message
                            $scope.message = 'Instructor updated successfully';
                        }
                });
            };

           
        }]);

