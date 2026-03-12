<div class="nav-overlay js-menu-toggle"></div>

<div class="nav-wrap js-menu-toggle">
    <a href="#" title="Toggle menu" class="nav-toggle js-nav-toggle flex items-center justify-center"><div class="menu-icon"><span></span><span></span><span></span></div></a>

    <a href="#" class="nav-back js-nav-back items-center justify-center" title="Toggle Menu Back">
        <svg width="21" height="21" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M14.842 17.685L9.158 12 14.842 6.315"/></svg>
    </a>

    <div class="nav-subitem js-nav-subitem text-center items-center justify-center">
        <a href="#" aria-label="sub-item" class="js-sub-item">
        </a>
    </div>

    <?php wp_nav_menu( array( 'theme_location' => 'Main Menu' , 'container' => false, 'menu_class' => 'nav-primary flex flex-col items-center justify-center' ) ); ?>

</div>