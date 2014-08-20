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

        units = cache.inputContainer.data('units'),

        bind = function() {
            cache.docket.on('click', eventHandlers.onDocketClick);
            cache.input.on('keypress', eventHandlers.onInputKeyPress);
            cache.input.on('keyup', eventHandlers.onInputKeyup);
            cache.swapBtn.on('click', eventHandlers.onSwapBtnClick)
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

        eventHandlers = {
            onDocketClick: function() {
                if (cache.converter.hasClass('active')) {
                    if (Modernizr.cssanimations) {
                        cache.converter.removeClass('active').addClass('not_active');
                    }
                    else {
                        //cache.converter.animate()
                        cache.converter.animate({
                            right: '-' + cache.converter.outerWidth(true)
                        }, 500, function() {
                            cache.converter.removeClass('active');
                        });
                    }

                }
                else {
                    if (Modernizr.cssanimations) {
                        cache.converter.addClass('active').removeClass('not_active');
                    }
                    else {
                        //cache.converter.animate()
                        cache.converter.animate({
                            right: '-20px'
                        }, 500, function() {
                            cache.converter.addClass('active');
                        });
                    }
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
        }
    }

}(AL_Converter || {}, jQuery);