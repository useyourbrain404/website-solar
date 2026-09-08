/**
 * AK Energies - Usability & Responsive Navigation Enhancement Script
 */
(function ($) {
    'use strict';

    $(document).ready(function () {
        var $header = $('header');
        var $menuBtn = $('#menu-btn');
        var $mainMenu = $('#mainmenu');
        var $headerColMid = $('.header-col-mid');

        // Robust Mobile Menu Toggle with immediate event isolation
        $menuBtn.off('click').on('click', function (e) {
            e.preventDefault();
            e.stopPropagation();
            e.stopImmediatePropagation();

            var isOpen = $header.hasClass('menu-open') || $mainMenu.hasClass('mobile-open');

            if (isOpen) {
                $header.removeClass('menu-open');
                $menuBtn.removeClass('menu-open').attr('aria-expanded', 'false');
                $mainMenu.removeClass('mobile-open');
                $headerColMid.removeClass('open');
            } else {
                $header.addClass('menu-open');
                $menuBtn.addClass('menu-open').attr('aria-expanded', 'true');
                $mainMenu.addClass('mobile-open');
                $headerColMid.addClass('open');
            }
        });

        // Close menu when clicking on any nav link on mobile
        $('#mainmenu a').on('click', function () {
            if ($(window).width() <= 991) {
                $header.removeClass('menu-open');
                $menuBtn.removeClass('menu-open').attr('aria-expanded', 'false');
                $mainMenu.removeClass('mobile-open');
                $headerColMid.removeClass('open');
            }
        });

        // Close mobile menu when clicking outside
        $(document).on('click touchstart', function (e) {
            if ($(window).width() <= 991 && ($header.hasClass('menu-open') || $mainMenu.hasClass('mobile-open'))) {
                if (!$(e.target).closest('header, #menu-btn, #mainmenu, .header-col-mid').length) {
                    $header.removeClass('menu-open');
                    $menuBtn.removeClass('menu-open').attr('aria-expanded', 'false');
                    $mainMenu.removeClass('mobile-open');
                    $headerColMid.removeClass('open');
                }
            }
        });

        // Smooth header scroll class: transparent at top, green background on scroll
        var scrollTicking = false;
        function updateHeaderScroll() {
            var scrollPos = $(window).scrollTop();
            if (scrollPos > 5) {
                $header.addClass('ak-header-scrolled');
            } else {
                $header.removeClass('ak-header-scrolled');
            }
            scrollTicking = false;
        }

        function handleHeaderScroll() {
            if (!scrollTicking) {
                requestAnimationFrame(updateHeaderScroll);
                scrollTicking = true;
            }
        }
        $(window).on('scroll.akHeader', handleHeaderScroll);
        updateHeaderScroll();

        // Drawer Toggle, Scroll Lock & Overlay Containment
        $('#btn-extra, #btn-cart').off('click.akDrawer').on('click.akDrawer', function (e) {
            e.preventDefault();
            $('#extra-content').removeClass('wow').css({'visibility': 'visible', 'opacity': '1'});
            $('#extra-wrap, #extra-overlay').addClass('open');
            $('body').addClass('drawer-open');
        });

        $('#btn-close, #extra-overlay').off('click.akDrawer').on('click.akDrawer', function (e) {
            e.preventDefault();
            $('#extra-wrap, #extra-overlay').removeClass('open');
            $('body').removeClass('drawer-open');
        });

        // Click outside drawer to close
        $(document).on('mousedown.akDrawer touchstart.akDrawer', function (e) {
            if ($('#extra-wrap').hasClass('open')) {
                if (!$(e.target).closest('#extra-wrap, #btn-extra, #btn-cart').length) {
                    $('#extra-wrap, #extra-overlay').removeClass('open');
                    $('body').removeClass('drawer-open');
                }
            }
        });

        // Ensure wheel events over the drawer smoothly scroll the drawer itself
        $('#extra-wrap').on('wheel.akDrawer', function (e) {
            e.stopPropagation();
        });

        // Accessible Keyboard Escape to close drawers & menus
        $(document).on('keydown', function (e) {
            if (e.key === 'Escape' || e.keyCode === 27) {
                if ($('#extra-wrap').hasClass('open')) {
                    $('#extra-wrap, #extra-overlay').removeClass('open');
                    $('body').removeClass('drawer-open');
                }
                if ($header.hasClass('menu-open')) {
                    $header.removeClass('menu-open');
                    $menuBtn.removeClass('menu-open').attr('aria-expanded', 'false');
                }
            }
        });

        // --------------------------------------------------------------------------
        // Projects Carousel Auto-Slide (Mobile & Desktop)
        // --------------------------------------------------------------------------
        var $projectsCarousel = $('#projects-carousel');
        if ($projectsCarousel.length) {
            // Trigger auto-slide playback (3.5s interval)
            setTimeout(function () {
                $projectsCarousel.trigger('play.owl.autoplay', [3500]);
            }, 500);

            // Re-arm autoplay on mobile touch/drag completion
            $projectsCarousel.on('dragged.owl.carousel translated.owl.carousel touchend touchcancel', function () {
                $projectsCarousel.trigger('play.owl.autoplay', [3500]);
            });
        }
    });
})(jQuery);
