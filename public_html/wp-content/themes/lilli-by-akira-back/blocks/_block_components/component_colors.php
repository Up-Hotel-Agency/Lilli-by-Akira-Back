<?php

function set_color_bg_values() {
    
    $bgField = get_field('background') ?? get_field('color')['background'] ?? [];

    $has_bg = $bgField['add_background'] ?? false;
    $bg = $bgField['add_background'] == 1 && array_key_exists('select_background', $bgField) ? $bgField['select_background'] : '';
    $custom_bg = $bg === "custom" && array_key_exists('custom_background', $bgField) ? $bgField['custom_background'] : '';
    $theme = $media_field = false;
    if ($bg === "media") {
        $theme = "image";
        $media_field = $bgField['background_media'];
    }

    return array(
        'theme' => $theme,
        'has_bg' => $has_bg,
        'bg' => $bg,
        'custom_bg' => $custom_bg,
        'block_media_field' => $media_field
    );
}

function set_color_behaviour_values() {
    $colorBehaviour = get_field('colour_behaviour') ?? '';
    return array(
        'colorBehaviour' => $colorBehaviour
    );
}


function set_color_palette_values() {

    $paletteField = get_field('palette') ?? get_field('color')['palette'] ?? [];
    $palette = array_key_exists('palette_select', $paletteField) ? $paletteField['palette_select'] : '';
    
    $custom_dark = $palette === 'custom' && array_key_exists('dark', $paletteField['custom_palette']) ? $paletteField['custom_palette']['dark'] : '';
    $custom_light = $palette === 'custom' && array_key_exists('light', $paletteField['custom_palette']) ? $paletteField['custom_palette']['light'] : '';
    $custom_primary = $palette === 'custom' && array_key_exists('primary', $paletteField['custom_palette']) ? $paletteField['custom_palette']['primary'] : '';
    $custom_primary_reverse = $palette === 'custom' && array_key_exists('primary_reverse', $paletteField['custom_palette']) ? $paletteField['custom_palette']['primary_reverse'] : '';

    return array(
        'palette' => $palette,
        'custom_dark' => $custom_dark,
        'custom_light' => $custom_light,
        'custom_primary' => $custom_primary,
        'custom_primary_reverse' => $custom_primary_reverse,
    );

}

function set_color_theme_values() {
    $themeField = get_field('theme') ?? get_field('color')['theme'] ?? [];
    $theme = array_key_exists('theme_select', $themeField) ? $themeField['theme_select'] : '';
    if($theme != "inherit"):
        return array('theme' => $theme);
    else:
        return array();
    endif;
}


function block_color_variables(){
    return array_merge(set_color_bg_values(), set_color_behaviour_values(), set_color_palette_values(), set_color_theme_values());
}