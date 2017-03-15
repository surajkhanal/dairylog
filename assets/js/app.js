var app = angular.module('dairyApp',['ui.router']);

app.config(function($stateProvider) {
	$stateProvider
		.state('login',{
			url:'/',
			templateUrl:'templates/login.html',
			controller:'loginCtrl'
		})	
		.state('dashboard',{
			url:'/dashboard',
			templateUrl:'templates/dashboard.html'
		});
	//$urlRouterProvider.otherwise('/');
});