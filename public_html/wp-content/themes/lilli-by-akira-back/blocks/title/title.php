<?php 
// register the block.
acf_register_block_type(array(
    'name'              => 'title',
    'title'             => __('Title'),
    'description'       => __('Title'),
    'render_callback'   => 'title_render_callback',
    'category'          => 'upcore-blocks',
    'icon'              => 'editor-aligncenter', // dashicons, without the leading dashicons-
    'keywords'          => array( 'title' ),
    'enqueue_style'     => get_template_directory_uri() . '/assets/css/content/content.css',
    'supports'          => [ 'align' => false, 'align_text' => true ]
));
function title_render_callback( $block, $content = '', $is_preview = false ) {
    extract(block_color_variables());
    ?>
    <section
    class="
    row
    container 
    title-block
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
            <?php if( get_field('title') ): ?>
                <h2 data-aos="fade-up"><?php the_field('title'); ?></h2>
                <hr class="centered mb-0" data-aos="fade-up">
            <?php endif; ?>
        </div>
    </section>
    <?php
}