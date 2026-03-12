<?php 
// register the block.
acf_register_block_type(array(
    'name'              => 'content',
    'title'             => __('Content'),
    'description'       => __('Content'),
    'render_callback'   => 'content_render_callback',
    'category'          => 'upcore-blocks',
    'icon'              => 'editor-aligncenter', // dashicons, without the leading dashicons-
    'keywords'          => array( 'content' ),
    'enqueue_style'     => get_template_directory_uri() . '/assets/css/content/content.css',
    'supports'          => [ 
                            'align' => false,
                            'align_text' => true 
                            ]
));
function content_render_callback( $block, $content = '', $is_preview = false ) {
    extract(block_color_variables());
    ?>
    <section
    class="
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

        <div class="content-block text-align-<?php echo $block['align_text']; ?><?php if( get_field('override_page_theme') ): if( $themeField['disable_overlay'] && $themeField['text_colour'] == 'dark' ): ?> theme--default<?php endif; endif; ?>">
            <?php if( get_field('overline_overline') ): ?>
                <p class="mb-1 overline-1" data-aos="fade-up">
                    <?php the_field('overline_overline'); ?>
                </p>
            <?php endif; ?>
            <?php if( get_field('title_title') ): ?>
                <h2 data-aos="fade-up"><?php the_field('title_title'); ?>
                    <?php if( get_field('subtitle_subtitle') ): ?>
                        <span class="subtitle" data-aos="fade-up" data-aos-delay="50">
                            <?php the_field('subtitle_subtitle'); ?>
                        </span>
                    <?php endif; ?>
                </h2>
            <?php endif; ?>
            <?php if( get_field('content_content') ): ?>
                <div data-aos="fade-up">
                    <?php the_field('content_content'); ?>
                </div>
            <?php endif; ?>

            <?php block_buttons(get_field('buttons'), [
                'aos' => true, 
                'aos_delay' => '200'
            ]); ?>
        </div>
    </section>
    <?php

}