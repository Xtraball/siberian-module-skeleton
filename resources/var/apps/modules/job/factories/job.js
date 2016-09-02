
App.factory('Job', function($rootScope, $http, httpCache, Url, CACHE_EVENTS, Customer) {

    var factory = {};

    factory.value_id = null;

    factory.findAll = function() {

        if(!this.value_id) return;

        return $http({
            method: 'GET',
            url: Url.get("job/mobile_list/findall", {value_id: this.value_id}),
            cache: !$rootScope.isOverview,
            responseType:'json'
        }).success(function() {
            var url =  Url.get("job/mobile_list/findall", {value_id: factory.value_id});
        });
    };

    factory.find = function(place_id) {

        if(!this.value_id) return;

        return $http({
            method: 'GET',
            url: Url.get("job/mobile_list/find", {value_id: this.value_id, place_id: place_id}),
            cache: !$rootScope.isOverview,
            responseType:'json'
        });
    };

    factory.findCompany = function(company_id) {

        if(!this.value_id) return;

        return $http({
            method: 'GET',
            url: Url.get("job/mobile_list/findcompany", {value_id: this.value_id, company_id: company_id}),
            cache: !$rootScope.isOverview,
            responseType:'json'
        });
    };

    return factory;
});
