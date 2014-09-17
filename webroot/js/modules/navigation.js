var AL_Navigation = (function(me, $) {

    var toTopBtnVisibilityBound = 500,

        cache = {
            body: $('bosy'),
            header: $('.header'),
            scrollspysEls: $('.js-scrollspy'),
            scrollToTopEls: $('.js-scrollToTop'),
            toTopBtn: $('.to-top-btn'),
            logo: $('.logo'),
            mainNavItems:  $('.main-nav__list_item'),
            toFullCompanyInfoLink: $('.short-company-info__link_to_full_info'),
            toMapLink: $('.short-company-info__address')
        },

        bind = function() {
            cache.logo.on('tap', eventHandlers.onLogoClick);
            cache.scrollToTopEls.on('tap', scrollToTop);
            cache.mainNavItems.on('tap', eventHandlers.onMainNavItemClick);
            cache.toFullCompanyInfoLink.on('tap', eventHandlers.onToFullCompanyInfoLinkClick);
            cache.toMapLink.on('tap', eventHandlers.toMapLinkClick);


            $(window).on('scroll', changeToTopBtnState);
            $(window).on('resize', changeToTopBtnState);
        },

        eventHandlers = {
            onLogoClick: function() {
                if (AL_Header.isMinimized()) {
                    scrollToTop();
                }
            },

            onMainNavItemClick: function() {
                var navId = $(this).data('nav-id');

                scrollTo(cache.scrollspysEls.filter('[data-nav-id="' + navId + '"]').position().top);
            },

            onToFullCompanyInfoLinkClick: function() {
                navigateTo('contacts');

                return false;
            },

            toMapLinkClick: function() {
                if (AL_Header.isMinimized()) {
                    navigateTo('contacts');
                }
            }
        },

        changeToTopBtnState = function() {
            if (Modernizr.cssanimations) {
                if ($(window).scrollTop() > toTopBtnVisibilityBound) {
                    cache.toTopBtn.removeClass('hidden').addClass('visible');
                }
                else {
                    cache.toTopBtn.removeClass('visible').addClass('hidden');
                }
            }
            else {
                cache.toTopBtn['fade' + ($(window).scrollTop() > toTopBtnVisibilityBound ? 'In' : 'Out')]();
            }
        },

        initWayPoints = function() {
            cache.scrollspysEls.waypoint(function(direction) {
                    var $this = $(this),
                        navId = ((direction === 'down') ? $this : $this.waypoint('prev')).data('nav-id'),
                        navEl = cache.mainNavItems.filter('[data-nav-id="' + navId + '"]');

                    navEl.siblings().removeClass('active');
                    navEl.addClass('active');
                },
                {
                    offset: function() {
                        return (Detectizr.device.type !== 'mobile') ? (AL_Header.isMinimized() ? AL_Header.minimizedHeight + 5 : AL_Header.height + 5) : 5;
                    }
                });
        },

        scrollTo = function(top, duration) {
            top = top || 0;
            duration = duration || 300;

            $('html, body').animate({
                scrollTop: top
            }, duration);
        },

        scrollToTop = function() {
            scrollTo();
        },

        navigateTo = function(dataNavId) {
            cache.mainNavItems.filter('[data-nav-id="' + dataNavId + '"]').trigger('tap');
        };

    return {
        init: function() {
            initWayPoints();
            bind();
            changeToTopBtnState();
        },

        navigateTo: navigateTo
    }
}(AL_Navigation || {}, jQuery));