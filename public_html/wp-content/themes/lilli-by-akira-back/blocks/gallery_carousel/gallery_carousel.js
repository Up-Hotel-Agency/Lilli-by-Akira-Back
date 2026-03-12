// set the global variables here for JSLint
/*global AOS, jQuery */
"use strict";

jQuery(function($){
    $(".js-gallery-carousel").each(function(){
        $(this).not('.slick-initialized').slick({
            arrows: false,
            infinite: true,
            adaptiveHeight: false,
            speed: 500,
            cssEase: 'cubic-bezier(0, 0, 0.04, 0.98)',
            focusOnSelect: false,
            slidesToScroll: 1,
            slidesToShow: 1,
            centerMode: true,
            variableWidth: true,
            dots: true,
            autoplay: false,
            rows: 0,
            appendDots: $(this).parents('.row').find(".gallery-dots")
        });
        var slideCount = $(this).find('.slick-slide').length;
        if (slideCount <= 1) {
            $(this).parents('.gallery-carousel-wrapper').find(".slick-controls").hide();
        }
    });

    $('.js-gallery-prev').click(function(e) {
        e.preventDefault();
        $(this).parents('.row').find('.js-gallery-carousel').slick('slickPrev');
    });
    $('.js-gallery-next').click(function(e) {
        e.preventDefault();
        $(this).parents('.row').find('.js-gallery-carousel').slick('slickNext');
    });
});