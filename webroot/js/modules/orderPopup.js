var AL_OrderPopup = function(me, $) {

    var popup,

        popupType,

        popupData,

        overlay,

        classMap = {
            root: 'order-popup',
            inner: 'order-popup__inner',
            closeBtn: 'order-popup__close_btn',
            overlay: 'overlay',
            materialFractionChooserItem: 'material_fraction_chooser__item',
            materialTotalCost: 'order-cost-calc__total_cost_price',
            materialWeightUnit: 'order-cost-calc__material_weight_unit',
            materialWeightInput: 'order-cost-calc__material_weight',
            orderForm: 'order-popup__order_form',
            orderBtn: 'order-popup__order_btn',
            orderFormField: 'order-popup__order_form_field',
            sendingResultContainer: 'order-popup__sending_results',
            resendBtn: 'order-popup__sending_results_resend_btn'
        },

        cache = {},

        sending = false,

        closeOnOrderBtnClick = false,

        bind = function() {
            $(document).on('tap', '.' + classMap.overlay, hide);
            $(document).on('tap', '.' + classMap.root, eventHandlers.onInnerClick);
            $(document).on('tap', '.' + classMap.closeBtn, hide);
            $(document).on('tap', '.' + classMap.materialFractionChooserItem, eventHandlers.onMaterialChooserItemClick);
            $(document).on('keypress', '.' + classMap.materialWeightInput, eventHandlers.onMaterialWeightInputKeyPress);
            $(document).on('tap', '.' + classMap.materialWeightUnit, eventHandlers.onMaterialWeightUnitClick);
            $(document).on('keyup', '.' + classMap.materialWeightInput, eventHandlers.onMaterialWeightInputKeyup);
            $(document).on('keyup', '.' + classMap.orderFormField, eventHandlers.onOrderFormFieldKeyup);
            $(document).on('tap', '.' + classMap.orderBtn, eventHandlers.onOrderBtnClick);
            $(document).on('tap', '.' + classMap.resendBtn, send);
        },

        create = function(type, data) {
            var specificClass = 'order-' + type + '-popup',
                popupInnerEl,
                closePopupBtn,
                mainContent,
                popupContent;

            popupType = type;
            popupData = data;

            popup = $('<div/>', {
                class: classMap.root + ' ' + specificClass
            }).hide();

            popupInnerEl = $('<div/>', {
                class: classMap.inner
            }).appendTo(popup);

            closePopupBtn = $('<span/>', {
                class: classMap.closeBtn
            }).appendTo(popupInnerEl);

            if (type === 'technic') {
                mainContent = $('<span/>', {
                    class: specificClass + '__main_content'
                }).appendTo(popupInnerEl);
            }

            $('<div class="' + specificClass + '__img_container' + ((data.fractions && data.fractions.length) ? "" : " loaded") + '">' +
                '<img class="' + specificClass + '__img" src="' + data.imgSrc + '" alt="altText"/>' +
              '</div>').appendTo((type === 'material') ? popupInnerEl : mainContent);

            popupContent = $('<div/>', {
                class: specificClass + '__content'
            }).appendTo(popupInnerEl);

            if (type === 'material') {
                popupData.units = (popupData.unit.indexOf('тонн') + 1) ? 'tonns' : 'meters';

                $('<p class="' + specificClass + '__desc">'+ data.desc +'</p>').appendTo(popupContent);

                if (data.fractions && data.fractions.length) {
                    var materialFractionChooser = $('<ul/>', {
                        class: 'material_fraction_chooser'
                    });

                    $.each(data.fractions, function (index, item) {
                        $('<li/>', {
                            class: classMap.materialFractionChooserItem,
                            html: '<p class="' + classMap.materialFractionChooserItem + '_material_fraction">' + item.fraction + '</p>' +
                                '<p class="' + classMap.materialFractionChooserItem + '_material_price">' + item.price + '<span class="ruble">p</span></p>'
                        }).attr('data-img', item.img).appendTo(materialFractionChooser);
                    });

                    materialFractionChooser.appendTo(popupContent);
                }

                $('<div class="order-cost-calc">' +
                    '<div class="order-cost-calc__material_weight_input_container">' +
                        '<input class="' + classMap.materialWeightInput + '" maxlength="3" type="text" value="2"/>' +
                        '<span class="order-cost-calc__material_weight_unit"></span>' +
                        '<span class="order-cost-calc__material_weight_desc"></span>' +
                    '</div>' +
                    '<span class="order-cost-calc__multiple_sign">×</span>' +
                    '<div class="order-cost-calc__material_type_container">' +
                        '<p class="order-cost-calc__material_price">' +
                        '<span class="order-cost-calc__material_price_value">0</span>' +
                        '<span class="ruble">p</span></p>' +
                        '<p class="order-cost-calc__material_type"></p>' +
                    '</div>' +
                    '<span class="order-cost-calc__equals_sign">=</span>' +
                    '<div class="order-cost-calc__total">' +
                        '<p class="' + classMap.materialTotalCost + '"><span class="odometer"></span><span class="ruble">p</span></p>' +
                        '<p class="order-cost-calc__total_cost_desc">+ доставка</p>' +
                    '</div>' +
                  '</div>').appendTo(popupContent);
            }

            if (type === 'technic') {

                $('<div class="order-technic-popup__price_container">' +
                    '<p class="order-technic-popup__price">' + ((data.priceFrom) ? 'от ' : '') + '<span class="order-technic-popup__price_digits">' + data.price + '<span class="ruble">p</span></span> в час</p>' +
                    '<p class="order-technic-popup__price_desc">' + ((!data.min_order) ? 'Цена может варьироваться<br/>в зависимости от продолжительности работы' : 'Минимальный заказ ' + data.min_order + ' ' + AL_Converter.getUnitsEnding(data.min_order, ['час', 'часа', 'часов'])) + '</p>' +
                  '</div>').appendTo(mainContent);

                $('<p/>', {
                    class: 'order-technic-popup__technic_name',
                    text: data.technicName
                }).appendTo(popupContent);

                $('<p/>', {
                    class: 'order-technic-popup__technic_type',
                    text: data.technicType
                }).appendTo(popupContent);

                if (data.desc) {
                    $('<p class="' + specificClass + '__desc">'+ data.desc +'</p>').appendTo(popupContent);
                }

                var technicParams = $('<div/>', {
                    class: 'technic-params'
                });

                $.each(data.params, function(index, paramsArray) {
                    var list = $('<ul/>', {
                        class: 'technic-params__list'
                    });

                    $.each(paramsArray, function(paramArrayIndex, param) {
                        var icoClass = '';

                        if (param.ico) {
                            icoClass = ' technic-params__param_type_' + param.ico;
                        }

                        $('<li/>', {
                            class: 'technic-params__param' + icoClass,
                            html: '<p class="technic-params__param_name">' + param.name + ':</p>' +
                                  '<p class="technic-params__param_value">' + param.value + '</p>'
                        }).appendTo(list);
                    });

                    list.appendTo(technicParams);
                });

                technicParams.appendTo(popupContent);
            }

            $('<div class="' + classMap.orderForm + '">' +
                '<div class="order-popup__order_form_field_container orderFirstLastName">' +
                    '<input class="' + classMap.orderFormField + '" type="text" placeholder="Имя и фамилия" tab-index="1"/>' +
                    '<span class="order-popup__order_form_field_desc">На это имя будет оформлен заказ</span>' +
                '</div>' +
                '<div class="order-popup__order_form_field_container orderPhone">' +
                    '<input class="' + classMap.orderFormField + '" type="text" placeholder="+7 (___)___-__-__" tab-index="2"/>' +
                    '<span class="order-popup__order_form_field_desc">По этому телефону мы позвоним,<br/>чтобы уточнить детали заказа</span>' +
                '</div>' +
                '<div class="order-popup__order_form_field_container orderAddress">' +
                    '<input class="' + classMap.orderFormField + '" type="text" placeholder="Адрес доставки" tab-index="3"/>' +
                    '<span class="order-popup__order_form_field_desc">На этот адрес мы доставим заказ</span>' +
                '</div>' +
              '</div>' +
              '<div class="' + classMap.sendingResultContainer + '">' +
                '<p class="order-popup__sending_results_head">Head</p>' +
                '<p class="order-popup__sending_results_desc">Desc</p>' +
                '<p class="order-popup__sending_results_resend_btn">Повторить</p>'+
              '</div>' +
              '<div class="order-popup__order_btn_wrapper">' +
                '<div class="order-popup__order_btn_container">' +
                    '<div class="' + classMap.orderBtn + '">Заказать</div>' +
                    '<p class="order-popup__order_note">Цена является предварительной.<br/>Менеджер свяжется с вами<br/>для уточнения деталей</p>' +
                '</div>' +
                '<div class="order-popup__call_back_container">' +
                    //'<a class="order-popup__call_back_phone_number"></a>' +
                    '<a class="order-popup__call_back_btn" href="#book-call">Заказать обратный звонок</a>' +
                '</div>' +
              '</div>').appendTo(popupContent);

            popup.appendTo('body');

            $('<a class="order-popup__call_back_phone_number"></a>')
                .prependTo('.order-popup__call_back_container')
                .attr('href', 'tel:' + AL_Header.getPhoneNumber().replace(/\s/g, '').replace('3812', '(3812)'))
                .text(AL_Header.getPhoneNumber().slice(-8));

            createCache();

            $('input, textarea').placeholder();

            cache.orderFormPhoneInput.inputmask("+7 (999)999-99-99", {
                showMaskOnHover: false
            });

            if (type === 'material') {

                new Odometer({
                    el: cache.materialTotalCost[0],
                    value: 0,
                    format: '( ddd).dd'
                });

                setTimeout(function() {
                    if (data.fractions && data.fractions.length) {
                        cache.materialFractionChooserItems.first().trigger('tap');
                    }
                    else {
                        cache.materialPriceValue.text(popupData.materialPrice);
                        cache.materialTypeValue.text('');

                        setMaterialCost(cache.materialWeightInput.val(), popupData.materialPrice);
                    }

                    cache.materialWeightInput.trigger('keyup');
                }, 100);
            }

            show();
        },

        createCache = function() {
            if (popupType === 'material') {
                cache.materialImgHolder = $('.order-' + popupType + '-popup' + '__img');
                cache.materialImgContainer = cache.materialImgHolder.parent();
                cache.materialTotalCost = $('.' + classMap.materialTotalCost).children('.odometer');
                cache.materialFractionChooserItems = $('.' + classMap.materialFractionChooserItem);
                cache.materialWeightInput = $('.' + classMap.materialWeightInput);
                cache.materialWeightInputContainer = cache.materialWeightInput.parent();

                cache.materialPriceValue = $('.order-cost-calc__material_price_value');
                cache.materialTypeValue = $('.order-cost-calc__material_type');

                cache.materialWeightUnit = $('.' + classMap.materialWeightUnit);
                cache.materialWeightInputDesc = $('.order-cost-calc__material_weight_desc');
            }

            cache.orderForm = $('.' + classMap.orderForm);

            cache.orderFormFieldContainers = $('.order-popup__order_form_field_container');

            cache.orderFormFLNameInputContainer = cache.orderFormFieldContainers.filter('.orderFirstLastName');
            cache.orderFormFLNameInput = cache.orderFormFLNameInputContainer.children('.order-popup__order_form_field');
            cache.orderFormFLNameInputDescEl = cache.orderFormFLNameInputContainer.children('.order-popup__order_form_field_desc');
            cache.orderFormFLNameInputDesc = cache.orderFormFLNameInputDescEl.html();

            cache.orderFormPhoneInputContainer = cache.orderFormFieldContainers.filter('.orderPhone');
            cache.orderFormPhoneInput = cache.orderFormPhoneInputContainer.children('.order-popup__order_form_field');
            cache.orderFormPhoneInputDescEl = cache.orderFormPhoneInputContainer.children('.order-popup__order_form_field_desc');
            cache.orderFormPhoneInputDesc = cache.orderFormPhoneInputDescEl.html();

            cache.orderFormAddressInputContainer = cache.orderFormFieldContainers.filter('.orderAddress');
            cache.orderFormAddressInput = cache.orderFormAddressInputContainer.children('.order-popup__order_form_field');
            cache.orderFormAddressInputDescEl = cache.orderFormAddressInputContainer.children('.order-popup__order_form_field_desc');
            cache.orderFormAddressInputDesc = cache.orderFormAddressInputDescEl.html();

            cache.innerEl = $('.' + classMap.inner);

            cache.orderBtn = $('.' + classMap.orderBtn);

            cache.sendingResult = $('.' + classMap.sendingResultContainer);
            cache.sendingResultsHead = cache.sendingResult.children('.' + classMap.sendingResultContainer + '_head');
            cache.sendingResultsDesc = cache.sendingResult.children('.' + classMap.sendingResultContainer + '_desc');
            cache.resendBtn = $('.' + classMap.resendBtn);
        },

        show = function() {
            showOverlay();

            setTimeout(function() {
                popup.css('top', $(window).scrollTop());

                if (Modernizr.cssanimations) {
                    popup.show();
                }
                else {
                    popup.fadeIn();
                }
            }, 100);
        },

        hide = function() {
            var converter = AL_Converter;

            if (Modernizr.cssanimations) {
                popup.addClass('closeAnimation');
            }
            else {
                popup.fadeOut(300);
            }

            setTimeout(function() {
                if (converter.isOpened()) {
                    converter.hide();
                    converter.preventHideOnDocumentClick(false);
                }

                closeOnOrderBtnClick = false;

                popup.remove();

                hideOverlay();

                // clear cache
                cache = {};
            }, 300);
        },

        showOverlay = function() {
            overlay = $('<div/>', {
                class: classMap.overlay
            }).appendTo('body');

            if (Modernizr.csstransitions) {
                overlay.show();

                setTimeout(function() {
                    overlay.css('opacity', 1);
                }, 10);
            }
            else {
                overlay.fadeIn(300);
            }
        },

        hideOverlay = function() {
            if (Modernizr.csstransitions) {
                overlay.css('opacity', 0);

                setTimeout(function() {
                    overlay.remove()
                }, 400);
            }
            else {
                overlay.fadeOut(300, function() {
                    overlay.remove();
                });
            }
        },

        setMaterialCost = function(weight, price) {
            cache.materialTotalCost.text(weight * price);
        },

        eventHandlers = {
            onInnerClick: function(event) {
                if (!$(event.target).closest('.' + classMap.inner).length) {
                    hide();
                }
            },

            onMaterialChooserItemClick: function(event, justUpdatePrice) {
                var item = $(this),
                    itemTypePrice = parseInt(item.children('.' + classMap.materialFractionChooserItem + '_material_price').text(), 10),
                    itemType = item.children('.' + classMap.materialFractionChooserItem + '_material_fraction').text(),

                    loadImg = function(src) {
                        var imgLoader = new Image();

                        imgLoader.onload = function() {
                            if (cache.materialImgHolder.length) {
                                cache.materialImgHolder.attr('src', item.data('img'));
                                setTimeout(function() {
                                    cache.materialImgContainer.addClass('loaded');
                                }, 100);
                            }
                        };

                        cache.materialImgContainer.removeClass('loaded');
                        setTimeout(function() {
                            imgLoader.src = src;
                        }, 200);
                    };

                if (!cache.materialWeightInput.val().length) {
                    return false;
                }

                item.siblings().removeClass('active');

                item.addClass('active');

                if (!justUpdatePrice) {
                    loadImg(item.data('img'));
                }

                cache.materialPriceValue.text(itemTypePrice);
                cache.materialTypeValue.text(itemType);

                setMaterialCost(cache.materialWeightInput.val(), itemTypePrice);
            },

            onMaterialWeightInputKeyPress: function(event) {
                return /\d/.test(String.fromCharCode(event.which)) || (event.which === 8);
            },

            onMaterialWeightUnitClick: function() {
                var converter = AL_Converter;

                converter.preventHideOnDocumentClick(true);

                converter.swap(popupData.units);

                converter.setMaterialByText(popupData.materialName);

                converter.show();
            },

            onMaterialWeightInputKeyup: function(event) {
                var keyCode = event.keyCode;

                if (keyCode === 40 || keyCode === 38) {

                    // arrow up
                    if (keyCode === 38) {
                        cache.materialWeightInput.val(parseInt(cache.materialWeightInput.val(), 10) + 1);
                    }

                    // arrow down
                    if (keyCode === 40) {
                        cache.materialWeightInput.val(parseInt(cache.materialWeightInput.val(), 10) - 1);
                    }
                }

                cache.materialWeightUnit.text((popupData.units === 'tonns') ?
                    AL_Converter.getUnitsEnding(cache.materialWeightInput.val(), ['тонна', 'тонны', 'тонн']) :
                    popupData.unit);

                if (!cache.materialWeightInput.val().length) {
                    return false;
                }

                if (+cache.materialWeightInput.val() >= +cache.materialWeightInput.attr('value')) {

                    if (cache.materialFractionChooserItems.length) {
                        cache.materialFractionChooserItems.filter('.active').trigger('tap', true);
                    }
                    else {
                        setMaterialCost(cache.materialWeightInput.val(), popupData.materialPrice);
                    }

                    if (cache.materialWeightInputContainer.hasClass('not_valid')) {
                        cache.materialWeightInputContainer.removeClass('not_valid');
                        cache.materialWeightInputDesc.text('');
                    }
                }
                else {
                    cache.materialWeightInputContainer.addClass('not_valid');
                    cache.materialWeightInputDesc.text('Минимум ' + cache.materialWeightInput.attr('value') + ' тонны');
                }
            },

            onOrderBtnClick: function(event) {
                if (sending) return;

                if (closeOnOrderBtnClick) {
                    hide();

                    return;
                }

                if (!cache.orderForm.is(':visible')) {
                    if (popupType === 'technic') {
                        popup.addClass('with_order_form');

                        cache.orderForm.appendTo(cache.innerEl);
                        cache.sendingResult.appendTo(cache.innerEl);
                        $('.order-popup__order_btn_wrapper').appendTo(cache.innerEl);
                    }

                    $(this).text('Отправить');

                    cache.orderForm.slideDown(400);
                }
                else {
                    if (!cache.orderFormFLNameInput.val().length) {
                        cache.orderFormFLNameInputContainer.addClass('not_valid');
                        cache.orderFormFLNameInputDescEl.html('Необходимо ввести имя и желательно, фамилию');
                    }
                    else {
                        cache.orderFormFLNameInputContainer.removeClass('not_valid');
                        cache.orderFormFLNameInputDescEl.html(cache.orderFormFLNameInputDesc);
                    }

                    if (!cache.orderFormPhoneInput.inputmask("isComplete")) {
                        cache.orderFormPhoneInputContainer.addClass('not_valid');
                        cache.orderFormPhoneInputDescEl.html('Необходимо ввести номер телефона');
                    }
                    else {
                        cache.orderFormPhoneInputContainer.removeClass('not_valid');
                        cache.orderFormPhoneInputDescEl.html(cache.orderFormPhoneInputDesc);
                    }

                    if (!cache.orderFormAddressInput.val().length) {
                        cache.orderFormAddressInputContainer.addClass('not_valid');
                        cache.orderFormAddressInputDescEl.html('Необходимо ввести адрес доставки');
                    }
                    else {
                        cache.orderFormAddressInputContainer.removeClass('not_valid');
                        cache.orderFormAddressInputDescEl.html(cache.orderFormAddressInputDesc);
                    }

                    if (!(cache.orderFormFLNameInputContainer.hasClass('not_valid') ||
                          cache.orderFormPhoneInputContainer.hasClass('not_valid') ||
                          cache.orderFormAddressInputContainer.hasClass('not_valid'))) {

                        send(event);
                    }
                }
            },

            onOrderFormFieldKeyup: function(event) {
                if ($(this)[0] === cache.orderFormFLNameInput[0]) {
                    if (cache.orderFormFLNameInput.val().length && cache.orderFormFLNameInputContainer.hasClass('not_valid')) {
                        cache.orderFormFLNameInputContainer.removeClass('not_valid');
                        cache.orderFormFLNameInputDescEl.html(cache.orderFormFLNameInputDesc);
                    }
                }
                else if ($(this)[0] === cache.orderFormPhoneInput[0]) {
                    if (cache.orderFormPhoneInput.inputmask("isComplete") && cache.orderFormPhoneInputContainer.hasClass('not_valid')) {
                        cache.orderFormPhoneInputContainer.removeClass('not_valid');
                        cache.orderFormPhoneInputDescEl.html(cache.orderFormPhoneInputDesc);
                    }
                }
                else if ($(this)[0] === cache.orderFormAddressInput[0]) {
                    if (cache.orderFormAddressInput.val().length && cache.orderFormAddressInputContainer.hasClass('not_valid')) {
                        cache.orderFormAddressInputContainer.removeClass('not_valid');
                        cache.orderFormAddressInputDescEl.html(cache.orderFormAddressInputDesc);
                    }
                }
            }
        },

        send = function(event) {
            var fio = cache.orderFormFLNameInput.val(),
                phone = cache.orderFormPhoneInput.val(),
                address = cache.orderFormAddressInput.val(),
                data = {
                    orderType: popupType,
                    fio: fio,
                    phone: phone,
                    address: address
                };

            if (popupType === 'material') {
                data.weight = cache.materialWeightInput.val();
                data.weightString = data.weight + ' ' + AL_Converter.getUnitsEnding(cache.materialWeightInput.val(), ['тонна', 'тонны', 'тонн']);
                data.materialName = (popupData.fractions && popupData.fractions.length) ? (popupData.materialName + '(' + cache.materialTypeValue.text() + ')') : popupData.materialName;
                data.cost = (popupData.fractions && popupData.fractions.length) ? cache.materialPriceValue.text() : popupData.materialPrice;
                data.totalCost = cache.materialWeightInput.val() * data.cost;
            }

            if (popupType === 'technic') {
                data.technicName = popupData.technicName;
                data.technicType = popupData.technicType;
                data.price = popupData.price;
            }

            cache.orderBtn.text('Отправка...').addClass('sending');

            if (!$(event.target).hasClass(classMap.resendBtn)) {
                cache.orderForm.addClass('hideAnimation');
                cache.orderForm.slideUp(400);

                $('.order-popup__order_note').hide();
                $('.order-popup__call_back_container').hide();
            }

            cache.sendingResult.slideUp(100);

            setTimeout(function() {
                cache.sendingResult.removeClass('error');
            }, 200);

            setTimeout(function() {
                $.post('/mail/send', data).done(function() {

                    cache.sendingResultsHead.text('Заявка успешно отправлена!');
                    cache.sendingResultsDesc.html('Менеджер перезвонит вам <br/>в течении рабочего дня');

                }).fail(function() {

                    cache.sendingResult.addClass('error');
                    cache.resendBtn.show();
                    cache.sendingResultsHead.text('Ошибка при отправке заявки!');
                    cache.sendingResultsDesc.html('Попробуйте повторить<br/>отправку позже');

                }).always(function() {

                    closeOnOrderBtnClick = true;
                    cache.sendingResult.slideDown(100);
                    cache.orderBtn.text('Спасибо!').removeClass('sending');
                    sending = false;

                });
            }, 1000);
        };

    return {
        init: function() {
            bind();
        },

        show: function(type, data) {
            create(type, data);
        }
    }

}(AL_OrderPopup || {}, jQuery);