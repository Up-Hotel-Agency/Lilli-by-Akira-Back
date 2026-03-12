<?php 
// register the block.
acf_register_block_type(array(
    'name'              => 'accordion',
    'title'             => __('Accordion'),
    'description'       => __('Accordion'),
    'render_callback'   => 'accordion_render_callback',
    'category'          => 'upcore-blocks',
    'icon'              => 'menu-alt', // dashicons, without the leading dashicons-
    'keywords'          => array( 'accordion' ),
    'enqueue_script'    => get_template_directory_uri() . '/assets/js/accordion/accordion.min.js',
    'enqueue_style'     => get_template_directory_uri() . '/assets/css/accordion/accordion.css',
    'mode'              => 'preview',
    'supports'          => array(
                                    'align'     => false,
                                    'anchor'    => true,
                                    'mode'      => false
                                )
));
function accordion_render_callback( $block, $content = '', $is_preview = false ) {
    extract(block_color_variables());
        ?>
    <section
    class="
    row
    container
    <?php if( get_field('display_content') ): ?> 
    accordion-lockup
    <?php the_field('layout'); ?>
    <?php endif; ?>
    
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
       <?php include get_template_directory() .'/blocks/_block_components/component_bg_media.php'; ?>
    
        <?php if( get_field('display_content') ): ?>
            <div class="content-lockup-wrapper<?php if( get_field('override_page_theme') ): if( $themeField['disable_overlay'] && $themeField['text_colour'] == 'dark' ): ?> theme--default<?php endif; endif; ?>">
                <div class="content-lockup">
                    <?php if( get_field('overline_overline') ): ?>
                        <p class="mb-1 overline-1" data-aos="fade-up">
                            <?php the_field('overline_overline'); ?>
                        </p>
                    <?php endif; ?>

                    <?php if( get_field('title_title') ): ?>
                        <h2 class="mb-6" data-aos="fade-up"><?php the_field('title_title'); ?>
                            <?php if( get_field('subtitle_subtitle') ): ?>
                                <span class="subtitle" data-aos="fade-up" data-aos-delay="50">
                                    <?php the_field('subtitle_subtitle'); ?>
                                </span>
                            <?php endif; ?>
                        </h2>
                    <?php endif; ?>

                    <div data-aos="fade-up">    
                        <?php the_field('content_content'); ?>
                    </div>
                    
                    <?php block_buttons(get_field('buttons'), [
                        'class' => 'no-margin',
                        'aos' => true, 
                        'aos_delay' => '150'
                    ]); ?>
                </div>
            </div>
        <?php endif; ?>
        <div class="accordion<?php if( get_field('override_page_theme') ): if( $themeField['disable_overlay'] && $themeField['text_colour'] == 'dark' ): ?> theme--default<?php endif; endif; ?>" data-aos="fade-up">
            <?php while ( have_rows('questions') ) : the_row(); ?>
                <div class="accordion-group">
                    <div class="accordion-title has-icon">
                        <h4>
                            <?php the_sub_field('question'); ?>
                            <span class="button secondary icon"><svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48"><title>caret-down</title><g class="caret-down"><polyline class="arrowhead" points="36.036 18.982 24 31.018 11.964 18.982" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="3"/></g></svg></span>
                        </h4>
                    </div>
                    <div class="accordion-content"><?php the_sub_field('answer'); ?></div>
                </div>
            <?php endwhile; ?>
        </div>
    </section>
    <?php
}