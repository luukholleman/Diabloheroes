window.app = angular.module('App', ['ngRoute', 'ngAnimate', 'ui.bootstrap', 'restangular', 'chieffancypants.loadingBar']);

window.app.config(function ($routeProvider, $locationProvider, RestangularProvider, $interpolateProvider) {
    $routeProvider.when('/', {
        templateUrl: '/templates/home/index.html',
        controller: 'HomeController',
        reloadOnSearch: false
    });

    RestangularProvider.setBaseUrl('/api/v1');

    $interpolateProvider.startSymbol('[[');
    $interpolateProvider.endSymbol(']]');
});

//window.app.service('Ranklist', function () {
//    this.ranklist = null;
//
//    this.setRanklist = function (ranklist) {
//        this.ranklist = ranklist
//    };
//})
//
//window.app.controller('HomeController', function ($scope, $location, $filter, Restangular, Ranklist) {
//    var _this = this;
//
//    $scope.Ranklist = Ranklist;
//
//    $scope.changeRanklist = function(index){
//        var ranklist = $scope.ranklists[index];
//        Ranklist.setRanklist(ranklist);
//
//        $location.search({
//            'ranklist': ranklist.stat
//        });
//    };
//    Restangular.one('ranklists').get().then(function (response) {
//        $scope.ranklists = response;
//
//        if($location.search().ranklist == undefined) {
//            Ranklist.ranklist = $scope.ranklists[0];
//        } else {
//            Ranklist.ranklist = $scope.ranklists[$scope.ranklists.indexOf($filter('filter')($scope.ranklists, $location.search().ranklist, true)[0])];
//        }
//    });

//    $scope.$watch('Ranklist.ranklist', function (ranklist) {
//        $scope.currentPage = 1;
//        _this.loadHeroes({
//            'page': $scope.currentPage,
//            'ranlist': ranklist,
//            'hardcore': hardcore
//        });
//    });
//});

window.app.controller('HomeHeroListController', function ($scope, $animate, $location, Restangular) {
    $scope.maxSize = 8;

    $scope.loadHeroes = function (data) {
        $scope.heroes = [];
        var heroes = Restangular.one('heroes');

        heroes.get({
            'page': $scope.currentPage,
            'ranklist': $scope.ranklist,
            'hardcore': $scope.hardcore
        }).then(function (response) {
            $scope.totalItems = response.total;
            $scope.itemsPerPage = response.per_page;
            $scope.heroes = response.data;
        });
    };

    $scope.$watch('currentPage', function () {
        $scope.loadHeroes();
//        $location.search($scope.pageKey, $scope.currentPage);
    });
});