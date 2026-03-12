<?php 
// register the block.
acf_register_block_type(array(
    'name'              => 'offerslisting',
    'title'             => __('Offers Listing'),
    'description'       => __('Offers Listing'),
    'render_callback'   => 'offers_listing_render_callback',
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
        wp_enqueue_style( 'block-acf-offers-grid', get_template_directory_uri() . '/assets/css/offers_grid/offers_grid.css' );
        wp_enqueue_style( 'block-acf-image-content-block', get_template_directory_uri() . '/assets/css/img_content/img_content.css' );
    }
));
function offers_listing_render_callback( $block, $content = '', $is_preview = false ) {
    extract(block_color_variables());
    ?>
    <section
    class="
    row 
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
        
        <?php
        $today = date('Ymd');
        $args = array(
            'posts_per_page' => -1,
            'post_type' => 'offers',
            'orderby' => 'name',
            'order' => 'menu_order',
            'meta_query' => array(
                'relation' => 'OR', // Use OR to check either start date or end date conditions
                array(
                    'key'		=> 'does_this_offer_have_an_expiry_date',
                    'compare'	=> '=',
                    'value'		=> '0',
                ),
                array(
                    'relation' => 'AND', // Check start date condition
                    array(
                        'key' => 'does_this_offer_have_an_expiry_date', // Check end date condition
                        'compare' => '=', // Only include if 'dates__times_end_date' is not set
                        'value' => '1',
                    ),
                    array(
                        'key' => 'start_date', // Check end date condition
                        'compare' => '<=', // Fetch events with end date greater than or equal to today
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
        $the_query = new WP_Query( $args );
        if ( $the_query->have_posts() ) :
            $offersCount = 1;
            while ( $the_query->have_posts() ) : $the_query->the_post(); $offer = get_the_ID(); ?>
                <div class="img-content container spacing <?php if( $offersCount % 2 ): ?>text-image<?php else: ?>image-text<?php endif; ?>">
                    <div class="img" data-aos="fade-up">
                        <?php block_media( get_field('offers_media', $offer), [
                            'img_sizes' => array('default' => 'img_800', 'page_area' => 100, 'mobile_page_area' => 100),
                            'default_aspect' => '4/3',
                            'slick_dots' => true,
                        ]); ?>
                    </div>

                    <div class="content">
                        <div class="content-inner">
                            <header>
                                <?php if( get_field('overline', $offer) ): ?>
                                    <p class="mb-1 overline-1" data-aos="fade-up">
                                        <?php the_field('overline', $offer); ?>
                                    </p>
                                <?php endif; ?>

                                <h2 data-aos="fade-up">
                                    <?php if( get_field('title', $offer) ): ?>
                                        <?php the_field('title', $offer); ?>
                                    <?php else: ?>
                                        <?php the_title(); ?>
                                    <?php endif; ?>
                                    <?php if(get_field('subtitle', $offer)): ?>
                                        <span class="subtitle"><?php the_field('subtitle', $offer); ?></span>
                                    <?php endif; ?>
                                </h2>
                            </header>

                            <article class="content-wrap" data-aos="fade-up" data-aos-delay="150"<?php if( get_field('hide_content_on_mobile') ): ?> class="hide-mobile"<?php endif; ?>>
                                <?php the_field('intro_content', $offer); ?>
                            </article>
                            
                            <div class="buttons" data-aos="fade-up" data-aos-delay="150">
                                <a class="button secondary" href="<?php echo get_the_permalink(); ?>">
                                    More Information
                                </a>
                                <?php block_buttons(get_field('link_field', $post_id), [
                                    'class' => 'button primary '
                                ]); ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php $offersCount++; endwhile;
        endif; wp_reset_query(); ?>
    </section>
    <?php
}