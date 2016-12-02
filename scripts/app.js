'use strict';

// declare modules
angular.module('Authentication', []);
angular.module('Home', []);

angular.module('University', [
    'Authentication',
    'Home',
    'ngRoute',
    'ngCookies'
])
 
.config(['$routeProvider', function ($routeProvider) {

    $routeProvider
        .when('/', {
            controller: 'StudentController',
            templateUrl: 'modules/students/views/home.html'
        })
         .when('/students', {
            controller: 'StudentController',
            templateUrl: 'modules/students/views/home.html'
        })
         .when('/addstudent', {
            controller: 'AddstudentController',
            templateUrl: 'modules/students/views/addstudent.html'
        })
           .when('/editstudent/:id', {
            controller: 'EditstudentController',
            templateUrl: 'modules/students/views/editstudent.html'
        })
            .when('/deletestudent/:id', {
            controller: 'DeletestudentController',
            templateUrl: 'modules/students/views/home.html'
        })
          .when('/instructors', {
            controller: 'InstructorController',
            templateUrl: 'modules/instructors/views/home.html'
        })
           .when('/courses', {
            controller: 'CourseController',
            templateUrl: 'modules/courses/views/home.html'
        })
 
        .otherwise({ redirectTo: '/' });
}]);