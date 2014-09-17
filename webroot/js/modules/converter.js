var AL_Converter = function(me, $) {

    var cache = {
            converter: $('.converter'),
            materialChooser: $('.converter__material_chooser'),
            docket: $('.converter__docket'),
            inputContainer: $('.converter__input_container'),
            input: $('.converter__input'),
            swapBtn: $('.converter__swap_btn'),
            result: $('.converter__result'),
            currentUnits: $('.converter__input_units'),
            resultUnits: $('.converter__result_units'),
            infoBtn: $('.converter__info_btn'),
            info: $('.converter__info')
        },

        materialDestiny = 0,

        opened = false,

        preOpened = false,

        needPreventHide = false,

        units = cache.inputContainer.data('units'),

        bind = function() {
            cache.docket.on('tap', eventHandlers.onDocketClick);
            cache.docket.on('mouseenter', eventHandlers.onDocketMouseEnter);
            cache.converter.on('mouseleave', eventHandlers.onConverterMouseLeave);
            cache.input.on('keypress', eventHandlers.onInputKeyPress);
            cache.input.on('keyup', eventHandlers.onInputKeyup);
            cache.swapBtn.on('tap', eventHandlers.onSwapBtnClick);
            cache.infoBtn.on('tap', eventHandlers.onInfoBtnClick);
            $(document).on('tap', eventHandlers.onDocumentClick);

            new Odometer({
                el: cache.result[0],
                value: 0,
                format: '( ddd).dd'
            });
        },

        convert = function(value, units) {
            var result = 0;

            if (units === 'tonns') {
                result = value / materialDestiny;
            }

            if (units === 'meters') {
                result = value * materialDestiny;
            }

            return result;
        },

        setResult = function() {
            var result = convert(cache.input.val(), units);

            cache.result.text(result);

            if (units === 'meters') {
                setTimeout(function() {
                    cache.resultUnits.text(getUnitsEnding(result, ['тонна', 'тонны', 'тонн']));
                }, 1000);
            }
        },

        show = function() {
            opened = true;

            if (Modernizr.cssanimations) {
                cache.converter.addClass('showAnimation').removeClass('hideAnimation');

                if (preOpened) {
                    setTimeout(function(){
                        cache.converter.removeClass('hover');
                        preOpened = false;
                    }, 500);
                }
            }
            else {
                cache.converter.animate({
                    right: '-40px'
                }, 500);
            }
        },

        hide = function() {
            opened = false;

            preventHide(false);

            if (Modernizr.cssanimations) {
                cache.converter.addClass('hideAnimation').removeClass('showAnimation');

                setTimeout(function() {
                    cache.converter.removeClass('hideAnimation unHover hover');
                    preOpened = false;
                }, 600);
            }
            else {
                cache.converter.animate({
                    right: '-' + cache.converter.outerWidth(true)
                }, 500);
            }

            cache.infoBtn.trigger('tap', true);
        },

        isOpened = function() {
            return opened;
        },

        preventHide = function(isPreventHide) {
            needPreventHide = isPreventHide;
        },

        setMaterialByText = function(materialName) {
            var selectize = cache.materialChooser[0].selectize,
                options = selectize.options;

            $.each(options, function(index, option) {
                if (option.text === materialName) {
                    selectize.setValue(option.value);
                }
            });
        },

        eventHandlers = {
            onDocketClick: function() {


                if (opened) {
                    hide();
                }
                else {
                    show();
                }
            },

            onDocketMouseEnter: function() {
                if (opened) {
                    return;
                }

                if (Modernizr.cssanimations) {
                    cache.converter.addClass('hover');
                    preOpened = true;
                }
            },

            onConverterMouseLeave: function() {
                if (opened) {
                    return;
                }

                if (Modernizr.cssanimations && preOpened) {
                    preOpened = false;
                    cache.converter.addClass('unHover').removeClass('hover');

                    setTimeout(function() {
                        cache.converter.removeClass('unHover');
                    }, 400);
                }
            },

            onInputKeyPress: function(event) {
                return /\d/.test(String.fromCharCode(event.which)) || (event.which === 8);
            },

            onInputKeyup: function(event) {
                var keyCode = event.keyCode;

                if (keyCode === 40 || keyCode === 38) {

                    // arrow up
                    if (keyCode === 38) {
                        cache.input.val(parseInt(cache.input.val(), 10) + 1);
                    }

                    // arrow down
                    if (keyCode === 40) {
                        cache.input.val(parseInt(cache.input.val(), 10) - 1);
                    }
                }

                if (units === 'tonns') {
                    cache.currentUnits.text(getUnitsEnding(cache.input.val(), ['тонна', 'тонны', 'тонн']));
                }

                setResult();
            },

            onSwapBtnClick: function() {
                var nextUnits = $(this).attr('data-units'),
                    prevUnitsDesc = cache.currentUnits.text(),
                    nextUnitsDesc = cache.resultUnits.text();

                cache.inputContainer.attr('data-units', nextUnits);

                $(this).attr('data-units', units);

                units = nextUnits;

                cache.currentUnits.text(nextUnitsDesc);
                cache.resultUnits.text(prevUnitsDesc);

                setResult();
            },

            onInfoBtnClick: function(event, forcedHide) {

                if (!forcedHide) {
                    cache.infoBtn.addClass('rotateAnimation');

                    setTimeout(function() {
                        cache.infoBtn.removeClass('rotateAnimation');
                    }, 300);
                }

                if (forcedHide || cache.info.is(':visible')) {
                    cache.info.addClass('hideAnimation');

                    setTimeout(function() {
                        cache.info.removeClass('hideAnimation');
                        cache.info.hide();
                    }, 300);
                }
                else {
                    cache.info.show();
                }
            },

            onDocumentClick: function(event) {
                if (!$(event.target).closest('.converter').length && !needPreventHide && opened) {
                    hide();
                }
            }
        },

        getUnitsEnding = function(val, endings) {
            var val = val + "",
                oneDigitEnding = parseInt(val.slice(-1)),
                twoDigitEnding = parseInt(val.slice(-2)),
                ending;

            if (val.indexOf('.') + 1) {
                return endings[1];
            }

            if ((twoDigitEnding >= 5 && twoDigitEnding <= 20) || ((oneDigitEnding >= 5 && oneDigitEnding <= 9) || oneDigitEnding === 0)) {
                ending = endings[2];
            }
            else if (oneDigitEnding === 1) {
                ending = endings[0];
            }
            else {
                ending = endings[1];
            }

            return ending;
        };

    cache.materialChooser.selectize({
        create: true,

        onInitialize: function() {
            var me = this;

            $.each(me.options, function(index, option) {
                if (!parseFloat(option.destiny)) {
                    me.removeOption(option.value);
                }
            });

            me.refreshOptions();

            for (var firstKey in me.options) break;

            firstKey = +firstKey;

            me.setValue(firstKey);

            materialDestiny = parseFloat(me.options[firstKey].destiny);
        },

        onChange: function(value) {
            materialDestiny = this.options[value] && parseFloat(this.options[value].destiny);

            setResult();
        }
    });

    return {
        init: function() {
            bind();

            cache.input.trigger('keyup');
        },

        getUnitsEnding: getUnitsEnding,

        show: show,

        hide: hide,

        preventHideOnDocumentClick: preventHide,

        isOpened: isOpened,

        setMaterialByText: setMaterialByText
    }

}(AL_Converter || {}, jQuery);