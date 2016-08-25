var app = angular.module("myApp", ["ngRoute"]);

app.config(function($routeProvider) {

    $routeProvider

    .when("/home", {
        templateUrl : "view/home.html"
    })

    .when("/system_flow", {
        templateUrl : "view/system_flow.html"
    })

    .when("/protocol", {
        templateUrl : "view/protocol.html"
    })

    .when("/team", {
        templateUrl : "view/team.html"
    })

    .otherwise({
        redirectTo: '/home'
      });

});

app.controller('AppController', ['$scope','$window', '$location', function($scope,$window, $location) {
 
  $scope.goTo = function(page)
  {
  	//remove all active all bar
  	$("ul.nav > li").removeClass("active");

  	//make the selected bar to be active
  	$("li#"+page).addClass("active");

  	//go to the page
  	$window.location.href = "#/" + page;
  }

  $scope.goToAnchor = function(anchor){
  	var currentPage = $window.location.hash;
  	currentPage = 	currentPage.split("#");
  	console.log(currentPage);
    if(currentPage.length > 2)
    {
    	if(currentPage[2] == anchor)
    	{
    		console.log("Asa")
    		$location.reload;
    		return;
    	}
    }
   	
   	$window.location.href = "#" + currentPage[1] + "#" + anchor;

  }

}]);