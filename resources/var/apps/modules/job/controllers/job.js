App.config(function($stateProvider, HomepageLayoutProvider) {

    $stateProvider.state('job-list', {
        url: BASE_PATH+"/job/mobile_list/index/value_id/:value_id",
        controller: 'JobListController',
        templateUrl: "modules/job/templates/l1/list.html"
    }).state('job-view', {
        url: BASE_PATH+"/job/mobile_view/index/value_id/:value_id/place_id/:place_id",
        controller: 'JobViewController',
        templateUrl: "modules/job/templates/l1/view.html"
    }).state('company-view', {
        url: BASE_PATH+"/job/mobile_view/index/value_id/:value_id/company_id/:company_id",
        controller: 'CompanyViewController',
        templateUrl: "modules/job/templates/l1/view-company.html"
    });

}).controller('JobListController', function($cordovaSocialSharing, $ionicModal, $rootScope, $scope, $state, $stateParams, $timeout, $translate, $window, Application, Customer, Dialog, Job) {

    $scope.$on("connectionStateChange", function(event, args) {
        if(args.isOnline == true) {
            $scope.loadContent();
        }
    });

    $scope.options = {
        show_logo: false,
        show_search: false
    };

    $scope.DEFAULT = 0;
    $scope.LOAD_MORE = 1;
    $scope.PULL_TO_REFRESH = 2;

    $scope.collection = new Array();
    $scope.can_load_older_places = false;
    $scope.social_sharing_active = false;
    $scope.is_loading = true;
    $scope.value_id = Job.value_id = $stateParams.value_id;
    $scope.offset = null;
    $scope.time = null;

    $scope.filters = {
        fulltext: "",
        category: null,
        location: null
    };
    

    $scope.filterPlaces = function(place) {
        var concat = place.title+place.subtitle+place.location+place.contract_type;
        var result = true;

        var parts = $scope.filters.fulltext.split(" ");
        for(var i = 0; i < parts.length; i++) {
            var regexp = new RegExp(parts[i], "gi");

            result = result && concat.match(regexp);
        }

        return result;
    };

    $scope.loadContent = function(type) {

        Job.findAll(0, false, 0).success(function(data) {

            $scope.collection = $scope.collection.concat(data.collection);
            $scope.page_title = data.page_title;
            $scope.can_load_older_places = data.more;

            $scope.social_sharing_active = !!(data.social_sharing_is_active == 1 && $scope.collection.length > 0 && !Application.is_webview);

            $scope.page_title = data.page_title;
        }).finally(function() {
            $scope.is_loading = false;
        });
    };

    $scope.loadMore = function() {
        var time = 0;
        console.log($scope.collection.length);
        if($scope.collection.length > 0) {
            time = $scope.collection[$scope.collection.length-1].time;
        }

        Job.findAll(time, false, $scope.collection.length).success(function(data) {

            $scope.collection = $scope.collection.concat(data.collection);
            $scope.page_title = data.page_title;
            $scope.can_load_older_places = data.more;

            $scope.social_sharing_active = !!(data.social_sharing_is_active == 1 && $scope.collection.length > 0 && !Application.is_webview);

            $scope.page_title = data.page_title;
        }).finally(function() {
            $scope.is_loading = false;
            $scope.$broadcast('scroll.infiniteScrollComplete');
        });
    };

    $scope.pullToRefresh = function() {
        var time = 0;
        console.log($scope.collection.length);
        if($scope.collection.length > 0) {
            time = $scope.collection[0].time;
        }

        Job.findAll(time, true, $scope.collection.length).success(function(data) {

            $scope.collection = data.collection.concat($scope.collection);

            $scope.page_title = data.page_title;

            $scope.social_sharing_active = !!(data.social_sharing_is_active == 1 && $scope.collection.length > 0 && !Application.is_webview);

            $scope.page_title = data.page_title;
        }).finally(function() {
            $scope.is_loading = false;
            $scope.$broadcast('scroll.refreshComplete');
        });
    };

    $scope.showItem = function(item) {
        $state.go("job-view", {value_id: $scope.value_id, place_id: item.id});
    };

    $scope.loadContent();

}).controller('JobViewController', function($cordovaSocialSharing, $ionicHistory, $ionicModal, $ionicPopup, $rootScope, $scope, $state, $stateParams, $timeout, $translate, $window, Application, Customer, Dialog, Job, Url, AUTH_EVENTS, CACHE_EVENTS) {

    $scope.$on("connectionStateChange", function(event, args) {
        if(args.isOnline == true) {
            $scope.loadContent();
        }
    });

    $scope.social_sharing_active = false;
    $scope.is_loading = true;
    $scope.value_id = Job.value_id = $stateParams.value_id;

    $scope.loadContent = function() {

        Job.find($stateParams.place_id).success(function(data) {

            $scope.place = data.place;
            $scope.page_title = data.page_title;

            $scope.social_sharing_active = !!(data.social_sharing_is_active == 1 && !Application.is_webview);


        }).finally(function() {
            $scope.is_loading = false;
        });
    };

    $scope.showCompany = function(company_id) {
        $state.go("company-view", {value_id: $scope.value_id, company_id: company_id});
    };

    $scope.loadContent();

}).controller('CompanyViewController', function($cordovaSocialSharing, $ionicHistory, $ionicModal, $ionicPopup, $rootScope, $scope, $state, $stateParams, $timeout, $translate, $window, Application, Customer, Dialog, Job, Url, AUTH_EVENTS, CACHE_EVENTS) {

    $scope.$on("connectionStateChange", function(event, args) {
        if(args.isOnline == true) {
            $scope.loadContent();
        }
    });

    $scope.social_sharing_active = false;
    $scope.is_loading = true;
    $scope.value_id = Job.value_id = $stateParams.value_id;

    $scope.loadContent = function() {

        Job.findCompany($stateParams.company_id).success(function(data) {

            $scope.company = data.company;
            $scope.page_title = data.page_title;

            $scope.social_sharing_active = !!(data.social_sharing_is_active == 1 && !Application.is_webview);


        }).finally(function() {
            $scope.is_loading = false;
        });
    };

    $scope.showPlace = function(place_id) {
        $state.go("job-view", {value_id: $scope.value_id, place_id: place_id});
    };

    $scope.loadContent();

});