<div class="row container">
    <div class="posts-grid flex flex-wrap js-post-ajax">
        <?php $postCount = 1; while ( have_posts() ) : the_post(); ?>

            <?php if($postCount == 1): ?>
                
                <?php //Featured article (Image / Content) ?>

                <div class="post-item feat-post" data-aos="fade-up">
                    <div class="post-item-img-wrapper">
                        <a href="<?php the_permalink(); ?>" class="post-item-img" aria-label="blog">
                            <?php block_media( get_field('featured_image__video'), [
                                'img_sizes' => array('default' => 'img_1367', 'page_area' => 100, 'mobile_page_area' => 100),
                                'default_aspect' => '4/3',
                                'video_aspect' => '4/3',
                                'slick_dots' => true,
                            ]); ?>
                        </a>
                    </div>
                    <div class="feat-post-content">
                        <p class="overline mb-1">Latest Article</p>
                        <h2 class="mb-1">
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </h2>
                        <p>
                            <?php echo get_the_date(); ?>
                        </p>
                        <?php if( get_field('excerpt') ): ?>
                            <p class="mb-8"><?php the_field('excerpt'); ?></p>
                        <?php endif; ?>
                        <a href="<?php the_permalink(); ?>" class="button minor icon-right no-padd-horz no-margin">
                            Read Article
                            <svg width="27" height="27" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48"><title>caret-right</title><g class="caret-right"><polyline class="arrowhead" points="18.982 11.964 31.018 24 18.982 36.036" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="3"/></g></svg>
                        </a>
                    </div>
                </div>

            <?php else: ?>

                <?php //Standard listing (Column content) ?>

                <div class="post-item" data-aos="fade-up">
                    <a href="<?php the_permalink(); ?>" class="post-item-img" aria-label="blog">
                        <?php block_media( get_field('featured_image__video'), [
                            'img_sizes' => array('default' => 'img_1367', 'page_area' => 100, 'mobile_page_area' => 100),
                            'default_aspect' => '4/3',
                            'video_aspect' => '4/3',
                            'slick_dots' => false,
                            'dynamic_mobile' => false
                        ]); ?>
                    </a>
                    <div class="post-item-content">
                        <p class="overline mb-1 xs:hidden"><?php
                            $categories = get_the_category();
                            $output = '';
                            if ($categories) {
                                foreach ($categories as $category) {
                                    $output .= '<a href="' . get_category_link($category->term_id) . '" class="cat-link">' . $category->cat_name . '</a>';
                                }
                                echo trim($output);
                            }
                        ?></p>
                        <h3 class="mb-1 xs:size-m"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                        <p class="no-margin xs:size-xs">
                            <?php echo get_the_date(); ?>
                        </p>
                    </div>
                </div>

            <?php endif; ?>

        <?php $postCount++; endwhile; ?>
    </div>
</div>