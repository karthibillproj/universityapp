'use strict';
 
angular.module('University')
 
/* .controller('StudentController',
    ['$scope',
    function ($scope) {
      
    }]); */

.controller('CourseController',
    ['$scope', '$http', function ($scope, $http) {
            $http.get("api/courses.php")
                .success(function(data){
                    $scope.data = data;
                })
                .error(function() {
                    $scope.data = "error in fetching data";
                });


                 $scope.deleteCourse = function(courses){
                    var conf = confirm('Are you sure to delete the course?');
                    if(conf === true){
                       var currentId = courses.id;
                         $http.get("api/courses.php?delete="+currentId)
                            .success(function(data){
                                var index = $scope.data.indexOf(courses);
                                $scope.data.splice(index,1);
                                 $scope.messageSuccess('Course deleted succesffully');
                            })
                            .error(function() {
                                $scope.messageError('Course not deleted');
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

.controller('AddcourseController',
    ['$scope', '$http', function ($scope, $http) {


         $scope.course = {};

        $scope.submitForm = function() {
                $http({
                    method: 'POST',
                    url: 'api/addcoursepost.php',
                    data: $.param($scope.course),
                   headers : { 'Content-Type': 'application/x-www-form-urlencoded' }
                }) .success(function(data) {
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
.controller('EditcourseController',
    ['$scope', '$http', '$routeParams', function ($scope, $http, $routeParams) {
             var currentId = $routeParams.id;


                 $scope.course = {};
              $http.get("api/getsinglecourse.php?id="+currentId)
                .success(function(data){
                    $scope.course.courseid = data.id;
                    $scope.course.coursename = data.coursename;
                    $scope.course.duration = data.duration;
                })
                .error(function() {
                    $scope.errormessage = "error in fetching data";
                });

              $scope.submitForm = function() {
                $http({
                    method: 'POST',
                    url: 'api/addcoursepost.php',
                    data: $.param($scope.course),
                   headers : { 'Content-Type': 'application/x-www-form-urlencoded' }
                }) .success(function(data) {
                        if (!data.success) {
                            $scope.errormessage = data.errors;
                        } else {
                            // if successful, bind success message to message
                            $scope.message = 'Course updated successfully';
                        }
                });
            };

           
        }]);
