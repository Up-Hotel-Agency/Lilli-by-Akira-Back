<?php

//Output style atrributes
if( $colorBehaviour == 'page_transition' ) {

    include get_template_directory() . '/blocks/_block_components/component_page_color_transition/component_page_color_transition.php';
     $transitionAttrs = [];

    if ( $transitionPalette ) {
        $transitionAttrs['paletteAttr'] = 'data-page-color-transition-palette="' . $transitionPalette . '"';
    };

    if ( $transitionTheme ) {
        $transitionAttrs['themeAttr'] = 'data-page-color-transition-theme="' . $transitionTheme . '"';
    };

    if ( $palette == 'custom') {
        $transitionAttrs['paletteCustomDarkAttr'] = 'data-page-color-transition-palette-custom-dark="' . $transitionDarkAttr . '"';
        $transitionAttrs['paletteCustomlightAttr'] = 'data-page-color-transition-palette-custom-light="' . $transitionLightAttr . '"';
        $transitionAttrs['paletteCustomprimaryAttr'] = 'data-page-color-transition-palette-custom-primary="' . $transitionPrimaryAttr . '"';
        $transitionAttrs['paletteCustomprimaryReverseAttr'] = 'data-page-color-transition-palette-custom-primary-reverse="' . $transitionPrimaryReverseAttr . '"';
    };

    //Output attributes separated by space
    //e.g. data-page-color-transition-palette="secondary"
    echo implode(" ", $transitionAttrs);
};

?>