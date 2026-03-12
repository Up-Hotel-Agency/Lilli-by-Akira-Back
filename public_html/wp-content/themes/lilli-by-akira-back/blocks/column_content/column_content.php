<?php 
// register the block.
acf_register_block_type(array(
    'name'              => 'columncontent',
    'title'             => __('Column Content'),
    'description'       => __('Column Content'),
    'render_callback'   => 'col_content_render_callback',
    'category'          => 'upcore-blocks',
    'icon'              => 'images-alt2', // dashicons, without the leading dashicons-
    'keywords'          => array( 'column', 'content', 'lockup' ),
    'enqueue_style'     => get_template_directory_uri() . '/assets/css/column_content/column_content.css',
    'mode'              => 'preview',
    'supports'          => array(
                                    'align'     => false,
                                    'anchor'    => true,
                                    'mode'      => false,
                                )
));
function col_content_render_callback( $block, $content = '', $is_preview = false ) {
    extract(block_color_variables());
    ?>
    <section
    class="
    row
    container
    <?php if( get_field('mobile_layout') == 'scroll' ): ?>
        nopadd-mob
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
        <?php include get_template_directory() .'/blocks/_block_components/component_bg_media.php'; //Apply background media from ACF row settings ?>

        <div class="column-content justify-center flex-wrap<?php if( get_field('mobile_layout') == 'scroll' ): ?> mobile-scroll<?php endif; ?><?php if( get_field('override_page_theme') ): if( $themeField['disable_overlay'] && $themeField['text_colour'] == 'dark' ): ?> theme--default<?php endif; endif; ?>" data-aos="fade-up">
            <?php while ( have_rows('column') ) : the_row(); ?>
                <div class="content-lockup">
    
                    
                    <?php block_media( get_sub_field('image'), [
                        'img_sizes' => array('default' => 'img_800', 'page_area' => 26, 'mobile_page_area' => 85),
                        'default_aspect' => '4/3',
                        'slick_dots' => false,
                    ]); ?>
                

                    <div class="column-content-content">
                        <?php if( get_sub_field('overline_overline') ): ?>
                            <span class="mb-1 overline-1" data-aos="fade-up">
                                <?php the_sub_field('overline_overline'); ?>
                        </span>
                        <?php endif; ?>

                        <?php if( get_sub_field('title_title') ): ?>
                            <h3 class="mb-6" data-aos="fade-up"><?php the_sub_field('title_title'); ?>
                                <?php if( get_sub_field('subtitle_subtitle') ): ?>
                                    <span class="subtitle" data-aos="fade-up" data-aos-delay="50">
                                        <?php the_sub_field('subtitle_subtitle'); ?>
                                    </span>
                                <?php endif; ?>
                            </h3>
                        <?php endif; ?>

                        <div data-aos="fade-up">    
                            <?php the_sub_field('content_content'); ?>
                        </div>
                        
                        <?php
                        if( have_rows('buttons_buttons') ): ?>
                            <div class="buttons" data-aos="fade-up" data-aos-delay="150">
                                <?php $buttonCount = 1;
                                while ( have_rows('buttons_buttons') ) : the_row(); ?>
                                    <?php
                                    $class = get_sub_field('button_type');
                                    $link = get_sub_field('link_field_link');
                                    if( isLink( $link ) ):
                                    ?>
                                        <a class="button <?php echo $class; ?> icon-position-<?php echo linkField( $link, 'icon_position' ); ?>" href="<?php echo linkField( $link, 'url' ); ?>" <?php echo linkField( $link, 'target' ); ?>>
                                            <span><?php echo linkField( $link, 'text' ); ?></span>
                                            <?php echo linkField( $link, 'icon' ); ?>
                                        </a>
                                    <?php endif; ?>
                                <?php $buttonCount++; endwhile; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </section>
    <?php
}