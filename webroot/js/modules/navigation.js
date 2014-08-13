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
            cache.logo.on('tap', eventHandlers.onLogoTap);
            cache.toTopBtn.on('tap', scrollToTop);
            cache.mainNavItems.on('tap', eventHandlers.onMainNavItemTap);
            cache.toFullCompanyInfoLink.on('tap', eventHandlers.onToFullCompanyInfoLinkTap);


            $(window).on('scroll', changeToTopBtnState);
            $(window).on('resize', changeToTopBtnState);
        },

        eventHandlers = {
            onLogoTap: function() {
                if ($('body').hasClass(header.minimizedHeaderModifier)) {
                    scrollToTop();
                }
            },

            onMainNavItemTap: function() {
                var navId = $(this).data('nav-id');

                scrollTo(cache.scrollspysEls.filter('[data-nav-id="' + navId + '"]').position().top - cache.header.height());
            },

            onToFullCompanyInfoLinkTap: function() {
                cache.mainNavItems.filter('[data-nav-id="contacts"]').trigger('tap');

                return false;
            }
        },

        changeToTopBtnState = function() {
            if (Modernizr.cssanimations) {
                if ($(window).scrollTop() > toTopBtnVisibilityBound) {
                    cache.toTopBtn.removeClass('hide').addClass('show');
                }
                else {
                    cache.toTopBtn.removeClass('show').addClass('hide');
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