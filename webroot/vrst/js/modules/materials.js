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
            cache.materialImg.on('click', showPopup);
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

        showPopup = function(event) {
            var target = $(event.target),
                parent = target.parents('.sale-material'),
                popupData = parent.data('popup-data');

            if (popupData) {
                popupData.imgSrc = parent.find('.sale-material__img').attr('src');

                AL_Popups.show("material", popupData);
            }
        };

    return {
        init: function() {
            bind();
            preloadBackgrounds();
        }
    }

}(AL_Materials || {}, jQuery);