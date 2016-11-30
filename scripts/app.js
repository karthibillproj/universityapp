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