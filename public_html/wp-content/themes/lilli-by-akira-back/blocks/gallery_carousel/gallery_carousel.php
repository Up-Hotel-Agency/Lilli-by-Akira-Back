<?php
// register the block.
acf_register_block_type(array(
    'name'              => 'gallerycarousel',
    'title'             => __('Gallery Carousel'),
    'description'       => __('Gallery Carousel'),
    'render_callback'   => 'gallery_carousel_render_callback',
    'category'          => 'upcore-blocks',
    'icon'              => 'slides', // dashicons, without the leading dashicons-
    'keywords'          => array( 'gallery', 'carousel' ),
    'enqueue_script'    => get_template_directory_uri() . '/assets/js/gallery_carousel/gallery_carousel.min.js',
    'enqueue_style'     => get_template_directory_uri() . '/assets/css/gallery_carousel/gallery_carousel.css',
    'mode'              => 'preview',
    'supports'          => array(
                                    'align'     => false,
                                    'anchor'    => true,
                                    'mode'      => false
                                )
));
function gallery_carousel_render_callback( $block, $content = '', $is_preview = false ) {
    extract(block_color_variables());
    ?>
    <section
    class="
    row 
    gallery-carousel-row
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
        
        <div class="gallery-carousel-wrapper<?php if( get_field('override_page_theme') ): if( $themeField['disable_overlay'] && $themeField['text_colour'] == 'dark' ): ?> theme--default<?php endif; endif; ?>" data-aos="fade-up">
             <div class="gallery-carousel js-gallery-carousel">
                <?php while ( have_rows('images_images') ) : the_row(); ?>
                    <?php if (get_sub_field('use_seasonal_images')): ?>
                        <?php $start_ts = DateTime::createFromFormat('d/m/Y', get_sub_field('start_date'))->getTimestamp(); ?>
                        <?php $end_ts = DateTime::createFromFormat('d/m/Y', get_sub_field('end_date'))->getTimestamp(); ?>
                        <?php $current_ts = time(); ?>
                        <?php if (($current_ts >= $start_ts) && ($end_ts <= $end_ts)): ?>
                            <div class="gallery-carousel-slide<?php if( get_sub_field('caption') ): ?> has-caption<?php endif; ?>">
                                <div class="gallery-carousel-slide-img img-abs">
                                    <?php echo img_sizes(get_sub_field('image'), ['default' => 'img_1367', 'page_area' => '42', 'mobile_page_area' => '85', 'lazy_load' => true, 'object_fit' => get_sub_field('image_object_fit')]); ?>
                                </div>
                                <?php if( get_sub_field('caption') ): ?>
                                    <p class="caption mb-0 size-s">
                                        <?php the_sub_field('caption'); ?>
                                    </p>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                    <?php if (!get_sub_field('use_seasonal_images')): ?>
                        <div class="gallery-carousel-slide<?php if( get_sub_field('caption') ): ?> has-caption<?php endif; ?>">
                            <div class="gallery-carousel-slide-img img-abs">
                                <?php echo img_sizes(get_sub_field('image'), ['default' => 'img_1367', 'page_area' => '82', 'mobile_page_area' => '85', 'lazy_load' => true, 'object_fit' => get_sub_field('image_object_fit')]); ?>
                            </div>
                            <?php if( get_sub_field('caption') ): ?>
                                <p class="caption mb-0 size-s">
                                    <?php the_sub_field('caption'); ?>
                                </p>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                <?php endwhile; ?>
            </div>

            <div class="slick-controls flex justify-center items-center">
                <a href="#" class="js-gallery-prev slick-control" title="Previous slide"><svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48"><title>Previous</title><g class="caret-left"><polyline class="arrowhead" points="29.018 36.036 16.982 24 29.018 11.964" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="3"/></g></svg></a>
                <div class="slick-dots gallery-dots"></div>
                <a href="#" class="js-gallery-next slick-control" title="Next slide"><svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48"><title>Next</title><g class="caret-right"><polyline class="arrowhead" points="18.982 11.964 31.018 24 18.982 36.036" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="3"/></g></svg></a>
            </div>
        </div>
    </section>
    <?php
}