<?php

//Define page color transition variables
if( $colorBehaviour == 'page_transition' ) {
    $transitionPalette = $palette;
    $transitionTheme = $theme;

    if ( $palette == 'custom') {
        $transitionPalette = 'custom';
        $transitionDarkAttr = $custom_dark;
        $transitionLightAttr = $custom_light;
        $transitionPrimaryAttr = $custom_primary;
        $transitionPrimaryReverseAttr = $custom_primary_reverse;
    };
}
?>