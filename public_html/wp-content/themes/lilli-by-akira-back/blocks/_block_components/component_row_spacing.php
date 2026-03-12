<?php

//Capture Theme Overide Fields
function set_row_spacing_override_values() {

    if( get_field('row_spacing')['override_row_spacing'] ): 
        $spaceTop = get_field('row_spacing')['top'];
        $spaceBottom = get_field('row_spacing')['bottom'];
    
        if( $spaceTop != null ): echo '--row-spacing-top: var(--row-' . $spaceTop . '); '; endif;
        if( $spaceBottom != null ): echo '--row-spacing-bottom: var(--row-' . $spaceBottom . ');'; endif;

    endif;
}