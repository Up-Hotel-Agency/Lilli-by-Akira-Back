<?php
// register the block.
acf_register_block_type(array(
    'name'              => 'contactcontentblock',
    'title'             => __('Contact / Content Block'),
    'description'       => __('Contact / Content Block'),
    'render_callback'   => 'contact_content_render_callback',
    'category'          => 'upcore-blocks',
    'icon'              => 'forms', // dashicons, without the leading dashicons-
    'keywords'          => array( 'contact, content' ),
    'enqueue_style'     => get_template_directory_uri() . '/assets/css/contact_content/contact_content.css',
    'mode'              => 'preview',
    'supports'          => array(
                                    'align'     => false,
                                    'anchor'    => true,
                                    'mode'      => false
                                )
));
function contact_content_render_callback( $block, $content = '', $is_preview = false ) {
    extract(block_color_variables());
    // the img-content-row class below is for vogue
    ?>
    <section
    class="
    row 
    form-content-row
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

        <div class="form-content container <?php the_field('layout'); ?> mob-form-bottom">
            <div class="form" data-aos="fade-up">
                <?php if(get_field('form_id')) {
                    echo do_shortcode('[gravityform id="'.get_field('form_id').'" title="false"]');
                } ?>
            </div>

            <div class="content<?php if( get_field('override_page_theme') ): if( $themeField['disable_overlay'] && $themeField['text_colour'] == 'dark' ): ?> theme--default<?php endif; endif; ?>">
                <div class="content-inner">
                    <header>
                        <?php if( get_field('overline_overline') ): ?>
                            <p class="mb-1 overline" data-aos="fade-up">
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
                    
                    <?php if( have_rows('buttons_buttons') ): ?>
                        <div class="buttons" data-aos="fade-up" data-aos-delay="150">
                            <?php $buttonCount = 1;
                            while ( have_rows('buttons_buttons') ) : the_row(); ?>
                                <?php
                                $class = get_sub_field('button_type');
                                $link = get_sub_field('link_field_link');
                                if( isLink( $link ) ):
                                ?>

                                    <?php if($class == 'secondary') { ?>
                                        <a href="<?php echo linkField( $link, 'url' ); ?>" class="button tertiary stripped" <?php echo linkField( $link, 'target' ); ?>>
                                            <span class="text"><?php echo linkField( $link, 'text' ); ?></span><span class="button icon secondary stripped"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.158 6.315L14.842 12 9.158 17.685"/></svg></span>
                                        </a>
                                    <?php } else { ?>
                                        <a class="button <?php echo $class; ?>" href="<?php echo linkField( $link, 'url' ); ?>" <?php echo linkField( $link, 'target' ); ?>>
                                            <?php echo linkField( $link, 'text' ); ?>
                                        </a>
                                    <?php } ?>
                                <?php endif; ?>
                            <?php $buttonCount++; endwhile; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
    <?php
}