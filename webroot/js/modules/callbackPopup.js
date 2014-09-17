var AL_CallbackPopup = function(me, $) {

    var classMap = {
            root: 'call-back-popup',
            closeBtn: 'call-back-popup__close_btn',
            orderBtn: 'call-back-popup__order_btn',
            resendOrderBtn: 'call-back-popup__resend_order_btn',
            input: 'call-back-popup__input',
            desc: 'call-back-popup__desc'
        },

        opened = false,

        sending = false,

        closeOnOrderBtnClick = false,

        popup,

        cache = {},

        phoneIsValid = false,

        bind = function() {
            $(document).on('tap', eventHandlers.onDocumentClick);
            $(document).on('tap', '.' + classMap.closeBtn , hide);
            $(document).on('tap', '.' + classMap.orderBtn , eventHandlers.onOrderBtnClick);
            $(document).on('tap', '.' + classMap.resendOrderBtn , eventHandlers.onOrderBtnClick);
            $(document).on('focus', '.' + classMap.input , eventHandlers.onInputFocus);
            $(document).on('tap', '.call-back__btn', eventHandlers.onCallbackBtnClick);
            $(document).on('tap', '.order-popup__call_back_btn', eventHandlers.onCallbackBtnClick);
        },

        show = function(options) {
            if (opened) return;

            popup = create();

            if (options.isFixed) {
                popup.css('position', 'fixed');
            }

            popup.css('left', options.left || 0);
            popup.css('top', options.top || 0);

            if (Modernizr.cssanimations) {
                popup.addClass('showAnimation');
            }

            popup.hide().appendTo('body');

            popup[Modernizr.cssanimations ? 'show' : 'fadeIn']();

            opened = true;

            $('input').placeholder();

            cache = {
                inputs: $('.' + classMap.input),
                desc: $('.' + classMap.desc),
                orderBtn: $('.' + classMap.orderBtn),
                resendBtn: $('.' + classMap.resendOrderBtn)
            };

            cache.descInitText = cache.desc.text();

            phoneIsValid = false;

            cache.inputs.slice().each(function() {
                var input = $(this);

                cache[input.attr('name') + 'Input'] = input;

                if ($(this).attr('name') === 'phone') {
                    input.mask("+7 (999)999-99-99", {
                        completed: function() {
                            phoneIsValid = true;
                        }
                    });
                }
            });
        },

        hide = function() {
            if (Modernizr.cssanimations) {
                popup.addClass('hideAnimation').removeClass('showAnimation');
            }
            else {
                popup.fadeOut();
            }

            setTimeout(function() {
                popup.hide();
                popup.remove();
                cache = {};
                opened = false;
            }, 400);
        },

        create = function() {
            popup = $('<div class="' + classMap.root + '">' +
                         '<p class="call-back-popup__head">Заказать обратный звонок</p>' +
                         '<div class="' + classMap.input + '_container">' +
                           '<input class="' + classMap.input + '" name="fio" type="text" placeholder="Ваше имя"/>' +
                         '</div>' +
                         '<div class="' + classMap.input + '_container">' +
                           '<input class="' + classMap.input + '" name="phone" type="text" placeholder="Номер телефона"/>' +
                         '</div>' +
                         '<p class="' + classMap.desc + '">Мы перезвоним вам  в течение 5 минут</p>' +
                         '<div class="' + classMap.orderBtn + '">Заказать звонок</div>' +
                         '<div class="' + classMap.resendOrderBtn + '">Повторить</div>' +
                         '<div class="' + classMap.closeBtn + '"></div>' +
                       '</div>');

            return popup;
        },

        isOpened = function() {
            return opened;
        },

        eventHandlers = {
            onDocumentClick: function(event) {
                if (!$(event.target).closest('.' + classMap.root).length && opened) {
                    hide();
                }
            },

            onOrderBtnClick: function(e) {
                var btn = cache.orderBtn,
                    fio = cache.fioInput.val(),
                    phone = cache.phoneInput.val(),

                    beforeSend = function() {
                        btn.addClass('sending').text('Отправка...');

                        cache.desc.text(cache.descInitText);
                        cache.resendBtn.hide();

                        cache.fioInput.attr('disabled', true);
                        cache.phoneInput.attr('disabled', true);

                        sending = true;
                    },

                    send = function() {
                            beforeSend();

                        setTimeout(function() {
                            $.post('/mail/call', {
                                fio: fio,
                                phone: phone

                            }).done(function() {

                                cache.desc.text('Ваша заявка принята!');

                            }).fail(function() {

                                cache.resendBtn.show();
                                cache.desc.text('Ошибка! Попробуйте еще раз');

                            }).always(function() {

                                closeOnOrderBtnClick = true;
                                btn.removeClass('sending').text('Спасибо!');
                                sending = false;

                            });
                        }, 1000);
                    };

                if ($(e.target).hasClass(classMap.resendOrderBtn)) {
                    send();

                    return;
                }

                if (sending) return;

                if (closeOnOrderBtnClick) {
                    hide();

                    closeOnOrderBtnClick = false;

                    return;
                }

                cache.fioInput[fio ? 'removeClass' : 'addClass']('invalid');
                cache.phoneInput[phoneIsValid ? 'removeClass' : 'addClass']('invalid');

                if (fio && phoneIsValid) {
                    send();
                }
            },

            onCallbackBtnClick: function() {
                var btn = $(this),
                    isFixed =  (Detectizr.device.type !== 'mobile') && btn.closest('.header').length,
                    options = {
                        isFixed: isFixed
                    };

                if (isFixed) {
                    options.left = (!AL_Header.isMinimized() ? btn.offset().left : btn.parent().offset().left) - 20;
                    options.top = (!AL_Header.isMinimized()) ? btn.offset().top - 15 : 15;
                }
                else {
                    options.left = btn.offset().left - 20;
                    options.top = btn.offset().top - 15;
                }

                show(options);

                return false;
            },

            onInputFocus: function() {
                var input = $(this);

                if (input.hasClass('invalid')) {
                    input.removeClass('invalid');
                }
            }
        };


    return {
        init: function() {
            bind();
        },

        show: show,

        hide: hide,

        isOpened: isOpened
    }

}(AL_CallbackPopup || {}, jQuery);