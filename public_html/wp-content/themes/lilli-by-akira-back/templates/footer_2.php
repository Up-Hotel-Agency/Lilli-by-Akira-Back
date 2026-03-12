<footer class="footer container flex sm:flex-wrap">
    <a href="<?php echo get_bloginfo( 'url' ); ?>" title="<?php echo get_bloginfo( 'name' ); ?>" class="footer-logo mb-12 flex xs:justify-center">
        <svg class="up-core-logo" fill="none" height="174" viewBox="0 0 173 174" width="173" xmlns="http://www.w3.org/2000/svg"><path clip-rule="evenodd" d="m86.4375.989761c.3537-.199884.7866-.19989 1.1402-.000015l33.1583 18.739354c.026.0137.052.0285.078.0442l33.344 18.845c.363.2051.587.5893.587 1.0055v.0101.0116 37.5043c0 .4168-.226.8012-.59 1.0055l-33.172 18.6174c-.354.1982-.785.1975-1.138-.0017l-32.8374-18.5555-32.8378 18.5555c-.3525.1992-.7838.1999-1.137.0017l-33.1728-18.615c-.3641-.2043-.5895-.5887-.5895-1.0055v-37.502c0-.0043 0-.0086.0001-.0129-.0001-.0037-.0001-.0074-.0001-.0111-.0006-.4162.2235-.8004.5864-1.0056l33.3268-18.836c.0371-.0239.0755-.0456.1149-.065zm-32.6245 21.091139-31.0335 17.54 30.8204 17.2972 30.9228-17.4778zm32.0381 19.2607-31.0947 17.5749v34.8712l31.0947-17.5705zm2.3131 34.8756v-34.8756l31.0948 17.5749v34.8712zm33.4078 17.5771 30.86-17.3192v-34.8799l-30.86 17.3235zm-1.155-36.8751 30.819-17.3005-31.033-17.5383-30.7104 17.3599zm-33.4094-18.7263-30.8485-17.4379 30.8486-17.43542 30.8493 17.43482zm-34.5643 55.6015-30.8597-17.317v-34.8801l30.8597 17.3192z" fill="#06f" fill-rule="evenodd"/><g fill="#000410"><path d="m8.46486 129.556h-7.44972v22.682c0 7.731 5.79697 13.006 14.92416 13.006 9.1024 0 14.8994-5.275 14.8994-13.006v-22.682h-7.4497v21.952c0 4.498-2.6888 7.44-7.4497 7.44-4.7856 0-7.47444-2.942-7.47444-7.44z"/><path d="m51.6091 138.162c-3.8235 0-6.759 1.896-8.1897 4.959h-.148v-4.546h-7.1044v34.57h7.203v-12.885h.148c1.4061 2.942 4.3663 4.79 8.2145 4.79 6.611 0 10.7059-5.057 10.7059-13.444 0-8.412-4.1196-13.444-10.8293-13.444zm-2.4174 21.175c-3.5275 0-5.8463-3.015-5.8463-7.731 0-4.668 2.3188-7.755 5.8463-7.755 3.6015 0 5.8709 3.038 5.8709 7.755 0 4.74-2.2694 7.731-5.8709 7.731z"/><path d="m82.5181 165.244c8.7325 0 14.8254-4.959 15.6642-12.787h-7.2524c-.7894 4.157-3.9716 6.709-8.3871 6.709-5.6983 0-9.2752-4.619-9.2752-12.106 0-7.391 3.6262-12.034 9.2505-12.034 4.3416 0 7.6964 2.82 8.3871 7.123h7.2524c-.5674-7.853-7.0797-13.201-15.6395-13.201-10.3112 0-16.8482 6.831-16.8482 18.136 0 11.329 6.4877 18.16 16.8482 18.16z"/><path d="m114.315 165.196c7.993 0 13.099-5.033 13.099-13.615 0-8.46-5.18-13.565-13.099-13.565-7.918 0-13.099 5.13-13.099 13.565 0 8.558 5.107 13.615 13.099 13.615zm0-5.422c-3.552 0-5.797-2.941-5.797-8.168 0-5.179 2.294-8.169 5.797-8.169s5.772 2.99 5.772 8.169c0 5.227-2.244 8.168-5.772 8.168z"/><path d="m131.139 164.636h7.203v-14.562c0-3.671 2.072-5.81 5.624-5.81 1.036 0 2.023.17 2.615.413v-6.248c-.494-.146-1.209-.267-2.048-.267-3.108 0-5.353 1.799-6.29 5.105h-.148v-4.692h-6.956z"/><path d="m160.518 143.267c3.207 0 5.402 2.285 5.55 5.616h-11.223c.246-3.258 2.516-5.616 5.673-5.616zm5.649 13.395c-.666 1.994-2.689 3.282-5.328 3.282-3.676 0-6.068-2.552-6.068-6.272v-.437h18.229v-2.164c0-7.925-4.859-13.055-12.556-13.055-7.82 0-12.753 5.397-12.753 13.711 0 8.339 4.884 13.469 13.025 13.469 6.537 0 11.273-3.428 12.062-8.534z"/></g></svg>
    </a>
    <div class="footer-content">
        <div class="footer-content-top xs:flex xs:flex-wrap">
            <?php if( have_rows('footer_menus', 'options') ): while ( have_rows('footer_menus', 'options') ) : the_row(); ?>
                <div class="footer-menu">
                    <?php if( get_sub_field('footer_menu_title', 'options') ): ?>
                        <h5 class="mob-footer-menu-toggle js-mob-footer-menu-toggle xs:flex xs:justify-between xs:items-center">
                            <?php the_sub_field('footer_menu_title', 'options'); ?>
                            <span class="button icon secondary no-margin">
                                <svg width="21" height="21" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.685 9.158L12 14.842 6.315 9.158"/></svg>
                            </span>
                        </h5>
                    <?php endif; ?>
                    <div class="footer-menu-wrap js-footer-menu">
                        <?php wp_nav_menu( array( 'menu' => get_sub_field('footer_menu') , 'container' => false, 'menu_class' => 'list-reset' ) ); ?>
                    </div>
                </div>
            <?php endwhile; endif; ?>
        </div>
        <div class="footer-content-bottom flex flex-wrap size-s no-margin xs:flex-col">
            <?php if( get_field('address', 'options') ): ?>
                <span><?php the_field('address', 'options'); ?></span>
            <?php endif; ?>
            <?php if( get_field('telephone', 'options') ): ?>
                <span><strong>T:</strong> <a href="tel:<?php the_field('telephone', 'options'); ?>"><?php the_field('telephone', 'options'); ?></a></span>
            <?php endif; ?>
            <?php if( get_field('email', 'options') ): ?>
                <span><strong>E:</strong> <a href="mailto:<?php the_field('email', 'options'); ?>"><?php the_field('email', 'options'); ?></a></span>
            <?php endif; ?>
        </div>
    </div>
    <div class="flex flex-col justify-start items-end social-links xs:flex-row xs:justify-center xs:items-center">
        <?php if( get_field('facebook', 'options') ): ?>
            <a href="<?php the_field('facebook', 'options'); ?>" class="button icon secondary size-s" target="_blank" rel="noopener">
                <svg width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48"><title>facebook</title><path class="facebook" d="M34.107,3.567a45.739,45.739,0,0,0-5.334-.281c-5.288,0-8.914,3.228-8.914,9.148v5.1H13.893v6.925h5.966V42.216h7.159V24.459H32.96l.913-6.925H27.018V13.112c0-1.989.538-3.369,3.416-3.369h3.673Z" fill="currentColor"/></svg>
            </a>
        <?php endif; ?>
        <?php if( get_field('instagram', 'options') ): ?>
            <a href="<?php the_field('instagram', 'options'); ?>" class="button icon secondary size-s" target="_blank" rel="noopener">
                <svg width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48"><title>instagram</title><path d="M42.12,16.472c-.143-2.921-.808-5.51-2.945-7.647s-4.726-2.8-7.647-2.945c-2.517-.142-5.011-.119-7.528-.119s-5.011-.023-7.528.119c-2.921.143-5.51.808-7.647,2.945s-2.8,4.726-2.945,7.647c-.142,2.517-.119,5.011-.119,7.528s-.023,5.011.119,7.528c.143,2.921.808,5.51,2.945,7.647s4.726,2.8,7.647,2.945c2.517.142,5.011.119,7.528.119s5.011.023,7.528-.119c2.921-.143,5.51-.808,7.647-2.945s2.8-4.726,2.945-7.647c.142-2.517.119-5.011.119-7.528S42.262,18.989,42.12,16.472ZM38.225,34.758a6.212,6.212,0,0,1-3.467,3.467c-2.4.95-8.1.736-10.758.736s-8.359.214-10.758-.736a6.212,6.212,0,0,1-3.467-3.467c-.95-2.4-.736-8.1-.736-10.758s-.214-8.359.736-10.758a6.212,6.212,0,0,1,3.467-3.467c2.4-.95,8.1-.736,10.758-.736s8.359-.214,10.758.736a6.212,6.212,0,0,1,3.467,3.467c.95,2.4.736,8.1.736,10.758S39.175,32.359,38.225,34.758Z" fill="currentColor"/><path d="M33.737,12.078a2.185,2.185,0,1,0,2.185,2.185A2.18,2.18,0,0,0,33.737,12.078Z" fill="currentColor"/><path d="M24,14.643A9.357,9.357,0,1,0,33.357,24,9.345,9.345,0,0,0,24,14.643ZM24,30.08A6.08,6.08,0,1,1,30.08,24,6.092,6.092,0,0,1,24,30.08Z" fill="currentColor"/></svg>
            </a>
        <?php endif; ?>
        <?php if( get_field('twitter', 'options') ): ?>
            <a href="<?php the_field('twitter', 'options'); ?>" class="button icon secondary size-s" target="_blank" rel="noopener">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><title>twitter</title>
            <path d="M17.1761 4H19.9362L13.9061 10.7774L21 20H15.4456L11.0951 14.4066L6.11723 20H3.35544L9.80517 12.7508L3 4H8.69545L12.6279 9.11262L17.1761 4ZM16.2073 18.3754H17.7368L7.86441 5.53928H6.2232L16.2073 18.3754Z" fill="currentColor"/>
            </svg>
            </a>
        <?php endif; ?>
        <?php if( get_field('linkedin', 'options') ): ?>
            <a href="<?php the_field('linkedin', 'options'); ?>" class="button icon secondary size-s" target="_blank" rel="noopener">
                <svg width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48"><title>linkedin</title><g class="linkedin"><rect x="7.435" y="17.44" width="7.298" height="21.916" fill="currentColor"/><path d="M15.2,10.673a3.763,3.763,0,0,0-4.069-3.782,3.8,3.8,0,0,0-4.114,3.782,3.762,3.762,0,0,0,4.025,3.781h.045A3.777,3.777,0,0,0,15.2,10.673Z" fill="currentColor"/><path d="M40.985,26.8c0-6.723-3.583-9.864-8.382-9.864a7.222,7.222,0,0,0-6.613,3.694h.045V17.44H18.759s.088,2.057,0,21.916h7.276V27.127a5.489,5.489,0,0,1,.243-1.792,3.988,3.988,0,0,1,3.737-2.654c2.632,0,3.694,2.013,3.694,4.954V39.356h7.276Z" fill="currentColor"/></g></svg>
            </a>
        <?php endif; ?>
    </div>
</footer>

<div class="copyright">
    <div class="container flex items-center justify-between xs:flex-col">
        <div class="flex xs:flex-col items-center copyright-menu">
            <p class="size-s no-margin color-body-50">©<?php echo date('Y'); ?> UpCore</p>
            <?php wp_nav_menu( array( 'theme_location' => 'Footer Copyright' , 'container' => false, 'menu_class' => 'list-reset' ) ); ?>
        </div>
        <div class="flex xs:flex-col items-center">
            <p class="size-s no-margin"><a href="https://uphotel.agency" target="_blank" rel="noopener"><span class="color-body-50">Website by</span> UP HOTEL AGENCY</a></p>
        </div>
    </div>
</div>