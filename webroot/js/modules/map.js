var AL_Map = function(me, $) {

    var map,

        bind = function() {
            $(window).on('resize', changeState);
        },

        loadMapLibrary = function(onSuccess) {
            $.getScript('http://api-maps.yandex.ru/2.1/?lang=ru_RU')
                .done(function() {
                    onSuccess && onSuccess();
                })
                .fail(function( jqxhr, settings, exception ) {
                    setTimeout(function() {
                        loadMapLibrary(onSuccess);
                    }, 2000);
                });
        },

        createMap = function() {
            loadMapLibrary(function() {
                ymaps.ready(function () {
                    map = new ymaps.Map('map', {
                        center: [54.9932, 73.2426],
                        zoom: 16,
                        controls: ['zoomControl', 'geolocationControl']
                    });

                    addBaloon();

                    changeState();

                    $(document).on('click', '.contacts__item_address', setMapInitSettings);
                });
            });
        },

        addBaloon = function() {
            var myPlacemark = new ymaps.Placemark(map.getCenter(), {
                    hintContent: ''
                },
                {
                    iconLayout: 'default#image',
                    iconImageHref: 'img/i/mapIcon@2x.png',
                    iconImageSize: [61, 76],
                    iconImageOffset: [-30, -72]
                });

            map.geoObjects.add(myPlacemark);


        },

        changeState = function() {
            map.behaviors[(map && $(window).height() <= 500) ? 'disable' : 'enable'](['multiTouch', 'scrollZoom']);
        },

        setMapInitSettings = function() {
            map.panTo([54.9932, 73.2426]).then(function () {
                map.setZoom(16);
            }, function (err) {
            }, this);
        };

    return {
        init: function() {
            bind();
            createMap();
        }
    }

}(AL_Map || {}, jQuery);