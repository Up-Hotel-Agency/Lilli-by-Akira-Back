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

        <div class="cta-blocks<?php if( get_field('mobile_layout') == 'scroll' ): ?> mobile-scroll<?php endif; ?>" data-aos="fade-up">
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
                                <p class="mb-1 overline-1">
                                    <?php the_sub_field('overline'); ?>
                                </p>
                            <?php endif; ?>
                            <h3 class="mb-1">
                                <?php the_sub_field('title'); ?>
                            </h3>
                        </header>

                        <div class="cta-content">
                            <?php the_sub_field('content'); ?>
                        </div>
                        <?php if( isLink( $link ) && linkField( $link, 'text' ) ): ?>
                            <div class="buttons justify-center">
                                <span class="button secondary no-margin">
                                    <?php echo linkField( $link, 'text' ); ?>
                                </span>
                            </div>
                        <?php elseif( isLink( $link ) && !linkField( $link, 'text' ) ): ?>
                            <div class="buttons justify-center">
                                <span class="button secondary icon no-margin">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" viewBox="0 0 48 48"><title>arrow-right</title><g class="arrow-right"><line class="arrow-stem" x1="39.964" y1="23.964" x2="7.964" y2="23.964" stroke-width="3" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" fill="none"/><polyline class="arrowhead" points="28 11.929 40.036 23.964 28 36" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="3"/></g></svg>
                                </span>
                            </div>
                        <?php endif; ?>
                    </div>
                    <?php if( $cardTheme == 'image' ): echo img_sizes(get_sub_field('image'), ['default' => 'img_800', 'page_area' => '26', 'mobile_page_area' => '85', 'lazy_load' => true]); endif; ?>
                <?php if( isLink( $link ) ): ?>
                </a>
                <?php else: ?>
                </div>
                <?php endif; ?>
            <?php endwhile; ?>
        </div>
    </section>
    <?php
}