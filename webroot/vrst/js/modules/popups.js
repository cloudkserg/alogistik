var AL_Popups = function(me, $) {

    var popup,

        popupType,

        overlay,

        classMap = {
            root: 'order-popup',
            inner: 'order-popup__inner',
            closeBtn: 'order-popup__close_btn',
            overlay: 'overlay',
            materialTypeChooserItem: 'material_type_chooser__item',
            materialTotalCost: 'order-cost-calc__total_cost_price',
            materialWeightInput: 'order-cost-calc__material_weight',
            orderForm: 'order-popup__order_form',
            orderBtn: 'order-popup__order_btn',
            orderFormField: 'order-popup__order_form_field'
        },

        cache = {},

        orderPhoneIsValid = false,

        bind = function() {
            $(document).on('click', '.' + classMap.overlay, hide);
            $(document).on('click', '.' + classMap.root, eventHandlers.onInnerClick);
            $(document).on('click', '.' + classMap.closeBtn, hide);
            $(document).on('click', '.' + classMap.materialTypeChooserItem, eventHandlers.onMaterialChooserItemClick);
            $(document).on('keypress', '.' + classMap.materialWeightInput, eventHandlers.onMaterialWeightInputKeyPress);
            $(document).on('keyup', '.' + classMap.materialWeightInput, eventHandlers.onMaterialWeightInputKeyup);
            $(document).on('keyup', '.' + classMap.orderFormField, eventHandlers.onOrderFormFieldKeyup);
            $(document).on('click', '.' + classMap.orderBtn, eventHandlers.onOrderBtnClick);
        },

        create = function(type, data) {
            var specificClass = 'order-' + type + '-popup',
                popupInnerEl,
                closePopupBtn,
                mainContent,
                popupContent;

            popupType = type;

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

            $('<div class="' + specificClass + '__img_container">' +
                '<img class="' + specificClass + '__img" src="' + data.imgSrc + '" alt="altText"/>' +
              '</div>').appendTo((type === 'material') ? popupInnerEl : mainContent);

            popupContent = $('<div/>', {
                class: specificClass + '__content'
            }).appendTo(popupInnerEl);

            if (type === 'material') {
                $('<p class="' + specificClass + '__desc">'+ data.desc +'</p>').appendTo(popupContent);

                var materialTypeChooser = $('<ul/>', {
                    class: 'material_type_chooser'
                });

                $.each(data.types, function(index, item) {
                    $('<li/>', {
                        class: classMap.materialTypeChooserItem,
                        html: '<p class="' + classMap.materialTypeChooserItem + '_material_type">' + item.type + '</p>' +
                              '<p class="' + classMap.materialTypeChooserItem + '_material_price">' + item.price + '<span class="ruble">p</span></p>'
                    }).appendTo(materialTypeChooser);
                });

                materialTypeChooser.appendTo(popupContent);

                $('<div class="order-cost-calc">' +
                    '<div class="order-cost-calc__material_weight_input_container">' +
                        '<input class="' + classMap.materialWeightInput + '" maxlength="2" type="text" value="2"/>' +
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
                    '<p class="order-technic-popup__price_desc">Цена может варьироваться<br/>в зависимости от продолжительности работы</p>' +
                  '</div>').appendTo(mainContent);

                $('<p/>', {
                    class: 'order-technic-popup__technic_name',
                    text: data.technicName
                }).appendTo(popupContent);

                $('<p/>', {
                    class: 'order-technic-popup__technic_type',
                    text: data.technicType
                }).appendTo(popupContent);

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
                            html: '<p class="technic-params__param_name">' + param.name + '</p>' +
                                  '<p class="technic-params__param_value">' + param.value + '</p>'
                        }).appendTo(list);
                    });

                    list.appendTo(technicParams);
                });

                technicParams.appendTo(popupContent);
            }


            $('<div class="' + classMap.orderForm + '">' +
                '<div class="order-popup__order_form_field_container orderFirstLastName">' +
                    '<input class="' + classMap.orderFormField + '" type="text" placeholder="Имя и фамилия"/>' +
                    '<span class="order-popup__order_form_field_desc">На это имя будет оформлен заказ</span>' +
                '</div>' +
                '<div class="order-popup__order_form_field_container orderPhone">' +
                    '<input class="' + classMap.orderFormField + '" type="text" placeholder="+7 (___)___-__-__"/>' +
                    '<span class="order-popup__order_form_field_desc">По этому телефону мы позвоним,<br/>чтобы уточнить детали заказа</span>' +
                '</div>' +
                '<div class="order-popup__order_form_field_container orderAddress">' +
                    '<input class="' + classMap.orderFormField + '" type="text" placeholder="Адрес доставки"/>' +
                    '<span class="order-popup__order_form_field_desc">На этот адрес мы доставим заказ</span>' +
                '</div>' +
              '</div>' +
              '<div class="order-popup__order_btn_wrapper">' +
                '<div class="order-popup__order_btn_container">' +
                    '<div class="' + classMap.orderBtn + '">Заказать</div>' +
                    '<p class="order-popup__order_note">Цена является предварительной.<br/>Менеджер свяжется с вами<br/>для уточнения деталей</p>' +
                '</div>' +
                '<div class="order-popup__book_call_container">' +
                    '<p class="order-popup__book_call_phone_number">55-66-77</p>' +
                    '<a class="order-popup__book_call_btn" href="#book-call">Заказать обратный звонок</a>' +
                '</div>' +
              '</div>').appendTo(popupContent);

            popup.appendTo('body');

            createCache();

            $('input, textarea').placeholder();

            cache.orderFormPhoneInput.mask("+7 (999)999-99-99", {
                completed: function() {
                    orderPhoneIsValid = true;
                }
            });

            if (type === 'material') {
                new Odometer({
                    el: cache.materialTotalCost[0],
                    value: 0
                });

                cache.materialTypeChooserItems.first().trigger('click');
                cache.materialWeightInput.trigger('keyup');
            }

            show();
        },

        createCache = function() {
            if (popupType === 'material') {
                cache.materialTotalCost = $('.' + classMap.materialTotalCost).children('.odometer');
                cache.materialTypeChooserItems = $('.' + classMap.materialTypeChooserItem);
                cache.materialWeightInput = $('.' + classMap.materialWeightInput);
                cache.materialWeightInputContainer = cache.materialWeightInput.parent();

                cache.materialPriceValue = $('.order-cost-calc__material_price_value');
                cache.materialTypeValue = $('.order-cost-calc__material_type');

                cache.materialWeightUnit = $('.order-cost-calc__material_weight_unit');
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
            if (Modernizr.cssanimations) {
                popup.addClass('closeAnimation');
            }
            else {
                popup.fadeOut(300);
            }

            setTimeout(function() {
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

            onMaterialChooserItemClick: function(event) {
                var item = $(this),
                    itemTypePrice = parseInt(item.children('.' + classMap.materialTypeChooserItem + '_material_price').text(), 10),
                    itemType = item.children('.' + classMap.materialTypeChooserItem + '_material_type').text();

                if (!cache.materialWeightInput.val().length) {
                    return false;
                }

                item.siblings().removeClass('active');

                item.addClass('active');

                cache.materialPriceValue.text(itemTypePrice);
                cache.materialTypeValue.text(itemType);

                setMaterialCost(cache.materialWeightInput.val(), itemTypePrice);
            },

            onMaterialWeightInputKeyPress: function(event) {
                return /\d/.test(String.fromCharCode(event.keyCode));
            },

            onMaterialWeightInputKeyup: function(event) {
                var materialWeightString = cache.materialWeightInput.val(),
                    materialWeight = parseInt(materialWeightString, 10);

                if (materialWeight >= 5 && materialWeight <= 20) {
                    cache.materialWeightUnit.text('тонн');
                }
                else if (parseInt(materialWeightString.charAt(materialWeightString.length - 1), 10) === 1) {
                    cache.materialWeightUnit.text('тонна');
                }
                else {
                    cache.materialWeightUnit.text('тонны');
                }

                if (!cache.materialWeightInput.val().length) {
                    return false;
                }

                if (+cache.materialWeightInput.val() >= +cache.materialWeightInput.attr('value')) {
                    cache.materialTypeChooserItems.filter('.active').trigger('click');

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
                if (!cache.orderForm.is(':visible')) {
                    if (popupType === 'technic') {
                        popup.addClass('with_order_form');
                    }

                    $(this).text('Отправить');

                    cache.orderForm.slideDown(200);
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

                    if (!orderPhoneIsValid) {
                        cache.orderFormPhoneInputContainer.addClass('not_valid');
                        cache.orderFormPhoneInputDescEl.html('Необходимо ввести номер телефона');
                    }
                    else {
                        cache.orderFormPhoneInputContainer.removeClass('not_valid');
                        cache.orderFormPhoneInputDescEl.html(cache.orderFormPhoneInputDesc);
                    }

                    if (!(cache.orderFormFLNameInputContainer.hasClass('not_valid') ||
                          cache.orderFormPhoneInputContainer.hasClass('not_valid'))) {
                        alert('SUBMIT');
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
                    if (orderPhoneIsValid && cache.orderFormPhoneInputContainer.hasClass('not_valid')) {
                        cache.orderFormPhoneInputContainer.removeClass('not_valid');
                        cache.orderFormPhoneInputDescEl.html(cache.orderFormPhoneInputDesc);
                    }
                }
            }
        };

    return {
        init: function() {
            bind();
        },

        show: function(type, data) {
            create(type, data);
        }
    }

}(AL_Popups || {}, jQuery);