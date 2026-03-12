// set the global variables here for JSLint
/*global AOS, jQuery */
"use strict";

jQuery(function($){
    $('.js-booking-mask').submit(function(e) {
        // generic code to be modified
        e.preventDefault();
        var arrivalDate = $(this).find('input[name="arrival"]').val();
        var departureDate = $(this).find('input[name="departure"]').val();
        var arrival = dayjs(arrivalDate).format('YYYY-MM-DD');
        var departure = dayjs(departureDate).format('YYYY-MM-DD');
        var rooms = $(this).find('input[name="rooms"]').val();
        var adults = $(this).find('input[name="adults"]').val();
        var children = $(this).find('input[name="children"]').val();
        // var propertyId = $(this).find('.js-location-selector-up').val();

        window.localStorage.setItem('bookingMaskData', JSON.stringify({
            arrival,
            departure,
            rooms,
            adults,
            children
        }));
        
        // go to your IBE
        // parent.open("/book/#/booking/results?propertyId="+ propertyId +"&arrival=" + arrival + "&departure=" + departure + "&rooms=" + rooms + "&adults=" + adults + "&children=" + children);
    });

    $(".js-datepicker-trigger").flatpickr({
        mode: "range",
        minDate: "today",
        showMonths: "2",
        locale: {
            firstDayOfWeek: 1
        },
        onClose: function(selectedDates) {
            var startDate = selectedDates[0];
            var endDate = selectedDates[1];
            $('.js-check-in-display').html( dayjs(startDate).format('ddd D MMM') );
            $('.js-check-out-display').html( dayjs(endDate).format('ddd D MMM') );

            $('.js-arrive-input').val( dayjs(startDate).format('YYYY-MM-DD') );
            $('.js-departure-input').val( dayjs(endDate).format('YYYY-MM-DD') );
        }
    });

    $('.js-arrive-input').change(function(){
        // get new selected date
        var checkInDate = new Date($(this).val());
        // figure out check out date (the next day)
        var checkOutDate = dayjs(checkInDate).add(1, 'day').format('YYYY-MM-DD');
        // update departure date input
        $(this).parents('form').find('input[name="departure"]').val(checkOutDate);
        // set the depart date input min date
        $(this).parents('form').find('input[name="departure"]').attr({
            'min' : dayjs(checkOutDate).format('YYYY-MM-DD')
        });
        // update text on the labels
        $(this).parents('form').find('.js-check-in-display').html(dayjs(checkInDate).format('ddd D MMM'));
        $(this).parents('form').find('.js-check-out-display').html(dayjs(checkOutDate).format('ddd D MMM'));
    });
    $('.js-departure-input').change(function(){
        // get new departure date
        var checkOutDate = new Date(this.value);
        // update the hidden depart input
        $(this).parents('form').find('input[name="departure"]').val(dayjs(checkOutDate).format('YYYY-MM-DD'));
        $(this).parents('form').find('input[name="departure"]').focus();
        // update text on the label
        $(this).parents('form').find('.js-check-out-display').html(dayjs(checkOutDate).format('ddd D MMM'));
    });
    $('.native-depart').change(function(){
        // get new departure date
        var checkOutDate = new Date(this.value);
        // update the hidden depart input
        $(this).parents('form').find('input[name="departure"]').val(dayjs(checkOutDate).format('YYYY-MM-DD'));
        $(this).parents('form').find('input[name="departure"]').focus();
        // update text on the label
        $(this).parents('form').find('.js-check-out-display').html(dayjs(checkOutDate).format('ddd D MMM'));
    });
    
    // booking widget inc / dec buttons
    $('.selector-control').on('click', function(e) {
        e.preventDefault();
        var $button = $(this);
        var max = $button.parents('.selector-wrap').attr('data-max');
        var min = $button.parents('.selector-wrap').attr('data-min');
        var oldValue = $button.parents('.selector-wrap').find('.selector-value').text();
        oldValue = parseInt(oldValue);
        var noless = Number(min) + Number(1);
        var nomore = Number(max) - Number(1);

        // update the input and update mini display
        if ($button.hasClass('plus')) {
            // + clicked
            // make sure min button is not disabled
            if (!oldValue >= max) {
                newVal = oldValue;
            } else if(oldValue < max) {
                // make sure - is reactivated
                $button.parents('.selector-wrap').find('.minus').removeClass('disabled');
                var newVal = parseFloat(oldValue) + 1;
            } else {
                newVal = max;
            }
            // the next click will reach the min so disable the max button
            if ( oldValue == nomore ) {
                $button.parents('.selector-wrap').find('.plus').addClass('disabled');
            }
        } else {
            // - clicked
            // Don't allow decrementing below zero
            if (oldValue > min) {
                // minus has been clicked and it can be decreased, make sure min button is not disabled
                var newVal = parseFloat(oldValue) - 1;
                $button.parents('.selector-wrap').find('.plus').removeClass('disabled');
            } else {
                // already reached the min, don't do anything
                newVal = min;
            }
            // the next click will reach the min so disable the min button
            if ( oldValue == noless ) {
                $button.parents('.selector-wrap').find('.minus').addClass('disabled');
            }
        }
        $button.parents('.selector-wrap').find('.selector-value').text(newVal);
        $button.parents('.selector-wrap').find('input').val(newVal);

        var rooms = $button.parents('.select-inner').find('input[name="rooms"]').val();
        var adults = $button.parents('.select-inner').find('input[name="adults"]').val();
        var children = $button.parents('.select-inner').find('input[name="children"]').val();

        // update the main display on the booking mask (this one only)
        // rooms
        var roomsSum = 0;
        var roomsCount = $button.parents('form').find('.js-count-rooms');
        roomsCount.each(function(){
            rooms = $(this).val();
            roomsSum = +roomsSum + +rooms;
        });
        if(roomsSum > 1) {
            $(".js-rooms-display").text(roomsSum + ' Rooms');
        } else {
            $(".js-rooms-display").text(roomsSum + ' Room');
        }
        // adults
        var adultsSum = 0;
        var adultsCount = $button.parents('form').find('.js-count-adults');
        adultsCount.each(function(){
            adults = $(this).val();
            adultsSum = +adultsSum + +adults;
        });
        if(adultsSum > 1) {
            $(".js-adults-display").text(adultsSum + ' Adults');
        } else {
            $(".js-adults-display").text(adultsSum + ' Adult');
        }
        // children
        var childSum = 0;
        var roomCount = $button.parents('form').find('.js-count-children');
        roomCount.each(function(){
            children = $(this).val();
            childSum = +childSum + +children;
        });
        if(childSum > 1 || childSum === 0) {
            $(".js-children-display").text(childSum + ' Children');
        } else {
            $(".js-children-display").text(childSum + ' Child');
        }

        // Multi Room 
        const $mask = $button.closest('.booking-mask');
        let totalAdults = 0;
        $mask.find('.js-count-adults').each(function () {
            totalAdults += +$(this).val();
        });

        let totalChildren = 0;
        $mask.find('.js-count-children').each(function () {
            totalChildren += +$(this).val();
        });

        const totalGuests = totalAdults + totalChildren;

        // Display total guests
        $mask.find('.js-guests-display').text(totalGuests + (totalGuests > 1 ? ' Guests' : ' Guest'));

        // Update hidden fields
        $mask.find('input[name="totaladults"]').val(totalAdults);
        $mask.find('input[name="totalchildren"]').val(totalChildren);
    });

    // rooms / guests selector on booking form
    $('.js-rooms-guests-trigger, .rooms-guests-close').on('click', function (e) {
        e.preventDefault();
        const $form = $(this).closest('form');
        $form.find('.rooms-guests-select').toggleClass('active');
    });

    // click outside
    $(document).on('click', function (e) {
        $('.rooms-guests-select.active').each(function () {
            const $select = $(this);
            const $form = $select.closest('form');

            const clickedInsideSelect = $(e.target).closest('.rooms-guests-select').length;
            const clickedTrigger = $(e.target).closest('.js-rooms-guests-trigger').length;

            if (!clickedInsideSelect && !clickedTrigger) {
                $select.removeClass('active');
            }
        });
    });

    // ESC key closes all open selectors
    $(document).on('keyup', function (e) {
        if (e.key === 'Escape' || e.keyCode === 27) {
            $('.rooms-guests-select').removeClass('active');
        }
    });


    // MULTI ROOM
    $('.add-room').on('click', function (e) {
        e.preventDefault();

        const $mask = $(this).closest('.booking-mask');

        // Cloning the Room line
  
        var rooms = $mask.find('.room').length;
        if (rooms < 4) {
            const newRoom = $mask.find(".room:first").clone(true, true);
            // Reset adult and child counters
            newRoom.find('.js-count-adults').val(1);
            newRoom.find('.js-count-children').val(0);
            newRoom.find('.selector-value').each(function () {
                const $el = $(this);
                if ($el.closest('.selector-wrap').find('.js-count-adults').length) {
                    $el.text(1); 
                } else {
                    $el.text(0);
                }
            });

            // Reset and hide child age selectors
            newRoom.find('.child-age-select').val('');
            newRoom.find('.child-age').hide();
            newRoom.find('.js-age-selectors').hide();
            newRoom.find('.selector-control.plus').removeClass('disabled');


            // Append the cleaned-up clone
            $mask.find(".room-selector").append(newRoom);
        }


        // Disable "add more" button if there are 4 rooms selected
        var totalRooms = $mask.find('.room').length;
        if (totalRooms == 4) {
            $(this).addClass("disabled");
        } else {
            $(this).removeClass("disabled");
        }

        // Disable "remove" button if more than 1 room
        if (totalRooms > 1) {
            $mask.find('.remove-room').removeClass("disabled");
        } else {
            $mask.find('.remove-room').addClass("disabled");
        }

        // Update room numbers
        let roomsNum = 1;
        $mask.find(".room").each(function () {
            $(this).find('.room-number').text(roomsNum);
            $(this).attr('data-room', roomsNum);
            roomsNum++;
        });

        // Update rooms input value
        $mask.find('input[name="rooms"]').val(totalRooms);
        if (totalRooms > 1) {
            $mask.find(".js-rooms-display").text(totalRooms + ' Rooms');
        } else {
            $mask.find(".js-rooms-display").text(totalRooms + ' Room');
        }

        // Update guests
        var totalAdults = 0;
        $mask.find(".js-count-adults").each(function () {
            totalAdults += +$(this).val();
        });
        var totalChildren = 0;
        $mask.find(".js-count-children").each(function () {
            totalChildren += +$(this).val();
        });

        $mask.find('input[name="totaladults"]').val(totalAdults);
        $mask.find('input[name="totalchildren"]').val(totalChildren);

        // Update guest display
        var totalGuests = totalAdults + totalChildren;
        if (totalGuests > 1) {
            $mask.find(".js-guests-display").text(totalGuests + ' Guests');
        } else {
            $mask.find(".js-guests-display").text(totalGuests + ' Guest');
        }
    });
    $('.remove-room').on('click', function () {
        if (!$(this).hasClass('disabled')) {
            const $mask = $(this).closest('.booking-mask');

            // Remove room
            let rooms = $mask.find('.room').length;
            if (rooms > 1) {
                $(this).closest('.room').remove();
            }

            // Re-number rooms
            let roomsNum = 1;
            $mask.find(".room").each(function () {
                $(this).find('.room-number').text(roomsNum);
                $(this).attr('data-room', roomsNum);
                roomsNum++;
            });

            // Update number of rooms
            let totalRooms = $mask.find('.room').length;
            $mask.find('input[name="rooms"]').val(totalRooms);
            if (totalRooms > 1) {
                $mask.find(".js-rooms-display").text(totalRooms + ' Rooms');
            } else {
                $mask.find(".js-rooms-display").text(totalRooms + ' Room');
            }

            // Enable/disable add/remove buttons
            if (totalRooms >= 4) {
                $mask.find('.add-room').addClass("disabled");
            } else {
                $mask.find('.add-room').removeClass("disabled");
            }

            if (totalRooms > 1) {
                $mask.find('.remove-room').removeClass("disabled");
            } else {
                $mask.find('.remove-room').addClass("disabled");
            }

            // Update guests count
            let totalAdults = 0;
            $mask.find(".js-count-adults").each(function () {
                totalAdults += +$(this).val();
            });

            let totalChildren = 0;
            $mask.find(".js-count-children").each(function () {
                totalChildren += +$(this).val();
            });

            $mask.find('input[name="totaladults"]').val(totalAdults);
            $mask.find('input[name="totalchildren"]').val(totalChildren);

            let totalGuests = totalAdults + totalChildren;
            if (totalGuests > 1) {
                $mask.find(".js-guests-display").text(totalGuests + ' Guests');
            } else {
                $mask.find(".js-guests-display").text(totalGuests + ' Guest');
            }
        }
    });
});