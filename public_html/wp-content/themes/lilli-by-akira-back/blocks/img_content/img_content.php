<?php
// register the block.
acf_register_block_type(array(
    'name'              => 'imagecontentblock',
    'title'             => __('Image / Content Block'),
    'description'       => __('Image / Content Block'),
    'render_callback'   => 'img_content_render_callback',
    'category'          => 'upcore-blocks',
    'icon'              => 'forms', // dashicons, without the leading dashicons-
    'keywords'          => array( 'image, content' ),
    'enqueue_assets' => function(){
        wp_enqueue_script( 'block-acf-googlemap', get_template_directory_uri() . '/assets/js/img_content/img_content.min.js' );
        wp_enqueue_style( 'block-acf-googlemap', get_template_directory_uri() . '/assets/css/img_content/img_content.css' );
    },
    'mode'              => 'preview',
    'supports'          => array(
                                    'align'     => ["wide", "full"],
                                    'anchor'    => true,
                                    'mode'      => false
                                )
));
function img_content_render_callback( $block, $content = '', $is_preview = false ) {
    extract(block_color_variables());

    //WP Align Attribute
    if( $block['align'] ){
        $align = $block['align'];
    } else {
        $align = 'wide';
    }
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
        
        <div class="img-content <?php the_field('layout'); ?><?php if( get_field('images_bottom_mob') ): ?> mob-img-bottom<?php endif; ?><?php echo ' style-' . get_field('block_style'); ?><?php echo ' align' . $align; ?>">
            <div class="img" data-aos="fade-up">
                <?php block_media( get_field('images'), [
                    'img_sizes' => array('default' => 'img_1367', 'page_area' => 41, 'mobile_page_area' => 43),
                    'default_aspect' => '1/1',
                    'slick_dots' => true,
                ]); ?>
            </div>

            <div class="content<?php if( get_field('override_page_theme') ): if( $themeField['disable_overlay'] && $themeField['text_colour'] == 'dark' ): ?> theme--default<?php endif; endif; ?>">
                <div class="content-inner">
                    <header>
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
                    </header>

                    <article class="content-wrap" data-aos="fade-up" data-aos-delay="150"<?php if( get_field('hide_content_on_mobile') ): ?> class="hide-mobile"<?php endif; ?>>
                        <?php the_field('content_content'); ?>
                    </article>
                    
                    <?php block_buttons(get_field('buttons'), [
                        'class' => 'no-margin',
                        'aos' => true, 
                        'aos_delay' => '150'
                    ]); ?>
                </div>
            </div>
        </div>
    </section>
    <?php
}