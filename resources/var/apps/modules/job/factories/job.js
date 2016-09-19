
App.factory('Job', function($rootScope, $http, httpCache, Url, CACHE_EVENTS, Customer) {

    var factory = {};

    factory.value_id = null;

    factory.findAll = function(options) {

        if(!this.value_id) return;

        options.concat({
            value_id: this.value_id
        });

        return $http({
            method: 'GET',
            url: Url.get("job/mobile_list/findall", options),
            cache: false,
            responseType:'json'
        });
    };

    factory.find = function(place_id) {

        if(!this.value_id) return;

        return $http({
            method: 'GET',
            url: Url.get("job/mobile_list/find", {value_id: this.value_id, place_id: place_id}),
            cache: false,
            responseType:'json'
        });
    };

    factory.findCompany = function(company_id) {

        if(!this.value_id) return;

        return $http({
            method: 'GET',
            url: Url.get("job/mobile_list/findcompany", {value_id: this.value_id, company_id: company_id}),
            //cache: !$rootScope.isOverview,
            cache: false,
            responseType:'json'
        });
    };

    return factory;
});
