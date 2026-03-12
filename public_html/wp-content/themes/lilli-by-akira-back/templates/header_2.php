<?php
$header_theme = 'default';
$logo_switch = false;

if ( $post && has_blocks( $post->post_content ) ) {
    $blocks = parse_blocks( $post->post_content );

	// force image theme on header when first block is banner
	if ( $blocks[0]['blockName'] === 'acf/upbannerdefault' || $blocks[0]['blockName'] === 'acf/upbannerportrait') {
		if( $blocks[0]['attrs']['data']['background_add_background'] == true ) {
			$banner_theme = $blocks[0]['attrs']['data']['background_select_background'];
			if( $banner_theme == 'media' ) {
				$header_theme = 'image js-header-switch-theme';
				$logo_switch = true;
			}
		}
	}
	// also image theme on header on singles with featured image
	if( is_singular('post') || is_singular('events') || is_singular('rooms') || is_singular('offers') ) {
		if( has_post_thumbnail() ) {
			$header_theme = 'image js-header-switch-theme';
			$logo_switch = true;
		}
	}
}
?>

<header class="header flex justify-between theme--<?php echo $header_theme; ?>">
	<a href="#" title="Toggle menu" class="nav-toggle js-nav-toggle flex items-center justify-center"><div class="menu-icon"><span></span><span></span><span></span></div></a>
	<?php block_buttons(get_field('header_button_field_link', 'options'), [
		'class' => 'button no-margin items-center',
		'type'  => 'primary'
	]); ?>
</header>

<a title="<?php echo get_bloginfo( 'name' ); ?>" class="logo flex justify-center items-center<?php if( $logo_switch ): echo ' logo-switch'; endif; ?>" href="<?php echo get_bloginfo( 'url' ); ?>">
	<svg class="default up-core-logo" fill="none" height="48" viewBox="0 0 48 48" width="48" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><path clip-rule="evenodd" d="m23.798 5.33392c.1253-.07189.2787-.0719.404 0l11.7482 6.74048c.0094.0049.0186.0102.0277.0159l11.8143 6.7785c.1286.0737.208.2119.2078.3616v.0037.0042 13.4901c0 .1499-.0798.2882-.2089.3617l-11.7534 6.6966c-.1252.0713-.278.071-.4029-.0006l-11.6348-6.6743-11.6348 6.6743c-.1249.0716-.2777.0719-.4029.0006l-11.753429-6.6957c-.1290245-.0735-.208871-.2118-.208871-.3617v-13.4893c0-.0016.00000843-.0032.00002526-.0047-.00001456-.0013-.00002281-.0027-.00002479-.004-.00022302-.1497.07917293-.2879.20777453-.3617l11.808025-6.7752c.0132-.0086.0268-.0164.0407-.0234zm-11.5592 7.58638-10.99554 6.3091 10.92004 6.2217 10.9563-6.2866zm11.3514 6.928-11.0172 6.3217v12.543l11.0172-6.3201zm.8196 12.5446v-12.5446l11.0172 6.3217v12.543zm11.8367 6.3225 10.934-6.2297v-12.5462l-10.934 6.2313zm-.4091-13.2639 10.9194-6.2229-10.9952-6.3085-10.8812 6.2444zm-11.8374-6.7358-10.93-6.2723 10.93-6.27145 10.9303 6.27125zm-12.2465 19.9997-10.933954-6.2288v-12.5463l10.933954 6.2297z" fill="currentColor" fill-rule="evenodd"/></svg>
	<svg class="invert up-core-logo" fill="none" height="48" viewBox="0 0 48 48" width="48" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><path clip-rule="evenodd" d="m23.798 5.33392c.1253-.07189.2787-.0719.404 0l11.7482 6.74048c.0094.0049.0186.0102.0277.0159l11.8143 6.7785c.1286.0737.208.2119.2078.3616v.0037.0042 13.4901c0 .1499-.0798.2882-.2089.3617l-11.7534 6.6966c-.1252.0713-.278.071-.4029-.0006l-11.6348-6.6743-11.6348 6.6743c-.1249.0716-.2777.0719-.4029.0006l-11.753429-6.6957c-.1290245-.0735-.208871-.2118-.208871-.3617v-13.4893c0-.0016.00000843-.0032.00002526-.0047-.00001456-.0013-.00002281-.0027-.00002479-.004-.00022302-.1497.07917293-.2879.20777453-.3617l11.808025-6.7752c.0132-.0086.0268-.0164.0407-.0234zm-11.5592 7.58638-10.99554 6.3091 10.92004 6.2217 10.9563-6.2866zm11.3514 6.928-11.0172 6.3217v12.543l11.0172-6.3201zm.8196 12.5446v-12.5446l11.0172 6.3217v12.543zm11.8367 6.3225 10.934-6.2297v-12.5462l-10.934 6.2313zm-.4091-13.2639 10.9194-6.2229-10.9952-6.3085-10.8812 6.2444zm-11.8374-6.7358-10.93-6.2723 10.93-6.27145 10.9303 6.27125zm-12.2465 19.9997-10.933954-6.2288v-12.5463l10.933954 6.2297z" fill="#fff" fill-rule="evenodd"/></svg>
</a>