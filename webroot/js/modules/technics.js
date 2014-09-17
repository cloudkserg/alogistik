var AL_Technics = function(me, $) {

    var cache = {
            technicImg: $('.rent-spec-technic__img_container')
        },

        bind = function() {
            cache.technicImg.on('tap', showPopup);
        },

        openFromHash = function() {
            var hash = decodeURIComponent(window.location.hash);

            if (hash) {
                cache.technicImg.filter(function() {
                    return $(this).attr('href') === hash;
                }).trigger('tap', true);
            }
        },

        showPopup = function(event, needScrollToSection) {
            var target = $(event.target),
                parent = target.parents('.rent-spec-technic'),
                priceText = parent.find('.rent-spec-technic__price').text(),
                popupData = parent.data('popup-data'),
                delay = !needScrollToSection ? 0 : 200;

            if (popupData) {
                popupData.imgSrc = parent.find('.rent-spec-technic__img').attr('src');
                popupData.price = priceText.replace(/\D/g, '');
                popupData.priceFrom = /^от/.test(priceText);
                popupData.technicName = parent.find('.rent-spec-technic__name').text();
                popupData.technicType = parent.find('.rent-spec-technic__desc').text();

                if (needScrollToSection) {
                    AL_Navigation.navigateTo(cache.technicImg.parents('.js-scrollspy').attr('data-nav-id'));
                }

                setTimeout(function() {
                    AL_OrderPopup.show("technic", popupData);
                }, delay);
            }
        };

    return {
        init: function() {
            bind();
            openFromHash();
        }
    }

}(AL_Technics || {}, jQuery);