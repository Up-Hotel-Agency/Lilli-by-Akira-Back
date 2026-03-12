<?php

/**
* @desc Register image sizes
*/
include 'functions/register-images.php';

/**
* @desc Set up header and footer
*/
include 'functions/setup-header.php';
include 'functions/setup-footer.php';

/**
* @desc Set up Wordpress admin stylesheet
*/
include 'functions/setup-admin-styles.php';

/**
* @desc Set up ACF
*/
include 'functions/setup-acf.php';

/**
* @desc Set up blog
*/
include 'functions/setup-blog.php';

/**
* @desc Set up carousel
*/
include 'functions/setup-carousel.php';

/**
* @desc Set up excerpts
*/
include 'functions/setup-excerpt.php';

/**
* @desc Set up image responsive srcset sizes
*/
include 'functions/setup-images.php';

/**
 * @desc Set up login styles
 */
include 'functions/setup-login.php';

/**
* @desc Clean up WordPress extras
*/
include 'functions/setup-restrict.php';

/**
* @desc Set up custom roles
*/
include 'functions/setup-roles.php';

/**
* @desc Set up shortcodes
*/
include 'functions/setup-shortcodes.php';

/**
* @desc Set up global overides for theme
*/
include 'functions/setup-theme.php';

/**
* @desc Set up upload resize
*/
include 'functions/setup-upload-resize.php';

/**
* @desc Set up Gutenberg
*/
include 'functions/setup-gutenberg.php';

/**
* @desc Register Gutenberg blocks
*/
include 'blocks/register-blocks.php';

// Don't forget to customise your custom post types and fields
require_once('inc/cpts/cpts.php');

/**
 * Check if WooCommerce is activated
 */
if ( ! function_exists( 'is_woocommerce_activated' ) ) {
	function is_woocommerce_activated() {
		if ( class_exists( 'woocommerce' ) ) { return true; } else { return false; }
	}
}

/**
* @desc Set up WooCommerce
*/
if (is_woocommerce_activated()) {
    include 'functions/setup-woocommerce.php';
}

/**
* @desc Sweetnr tools
*/
include 'functions/setup-conversion-tools.php';

/**
 * @desc Chameleon setup
 */

include 'functions/setup-chameleon.php';

/**
 * @desc Gravity Forms functions
 */

include 'functions/setup-gravityforms.php';

/**
 * @desc Setup icons functions
 */

 include 'functions/setup-icons/setup-icons.php';


 /**
 * @desc Disallow selected blocks
 */

 include 'functions/disallow-blocks.php';
  add_filter('wp_get_attachment_image_attributes', function ($attr) {
    unset($attr['width']);
    unset($attr['height']);
    return $attr;
}, 10);
add_filter('wp_img_tag_add_width_and_height_attr', '__return_false');
add_filter( 'wp_img_tag_add_auto_sizes', '__return_false' );