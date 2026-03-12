<?php
// register the block.
acf_register_block_type(array(
    'name'              => 'gridlist',
    'title'             => __('Grid List'),
    'description'       => __('Grid List'),
    'render_callback'   => 'grid_list_render_callback',
    'category'          => 'upcore-blocks',
    'icon'              => 'grid-view', // dashicons, without the leading dashicons-
    'keywords'          => array( 'list', 'grid' ),
    'mode'              => 'preview',
    'supports'          => array(
                                'align'     => false,
                                'anchor'    => true,
                                'mode'      => false
                                ),
    'enqueue_assets' => function(){
        wp_enqueue_style( 'block-acf-grid-list', get_template_directory_uri() . '/assets/css/grid_list/grid_list.css' );
        wp_enqueue_style( 'block-acf-featured-list', get_template_directory_uri() . '/assets/css/featured_list/featured_list.css' );
    }
));
function grid_list_render_callback( $block, $content = '', $is_preview = false ) {
    extract(block_color_variables());

    $counterType = get_field('counter_type');
    ?>
    <section
    class="
    row 
    container
    <?php if( get_field('mobile_layout') == 'scroll' ): ?> nopadd-mob<?php endif; ?>
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

        <div class="grid-list grid-columns-<?php echo get_field('number_of_columns'); ?><?php if( get_field('mobile_layout') == 'scroll' ): ?> mobile-scroll<?php endif; ?><?php if( get_field('override_page_theme') ): if( $themeField['disable_overlay'] && $themeField['text_colour'] == 'dark' ): ?> theme--default<?php endif; endif; ?>">
            <?php $listCount = 1; while ( have_rows('list_items') ) : the_row(); ?>
                <div class="grid-list-item flex flex-col items-center" data-aos="fade-up">
                    <?php if($counterType != 'none') { ?>
                        <div class="list-counter flex items-center mb-4 <?php echo $counterType; ?>">
                            <?php if( $counterType == 'numbers' ): ?>
                                <span class="number"><?php if( $listCount < '10' ): echo '0'; endif; echo $listCount; ?></span>
                            <?php else: ?>
                                <?php the_sub_field('autoloaded_icon'); ?>
                            <?php endif; ?>
                        </div>
                    <?php } ?>
                    <div class="list-content">
                        <h4 class=" list-content-title no-margin"><?php the_sub_field('title'); ?></h4>
                        <p class="list-content-content size-s mb-0"><?php the_sub_field('content'); ?></p>
                    </div>
                </div>
            <?php $listCount++; endwhile; ?>
        </div>
    </section>
    <?php
}