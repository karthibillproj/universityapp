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

                 $scope.deleteUser = function(students){
                    var conf = confirm('Are you sure to delete the student?');
                    if(conf === true){
                       var currentId = students.id;
                         $http.get("api/students.php?delete="+currentId)
                            .success(function(data){
                                var index = $scope.data.indexOf(students);
                                $scope.data.splice(index,1);
                                 $scope.messageSuccess('Student deleted succesffully');
                            })
                            .error(function() {
                                $scope.messageError('Student not deleted');
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

.controller('AddstudentController',
    ['$scope', '$http', function ($scope, $http) {

         $http.get("api/getcourse.php")
                .success(function(data){
                    $scope.coursedata = data;
                })
                .error(function() {
                    $scope.coursedata = "error in fetching data";
                });

         $scope.student = {};

        $scope.submitForm = function() {
                $http({
                    method: 'POST',
                    url: 'api/addstudentpost.php',
                    data: $.param($scope.student),
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
.controller('EditstudentController',
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

                 $http.get("api/getcourse.php?studentid="+currentId)
                .success(function(data){
                    //$scope.coursedata = data;
                   $scope.student.course = data;
                })
                .error(function() {
                    $scope.coursedata = "error in fetching data";
                });


                 $scope.student = {};
              $http.get("api/getstudent.php?id="+currentId)
                .success(function(data){
                    $scope.student.studentid = data.studentid;
                    $scope.student.first_name = data.first_name;
                    $scope.student.last_name = data.last_name;
                    $scope.student.email = data.email;
                    $scope.student.dob = data.dob; 
                })
                .error(function() {
                    $scope.errormessage = "error in fetching data";
                });

              $scope.submitForm = function() {
                $http({
                    method: 'POST',
                    url: 'api/addstudentpost.php',
                    data: $.param($scope.student),
                   headers : { 'Content-Type': 'application/x-www-form-urlencoded' }
                }) .success(function(data) {
                    console.log(data);
                        if (!data.success) {
                            $scope.errormessage = data.errors;
                        } else {
                            // if successful, bind success message to message
                            $scope.message = 'Student updated successfully';
                        }
                });
            };

           
        }]);


angular.module('University')
.controller('DeletestudentController',
    ['$scope', '$http', '$routeParams', function ($scope, $http, $routeParams) {
             var currentId = $routeParams.id;
                
          //  $http.get("api/addstudentpost.php?delete="+currentId)
            $http.get("api/students.php?delete="+currentId)
                .success(function(data){
                    $scope.data = data;
                })
                .error(function() {
                    $scope.errormessage = "error in fetching data";
                }); 


           
        }]);

