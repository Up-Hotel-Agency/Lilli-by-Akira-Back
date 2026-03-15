// set the global variables here for JSLint
/*global AOS, jQuery, objectFitImages, window, console, document, ajaxurl, setTimeout, navigator */
"use strict";

// fixes "Does not use passive listeners to improve scrolling performance" from PageSpeed Insights
jQuery.event.special.touchstart = {
    setup: function( _, ns, handle ) {
        this.addEventListener("touchstart", handle, { 
        passive: !ns.includes("noPreventDefault") });
    }
};
jQuery.event.special.touchmove = {
    setup: function( _, ns, handle ) {
        this.addEventListener("touchmove", handle, { 
            passive: !ns.includes("noPreventDefault") 
        });
    }
};
jQuery.event.special.wheel = {
    setup: function( _, ns, handle ){
        this.addEventListener("wheel", handle, { 
            passive: true 
        });
    }
};
jQuery.event.special.mousewheel = {
    setup: function( _, ns, handle ){
        this.addEventListener("mousewheel", handle, { 
            passive: true 
        });
    }
};

// service worker for fake Progressive Web App
if (navigator.hasOwnProperty('serviceWorker')) {
    window.addEventListener('load', function() {
        navigator.serviceWorker.register('/service-worker.js')
        .then(function(registration) {
            registration.update();
        })
        .catch(function(error) {
            console.log('Registration failed with ' + error);
        });
    });
}




