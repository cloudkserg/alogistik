var AL_Header = (function(me, $) {

    var minimizedHeaderModifier = 'headerMinimized',
        minDocumentWidth = 1000,
        maxMinimizedHeaderWidth = 1200,
        body = $('body'),

        bind = function() {
            $(window).on('scroll', changeState);
            $(window).on('resize', changeState);
        },

        headerMustBeMinimized = function() {
            var viewportWidth = $(window).width();

            return (viewportWidth <= minDocumentWidth) ||
                (viewportWidth > minDocumentWidth && viewportWidth <= maxMinimizedHeaderWidth);
        },

        changeState = function(event) {
            var winScrollTop = $(window).scrollTop();

            if (!event) {
                body[headerMustBeMinimized() ? 'addClass' : 'removeClass'](minimizedHeaderModifier);
            }
            else {
                if (event.type === 'scroll') {
                    body[(headerMustBeMinimized() || winScrollTop > 0) ? 'addClass' : 'removeClass'](minimizedHeaderModifier);
                }
                else if (event.type === 'resize') {
                    if (winScrollTop > 0) {
                        return;
                    }

                    body[headerMustBeMinimized() ? 'addClass' : 'removeClass'](minimizedHeaderModifier);
                }
            }
        };

    return {
        init: function() {
            changeState();
            bind();
        },

        minimizedHeaderModifier: minimizedHeaderModifier
    }
}(AL_Header || {}, jQuery));