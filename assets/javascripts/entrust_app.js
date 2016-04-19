/**
 *= require theme
 *= require angular/angular.min
 *= require angular-animate/angular-animate.min
 *= require angular-aria/angular-aria.min
 *= require angular-messages/angular-messages.min
 *= require angular-material/angular-material.min
 */

var app = angular.module('backendApp', ['ngMaterial','ngMessages']);

app.config(function($interpolateProvider) {
  $interpolateProvider.startSymbol('{[{');
  $interpolateProvider.endSymbol('}]}');
});