jQuery(function($){

    $(".bg-image-carousel").each(function(){
        $(this).not('.slick-initialized').slick({
            arrows: false,
            infinite: true,
            adaptiveHeight: false,
            speed: 600,
            cssEase: 'cubic-bezier(0, 0, 0.04, 0.98)',
            focusOnSelect: false,
            pauseOnHover: false,
            fade: true,
            slidesToShow: 1,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 4000,
            rows: 0,
            dots: false,
        });
    });

    if( $('html').hasClass('no-cssgrid') ) {
        // this is IE, load in the IE css file
        $("[data-aos^=fade][data-aos^=fade]").css("opacity", "1");
        $("[data-aos^=fade][data-aos^=fade]").css("transform", "none");
        $("[data-aos^=fade][data-aos^=fade]").css("pointer-events", "auto");
        $("head").append('<link rel="stylesheet" type="text/css" href="/wp-content/themes/lilli-by-akira-back/assets/css/ie-gte10.css" />');
    } else {
        AOS.init();
    }

    // $('p:empty').remove(); // Hack to remove WP generated empty p tags
    $('p:empty').not('[role="status"]').remove();

    // in page navigation
    $(".scroll-to").click(function(e) {
        e.preventDefault();
        var target;
        target = $(this).attr('href');
        $('html, body').animate({
            scrollTop: $(target).offset().top - 100
         });
        return false;
    });

    // scroll to next block
    $(".js-scroll-next-block").click(function(e) {
        e.preventDefault();
        var target;
        target = $(this).parents('.row').nextAll('.row');
        $('html, body').animate({
            scrollTop: $(target).offset().top - 172
        });
        return false;
    });

    // nav toggle
    $('.js-nav-toggle').click(function(e) {
        e.preventDefault();
        $(".sub-menu").removeClass("active");
        $('.js-nav-toggle').toggleClass('active');
        $('.js-menu-toggle, html, body, header').toggleClass('menu-open');
    });

   function closeBookWidget() {
        $('.js-book-widget-container').removeClass('active');
        $('html, body').removeClass('menu-open');
    }

    // OPEN
    $(document).on('click', '.js-book-widget', function(e) {
        e.preventDefault();
        e.stopPropagation(); // important

        $('.js-book-widget-container').toggleClass('active');
        $('html, body').toggleClass('menu-open');
    });


    // Prevent modal clicks closing it
    $(document).on('click', '.js-book-widget-container', function(e) {
        //e.stopPropagation();
    });

    // Click anywhere else to close
    $(document).on('click', function() {
        if ($('.js-book-widget-container').hasClass('active')) {
            closeBookWidget();
        }
    });

    // ESC key
    $(document).on('keydown', function(e) {
        if (e.key === 'Escape') {
            closeBookWidget();
        }
    });

    /*
        Nav for header 2
    */
    function header2() {
        if( $('.nav-wrap').length ) {
            if ($(window).width() > 768) {

                    console.log('tessst11');
                // nav main show children
                $(".menu-item-has-children").hover(function () {
                    $(this).parent('ul').find("> .sub-menu").removeClass("active");
                    $(this).find("> .sub-menu").addClass("active");
                });

                // Remove submenu if hovering an item without submenu
                $("#menu-main-menu > .menu-item").hover(function () {
                    if (!$(this).hasClass("menu-item-has-children")) {
                        $(".sub-menu").removeClass("active");
                    }
                });
                $("#menu-main-menu > .menu-item > .sub-menu > .menu-item ").hover(function () {
                    console.log('tessst');
                    if (!$(this).hasClass("menu-item-has-children")) {
                        $("#menu-main-menu > .menu-item > .sub-menu.active > .menu-item > .sub-menu").removeClass("active");
                    }
                });

                $(".nav-overlay").click(function() {
                    if ($('.nav-overlay').hasClass("menu-open")) {
                        $(".nav-overlay").removeClass("menu-open");
                        $(".nav-wrap").removeClass("menu-open");
                        $("body").removeClass("menu-open");
                        $('.js-nav-toggle').removeClass('active');
                        $(".sub-menu").removeClass("active");
                    }
                });

            } else {

                $(".menu-item-has-children > a").click(function(e) {
                    e.preventDefault();
                });
                
                $('.menu-item-has-children').click(function(e) {
                    e.stopPropagation(); // avoid bubbling issues

                    var $item = $(this);
                    var level = $item.parents('.sub-menu').length;
                    var levelItem = '';

                    if (level === 0) {
                        levelItem = 'top';
                    } else if (level === 1) {
                        levelItem = 'sub-item';
                    } 

                    // save levelItem for later
                    $('.js-nav-back').data('levelItem', levelItem);

                    var navSubitemText = $(this).find('a').html();
                    var navSubitemURL = $(this).find('a').attr('href');
                    if(levelItem == 'top'){
                        // First Sub Menu
                        $(".js-sub-item").html(navSubitemText);
                        $(".js-sub-item").attr("href", navSubitemURL);

                        $(this).find('> .sub-menu').addClass('active');
                    }else{
                        // Second Sub Menu
                        $('.js-nav-subitem').append('<div class="js-nav-separation">/</div>');
                        var clone = $('.js-nav-subitem a').clone();
                        $('.js-nav-subitem').append(clone);
                        $(".js-sub-item:nth-of-type(2)").html(navSubitemText);
                        $(".js-sub-item:nth-of-type(2)").attr("href", navSubitemURL);
                        $(this).find('> .sub-menu').addClass('active');
                    }

                    $('.js-nav-back').addClass('active');
                    $('.js-nav-subitem').addClass('active');
                    $('.js-nav-toggle').addClass('subnav-open');
                });

                $('.js-nav-back').click(function(e) {
                    e.preventDefault();
                    var levelItem = $(this).data('levelItem');
                    if(levelItem == 'top'){
                        // Close Top Menu

                        $(this).removeClass('active');
                        $('.sub-menu').removeClass('active');
                        $('.js-nav-subitem').removeClass('active');
                        $('.js-nav-toggle').removeClass('subnav-open');
                    }else{
                        // Close Sub Menu
                        $('#menu-main-menu .sub-menu .sub-menu').removeClass('active');
                        $(".js-nav-separation").remove();
                        $(".js-sub-item:nth-of-type(2)").remove();
                        $('.js-nav-back').data('levelItem', 'top');
                    }
                    // $(this).removeClass('active');
                    // $('.sub-menu').removeClass('active');
                    // $('.js-nav-subitem').removeClass('active');
                    // $('.js-nav-toggle').removeClass('subnav-open');
                });

                $('.js-nav-toggle').click(function(e) {
                    // always reset the subnav when opening / closing the nav
                    $('.nav-wrap .js-nav-subitem').removeClass('active');
                    $('.nav-wrap .nav-back').removeClass('active');
                    $('.nav-wrap .sub-menu').removeClass('active');
                    $('.js-nav-toggle').removeClass('subnav-open');
                });
                
            };
        }
    }
    header2();

    $(window).resize(function() {
        header2();
    });

    /*
        Footer 2 mobile menu toggles
    */
    $('.js-mob-footer-menu-toggle').click(function() {
        if ($(window).width() < 641) {
            $(this).toggleClass('active');
            $(this).parents('.footer-menu').find('.js-footer-menu').slideToggle();
        }
    });

    /*
        Nav for header 3
    */
    function header3() {
        if( $('.header-with-dropdowns').length ) {
            if ($(window).width() > 768) {

                $("#menu-main-menu > .menu-item-has-children > .sub-menu > .menu-item-has-children").hover(function(e) {
                    e.preventDefault();
                    console.log('test');
                });
                // nav main show children
                $("#menu-main-menu > .menu-item-has-children").hover(function() {
                    $(this).find('> .sub-menu').addClass('active');
                },
                function() {
                    $(this).find('> .sub-menu').removeClass('active');
                });



            } else {

                $(".menu-item-has-children > a").click(function(e) {
                    if( !$(this).parent().hasClass('active') ) {
                        // if the li is not open then let's stop the link
                        e.preventDefault();
                        // first time, add class to main menu to make all other top level links fade out
                        $(this).parents('.menu-wrapper').addClass('submenu-active')
                    }
                });
                
                $('.menu-item-has-children').click(function() {
                    if( !$(this).hasClass('active') ) {
                        // if this is not already open, close all others
                        $('.menu-item-has-children').removeClass('active');
                    }
                    $(this).addClass('active');
                });
                
            }
        }
    }
    header3();

    $(window).resize(function() {
        header3();
    });

    // if input has content, add class
    $('.input-wrap input, .input-wrap textarea').each(function(){
        if( !$(this).parents('.input-wrap').hasClass('label-locked') ) {
            $(this).blur(function(){
                var tmpval;
                tmpval = $(this).val();
                if(tmpval === '') {
                    $(this).parents('.input-wrap').removeClass('label-active');
                } else {
                    $(this).parents('.input-wrap').addClass('label-active');
                }
            });
        }
    });
    

    // Add dropdown parent element around selects
    $( "select" ).not('.block-editor select').wrap( "<div class='dropdown'></div>" );

    // Add active state to wrapping input label when input is active
    $("input, textarea").on('focusin',
    function(){
        $(this).parent().addClass('active');
    }).on('focusout', function(){
        $(this).parent().removeClass('active');
    });

    //Add active state to dropdown select wrapping labels when active
    $('select').click(function(){
        $(this).closest("label").addClass('active');
    });

    $('select').blur(function() {
        $(this).closest("label").removeClass('active');
    });

    // init fancybox, just add data-fancybox to element
    $("[data-fancybox]").fancybox({
        smallBtn : false
    });

    // custom modal trigger
    $('.custom-modal-trigger').click(function(e) {
        e.preventDefault();
        $('body').addClass('menu-open');
        var modal = $(this).attr('data-modal');
        $('.custom-modal.' + modal).addClass('active');
    });

    $('.js-modal-close').click(function(e) {
        e.preventDefault();
        $('body').removeClass('modal-open');
        $('.js-gallery-modal, .js-single-modal').removeClass('active');
        window.location.hash="";
        $(this).parents('.js-gallery-modal, .js-single-modal').find('.js-gallery-modal-slider').slick('unslick');
    });

    $(document).keyup(function(e) {
        if (e.keyCode === 27) { // escape key
            $('html, body, header, .js-menu-toggle').removeClass('menu-open');
            $('body').removeClass('modal-open');
            $('.js-nav-toggle, .js-mob-nav-toggle, .single-modal, .gallery-modal, .custom-modal').removeClass('active');
        }
    });

    // modal
    $('.modal-trigger').click(function(){
        var $modalSrc;
        $modalSrc = $(this).parents('.modal-trigger-wrap').find(".modal-target").html();
        $.fancybox.open({
            buttons : ['close'],
            content : $modalSrc,
            opts : {
                smallBtn : false
            }
        });
        return false;
    });

    // single modal trigger
    $('.js-single-modal-trigger').click(function(e) {
        e.preventDefault();
        var gallery = $(this).attr('data-modal');
        $('.js-single-modal.' + gallery).addClass('active');
        $('body').addClass('modal-open');

        // room modal carousel
        var $imgconSlick = $('.js-single-modal.' + gallery + ' .js-single-modal-slider');
        var $imgconDots = $('.js-single-modal.' + gallery + ' .rooms-dots');
        if( !$imgconSlick.hasClass('slick-initialized') ) {
            $imgconSlick.slick({
                arrows: false,
                infinite: true,
                adaptiveHeight: false,
                speed: 300,
                cssEase: 'cubic-bezier(0, 0, 0.04, 0.98)',
                focusOnSelect: false,
                pauseOnHover: false,
                fade: true,
                slidesToShow: 1,
                slidesToScroll: 1,
                autoplay: false,
                rows: 0,
                dots: true,
                appendDots: $imgconDots
            });
        }
        $('.js-single-modal-next').click(function() {
            $(this).parents('.js-single-modal').find('.js-single-modal-slider').slick('slickNext');
        });
        $('.js-single-modal-prev').click(function() {
            $(this).parents('.js-single-modal').find('.js-single-modal-slider').slick('slickPrev');
        });
    });

    // when you load one of the singles themselves
    if( $('body').hasClass('single') ) {
        // room modal carousel
        var $imgconSlick = $('.js-single-modal-slider');
        var $imgconDots = $('.rooms-dots');
        if( !$imgconSlick.hasClass('slick-initialized') ) {
            $imgconSlick.slick({
                arrows: false,
                infinite: true,
                adaptiveHeight: false,
                speed: 300,
                cssEase: 'cubic-bezier(0, 0, 0.04, 0.98)',
                focusOnSelect: false,
                pauseOnHover: false,
                fade: true,
                slidesToShow: 1,
                slidesToScroll: 1,
                autoplay: false,
                rows: 0,
                dots: true,
                appendDots: $imgconDots
            });
        }
        $('.js-single-modal-next').click(function() {
            $('.js-single-modal-slider').slick('slickNext');
        });
        $('.js-single-modal-prev').click(function() {
            $('.js-single-modal-slider').slick('slickPrev');
        });
    }

    // cats nav
    function catNav() {
        $(document).on('click', '.js-category-nav a', function(e) {
            e.preventDefault();
            var $el = $(this);
            var cat = $(this).attr('data-cat');
            $(this).closest('.js-category-nav').find('a').removeClass('active');
            $(this).addClass('active');
            if ( cat !== 'all' ) {
                $(this).closest('.js-category-filter-group').find('.js-category-target:first').parent().find('> .js-category-target').addClass('fade-out');
                setTimeout(function() {
                    $el.closest('.js-category-filter-group').find('.js-category-target:first').parent().find('> .js-category-target').addClass('filtered');
                    $el.closest('.js-category-filter-group').find('.js-category-target:first').parent().find('> .js-category-target.' + cat).removeClass('filtered');
                }, 300);
                setTimeout(function() {
                    $el.closest('.js-category-filter-group').find('.js-category-target:first').parent().find('> .js-category-target.' + cat).removeClass('fade-out');
                }, 600);
            } else {
                $(this).closest('.js-category-filter-group').find('.js-category-target:first').parent().find('> .js-category-target').addClass('fade-out');
                setTimeout(function() {
                    $el.closest('.js-category-filter-group').find('.js-category-target:first').parent().find('> .js-category-target').addClass('filtered');
                    $el.closest('.js-category-filter-group').find('.js-category-target:first').parent().find('> .js-category-target').removeClass('filtered');
                }, 300);
                setTimeout(function() {
                    $el.closest('.js-category-filter-group').find('.js-category-target:first').parent().find('> .js-category-target').removeClass('fade-out');
                }, 600);
            }
            AOS.refresh();
        });

        // dropdown cats nav
        $('.js-dropdown-cat-nav').on('change', function() {
            var $el;
            $el = $(this);
            var cat = $(this).val();
            if ( cat !== 'all' ) {
                $(this).closest('.category-filter-group').find('.js-category-target:first').parent().find('> .category-target').addClass('fade-out');
                setTimeout(function() {
                    $el.closest('.category-filter-group').find('.js-category-target:first').parent().find('> .category-target').addClass('filtered');
                    $el.closest('.category-filter-group').find('.js-category-target:first').parent().find('> .category-target.' + cat).removeClass('filtered');
                }, 300);
                setTimeout(function() {
                    $el.closest('.category-filter-group').find('.js-category-target:first').parent().find('> .category-target.' + cat).removeClass('fade-out');
                }, 600);
            } else {
                $(this).closest('.category-filter-group').find('.js-category-target:first').parent().find('> .category-target').addClass('fade-out');
                setTimeout(function() {
                    $el.closest('.category-filter-group').find('.js-category-target:first').parent().find('> .category-target').addClass('filtered');
                    $el.closest('.category-filter-group').find('.js-category-target:first').parent().find('> .category-target').removeClass('filtered');
                }, 300);
                setTimeout(function() {
                    $el.closest('.category-filter-group').find('.js-category-target:first').parent().find('> .category-target').removeClass('fade-out');
                }, 600);
            }
            AOS.refresh();
        });
    }
    catNav();

    $(".back-to-top").click(function(e) {
        e.preventDefault();
        $("html, body").animate({ scrollTop: 0 });
        return false;
    });

    $(".go-to-link").change(function() {
        var address = $(this).val();
        window.location.replace(address);
    });


    // ajax load more posts
    var post_offset = $('#loadmore').data('posts-per-page');
    $('#loadmore').click(function () {
        var $el = $(this);

        if ($el.hasClass("disabled")) {
            return false;
        }

        $.ajax({
            url: ajaxurl,
            data: {
                action: 'get_more',
                offset: post_offset
            },
            success: function (data) {
                if (data) {
                    $('.js-post-ajax').append(data);
                    AOS.refresh();

                    // increment AFTER success
                    post_offset += $el.data('posts-per-page');

                    if (post_offset >= $el.data('count-posts')) {
                        $el.hide();
                    }
                } else {
                    $el.hide();
                }
            }
        });

        return false;
    });


   
    /*
    Title: AJAX modal call & handling functions 
    Desc: Calls main theme ajax modal located in website footer /templates/ajax-modal.php
    Requires: attr "data-type" & attr "data-id"
    */

    //Data Request 
    $(document).on('click', '.js-single-modal-trigger-ajax', function () {
        var $btn = $(this);
        var post_type = $btn.data('type');
        var post_id = $btn.data('id');

        if (!post_type || !post_id) return;

        // Disable button to prevent multiple clicks
        $btn.addClass('disabled');

        // Show spinner
        $('.js-single-modal-ajax .single-modal-inner').html('<div class="spinner"></div>');
        $('.js-single-modal-ajax').addClass('active');

        // Make AJAX request
        $.ajax({
            url: ajaxurl,
            data: {
                action: 'get_' + post_type + '_modal',
                id: post_id
            },
            success: function (data) {
                if (data) {
                    // Replace spinner with actual content
                    $('.js-single-modal-ajax .single-modal-inner').html(data);
                    AOS.refresh();
                }
            },
            complete: function () {
                // Re-enable button
                $btn.removeClass('disabled');
            }
        });

        return false;
    });

    //Close Modal & Reset 
    $('.js-modal-close-ajax').click(function(e) {
        e.preventDefault();
        $(this).parents('.js-single-modal-ajax').removeClass('active');
        $(this).parent('.js-single-modal-ajax').find('.single-modal-inner').html("");

    });

    $(".js-image-carousel").each(function() {
        var slides = $(this).find('img');
        var $slide = $(this).parent();
        
        if(slides.length > 1) {
            $('.js-image-carousel').slick('slickSetOption', 'dots', true, true);
        } else {
            slides.attr('aria-hidden', true);
        }
        if ($slide.attr('aria-describedby') != undefined) {
            $(this).attr('id', $slide.attr('aria-describedby'));
        }
    });


    // change header on scroll
    function headerScroll(){
        $(window).scroll(function(){
            var scrollTop = $(window).scrollTop();
            if (scrollTop > 500) {
                $('.js-header-switch-theme').addClass('scrolled');
                $('.js-header-switch-theme').removeClass('theme--image');
                $('.js-header-switch-theme').addClass('theme--default');
            } else {
                $('.js-header-switch-theme').removeClass('scrolled');
                $('.js-header-switch-theme').removeClass('theme--default');
                $('.js-header-switch-theme').addClass('theme--image');
            }
        });
    }
    headerScroll();
    $(document).scroll(function() {
        headerScroll();
    });
    $(window).resize(function() {
        headerScroll();
    });

    //Add target: "_blank" to external links 
    $(window).ready(function() {
        $('a').filter(function() {
         return this.hostname && this.hostname.replace(/^www\./, '') !== location.hostname.replace(/^www\./, '');
        }).each(function() {
              $(this).attr({
                  target: "_blank",
                  rel: "noopener"
              });
          });
      });

    //   Search Bar

    if( $('.search-bar').length ) {
        $(".searchinput").on("input", function() {
            if ($(this).val().trim() !== "") {
                $('.search-bar').addClass('filled');
            }
        });
        $('.remove-search').click(function(e) {
            e.preventDefault();
            $('.search-bar').removeClass('filled');
            $(".searchinput").val("");
            $('.search-bar').removeClass('active');
        });

         $('.searchinput').each(function() {
            const $input = $(this);

            function toggleActiveClass() {
            if ($input.is(':focus-visible') || $input.val().trim() !== '') {
                $input.parents('.search-bar').addClass('active');
            } else {
                $input.parents('.search-bar').removeClass('active');
            }
            }

            // Run once in case the input is pre-filled
            toggleActiveClass();

            // Update class on events
            $input.on('focus blur input', toggleActiveClass);
        });
    }
});

