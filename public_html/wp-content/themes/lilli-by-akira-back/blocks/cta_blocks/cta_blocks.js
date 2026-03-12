// set the global variables here for JSLint
/*global AOS, jQuery */
"use strict";

jQuery(function($){
    $(".js-cta-blocks").each(function(){

        var cta = $(this);

        $(cta).not('.slick-initialized').slick({
            arrows: false,
            infinite: true,
            adaptiveHeight: false,
            speed: 500,
            cssEase: 'cubic-bezier(0, 0, 0.04, 0.98)',
            focusOnSelect: false,
            slidesToScroll: 1,
            slidesToShow: 3,
            variableWidth: true,
            dots: false,
            autoplay: false,
            rows: 0,
        });

    });

    $('.js-cta-prev').click(function(e) {
        e.preventDefault();
        $(this).parents('.row').find('.js-cta-blocks').slick('slickPrev');
    });
    $('.js-cta-next').click(function(e) {
        e.preventDefault();
        $(this).parents('.row').find('.js-cta-blocks').slick('slickNext');
    });
});