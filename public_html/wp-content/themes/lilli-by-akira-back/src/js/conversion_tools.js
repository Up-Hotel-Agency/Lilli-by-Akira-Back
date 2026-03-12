// set the global variables here for JSLint
/*global AOS, jQuery, objectFitImages, window, console, document, ajaxurl, setTimeout, navigator */
"use strict";

jQuery(function($){
    $(document).ready(function(){
        // exit capture
        if( $('.js-exitcapture-modal').length ) {
            if (!Cookies.get('hide-exitcapture')) {
                setTimeout(function() {
                    $('.js-exitcapture-modal').fadeIn();
                }, 500);

            } else if (Cookies.get('hide-exitcapture') && $('.js-exitcapture-modal').hasClass('aggressive-popup')) {
                setTimeout(function() {
                    $('.js-exitcapture-modal.aggressive-popup').fadeIn();
                }, 500);
            }
          
            $(".js-exitcapture-close").click(function (e) {
                e.preventDefault();
                $(".js-exitcapture-modal").fadeOut();

                if( $('.js-exitcapture-modal').hasClass('js-session-cookie') ) {
                    Cookies.set('hide-exitcapture', true);
                }
            });

            $(".js-exitcapture-modal .button").click(function () {
                
                $(".js-exitcapture-modal").fadeOut();
                Cookies.set('hide-exitcapture', true);
            });
        }

        // slide callout
        if( $('.js-slide-callout').length ) {
            if (!Cookies.get('hide-slidecallout')) {
                setTimeout(function() {
                    $('.js-slide-callout').fadeIn();
                }, 500);

            } else if (Cookies.get('hide-slidecallout') && $('.js-exitcapture-modal').hasClass('aggressive-callout')) {
                setTimeout(function() {
                    $('.js-slide-callout.aggressive-callout').fadeIn();
                }, 500);
            }
          
            $(".js-slide-callout-close").click(function (e) {
                e.preventDefault();
                $(".js-slide-callout").fadeOut();

                if( $('.js-slide-callout').hasClass('js-session-cookie') ) {
                    Cookies.set('hide-slidecallout', true);
                }
            });
        }

        // highlight bar
        if( $('.js-highlight-bar').length ) {
            if (!Cookies.get('hide-highlightbar')) {
                setTimeout(function() {
                    $('.js-highlight-bar').fadeIn();
                }, 500);

            } else if (Cookies.get('hide-highlightbar') && $('.js-highlight-bar').hasClass('aggressive-highlight-bar')) {
                setTimeout(function() {
                    $('.js-js-highlight-bar.aggressive-highlight-bar').fadeIn();
                }, 500);
            }
          
            $(".js-highlight-bar-close").click(function (e) {
                e.preventDefault();
                $(".js-highlight-bar").fadeOut();

                if( $('.js-highlight-bar').hasClass('js-session-cookie') ) {
                    Cookies.set('hide-highlightbar', true);
                }
            });
        }
    });

    function modalTimer() {
        $('.js-conversion-tools-countdown').each(function(){
            var endTime = new Date( $(this).attr('data-countdown-date') );
            endTime = (Date.parse(endTime) / 1000);

            var now = new Date();
            now = (Date.parse(now) / 1000);

            if(endTime > now){
                $(this).css('display','flex');
            }

            var timeLeft = endTime - now;

            var days = Math.floor(timeLeft / 86400); 
            var hours = Math.floor((timeLeft - (days * 86400)) / 3600);
            var minutes = Math.floor((timeLeft - (days * 86400) - (hours * 3600 )) / 60);

            if (hours < "10") { hours = "0" + hours; }
            if (minutes < "10") { minutes = "0" + minutes; }

            $(this).find(".js-conversion-tools-countdown-days").html(days + "<span class='countdown-unit'>days</span>");
            $(this).find(".js-conversion-tools-countdown-hours").html(hours + "<span class='countdown-unit'>hrs</span>");
            $(this).find(".js-conversion-tools-countdown-minutes").html(minutes + "<span class='countdown-unit'>mins</span>");
        });
    }
    
    if( $('.js-conversion-tools-countdown').length ) {
        setInterval(function() { 
            modalTimer(); 
        }, 1000);
    }
});