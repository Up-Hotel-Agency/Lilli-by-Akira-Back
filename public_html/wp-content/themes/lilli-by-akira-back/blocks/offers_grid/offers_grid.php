<?php 
// register the block.
acf_register_block_type(array(
    'name'              => 'offersgrid',
    'title'             => __('Offers Grid'),
    'description'       => __('Offers Grid'),
    'render_callback'   => 'offers_grid_render_callback',
    'category'          => 'upcore-blocks',
    'icon'              => 'tickets-alt', // dashicons, without the leading dashicons-
    'keywords'          => array( 'offers' ),
    'mode'              => 'preview',
    'supports'          => array(
                                    'align'     => false,
                                    'anchor'    => true,
                                    'mode'      => false
                                ),
    'enqueue_assets' => function(){
        wp_enqueue_style( 'block-acf-cta-blocks', get_template_directory_uri() . '/assets/css/cta_blocks/cta_blocks.css' );
        wp_enqueue_style( 'block-acf-offers-grid', get_template_directory_uri() . '/assets/css/offers_grid/offers_grid.css' );
    }
));
function offers_grid_render_callback( $block, $content = '', $is_preview = false ) {
    extract(block_color_variables());
    ?>
    <section
    class="
    row
    offers-grid
    js-category-filter-group 
    <?php include get_template_directory() . '/blocks/_block_components/component_block_class.php';  //Apply classes from ACF row settings ?>
    <?php if( array_key_exists('className', $block) ): echo ' ' . $block['className']; endif; ?>
    "

    id="<?php if( array_key_exists('anchor', $block) && !empty($block['anchor'])): echo esc_attr($block['anchor']); else: echo $block['id']; endif ?>"
    
    style="
    <?php include get_template_directory() .'/blocks/_block_components/component_block_style.php'; //Apply inline styles and variables from ACF row settings ?>
    <?php set_row_spacing_override_values(); //Apply row spacing override ACF settings ?>
    "

    <?php include get_template_directory() .'/blocks/_block_components/component_block_attributes.php'; //Apply custom attributes based on fields from ACF row settings ?>
    >
        <?php include get_template_directory() .'/blocks/_block_components/component_bg_media.php'; //Apply background media from ACF row settings ?>
        
        <div class="in-page-nav-wrap mb-8">
            <div class="in-page-nav js-category-nav flex flex-wrap justify-center text-center">
                <a href="#" class="active" data-cat="all">All</a>
                <?php $today = date('Ymd');
                $offers_args = array(
                    'posts_per_page' => -1,
                    'post_type' => 'offers',
                    'orderby' => 'name',
                    'order' => 'menu_order',
                    'meta_query' => array(
                        'relation' => 'OR', // Use OR to check either has the expiracy date check box ticked or not
                        array(
                            'key'		=> 'does_this_offer_have_an_expiry_date',
                            'compare'	=> '=',
                            'value'		=> '0',
                        ),
                        array(
                            'relation' => 'AND', // Check start & date conditions and expiracy date ticked
                            array(
                                'key' => 'does_this_offer_have_an_expiry_date', // Check expiracy date ticked
                                'compare' => '=',
                                'value' => '1',
                            ),
                            array(
                                'key' => 'start_date', // Check start date condition
                                'compare' => '<=', // Fetch events with start date lower than or equal to today
                                'value' => $today,
                                'type' => 'DATE', // Ensure proper date comparison
                            ),
                            array(
                                'key' => 'end_date', // Check end date condition
                                'compare' => '>=', // Fetch events with end date greater than or equal to today
                                'value' => $today,
                                'type' => 'DATE', // Ensure proper date comparison
                            ),
                        ),
                    )
                ); 
                
                $tax_query = new WP_Query( $offers_args );
                if ( $tax_query->have_posts() ) :?>
                    <?php while ( $tax_query->have_posts() ) : $tax_query->the_post(); $offer = get_the_ID();
                    $taxonomy = 'offers-categories';
                    $terms = get_the_terms( $offer, $taxonomy ); ?>
                        <?php if( $terms ): foreach ($terms as $term): 
                            if (!in_array($term->slug, $terms_array)) {
                                $terms_array[] = $term->slug;
                                ?><a href="#" data-cat="<?php echo $term->slug; ?>" class="<?php echo $term->slug; ?>"><?php echo $term->name; ?></a><?php
                            }
                        endforeach; endif; ?>
                    <?php endwhile; ?>
                <?php endif; wp_reset_query(); ?>
            </div>
        </div>

        <?php
        $offers_query = new WP_Query( $offers_args );
        if ( $offers_query->have_posts() ) :
            $offersCount = 1; ?>
            <div class="container">
                <div class="cta-blocks" data-aos="fade-up">
                    <?php while ( $offers_query->have_posts() ) : $offers_query->the_post(); $offer = get_the_ID();
                    $taxonomy = 'offers-categories';
                    $terms = get_the_terms( $offer, $taxonomy ); ?>
                        <a href="#"
                        data-type="offer"
                        data-id="<?php echo $offer; ?>"
                        class="
                            js-single-modal-trigger-ajax cta
                            <?php if( has_post_thumbnail() ): ?> theme--image<?php else: ?> theme__card--standard<?php endif; ?>
                            js-category-target all <?php if( $terms ): foreach ($terms as $term): echo $term->slug . " "; endforeach; endif; ?>
                        "
                        data-modal="modal-<?php echo $offersCount; ?>">
                            <div class="cta-inner flex items-center flex-col justify-center">
                                <header>
                                    <?php if( get_field('overline', $offer) ): ?>
                                        <p class="mb-1 overline-1">
                                            <?php the_field('overline', $offer); ?>
                                        </p>
                                    <?php endif; ?>
                                    <h3 class="mb-1">
                                        <?php if( get_field('title', $offer) ): ?>
                                            <?php the_field('title', $offer); ?>
                                        <?php else: ?>
                                            <?php the_title(); ?>
                                        <?php endif; ?>
                                    </h3>
                                </header>

                                <?php if( get_field('subtitle', $offer) ): ?>
                                    <div class="cta-content">
                                        <p><?php the_field('subtitle', $offer); ?></p>
                                    </div>
                                <?php endif; ?>
                                <div class="buttons justify-center">
                                    <span class="button secondary icon no-margin">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" viewBox="0 0 48 48"><title>arrow-right</title><g class="arrow-right"><line class="arrow-stem" x1="39.964" y1="23.964" x2="7.964" y2="23.964" stroke-width="3" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" fill="none"/><polyline class="arrowhead" points="28 11.929 40.036 23.964 28 36" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="3"/></g></svg>
                                    </span>
                                </div>
                            </div>
                            <?php block_media( get_field('offers_media', $offer), [
                                'img_sizes' => array('default' => 'img_1367', 'page_area' => 100, 'mobile_page_area' => 100),
                                'default_aspect' => '1/1',
                                'slick_dots' => false,
                                'dynamic' => false
                            ]); ?>
                        </a>
                    <?php $offersCount++; endwhile; ?>
                </div>
            </div>
        <?php endif; wp_reset_query(); ?>
    </section>
    <?php
}

