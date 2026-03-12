<?php
get_header();

// Offers
if(get_field('does_this_offer_have_an_expiry_date')){
    $date = get_field('end_date');
    $todayDate = date("Ymd");
    if($date < $todayDate){
        http_response_code(404);
        header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found", true, 404);
        include get_template_directory()."/404.php";
        get_footer();
        die();
    }
}

while ( have_posts() ) : the_post();
if( get_offer_single_type() == 'offer_1' ) {
    
    //Enqueue CTA Blocks styling
    wp_enqueue_style( 'block-acf-cta-blocks', get_template_directory_uri() . '/assets/css/cta_blocks/cta_blocks.css' );
    ?>

    <main class="page-container" id="scroll-target">

        <section
        class="row container banner-block flex justify-center items-center<?php if( has_post_thumbnail() ): ?> theme--image<?php endif; ?>"
        >
            <?php if( has_post_thumbnail() ): ?>
            <div class="block-bg-img">
                <?php block_media( get_field('offers_media'), [
                    'img_sizes' => array('default' => 'img_1367', 'page_area' => 100, 'mobile_page_area' => 100),
                    'dynamic_mobile' => false,
                    'video_autoplay' => true,
                    'allow_aspect' => false 
                ]); ?>
            </div>
            <?php endif; ?>
            <div class="banner-content-block">
                <?php if( get_field('offers_page', 'options') ): ?>
                    <a class="button icon-left back no-margin-right minor mb-3" href="<?php echo get_the_permalink( get_field('offers_page', 'options') ); ?>">
                        <svg width="27" height="27" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48"><title>caret-left</title><g class="caret-left"><polyline class="arrowhead" points="29.018 36.036 16.982 24 29.018 11.964" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="3"/></g></svg>
                        Back to Special Offers
                    </a>
                <?php endif; ?>
                <?php if( get_field('overline') ): ?>
                    <p class="mb-2 overline-1">
                        <?php the_field('overline'); ?>
                    </p>
                <?php endif; ?>
                <h1 class="mb-12">
                    <?php if( get_field('title') ): ?>
                        <?php the_field('title'); ?>
                    <?php else: ?>
                        <?php the_title(); ?>
                    <?php endif; ?>
                    <?php if( get_field('subtitle') ): ?>
                        <span class="subtitle">
                            <?php the_field('subtitle'); ?>
                        </span>
                    <?php endif; ?>
                </h1>
                <?php if( get_field('link_field') ): ?>
                    <div class="buttons centered no-margin">
                        <?php block_buttons(get_field('link_field'), [
                            'class' => 'button',
                            'type'  => 'primary'
                        ]); ?>
                    </div>
                <?php endif; ?>
            </div>
        </section>

        <section class="container offer-share">
            <div class="bordered flex items-center justify-end xs:justify-start">
                <div class="post-share flex items-center">
                    <strong>Share This Offer</strong>
                    <a class="button icon secondary no-margin size-s" href="#" onclick="window.open('http://www.facebook.com/sharer.php?s=100&amp;p[url]=<?php the_permalink(); ?>&amp;&p[images][0]=<?php $src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), array( 300,300 ), false, '' ); echo $src[0]; ?>', 'sharer', 'toolbar=0,status=0,width=626,height=436');;return false;" title="Share on Facebook">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48"><title>facebook</title><path class="facebook" d="M34.107,3.567a45.739,45.739,0,0,0-5.334-.281c-5.288,0-8.914,3.228-8.914,9.148v5.1H13.893v6.925h5.966V42.216h7.159V24.459H32.96l.913-6.925H27.018V13.112c0-1.989.538-3.369,3.416-3.369h3.673Z" fill="currentColor"/></svg>
                    </a>
                    <a class="button icon secondary no-margin size-s" href="#" onclick="window.open('http://twitter.com/share?url=<?php the_permalink(); ?>&text=<?php echo urlencode(get_the_title()); ?>', 'sharer', 'toolbar=0,status=0,width=626,height=436');return false;" title="Share on Twitter">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path d="M17.1761 4H19.9362L13.9061 10.7774L21 20H15.4456L11.0951 14.4066L6.11723 20H3.35544L9.80517 12.7508L3 4H8.69545L12.6279 9.11262L17.1761 4ZM16.2073 18.3754H17.7368L7.86441 5.53928H6.2232L16.2073 18.3754Z" fill="currentColor"/>
                    </svg>
                    </a>
                    <a class="button icon secondary no-margin size-s" href="#" onclick="window.open('https://www.linkedin.com/shareArticle?mini=true&url=<?php the_permalink(); ?>', 'sharer', 'toolbar=0,status=0,width=626,height=436');;return false;" title="Share on LinkedIn">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48"><title>linkedin</title><g class="linkedin"><rect x="7.435" y="17.44" width="7.298" height="21.916" fill="currentColor"/><path d="M15.2,10.673a3.763,3.763,0,0,0-4.069-3.782,3.8,3.8,0,0,0-4.114,3.782,3.762,3.762,0,0,0,4.025,3.781h.045A3.777,3.777,0,0,0,15.2,10.673Z" fill="currentColor"/><path d="M40.985,26.8c0-6.723-3.583-9.864-8.382-9.864a7.222,7.222,0,0,0-6.613,3.694h.045V17.44H18.759s.088,2.057,0,21.916h7.276V27.127a5.489,5.489,0,0,1,.243-1.792,3.988,3.988,0,0,1,3.737-2.654c2.632,0,3.694,2.013,3.694,4.954V39.356h7.276Z" fill="currentColor"/></g></svg>
                    </a>
                </div>
            </div>
        </section>

        <?php the_content(); ?>

        <section class="container row more-articles">
            <header data-aos="fade-up" class="text-center">
                <p class="mb-1 overline-1" data-aos="fade-up">
                    Keep Exploring
                </p>
                <h3 class="mb-10">More Special Offers</h3>
            </header>
            <div data-aos="fade-up" class="cta-blocks flex flex-wrap justify-center">
                <?php
                $currentID = get_the_ID();
                $args = array(
                    'posts_per_page' => 3,
                    'post_type' => 'offers',
                    'post__not_in' => array($currentID)
                );
                $the_query = new WP_Query( $args );
                if ( $the_query->have_posts() ) :
                    while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
                        <a href="<?php the_permalink(); ?>" class="cta theme--image">
                            <div class="cta-inner flex items-center flex-col justify-center">
                                <header>
                                    <?php if( get_field('overline') ): ?>
                                        <p class="mb-1 overline-1" data-aos="fade-up">
                                            <?php the_field('overline'); ?>
                                        </p>
                                    <?php endif; ?>
                                    <h3 class="mb-1">
                                        <?php if( get_field('title') ): ?>
                                            <?php the_field('title'); ?>
                                        <?php else: ?>
                                            <?php the_title(); ?>
                                        <?php endif; ?>
                                    </h3>
                                </header>

                                <?php if( get_field('subtitle') ): ?>
                                    <div class="cta-content">
                                        <p><?php the_field('subtitle'); ?></p>
                                    </div>
                                <?php endif; ?>
                                <div class="buttons justify-center">
                                    <span class="button secondary icon no-margin">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" viewBox="0 0 48 48"><title>arrow-right</title><g class="arrow-right"><line class="arrow-stem" x1="39.964" y1="23.964" x2="7.964" y2="23.964" stroke-width="3" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" fill="none"/><polyline class="arrowhead" points="28 11.929 40.036 23.964 28 36" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="3"/></g></svg>
                                    </span>
                                </div>
                            </div>

                            <?php block_media( get_field('offers_media'), [
                                'img_sizes' => array('default' => 'img_1367', 'page_area' => 100, 'mobile_page_area' => 100),
                                'dynamic' => false,
                                'aspect' => false,
                            ]); ?>
                     
                        </a>
                    <?php endwhile;
                endif; wp_reset_query(); ?>
            </div>
        </section>
    </main>

<?php }
if( get_offer_single_type() == 'offer_2' ) { ?>

    <div id="scroll-target" class="single-modal forced">
        <a href="<?php echo get_the_permalink( get_field('offers_page', 'options') ); ?>" class="modal-close flex justify-center items-center">
            <svg width="28" height="28" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><title>Close</title><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.755 19.245L19.245 4.755"/><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19.245 19.245L4.755 4.755"/></svg>
        </a>
        <div class="single-modal-inner">
            <div class="modal-images theme--image">
                <?php block_media( get_field('offers_media'), [
                    'img_sizes' => array('default' => 'img_1367', 'page_area' => 100, 'mobile_page_area' => 100),
                    'video_autoplay' => true,
                    'allow_aspect' => false 
                ]); ?>
            </div>
            <div class="modal-content">
                <div class="modal-content-inner">
                    <?php if( get_field('overline') ): ?>
                        <p class="mb-1 overline-1">
                            <?php the_field('overline'); ?>
                        </p>
                    <?php endif; ?>
                    <h2 class="h1">
                        <?php if( get_field('title') ): ?>
                            <?php the_field('title'); ?>
                        <?php else: ?>
                            <?php the_title(); ?>
                        <?php endif; ?>
                        <?php if( get_field('subtitle') ): ?>
                            <span class="subtitle">
                                <?php the_field('subtitle'); ?>
                            </span>
                        <?php endif; ?>
                    </h2>
                    <div class="flex offers-actions mb-12 xs:flex-wrap">
                        <?php block_buttons(get_field('link_field'), [
                            'class' => 'buttons centered no-margin',
                            'type'  => 'primary'
                        ]); ?>
                        <div class="post-share flex items-center">
                            <strong>Share</strong>
                            <?php
                                $permalink = urlencode(get_permalink());
                                $thumbnail = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full');
                                $image_url = $thumbnail ? urlencode($thumbnail[0]) : '';
                            ?>
                            <a class="button icon secondary no-margin size-s" href="#" onclick="window.open( 'https://www.facebook.com/sharer/sharer.php?u=<?php echo $permalink; ?><?php echo $image_url ? '&picture=' . $image_url : ''; ?>', 'sharer', 'toolbar=0,status=0,width=626,height=436' ); return false;" title="Share on Facebook">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48">
                                    <title>facebook</title>
                                    <path class="facebook" d="M34.107,3.567a45.739,45.739,0,0,0-5.334-.281c-5.288,0-8.914,3.228-8.914,9.148v5.1H13.893v6.925h5.966V42.216h7.159V24.459H32.96l.913-6.925H27.018V13.112c0-1.989.538-3.369,3.416-3.369h3.673Z" fill="currentColor"/>
                                </svg>
                            </a>

                            <?php
                                $title = urlencode(get_the_title());
                            ?>
                            <a class="button icon secondary no-margin size-s" href="#" onclick="window.open( 'https://twitter.com/share?url=<?php echo $permalink; ?>&text=<?php echo $title; ?>', 'sharer', 'toolbar=0,status=0,width=626,height=436' ); return false;" title="Share on Twitter">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M17.1761 4H19.9362L13.9061 10.7774L21 20H15.4456L11.0951 14.4066L6.11723 20H3.35544L9.80517 12.7508L3 4H8.69545L12.6279 9.11262L17.1761 4ZM16.2073 18.3754H17.7368L7.86441 5.53928H6.2232L16.2073 18.3754Z" fill="currentColor"/>
                                </svg>
                            </a>

                            <a class="button icon secondary no-margin size-s" href="#" onclick="window.open( 'https://www.linkedin.com/shareArticle?mini=true&url=<?php echo $permalink; ?>', 'sharer', 'toolbar=0,status=0,width=626,height=436' ); return false;" title="Share on LinkedIn">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48">
                                    <title>linkedin</title>
                                    <g class="linkedin">
                                        <rect x="7.435" y="17.44" width="7.298" height="21.916" fill="currentColor"/>
                                        <path d="M15.2,10.673a3.763,3.763,0,0,0-4.069-3.782,3.8,3.8,0,0,0-4.114,3.782,3.762,3.762,0,0,0,4.025,3.781h.045A3.777,3.777,0,0,0,15.2,10.673Z" fill="currentColor"/>
                                        <path d="M40.985,26.8c0-6.723-3.583-9.864-8.382-9.864a7.222,7.222,0,0,0-6.613,3.694h.045V17.44H18.759s.088,2.057,0,21.916h7.276V27.127a5.489,5.489,0,0,1,.243-1.792,3.988,3.988,0,0,1,3.737-2.654c2.632,0,3.694,2.013,3.694,4.954V39.356h7.276Z" fill="currentColor"/>
                                    </g>
                                </svg>
                            </a>
                        </div>
                    </div>
                    <?php the_field('intro_content'); ?>
                </div>
            </div>
        </div>
    </div>

<?php }

endwhile;

get_footer();