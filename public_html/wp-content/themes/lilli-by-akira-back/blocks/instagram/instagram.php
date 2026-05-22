<?php 
// register the block.
acf_register_block_type(array(
    'name'              => 'instagram',
    'title'             => __('Instagram'),
    'description'       => __('Instagram'),
    'render_callback'   => 'instagram_render_callback',
    'category'          => 'upcore-blocks',
    'icon'              => 'editor-aligncenter', // dashicons, without the leading dashicons-
    'keywords'          => array( 'Instagram' ),
    'supports'          => array(
                                'align' => false, 
                                'align_text' => true, 
                                'anchor' => true 
                            ),
    'enqueue_assets' => function(){
        wp_enqueue_script( 'block-acf-instagram', get_template_directory_uri() . '/assets/js/instagram/instagram.min.js' );
        wp_enqueue_style( 'block-acf-instagram', get_template_directory_uri() . '/assets/css/instagram/instagram.css' );
    }
));
function instagram_render_callback( $block, $content = '', $is_preview = false ) {
    extract(block_color_variables());

?>
    <section 
    class="
    row 
    instagram-block-class 
    container
    <?php include get_template_directory() . '/blocks/_block_components/component_block_class.php';  //Apply classes from ACF row settings ?>
    <?php if( array_key_exists('className', $block) ): echo ' ' . $block['className']; endif; ?> 
    "

    id="<?php if( array_key_exists('anchor', $block) && !empty($block['anchor'])): echo esc_attr($block['anchor']); else: echo $block['id']; endif ?>"

    style="
    <?php include get_template_directory() .'/blocks/_block_components/component_block_style.php'; //Apply inline styles and variables from ACF row settings ?>
    <?php set_row_spacing_override_values(); //Apply row spacing override ACF settings ?>
    "

    data-aos-id="instagram"
    >
    <?php include get_template_directory() .'/blocks/_block_components/component_bg_media.php'; //Apply background media from ACF row settings ?>

        <div class="instagram-block text-align-<?php echo $block['align_text']; ?><?php if( get_field('override_page_theme') ): if( $themeField['disable_overlay'] && $themeField['text_colour'] == 'dark' ): ?> theme--default<?php endif; endif; ?>">
            <div class="insta-top color-accent flex justify-between">
                <?php if( get_field('title_title') ): ?>
                    <h3 class="mb-0"><?php the_field('title_title'); ?></h3>
                <?php endif; ?>
                 <?php $button_link = get_field('button_link');
                 if($button_link):
                if( isLink( $button_link ) ):?>
                <div class="buttons">
                    <a class="button secondary icon-position-<?php echo linkField( $button_link, 'icon_position' ); ?>" href="<?php echo linkField( $button_link, 'url' ); ?>" <?php echo linkField( $button_link, 'target' ); ?>>
                        <span><?php echo linkField( $button_link, 'text' ); ?></span>
                        <?php echo linkField( $button_link, 'icon' ); ?>
                    </a>
                </div>
                <?php endif; endif;?>
            </div>
            <?php
            if(get_field('up_instagram', 'options')):
                $instagram = up_instagram(get_field('up_instagram', 'options'));
            ?>
                <div class="insta-images" id="instafeed" data-account="<?php echo get_field('up_instagram', 'options'); ?>">
                    <?php if($instagram): ?>
                        <?php $count = 1; foreach($instagram as $post):?>
                            <?php if ($count > 4) break; ?>
                            <a href="<?php echo $post['permalink'];?>" target="_blank" class="instagram-image">
                                <img loading="lazy" src="<?php echo $post['src'];?>">
                            </a>
                        <?php $count++; endforeach; ?>
                    <?php endif; ?>
                </div>    
            <?php endif; ?>
        </div>
    </section>
    <?php
}