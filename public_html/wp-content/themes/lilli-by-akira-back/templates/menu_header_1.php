<section class="menu-wrapper js-menu-toggle flex items-center justify-center">
	<?php
		$headerButton = get_field('header_button_field_link_link', 'options');
		if( isLink( $headerButton ) ):
			?>
			<a class="button primary no-margin menu-button" href="<?php echo linkField( $headerButton, 'url' ); ?>" <?php echo linkField( $headerButton, 'target' ); ?>>
				<?php echo linkField( $headerButton, 'text' ); ?>
			</a>
		<?php endif;
	?>
	<a href="#" title="Toggle menu" class="nav-toggle js-nav-toggle flex items-center justify-center size-s"><span class="hide-mobile">Menu</span><div class="menu-icon"><span></span><span></span><span></span></div></a>
	<?php wp_nav_menu( array( 'theme_location' => 'Main Menu' , 'container' => false, 'menu_class' => 'list-reset' ) ); ?>
</section>