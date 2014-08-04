var AL_Technics = function(me, $) {

    var cache = {
            technicImg: $('.rent-spec-technic__img_container')
        },

        bind = function() {
            cache.technicImg.on('tap', showPopup);
        },

        showPopup = function(event) {
            var target = $(event.target),
                parent = target.parents('.rent-spec-technic'),
                priceText = parent.find('.rent-spec-technic__price').text(),
                popupData = parent.data('popup-data');

            if (popupData) {
                popupData.imgSrc = parent.find('.rent-spec-technic__img').attr('src');
                popupData.price = priceText.replace(/\D/g, '');
                popupData.priceFrom = /^от/.test(priceText);
                popupData.technicName = parent.find('.rent-spec-technic__name').text();
                popupData.technicType = parent.find('.rent-spec-technic__desc').text();

                AL_Popups.show("technic", popupData);
            }
        };

    return {
        init: function() {
            bind();
        }
    }

}(AL_Technics || {}, jQuery);