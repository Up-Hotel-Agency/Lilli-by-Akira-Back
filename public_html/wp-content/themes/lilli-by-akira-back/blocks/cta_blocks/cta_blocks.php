<?php 
// register the block.
acf_register_block_type(array(
    'name'              => 'ctablocks',
    'title'             => __('CTA Blocks'),
    'description'       => __('CTA Blocks'),
    'render_callback'   => 'cta_blocks_render_callback',
    'category'          => 'upcore-blocks',
    'icon'              => 'images-alt2', // dashicons, without the leading dashicons-
    'keywords'          => array( 'cta', 'blocks', 'call to action' ),
    'enqueue_script'    => get_template_directory_uri() . '/assets/js/cta_blocks/cta_blocks.min.js',
    'enqueue_style'     => get_template_directory_uri() . '/assets/css/cta_blocks/cta_blocks.css',
    'mode'              => 'preview',
    'supports'          => array(
                                    'align'     => false,
                                    'anchor'    => true,
                                    'mode'      => true
                                )
));
function cta_blocks_render_callback( $block, $content = '', $is_preview = false ) {
    extract(block_color_variables());
    ?>
    <section
    class="
    cta-blocks-class <?php if(get_field('carousel_mode')): ?> carousel-mode <?php endif; ?>
    row 
    container
    <?php include get_template_directory() . '/blocks/_block_components/component_block_class.php';  //Apply classes from ACF row settings ?>
    <?php if( get_field('mobile_layout') == 'scroll' ): ?> nopadd-mob<?php endif; ?>
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

         <?php if(get_field("title") || get_field('subtitle')): ?>

            <header class="header-section">
                <?php if(get_field('title')): ?>
                    <div class="header-item flex">
                        <h2 class="no-margin"><?php echo get_field('title'); ?></h2>

                        <?php if(get_field("seasonal_styles") && get_field('seasonal_title_icon')): 
                            $title_icon = get_field('seasonal_title_icon'); 
                            if( !empty($title_icon) && is_array($title_icon) ): ?>
                                <?php $attachment_id = $title_icon['ID'] ?? null; ?>
                                <?php if( $attachment_id ): ?>
                                    <?php $svg_path = get_attached_file($attachment_id); ?>
                                    <?php if( $svg_path && file_exists($svg_path) ): ?>
                                        <div class="icon-wrapper">
                                            <?php echo file_get_contents($svg_path); ?>
                                        </div>
                                    <?php endif; ?>
                                <?php endif; ?>
                            <?php endif; ?>

                        <?php endif; ?>

                    </div>
                <?php endif; ?>

                <?php 
                $subtitle = get_field('subtitle');
                $buttonsField  = get_field('buttons');

                $has_buttons = false;
                if (!empty($buttonsField) && is_array($buttonsField)) {
                    foreach ($buttonsField as $buttons) {
                        if (!empty($buttons)) {
                            foreach ($buttons as $btn) {
                                if (!empty($btn['link_field_link'])) {
                                    $link = $btn['link_field_link'];

                                    if (
                                        ($link['link_type'] === 'internal' && !empty($link['internal_link'])) ||
                                        ($link['link_type'] === 'external' && !empty($link['external_link']))
                                    ) {
                                        $has_buttons = true;
                                        break;
                                    }
                                }
                            }
                        }
                    }
                }
                ?>

                <?php if( get_field('title') && ($subtitle || $has_buttons) ): ?>
                    <div class="cta-divider"></div>
                <?php endif; ?>

                <?php if($subtitle || $has_buttons): ?>
                    <div class="content-item">
                        <?php if($subtitle): ?>
                            <p class="no-margin"><?php echo $subtitle; ?></p>
                        <?php endif; ?>
                        <?php block_buttons($buttonsField, [
                            'class' => 'no-margin',
                            'aos' => true, 
                            'aos_delay' => '150'
                        ]); ?>
                    </div>
                <?php endif; ?>
            </header>

        <?php endif; ?>

        <div class="cta-blocks<?php if( get_field('mobile_layout') == 'scroll' ): ?> mobile-scroll<?php endif; ?>" data-aos="fade-up">

            <?php if(get_field('carousel_mode')): ?>

                <div class="js-cta-blocks">
        
            <?php endif; ?>

            <?php while ( have_rows('ctas') ) : the_row(); ?>
                <?php
                $link = get_sub_field('link_field_link');
                $cardTheme = get_sub_field('theme');
                $cardThemeClass = ($cardTheme == 'image' ? 'theme--image' : 'theme__card--'.$cardTheme );
                if( isLink( $link ) ):
                ?>
                <a href="<?php echo linkField( $link, 'url' ); ?>" class="cta img-abs <?php echo $cardThemeClass ?>" <?php echo linkField( $link, 'target' ); ?>>
                <?php else: ?>
                <div class="cta img-abs <?php echo $cardThemeClass ?>">
                <?php endif; ?>
                    <div class="cta-inner flex items-center flex-col justify-center">
                        <header>
                            <?php if( get_sub_field('overline') ): ?>
                                <p class="mb-1 overline color-accent">
                                    <?php the_sub_field('overline'); ?>
                                </p>
                            <?php endif; ?>
                            <?php if( get_sub_field('title') ): ?>
                                <h3 class="mb-1 <?php if(!get_sub_field('content')): ?> heading-center <?php endif; ?>">
                                    <?php the_sub_field('title'); ?>
                                </h3>
                            <?php endif; ?>
                        </header>
                        <?php if(get_sub_field('content')): ?>
                            <div class="cta-content">
                                <?php the_sub_field('content'); ?>
                            </div>
                        <?php endif; ?>
                        <?php if( isLink( $link ) && linkField( $link, 'text' ) ): ?>
                            <div class="buttons justify-center">
                                <span class="button secondary no-margin">
                                    <?php echo linkField( $link, 'text' ); ?>
                                </span>
                            </div>
                        <?php elseif( isLink( $link ) && !linkField( $link, 'text' ) ): ?>

                            <?php if( get_field("seasonal_styles") ): 
                                $block_icon = get_field('seasonal_block_icon'); 

                                if( !empty($block_icon) && is_array($block_icon) ): ?>
                                    <?php $attachment_id = $block_icon['ID'] ?? null; ?>
                                    <?php if( $attachment_id ): ?>
                                        <?php $svg_path = get_attached_file($attachment_id); ?>
                                        <?php if( $svg_path && file_exists($svg_path) ): ?>
                                            <div class="icon-wrapper">
                                                <?php echo file_get_contents($svg_path); ?>
                                            </div>
                                        <?php else: ?>
                                            <span class="diamond"></span>
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <span class="diamond"></span>
                                    <?php endif; ?>
                                <?php else: ?>
                                    <span class="diamond"></span>
                                <?php endif; ?>
                            <?php else: ?>
                                <span class="diamond"></span>
                            <?php endif; ?>

                        <?php endif; ?>
                    </div>
                    <?php if( $cardTheme == 'image' ): echo img_sizes(get_sub_field('image'), ['default' => 'img_800', 'page_area' => '26', 'mobile_page_area' => '85', 'lazy_load' => true]); endif; ?>
                <?php if( isLink( $link ) ): ?>
                </a>
                <?php else: ?>
                </div>
                <?php endif; ?>
            <?php endwhile; ?>

            <?php if(get_field('carousel_mode')): ?>

            </div>

            <button href="#" class="js-cta-prev no-margin slick-control" title="Previous slide"><svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48"><title>Previous</title><g class="caret-left"><polyline class="arrowhead" points="29.018 36.036 16.982 24 29.018 11.964" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="3"/></g></svg></button>
            <button href="#" class="js-cta-next no-margin slick-control" title="Next slide"><svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48"><title>Next</title><g class="caret-right"><polyline class="arrowhead" points="18.982 11.964 31.018 24 18.982 36.036" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="3"/></g></svg></button>

            <?php endif; ?>


        </div>
    </section>
<?php

}