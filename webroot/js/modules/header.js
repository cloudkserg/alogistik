var AL_Header = (function(me, $) {

    var minimizedModifier = 'headerMinimized',
        height = 144,
        minimizedHeight = 50,
        minDocumentWidth = 1000,
        maxMinimizedHeaderWidth = 1200,
        body = $('body'),
        header = $('.header'),
        isMinimized = false,

        bind = function() {

            if (Detectizr.device.type !== 'mobile' && Detectizr.device.type !== 'tablet') {
                $(window).on('scroll', createThrottled(changeState, 100));
                $(window).on('resize', createThrottled(changeState, 250));
            }
        },

        getPhoneNumber = function() {
            return $('.call-back__phone_number').text();
        },

        createThrottled = function(fn, interval, scope) {
            var lastCallTime,
                elapsed,
                lastArgs,
                timer,
                execute = function() {
                    fn.apply(scope || this, lastArgs);
                    lastCallTime = new Date().getTime();
                };

            return function() {
                elapsed = new Date().getTime() - lastCallTime;
                lastArgs = arguments;

                clearTimeout(timer);
                if (!lastCallTime || (elapsed >= interval)) {
                    execute();
                } else {
                    timer = setTimeout(execute, interval - elapsed);
                }
            };
        },

        headerShouldBeMinimized = function() {
            var viewportWidth = $(window).width();

            return (Detectizr.device.type !== 'mobile' && Detectizr.device.type !== 'tablet') && ((viewportWidth <= minDocumentWidth) ||
                (viewportWidth > minDocumentWidth && viewportWidth <= maxMinimizedHeaderWidth));
        },

        changeState = function(event) {
            var winScrollTop = $(window).scrollTop(),
                headerShouldBeMinimizedCached = headerShouldBeMinimized();

            if (!event) {
                body[headerShouldBeMinimizedCached ? 'addClass' : 'removeClass'](minimizedModifier);
                isMinimized = headerShouldBeMinimizedCached;
            }
            else {
                if (event.type === 'scroll') {
                    body[(headerShouldBeMinimizedCached || winScrollTop > 0) ? 'addClass' : 'removeClass'](minimizedModifier);

                    isMinimized = (headerShouldBeMinimizedCached || winScrollTop > 0);
                }
                else if (event.type === 'resize') {
                    if (winScrollTop > 0) {
                        return;
                    }

                    body[headerShouldBeMinimizedCached ? 'addClass' : 'removeClass'](minimizedModifier);
                    isMinimized = headerShouldBeMinimizedCached;
                }
            }
        };

    return {
        init: function() {
            changeState();
            bind();
        },

        minimizedModifier: minimizedModifier,

        minimizedHeight: minimizedHeight,

        height: height,

        isMinimized: function() {
            return isMinimized;
        },

        getPhoneNumber: getPhoneNumber
    }
}(AL_Header || {}, jQuery));