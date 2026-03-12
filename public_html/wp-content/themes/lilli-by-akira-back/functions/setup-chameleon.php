<?php
// ensure is_plugin_active() exists (not on frontend)
if( !function_exists('is_plugin_active') ) {
			
    include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
    
}

function chameleon_enqueue_styles() {
    wp_enqueue_style('chameleon_override', get_theme_file_uri('assets/css/chameleon/chameleon-override.css') );
}

//Check if Chameleon plugin is active
if (is_plugin_active('up-engine-plugin/dynamic-content-engine.php')) {
    add_action( 'wp_enqueue_scripts', 'chameleon_enqueue_styles' );
}