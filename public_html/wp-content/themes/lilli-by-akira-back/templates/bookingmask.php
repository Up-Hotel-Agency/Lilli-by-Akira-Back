<?php 
//Choose which Booking Mask you want to display
$bookingmaks = 'simple';
// $bookingmaks = 'multi_room';

if( $bookingmaks == 'simple' ): 
    include 'booking_mask/bookingmask_simple.php'; 
elseif( $bookingmaks == 'multi_room' ):
    include 'booking_mask/bookingmask_multi_room.php'; 
endif;
?>