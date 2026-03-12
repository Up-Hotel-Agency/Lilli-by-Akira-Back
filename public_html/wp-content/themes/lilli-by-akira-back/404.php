<?php get_header(); ?>

<header class="row container banner-block blog-header flex justify-center items-center" id="scroll-target">
    <div class="banner-content-block">
        <p class="mb-2 overline-1" data-aos="fade-up">
            Error 404
        </p>
        <h1 class="mb-2" data-aos="fade-up"><?php the_field('404_page_title', 'options') ?></h1>
        <div class="banner-content mb-12" data-aos="fade-up">
            <p class="mb-0"><?php the_field('404_page_subtitle', 'options') ?></p>
        </div>
        <div class="buttons centered no-margin" data-aos="fade-up" data-aos-delay="200">
            <a class="button primary" href="<?php echo get_bloginfo( 'url' ); ?>">
                Return to Homepage
            </a>
        </div>
    </div>
</header>

<section class="row container">
    <div class="cta-blocks flex flex-wrap justify-center">
        <?php while ( have_rows('404_ctas', 'options') ) : the_row(); ?>
            <?php
            $link = get_sub_field('link_field_link');
            if( isLink( $link ) ):
            ?>
            <a href="<?php echo linkField( $link, 'url' ); ?>" class="cta theme--<?php the_sub_field('theme'); ?>" <?php echo linkField( $link, 'target' ); ?>>
            <?php else: ?>
            <div class="cta theme--<?php the_sub_field('theme'); ?>">
            <?php endif; ?>
                <div class="cta-inner flex items-center flex-col justify-center">
                    <header>
                        <?php if( get_sub_field('overline') ): ?>
                            <p class="mb-1 overline-1" data-aos="fade-up">
                                <?php the_sub_field('overline'); ?>
                            </p>
                        <?php endif; ?>
                        <h3 class="mb-1">
                            <?php the_sub_field('title'); ?>
                        </h3>
                    </header>

                    <div class="cta-content">
                        <?php the_sub_field('content'); ?>
                    </div>
                    <?php if( isLink( $link ) && linkField( $link, 'text' ) ): ?>
                        <div class="buttons justify-center">
                            <span class="button secondary no-margin">
                                <?php echo linkField( $link, 'text' ); ?>
                            </span>
                        </div>
                    <?php elseif( isLink( $link ) && !linkField( $link, 'text' ) ): ?>
                        <div class="buttons justify-center">
                            <span class="button secondary icon no-margin">
                                <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" viewBox="0 0 48 48"><title>arrow-right</title><g class="arrow-right"><line class="arrow-stem" x1="39.964" y1="23.964" x2="7.964" y2="23.964" stroke-width="3" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" fill="none"/><polyline class="arrowhead" points="28 11.929 40.036 23.964 28 36" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="3"/></g></svg>
                            </span>
                        </div>
                    <?php endif; ?>
                </div>
                <?php if( get_sub_field('theme') == 'image' ): echo img_sizes(get_sub_field('image'), ['default' => 'img_800', 'lazy_load' => true]); endif; ?>
            <?php if( isLink( $link ) ): ?>
            </a>
            <?php else: ?>
            </div>
            <?php endif; ?>
        <?php endwhile; ?>
    </div>
</section>


<?php get_footer(); ?>
