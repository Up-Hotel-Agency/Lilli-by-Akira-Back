<?php 
// register the block.
acf_register_block_type(array(
    'name'              => 'compactctablocks',
    'title'             => __('Compact CTA Blocks'),
    'description'       => __('Compact CTA Blocks'),
    'render_callback'   => 'compact_cta_blocks_render_callback',
    'category'          => 'upcore-blocks',
    'icon'              => 'images-alt2', // dashicons, without the leading dashicons-
    'keywords'          => array( 'cta', 'blocks', 'call to action', 'compact' ),
    'mode'              => 'preview',
    'supports'          => array(
                                    'align'     => false,
                                    'anchor'    => true,
                                    'mode'      => false
                                ),
    'enqueue_assets' => function(){
        wp_enqueue_style( 'block-acf-compact-cta', get_template_directory_uri() . '/assets/css/compact_cta_blocks/compact_cta_blocks.css' );
        wp_enqueue_style( 'block-acf-cta', get_template_directory_uri() . '/assets/css/cta_blocks/cta_blocks.css' );
    }
));
function compact_cta_blocks_render_callback( $block, $content = '', $is_preview = false ) {
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

        <div class="compact-cta-blocks flex flex-wrap justify-center<?php if( get_field('mobile_layout') == 'scroll' ): ?> mobile-scroll<?php endif; ?>" data-aos="fade-up">
            <?php while ( have_rows('ctas') ) : the_row(); ?>
                <?php
                $link = get_sub_field('link_field_link');
                $cardTheme = get_sub_field('theme');
                $cardThemeClass = ($cardTheme == 'image' ? 'theme--image' : 'theme__card--'.$cardTheme );
                if( isLink( $link ) ):
                ?>
                <a href="<?php echo linkField( $link, 'url' ); ?>" class="compact-cta img-abs <?php echo $cardThemeClass ?>" <?php echo linkField( $link, 'target' ); ?>>
                <?php else: ?>
                <div class="compact-cta img-abs <?php echo $cardThemeClass ?>">
                <?php endif; ?>
                    <div class="compact-cta-inner flex items-center flex-col justify-center">
                        <header>
                            <h4 class="h6 no-margin">
                                <?php the_sub_field('title'); ?>
                            </h4>
                        </header>

                        <?php if( linkField( $link, 'text' ) ): ?>
                            <p class="size-xs">
                                <?php echo linkField( $link, 'text' ); ?>
                            </p>
                        <?php endif; ?>
                    </div>
                    <?php if( $cardTheme == 'image' ): echo img_sizes(get_sub_field('image'), ['default' => 'img_188', 'page_area' => '13', 'tablet_page_area' => '26', 'mobile_page_area' => '38', 'lazy_load' => true]); endif; ?>
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