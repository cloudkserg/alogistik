var AL_Materials = function(me, $) {

    var cache = {
            materialsEls: $('.sale-material'),
            materialImg: $('.sale-material__img_container'),
            backgroundHolder: $('.sale-materials__background_holder'),
            crossfadeHelper: $('.sale-materials__background_crossfade_helper')
        },

        allBackgroundsLoaded = false,

        backgroundsCount = cache.materialsEls.length,

        currentBackground,


        bind = function() {
            cache.materialImg.on('mouseenter', crossfadeBackgrounds);
            cache.materialImg.on('tap', showPopup);
        },

        openFromHash = function() {
            var hash = decodeURIComponent(window.location.hash);

            if (hash) {
                cache.materialImg.filter(function() {
                     return $(this).attr('href') === hash;
                }).trigger('tap', true);
            }
        },

        preloadBackgrounds = function() {

            cache.materialsEls.each(function(index) {

                var imgLoader = new Image(),
                    background = $(this).data('bg'),

                    loadBackground = function() {
                        imgLoader.onload = function() {
                            backgroundsCount--;

                            if (!backgroundsCount) {
                                allBackgroundsLoaded = true;
                            }
                        };

                        imgLoader.onerror = function() {
                            setTimeout(function() {
                                loadBackground();
                            }, 2000);
                        };

                        imgLoader.src = background;
                    };

                loadBackground();

                if (index === 0) {
                    currentBackground = background;
                    cache.backgroundHolder.attr('src', background);
                }
            });
        },

        crossfadeBackgrounds = function() {
            if (allBackgroundsLoaded) {
                var background = $(this).parents('.sale-material').data('bg');

                if (background !== currentBackground) {
                    cache.crossfadeHelper.attr('src', background);

                    if (Modernizr.csstransitions) {
                        cache.backgroundHolder.css('opacity', 0);
                    }
                    else {
                        cache.backgroundHolder.fadeOut(300);
                    }

                    setTimeout(function() {
                        currentBackground = background;

                        cache.backgroundHolder.attr('src', currentBackground);

                        if (Modernizr.csstransitions) {
                            cache.backgroundHolder.css({'opacity': 1});
                        }
                        else {
                            cache.backgroundHolder.show();
                        }

                    }, 400);

                }
            }
        },

        showPopup = function(event, needScrollToSection) {
            var target = $(event.target),
                parent = target.parents('.sale-material'),
                popupData = parent.data('popup-data'),
                delay = !needScrollToSection ? 0 : 200;

            if (popupData) {
                popupData.materialName = parent.find('.sale-material__name').text();
                popupData.imgSrc = parent.find('.sale-material__img').attr('src');
                popupData.materialPrice = parent.find('.sale-material__price').text();
                popupData.materialPrice = parseInt(popupData.materialPrice) || parseInt(popupData.materialPrice.slice(3));

                if (needScrollToSection) {
                    AL_Navigation.navigateTo(cache.materialImg.parents('.js-scrollspy').attr('data-nav-id'));
                }

                setTimeout(function() {
                    AL_OrderPopup.show("material", popupData);
                }, delay);
            }
        };

    return {
        init: function() {
            bind();
            openFromHash();
            preloadBackgrounds();
        }
    }

}(AL_Materials || {}, jQuery);