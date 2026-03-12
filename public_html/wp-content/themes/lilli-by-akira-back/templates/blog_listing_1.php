<div class="row container">
    <div class="cta-blocks flex flex-wrap justify-center js-post-ajax">
        <?php $postCount = 1; while ( have_posts() ) : the_post(); ?>
            <a href="<?php the_permalink(); ?>" class="cta theme--image">
                <div class="cta-inner flex items-center flex-col justify-center">
                    <header>
                        <p class="mb-1 overline-1">
                            <?php
                                $categories = get_the_category();
                                $output = '';
                                if ($categories) {
                                    foreach ($categories as $category) {
                                        $output .= '<span class="cat-link">' . $category->cat_name . '</span>';
                                    }
                                    echo trim($output);
                                }
                            ?>
                        </p>
                        <h3 class="mb-1">
                            <?php the_title(); ?>
                        </h3>
                    </header>

                    <div class="cta-content">
                        <p><?php echo get_the_date(); ?></p>
                    </div>
                    <div class="buttons justify-center">
                        <span class="button secondary icon no-margin">
                            <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" viewBox="0 0 48 48"><title>arrow-right</title><g class="arrow-right"><line class="arrow-stem" x1="39.964" y1="23.964" x2="7.964" y2="23.964" stroke-width="3" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" fill="none"/><polyline class="arrowhead" points="28 11.929 40.036 23.964 28 36" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="3"/></g></svg>
                        </span>
                    </div>
                </div>
                <?php if( has_post_thumbnail() ): echo img_sizes(get_post_thumbnail_id(), ['default' => 'img_800', 'lazy_load' => true]); endif; ?>
            </a>
        <?php $postCount++; endwhile; ?>
    </div>
</div>