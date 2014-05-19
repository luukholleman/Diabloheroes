window.app.controller('HeroDetailController', function($scope, $routeParams, Restangular){
    Restangular.one('hero', $routeParams.id).get().then(function (response) {
        $scope.hero = response;
    });


});