var AL_Navigation = (function(me, $) {

    var toTopBtnVisibilityBound = 500,

        cache = {
            header: $('.header'),
            scrollspysEls: $('.js-scrollspy'),
            toTopBtn: $('.to-top-btn'),
            logo: $('.logo'),
            mainNavItems:  $('.main-nav__list_item'),
            toFullCompanyInfoLink: $('.short-company-info__link_to_full_info')
        },

        bind = function() {
            cache.logo.on('click', eventHandlers.onLogoClick);
            cache.toTopBtn.on('click', scrollToTop);
            cache.mainNavItems.on('click', eventHandlers.onMainNavItemClick);
            cache.toFullCompanyInfoLink.on('click', eventHandlers.onToFullCompanyInfoLinkClick);


            $(window).on('scroll', changeToTopBtnState);
            $(window).on('resize', changeToTopBtnState);
        },

        eventHandlers = {
            onLogoClick: function() {
                if ($('body').hasClass(AL_Header.minimizedHeaderModifier)) {
                    scrollToTop();
                }
            },

            onMainNavItemClick: function() {
                var navId = $(this).data('nav-id');

                scrollTo(cache.scrollspysEls.filter('[data-nav-id="' + navId + '"]').position().top - cache.header.height());
            },

            onToFullCompanyInfoLinkClick: function() {
                cache.mainNavItems.filter('[data-nav-id="contacts"]').trigger('click');

                return false;
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
                        return cache.header.height() + 10;
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
        };

    return {
        init: function() {
            initWayPoints();
            bind();
            changeToTopBtnState();
        }
    }
}(AL_Navigation || {}, jQuery));