var AL_Services = function(me, $) {

    var maxVisibleServices = 6,

        cache = {
            services: $('.service')
        },

        bind = function() {
            $(document).on('tap', '.service__see_more_btn_container', onMoreBtnClick);

            cache.services.each(function() {
                var serviceContainer = $(this),
                    serviceItems = serviceContainer.find('.service__item');

                if (serviceItems.length > maxVisibleServices) {
                    serviceItems.each(function(index) {
                        var serviceItem = $(this);

                        if (index > maxVisibleServices - 1) {
                            serviceItem.hide();

                            if (Modernizr.csstransitions) {
                                serviceItem.css('opacity', 0);
                            }
                        }
                    });

                    createMoreBtn().appendTo(serviceContainer.find('.service__content'));
                }
            });
        },

        createMoreBtn = function() {
            return $('<div class="service__see_more_btn_container">' +
                        '<a class="service__see_more_btn" href="#seeMore">Показать все услуги</a>' +
                     '</div>');
        },

        onMoreBtnClick = function(e) {
            var moreBtn = $(this),
                hiddenItems = moreBtn.parent().find('.service__item:hidden');

            e.preventDefault();

            if (Modernizr.csstransitions) {
                moreBtn.css('opacity', 0);

                setTimeout(function() {
                    moreBtn.remove();
                }, 200);

                hiddenItems.show();

                setTimeout(function() {
                    hiddenItems.css('opacity', 1);
                }, 10);
            }
            else {
                moreBtn.fadeOut();

                hiddenItems.fadeIn();
            }

            return false;
        };

    return {
        init: function() {
            bind();
        }
    }

}(AL_Services || {}, jQuery);