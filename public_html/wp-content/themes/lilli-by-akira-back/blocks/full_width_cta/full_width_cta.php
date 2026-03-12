<?php
// register the block.
acf_register_block_type(array(
    'name'              => 'fullwidthcta',
    'title'             => __('Full Width CTA'),
    'description'       => __('Full Width CTA'),
    'render_callback'   => 'full_width_cta_render_callback',
    'category'          => 'upcore-blocks',
    'icon'              => 'editor-expand', // dashicons, without the leading dashicons-
    'keywords'          => array( 'cta', 'call to action', 'full', 'width' ),
    'mode'              => 'preview',
    'supports'          => array(
                                    'align'     => false,
                                    'anchor'    => true,
                                    'mode'      => false
                                ),
    'enqueue_assets' => function(){
        wp_enqueue_style( 'block-acf-full-width-cta', get_template_directory_uri() . '/assets/css/full_width_cta/full_width_cta.css' );
        wp_enqueue_style( 'block-acf-cta', get_template_directory_uri() . '/assets/css/cta_blocks/cta_blocks.css' );
    }
));
function full_width_cta_render_callback( $block, $content = '', $is_preview = false ) {
    extract(block_color_variables());
    ?>
    <section
    class="
    row 
    full-width-cta
    <?php if( get_field('contained') ):?> container<?php endif; ?>
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
        
        <div class="theme--image full-width-cta__wrapper flex items-center justify-center not-square img-abs" data-aos="fade-up">
            <div class="full-width-cta__inner text-center flex items-center flex-col justify-center">
                <header>
                    <?php if( get_field('overline_overline') ): ?>
                        <p class="mb-1 overline-1">
                            <?php the_field('overline_overline'); ?>
                        </p>
                    <?php endif; ?>

                    <?php if( get_field('title_title') ): ?>
                        <h2 class="h1"><?php the_field('title_title'); ?>
                            <?php if( get_field('subtitle_subtitle') ): ?><span class="subtitle"><?php the_field('subtitle_subtitle'); ?></span><?php endif; ?>
                        </h2>
                    <?php endif; ?>
                </header>

                <?php if( get_field('content_content') || have_rows('buttons_buttons') ): ?>
                    <article>
                        <?php the_field('content_content'); ?>

                        <?php block_buttons(get_field('buttons'), [
                            'class' => 'no-margin centered'
                        ]); ?>
                    </article>    
                <?php endif; ?>

            </div>
            <?php if( get_field('contained') ):
                //Serve smaller page areas if set to contained
                echo img_sizes(get_field('image'), ['default' => 'img_1920', 'page_area' => '83', 'mobile_page_area' => '85', 'lazy_load' => true]);
            else :
                //Serve full-width page areas if not set to contained
                echo img_sizes(get_field('image'), ['default' => 'img_1920', 'page_area' => '100', 'tablet_page_area' => '100', 'mobile_page_area' => '100', 'lazy_load' => true]);
            endif; ?>
        </div>
    </section>
    <?php
}