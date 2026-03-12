<?php 
// register the block.
acf_register_block_type(array(
    'name'              => 'openingtimes',
    'title'             => __('Opening Times'),
    'description'       => __('Opening Times'),
    'render_callback'   => 'opening_times_render_callback',
    'category'          => 'upcore-blocks',
    'icon'              => 'editor-aligncenter', // dashicons, without the leading dashicons-
    'keywords'          => array( 'content' ),
    'enqueue_style'     => get_template_directory_uri() . '/assets/css/opening_times/opening_times.css',
    'supports'          => [ 
                            'align' => false,
                            'align_text' => true 
                            ]
));
function opening_times_render_callback( $block, $content = '', $is_preview = false ) {
    extract(block_color_variables());
    ?>
    <section
    class="
    opening-times
    row 
    container 
    content-block-container
    <?php if(get_field('has_patterned_background')): ?> has-patterned-background<?php endif; ?>
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

       
            <?php if(get_field('custom_logo')): ?>
                <div class="restaurant-logo">
                    <?php echo img_sizes(get_field('custom_logo'), ['default' => 'img_1920', 'lazy_load' => true]); ?>
                </div>
            <?php endif; ?>
            <?php if(have_rows('opening_times')): ?>
                <header>
                    <?php if(get_field('opening_times_title')): ?>
                        <h4><?php echo get_field('opening_times_title'); ?></h4>
                    <?php endif; ?>
                    <?php if(get_field('opening_times_subtitle')): ?>
                        <p class="subtitle"><?php echo get_field('opening_times_subtitle'); ?></p>
                    <?php endif; ?>
                </header>

                <div class="opening-times-info">
                    <?php while(have_rows('opening_times')): the_row(); ?>
                        <div class="date-range-contain">
                            <p class="overline"><?php echo get_sub_field('date_range'); ?></p>
                            <div class="opening-times-types">
                                <?php while(have_rows('times_area')): the_row();?>
                                <div class="type">
                                    <p class="subtitle"><?php echo get_sub_field('area_name'); ?></p>
                                    <h5><?php echo get_sub_field('area_times'); ?></h5>
                                </div>
                                <div class="type-divider"></div>
                                <?php endwhile; ?>
                            </div>
                        </div>
                        <div class="date-range-divider"></div>
                    <?php endwhile; ?>
                </div>
                <?php if(get_field('opening_times_terms_text')): ?>
                    <div class="opening-terms"><p><?php echo get_field('opening_times_terms_text'); ?></p></div>
                <?php endif; ?>
            <?php endif; ?>

    </section>
    <?php

}