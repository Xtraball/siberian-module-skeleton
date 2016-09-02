App.service('l17', function($rootScope, $location, $timeout) {

    var service = {};
    
    service.bindResize = function() {
        window.addEventListener("orientationchange", function(){
            console.log('orientationchange');
            service.onResize();
        });

        $rootScope.$on('$ionicView.afterEnter', function() {
            console.log('$ionicView.afterEnter');
            console.log($location.path());
            console.log("/" + APP_KEY);
            if($location.path() == "/" + APP_KEY) {
                service.onResize();
            }
        });

        $rootScope.$on('$stateChangeSuccess', function() {
            console.log('$stateChangeSuccess');
            console.log($location.path());
            console.log("/" + APP_KEY);
            if($location.path() == "/" + APP_KEY) {
                service.onResize();
            }
        });
    };

    service.onResize = function() {
        console.log("service.onResize");
        $timeout(function() {
            var scrollview = document.getElementById('metro-scroll');
            if(scrollview) {
                scrollview.style.display = "block";
            }
            var element = document.getElementById('metro-line-2');
            if(element) {
                var positionInfo = element.getBoundingClientRect();
                element.style.height = positionInfo.width/4+"px";
            }
            /// In case 100 ms was too short.
            $timeout(function() {
                var scrollview = document.getElementById('metro-scroll');
                if(scrollview) {
                    scrollview.style.display = "block";
                }
            }, 1000);
        }, 1500);

    };

    service.features = function(features) {
        console.log("service.features");

        var more_options = features.options.slice(12);
        var chunks = new Array();
        var i, j, temparray, chunk = 2;
        for (i = 0, j = more_options.length; i < j; i += chunk) {
            temparray = more_options.slice(i, i + chunk);
            chunks.push(temparray);
        }
        features.chunks = chunks;

        return features;
    };

    return service;
});