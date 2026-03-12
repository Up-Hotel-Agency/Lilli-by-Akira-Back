<footer class="footer container sm:flex-wrap">
    <div class="flex justify-between items-center mb-14">
        <a href="<?php echo get_bloginfo( 'url' ); ?>" title="<?php echo get_bloginfo( 'name' ); ?>" class="footer-logo flex xs:justify-start">
            <svg class="up-core-logo" fill="none" viewBox="0 0 140 40" width="180" height="72" xmlns="http://www.w3.org/2000/svg"><title>UP Core logo</title><path clip-rule="evenodd" d="m27.7643.0621215c.1462-.0828264.3252-.0828288.4714-.0000062l13.7062 7.7650747c.0109.00567.0217.01177.0323.0183l13.7834 7.80881c.15.085.2426.2442.2424.4167v.0041.0049 15.5407c0 .1727-.0931.332-.2437.4166l-13.7123 7.7145c-.146.0822-.3243.0819-.4701-.0006l-13.5739-7.6889-13.5739 7.6889c-.1457.0825-.324.0828-.47.0007l-13.712417-7.7136c-.1505287-.0846-.24368299-.2439-.24368299-.4166v-15.5398c0-.0018.00000983-.0036.00002946-.0053-.00001698-.0016-.00002662-.0031-.00002892-.0046-.00026019-.1725.09236835-.3317.24240445-.4167l13.775995-7.80513c.0154-.0099.0313-.01888.0476-.02692zm-13.4857 8.7395885-12.82813 7.26809 12.74003 7.1674 12.7823-7.2423zm13.2433 7.98109-12.8534 7.2825v14.4496l12.8534-7.2807zm.9562 14.4514v-14.4514l12.8534 7.2825v14.4496zm13.8095 7.2835 12.7563-7.1766v-14.4532l-12.7563 7.1783zm-.4773-15.28 12.7393-7.1688-12.8278-7.26744-12.6946 7.19344zm-13.8103-7.7597-12.7516-7.22574 12.7516-7.22473 12.752 7.2245zm-14.2876 23.0397-12.756262-7.1756v-14.4534l12.756262 7.1766z" fill="#0038ff" fill-rule="evenodd"/><g fill="#000a2c"><path d="m71.0967 12.8422h-3.0967v9.5669c0 3.2607 2.4097 5.4858 6.2036 5.4858 3.7837 0 6.1934-2.2251 6.1934-5.4858v-9.5669h-3.0967v9.2592c0 1.897-1.1177 3.1377-3.0967 3.1377-1.9892 0-3.1069-1.2407-3.1069-3.1377z"/><path d="m89.0308 16.472c-1.5894 0-2.8096.7999-3.4043 2.0918h-.0616v-1.9174h-2.9531v14.581h2.9942v-5.4346h.0615c.5845 1.2408 1.8149 2.0201 3.4145 2.0201 2.7481 0 4.4502-2.1328 4.4502-5.6704 0-3.5479-1.7124-5.6705-4.5014-5.6705zm-1.0049 8.9312c-1.4663 0-2.4302-1.2715-2.4302-3.2607 0-1.9688.9639-3.271 2.4302-3.271 1.497 0 2.4404 1.2817 2.4404 3.271 0 1.9995-.9434 3.2607-2.4404 3.2607z"/><path d="m101.879 27.8949c3.63 0 6.163-2.0918 6.511-5.3936h-3.015c-.328 1.7535-1.65 2.8301-3.486 2.8301-2.3685 0-3.8553-1.9482-3.8553-5.1064 0-3.1172 1.5073-5.0757 3.8453-5.0757 1.805 0 3.199 1.1894 3.486 3.0044h3.015c-.236-3.312-2.943-5.5679-6.501-5.5679-4.2862 0-7.0035 2.8814-7.0035 7.6494 0 4.7783 2.6968 7.6597 7.0035 7.6597z"/><path d="m115.096 27.8744c3.322 0 5.445-2.1226 5.445-5.7422 0-3.5684-2.153-5.7217-5.445-5.7217-3.291 0-5.445 2.1636-5.445 5.7217 0 3.6094 2.123 5.7422 5.445 5.7422zm0-2.2866c-1.476 0-2.409-1.2408-2.409-3.4453 0-2.1841.953-3.4454 2.409-3.4454s2.4 1.2613 2.4 3.4454c0 2.2045-.934 3.4453-2.4 3.4453z"/><path d="m122.089 27.6385h2.994v-6.142c0-1.5484.862-2.4507 2.338-2.4507.431 0 .841.0718 1.087.1743v-2.6353c-.205-.0615-.502-.1128-.851-.1128-1.292 0-2.225.7588-2.615 2.1534h-.061v-1.979h-2.892z"/><path d="m134.302 18.6254c1.333 0 2.245.9638 2.307 2.3686h-4.666c.103-1.374 1.046-2.3686 2.359-2.3686zm2.348 5.6499c-.277.8408-1.118 1.3842-2.215 1.3842-1.528 0-2.522-1.0766-2.522-2.6455v-.1845h7.577v-.9126c0-3.3428-2.02-5.5064-5.219-5.5064-3.25 0-5.301 2.2764-5.301 5.7832 0 3.5171 2.03 5.6807 5.414 5.6807 2.717 0 4.686-1.4458 5.014-3.5991z"/></g></svg>
        </a>
        <div class="flex justify-end items-center social-links xs:hidden">
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
    </div>
    <div class="footer-content">
        <div class="footer-content-top flex xs:flex-wrap">
            <div class="footer-menus">
                <?php if( have_rows('footer_menus', 'options') ): while ( have_rows('footer_menus', 'options') ) : the_row(); ?>
                    <div class="footer-menu">
                        <?php if( get_sub_field('footer_menu_title', 'options') ): ?>
                            <h3 class="h5 mob-footer-menu-toggle js-mob-footer-menu-toggle xs:flex xs:justify-between xs:items-center">
                                <?php the_sub_field('footer_menu_title', 'options'); ?>
                                <span class="button icon secondary no-margin">
                                    <svg width="21" height="21" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.685 9.158L12 14.842 6.315 9.158"/></svg>
                                </span>
                            </h3>
                        <?php endif; ?>
                        <div class="footer-menu-wrap js-footer-menu">
                            <?php wp_nav_menu( array( 'menu' => get_sub_field('footer_menu') , 'container' => false, 'menu_class' => 'list-reset' ) ); ?>
                        </div>
                    </div>
                <?php endwhile; endif; ?>
            </div>
            <div class="footer-contact">
                <?php if( get_field('contact_title', 'options') ): ?>
                    <h3 class="h5"><?php the_field('contact_title', 'options'); ?></h3>
                <?php endif; ?>
                <?php if( get_field('address', 'options') ): ?>
                    <p class="size-s"><?php the_field('address', 'options'); ?></p>
                <?php endif; ?>
                <?php if( get_field('telephone', 'options') ): ?>
                    <p class="size-s tel"><strong>T:</strong> <a href="tel:<?php the_field('telephone', 'options'); ?>"><?php the_field('telephone', 'options'); ?></a></p>
                <?php endif; ?>
                <?php if( get_field('email', 'options') ): ?>
                    <p class="size-s email"><strong>E:</strong> <a href="mailto:<?php the_field('email', 'options'); ?>"><?php the_field('email', 'options'); ?></a></p>
                <?php endif; ?>
            </div>
            <div class="hidden social-links xs:flex">
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
                        <svg width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48"><title>twitter</title><path class="twitter" d="M43.457,13.233a15.624,15.624,0,0,1-4.485,1.206A7.763,7.763,0,0,0,42.4,10.147a15.348,15.348,0,0,1-4.943,1.881,7.8,7.8,0,0,0-13.478,5.329,8.765,8.765,0,0,0,.193,1.784,22.14,22.14,0,0,1-16.059-8.15A7.8,7.8,0,0,0,10.52,21.407,7.849,7.849,0,0,1,7,20.419v.1a7.789,7.789,0,0,0,6.245,7.644,8.269,8.269,0,0,1-2.05.265,9.718,9.718,0,0,1-1.47-.121,7.8,7.8,0,0,0,7.281,5.4,15.6,15.6,0,0,1-9.668,3.328,15.963,15.963,0,0,1-1.881-.1,22,22,0,0,0,11.959,3.5c14.323,0,22.159-11.862,22.159-22.158,0-.338,0-.675-.024-1.013A16.728,16.728,0,0,0,43.457,13.233Z" fill="currentColor"/></svg>
                    </a>
                <?php endif; ?>
                <?php if( get_field('linkedin', 'options') ): ?>
                    <a href="<?php the_field('linkedin', 'options'); ?>" class="button icon secondary size-s" target="_blank" rel="noopener">
                        <svg width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48"><title>linkedin</title><g class="linkedin"><rect x="7.435" y="17.44" width="7.298" height="21.916" fill="currentColor"/><path d="M15.2,10.673a3.763,3.763,0,0,0-4.069-3.782,3.8,3.8,0,0,0-4.114,3.782,3.762,3.762,0,0,0,4.025,3.781h.045A3.777,3.777,0,0,0,15.2,10.673Z" fill="currentColor"/><path d="M40.985,26.8c0-6.723-3.583-9.864-8.382-9.864a7.222,7.222,0,0,0-6.613,3.694h.045V17.44H18.759s.088,2.057,0,21.916h7.276V27.127a5.489,5.489,0,0,1,.243-1.792,3.988,3.988,0,0,1,3.737-2.654c2.632,0,3.694,2.013,3.694,4.954V39.356h7.276Z" fill="currentColor"/></g></svg>
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</footer>

<div class="copyright">
    <div class="container flex items-center justify-between xs:flex-col xs:items-start">
        <div class="flex items-center copyright-menu">
            <p class="size-s no-margin color-body-50">©<?php echo date('Y'); ?> UpCore</p>
            <?php wp_nav_menu( array( 'theme_location' => 'Footer Copyright' , 'container' => false, 'menu_class' => 'list-reset' ) ); ?>
        </div>
        <div class="flex items-center">
            <p class="size-s no-margin"><a class="uphotel" href="https://uphotel.agency" target="_blank" rel="noopener"><span class="color-body-50">Website by</span> UP HOTEL AGENCY</a></p>
        </div>
    </div>
</div>