//Modal for ajax request 

function ajax_load_modal_offers() {
    if ( isset($_REQUEST) ):
       
    if ( isset($_REQUEST['id'])){
        $post_id = $_REQUEST['id'];
    }else{
        return;
    }

    //Modal content 
    ?>
    <div class="modal-images theme--image">
        <?php block_media( get_field('offers_media', $post_id), [
                'img_sizes' => array('default' => 'img_1367', 'page_area' => 100, 'mobile_page_area' => 100),
                'video_autoplay' => true,
                'allow_aspect' => false, 
                'ajax' => true,
        ]); ?>
    </div>
    <div class="modal-content">
    <div class="modal-content-inner">
        <?php if( get_field('overline', $post_id) ): ?>
            <p class="mb-1 overline-1">
                <?php the_field('overline', $post_id); ?>
            </p>
        <?php endif; ?>
        <h2 class="h1">
            <?php if( get_field('title', $offer) ): ?>
                <?php the_field('title', $post_id); ?>
            <?php else: ?>
                <?php echo get_the_title( $post_id ); ?>
            <?php endif; ?>
            <?php if( get_field('subtitle', $post_id) ): ?>
                <span class="subtitle">
                    <?php the_field('subtitle', $post_id); ?>
                </span>
            <?php endif; ?>
        </h2>
        <div class="flex offers-actions mb-12 xs:flex-wrap">
            <?php block_buttons(get_field('link_field', $post_id), [
                'class' => 'button primary no-margin '
            ]); ?>
            <div class="post-share flex items-center">
                <strong>Share</strong>
                <a class="button icon secondary no-margin size-s" href="#" onclick="window.open('http://www.facebook.com/sharer.php?s=100&amp;p[url]=<?php echo get_the_permalink( get_field('offers_page', 'options') ); ?>&amp;&p[images][0]=<?php $src = wp_get_attachment_image_src( get_post_thumbnail_id($post_id), array( 300,300 ), false, '' ); echo $src[0]; ?>', 'sharer', 'toolbar=0,status=0,width=626,height=436');;return false;" title="Share on Facebook">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48"><title>facebook</title><path class="facebook" d="M34.107,3.567a45.739,45.739,0,0,0-5.334-.281c-5.288,0-8.914,3.228-8.914,9.148v5.1H13.893v6.925h5.966V42.216h7.159V24.459H32.96l.913-6.925H27.018V13.112c0-1.989.538-3.369,3.416-3.369h3.673Z" fill="currentColor"/></svg>
                </a>
                <a class="button icon secondary no-margin size-s" href="#" onclick="window.open('http://twitter.com/share?url=<?php echo get_the_permalink( get_field('offers_page', 'options') ); ?>&text=<?php echo urlencode(get_the_title($post_id)); ?>', 'sharer', 'toolbar=0,status=0,width=626,height=436');return false;" title="Share on X">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><title>twitter</title> <path d="M17.1761 4H19.9362L13.9061 10.7774L21 20H15.4456L11.0951 14.4066L6.11723 20H3.35544L9.80517 12.7508L3 4H8.69545L12.6279 9.11262L17.1761 4ZM16.2073 18.3754H17.7368L7.86441 5.53928H6.2232L16.2073 18.3754Z" fill="currentColor"/> </svg>
                </a>
                <a class="button icon secondary no-margin size-s" href="#" onclick="window.open('https://www.linkedin.com/shareArticle?mini=true&url=<?php echo get_the_permalink( get_field('offers_page', 'options') ); ?>', 'sharer', 'toolbar=0,status=0,width=626,height=436');;return false;" title="Share on LinkedIn">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48"><title>linkedin</title><g class="linkedin"><rect x="7.435" y="17.44" width="7.298" height="21.916" fill="currentColor"/><path d="M15.2,10.673a3.763,3.763,0,0,0-4.069-3.782,3.8,3.8,0,0,0-4.114,3.782,3.762,3.762,0,0,0,4.025,3.781h.045A3.777,3.777,0,0,0,15.2,10.673Z" fill="currentColor"/><path d="M40.985,26.8c0-6.723-3.583-9.864-8.382-9.864a7.222,7.222,0,0,0-6.613,3.694h.045V17.44H18.759s.088,2.057,0,21.916h7.276V27.127a5.489,5.489,0,0,1,.243-1.792,3.988,3.988,0,0,1,3.737-2.654c2.632,0,3.694,2.013,3.694,4.954V39.356h7.276Z" fill="currentColor"/></g></svg>
                </a>
            </div>
        </div>
        <?php the_field('intro_content', $post_id); ?>
    </div>
    </div>


    <?php

    endif;
    die();
}
add_action( 'wp_ajax_get_offer_modal', 'ajax_load_modal_offers' );
add_action( 'wp_ajax_nopriv_get_offer_modal', 'ajax_load_modal_offers' );
