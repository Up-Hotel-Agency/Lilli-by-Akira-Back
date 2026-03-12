<?php if ( !class_exists( 'acf' ) ): ?>
<p style="text-align: center;">Please activate Advanced Custom Fields</p>
<?php die; endif; ?>
<!DOCTYPE html>
<html id="html" lang="en">
<head>

<script>
var googleMapScriptLoaded;
var neighbourhoodScriptLoaded;
</script>

<meta charset="utf-8">
<meta name="viewport" content="height=device-height, width=device-width, initial-scale=1.0, minimum-scale=1.0, target-densitydpi=device-dpi">
<meta name="Author" content="Lilli by Akira Back">

<?php global $post; ?>

<script>
    ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
</script>

<style>
<?php echo file_get_contents(get_template_directory() . '/assets/css/abovethefold.css'); ?>
</style>

<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
<link rel="manifest" href="/site.webmanifest">
<link rel="mask-icon" href="/safari-pinned-tab.svg" color="#0e566e">
<meta name="msapplication-TileColor" content="#0e566e">
<meta name="theme-color" content="#0e566e">
<link rel="manifest" href="/manifest.json">
<link rel="preconnect" href="https://core.up-dev.com" crossorigin>
<link rel="stylesheet" href="https://use.typekit.net/ufq5wwa.css">

<!-- Preload webfont -->
<link rel="preload" href="<?php echo get_template_directory_uri(); ?>/assets/fonts/inter/inter-v13-latin-regular.woff2" as="font" type="font/woff2" crossorigin>
<link rel="preload" href="<?php echo get_template_directory_uri(); ?>/assets/fonts/inter/inter-v13-latin-700.woff2" as="font" type="font/woff2" crossorigin>

<link rel="preload" href="<?php echo get_template_directory_uri(); ?>/assets/fonts/red-hat-display/red-hat-display-v19-latin-700.woff2" as="font" type="font/woff2" crossorigin>
<link rel="preload" href="<?php echo get_template_directory_uri(); ?>/assets/fonts/red-hat-display/red-hat-display-v19-latin-regular.woff2" as="font" type="font/woff2" crossorigin>
<!-- End Preload webfont -->

<?php wp_head(); ?>

<script>jQuery.event.special.touchstart = {setup: function( _, ns, handle ) {this.addEventListener("touchstart", handle, { passive: !ns.includes("noPreventDefault") });}};jQuery.event.special.touchmove = {setup: function( _, ns, handle ) {this.addEventListener("touchmove", handle, { passive: !ns.includes("noPreventDefault") });}};jQuery.event.special.wheel = {setup: function( _, ns, handle ){this.addEventListener("wheel", handle, { passive: true });}};jQuery.event.special.mousewheel = {setup: function( _, ns, handle ){this.addEventListener("mousewheel", handle, { passive: true });}};</script>
</head>

<body <?php body_class( get_option('stylesheet') ); ?>>

<a class="button primary screenreader-link" href="#scroll-target">Skip to content</a>

<?php
    // includes the template of the header set in setup-header.php
    include 'templates/' . get_header_type() . '.php';
?>