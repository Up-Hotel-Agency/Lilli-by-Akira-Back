<?php 
// register the block.
acf_register_block_type(array(
    'name'              => 'eventsgrid',
    'title'             => __('Events Grid'),
    'description'       => __('Events Grid'),
    'render_callback'   => 'events_grid_render_callback',
    'category'          => 'upcore-blocks',
    'icon'              => 'calendar-alt', // dashicons, without the leading dashicons-
    'keywords'          => array( 'event, events' ),
    'enqueue_style'     => get_template_directory_uri() . '/assets/css/cta_blocks/cta_blocks.css',
    'mode'              => 'preview',
    'supports'          => array(
                                    'align'     => false,
                                    'anchor'    => true,
                                    'mode'      => false
                                )
));
function events_grid_render_callback( $block, $content = '', $is_preview = false ) {
    extract(block_color_variables());
    ?>
    <section
    class="
    row 
    container 
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
        
        <?php
        $today = date('Ymd');
        $event_args = array(
            'posts_per_page' => -1,
            'post_type' => 'events',
            'meta_key'  => 'date',
            'orderby' => 'meta_value',
            'meta_type' => 'DATE',
            'order' => 'ASC',
            'meta_query' => array(
                'relation' => 'OR', // Use OR to check either start date or end date conditions
                array(
                    'key'		=> 'date',
                    'compare'	=> '>',
                    'value'		=> $today,
                ),
                array(
                    'relation' => 'AND', // Check start date condition
                    array(
                        'key' => 'date_range', // Check end date condition
                        'compare' => '=', // Only include if 'dates__times_end_date' is not set
                        'value' => '1',
                    ),
                    array(
                        'key' => 'end_date', // Check end date condition
                        'compare' => '>', // Fetch events with end date greater than or equal to today
                        'value' => $today,
                        'type' => 'DATE', // Ensure proper date comparison
                    ),
                ),
            )
        );
        $event_query = new WP_Query($event_args);
        $event_posts = $event_query->get_posts();
                $event_months = array();

                foreach ($event_posts as $event_post) {
                    $meta_value = get_post_meta($event_post->ID, 'date', true);
                    if (!$meta_value) {
                        continue;
                    }
                    $date = date('Ym', strtotime($meta_value));
                    $event_months[$date][] = $event_post;
                }
                foreach ($event_months as $post_date => $event_posts): ?>
                <section class="spacing events-grid">
                    <div class="cta theme__card--standard xs:not-square no-hover events-month">
                        <div class="cta-inner flex items-center flex-col justify-center">
                            <h2 class="no-margin"><?php echo date_format( date_create($post_date . '01'), "F"); ?></h2>
                            <div class="cta-content">
                                <p><?php echo date_format( date_create($post_date . '01'), "Y"); ?></p>
                            </div>
                        </div>
                    </div>

                    <?php foreach ($event_posts as $event_post): ?>
                        <a href="<?php the_permalink( $event_post->ID ); ?>" class="cta theme--image">
                            <div class="cta-inner flex items-center flex-col justify-center">
                                <header>
                                    <p class="mb-1 overline-1">
                                        <?php
                                            $date = date_create(get_field('date', $event_post->ID));
                                            $dateevent = $date->format('Ymd');
                                            if(get_field('date_range',$event_post->ID)){
                                                $date_end = date_create(get_field('end_date', $event_post->ID));
                                                $dateEnd = $date_end->format('Ymd');
                                                $eventYear = date('Y', strtotime($dateevent));
                                                $endYear = date('Y', strtotime($dateEnd));
                                                if($eventYear == $endYear){
                                                    echo date_format( $date, "D d M") . ' - ' . date_format( $date_end, "D d M");
                                                }else{
                                                    echo date_format( $date, "D d M Y") . ' - ' . date_format( $date_end, "D d M Y");
                                                }
                                            }else{
                                                echo date_format( $date, "D d M");
                                            }
                                        ?>
                                    </p>
                                    <h3 class="mb-1">
                                        <?php echo get_the_title($event_post->ID); ?>
                                    </h3>
                                </header>

                                <?php if( get_field('subtitle', $event_post->ID) ): ?>
                                    <div class="cta-content">
                                        <p><?php the_field('subtitle', $event_post->ID); ?></p>
                                    </div>
                                <?php endif; ?>
                                <div class="buttons justify-center">
                                    <span class="button secondary icon no-margin">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" viewBox="0 0 48 48"><title>arrow-right</title><g class="arrow-right"><line class="arrow-stem" x1="39.964" y1="23.964" x2="7.964" y2="23.964" stroke-width="3" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" fill="none"/><polyline class="arrowhead" points="28 11.929 40.036 23.964 28 36" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="3"/></g></svg>
                                    </span>
                                </div>
                            </div>
                            <?php if( has_post_thumbnail( $event_post->ID ) ): echo img_sizes(get_post_thumbnail_id( $event_post->ID ), ['default' => 'img_800', 'lazy_load' => true]); endif; ?>
                        </a>
                    <?php endforeach; ?>
                </section>
            <?php endforeach; ?>
            <?php wp_reset_query(); ?>
    </section>
    <?php
}