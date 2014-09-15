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
            resultUnits: $('.converter__result_units')
        },

        materialDestiny = 0,

        opened = false,

        preOpened = false,

        needPreventHide = false,

        units = cache.inputContainer.data('units'),

        bind = function() {
            cache.docket.on('click', eventHandlers.onDocketClick);
            cache.docket.on('mouseenter', eventHandlers.onDocketMouseEnter);
            cache.converter.on('mouseleave', eventHandlers.onConverterMouseLeave);
            cache.input.on('keypress', eventHandlers.onInputKeyPress);
            cache.input.on('keyup', eventHandlers.onInputKeyup);
            cache.swapBtn.on('click', eventHandlers.onSwapBtnClick);
            $(document).on('click', eventHandlers.onDocumentClick);

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
            cache.result.text(convert(cache.input.val(), units));
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
        },

        isOpened = function() {
            return opened;
        },

        preventHide = function(isPreventHide) {
            needPreventHide = isPreventHide;
        },

        setMaterialByText = function(materialName) {
            var selectize = cache.materialChooser[0].selectize,
                items = selectize.sifter.items;

            $.each(items, function(index, item) {
                if (item.text === materialName) {
                    selectize.setValue(item.value);
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
                return /\d/.test(String.fromCharCode(event.keyCode));
            },

            onInputKeyup: function() {
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

            onDocumentClick: function(event) {
                if (!$(event.target).closest('.converter').length && !needPreventHide && opened) {
                    hide();
                }
            }
        };

    cache.materialChooser.selectize({
        create: true,

        onInitialize: function() {
            materialDestiny = parseFloat(this.options[this.caretPos].destiny);
        },

        onChange: function(value) {
            materialDestiny = parseFloat(this.options[value].destiny);

            setResult();
        }
    });

    return {
        init: function() {
            bind();

            cache.input.trigger('keyup');
        },

        show: show,

        hide: hide,

        preventHideOnDocumentClick: preventHide,

        isOpened: isOpened,

        setMaterialByText: setMaterialByText
    }

}(AL_Converter || {}, jQuery);