function slick_load(){

    //Media JS Function for sliders
    $(".js-image-carousel").each(function(){
        $(this).not('.slick-initialized').slick({
            arrows: false,
            infinite: true,
            adaptiveHeight: false,
            speed: 600,
            cssEase: 'cubic-bezier(0, 0, 0.04, 0.98)',
            focusOnSelect: false,
            pauseOnHover: false,
            fade: true,
            slidesToShow: 1,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 5000,
            rows: 0,
            dots: false,
            appendDots: $(this).parent().find('.img-content-dots')
        });
    });

    if($('.banner-block.theme--image').length){
        $('.banner-block .js-image-carousel').on('beforeChange', function(event, slick, currentSlide, nextSlide){
            $(this).find('[data-slick-index='+nextSlide+']').addClass('animation-active');
            var target = $(this);
            setTimeout(function(){
                    $(target).find('[data-slick-index='+currentSlide+']').removeClass('animation-active');
                }, 2000, target);
        });
    }

    $('.js-img-next').click(function(e) {
        e.preventDefault();
        $(this).parent().parent().find('.media-container').slick('slickNext');
    });
    $('.js-img-prev').click(function(e) {
        e.preventDefault();
        $(this).parent().parent().find('.media-container').slick('slickPrev');
    });

}

slick_load();

function initializeVimeoPlayers() {
    var elements = document.querySelectorAll('.vimeo-player:not(.vimeo-player-initialized)');
    for (var i = 0; i < elements.length; i++) {
        var element = elements[i];
        element.classList.add('vimeo-player-initialized');
        new Vimeo.Player(element);
    }
}

initializeVimeoPlayers();
