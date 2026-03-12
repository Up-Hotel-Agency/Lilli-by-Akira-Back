<section class="menu-wrapper js-menu-toggle flex header-with-dropdowns">
	<a href="#" title="Toggle menu" class="nav-toggle js-nav-toggle flex items-center justify-center size-s"><div class="menu-icon"><span></span><span></span><span></span></div></a>
	<?php wp_nav_menu( array( 'theme_location' => 'Main Menu' , 'container' => false, 'menu_class' => 'list-reset' ) ); ?>
</section>