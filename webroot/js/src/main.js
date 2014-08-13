// prepended vendors by CodeKit
// prepended modules by CodeKit

$(document).ready(function() {
    AL_Header.init();

    AL_Materials.init();

    AL_Navigation.init();

    AL_Map.init();

    AL_Popups.init();

    AL_Technics.init();

    AL_Converter.init();

    /*



    $('.converter__input').on('keypress', function(e){
        return /\d/.test(String.fromCharCode(e.keyCode));
    });

    $('.converter__input').on('keyup', function(e) {
        resultField.text(convert($(this).val(), units));
    });

    $('.converter__input').trigger('keyup');

    $('.converter__swap_btn').on('tap', function() {
        var nextUnits = $(this).attr('data-units');

        $('.converter__input_container').attr('data-units', nextUnits);

        $(this).attr('data-units', units);

        units = nextUnits;


        var prevUnitsDesc = $('.converter__input_units').text();
        var nextUnitsDesc = $('.converter__result_units').text();

        $('.converter__input_units').text(nextUnitsDesc);
        $('.converter__result_units').text(prevUnitsDesc);

        resultField.text(convert($('.converter__input').val(), units));
    });*/

});
