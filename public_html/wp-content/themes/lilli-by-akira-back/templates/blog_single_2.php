<section class="row container banner-block flex justify-center items-center flex-col" id="scroll-target">
    <div class="banner-content-block">
        <p><a class="button icon-left back no-margin minor" href="<?php echo get_permalink( get_option( 'page_for_posts' ) ); ?>">
            <svg width="27" height="27" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48"><title>caret-left</title><g class="caret-left"><polyline class="arrowhead" points="29.018 36.036 16.982 24 29.018 11.964" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="3"/></g></svg>
            Back to Blog
        </a></p>
        <?php $categories = get_the_category();
        $output = '';
        if ($categories) { ?>
            <p>
                <?php foreach ($categories as $category) {
                    $output .= '<a href="' . get_category_link($category->term_id) . '" class="overline">' . $category->cat_name . '</a>';
                }
                echo trim($output); ?>
            </p>
        <?php } ?>
        <h1 class="mb-8" data-aos="fade-up">
            <?php the_title(); ?>
            <span class="subtitle" data-aos="fade-up" data-aos-delay="50">
                <?php the_date(); ?>
            </span>
        </h1>
        <?php if( get_field('excerpt') ): ?>
        <div class="post-excerpt" data-aos="fade-up">
            <p class="size-l mb-0"><?php the_field('excerpt'); ?></p>
        </div>
        <?php endif; ?>
    </div>
</section>

<section class="container nopadd-mob">
    <div class="container">
        <div class="post-feat-img">
        <?php if(get_blog_listing() == "blog_1"): ?>
            <?php echo img_sizes(get_post_thumbnail_id(), ['default' => 'img_1920', 'lazy_load' => true]); ?>
        <?php else: ?>
        <?php block_media( get_field('featured_image__video'), [
                'img_sizes' => array('default' => 'img_1367', 'page_area' => 100, 'mobile_page_area' => 100),
                'default_aspect' => '16/9',
                'slick_dots' => true,
            ]); ?>
        <?php endif; ?>
        </div>
    </div>

    <header class="container">
        <div class="post-details post-info thin flex justify-between items-center xs:flex-col xs:items-start">
            <p class="no-margin"><?php
                $tags = get_the_tags();
                $tagOutput = '';
                if ($tags) {
                    foreach ($tags as $tag) {
                        $tagOutput .= '<a href="' . get_tag_link($tag->term_id) . '" class="cat-link">' . $tag->name . '</a>';
                    }
                    echo trim($tagOutput);
                }
            ?></p>
            <div class="post-share flex items-center">
                <strong>Share This Article</strong>
                <?php
                    $permalink = urlencode(get_permalink());
                    $thumbnail = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full');
                    $image_url = $thumbnail ? urlencode($thumbnail[0]) : '';
                ?>
                <a class="button icon secondary no-margin size-s" href="#" onclick="window.open( 'https://www.facebook.com/sharer/sharer.php?u=<?php echo $permalink; ?><?php echo $image_url ? '&picture=' . $image_url : ''; ?>', 'sharer', 'toolbar=0,status=0,width=626,height=436' ); return false;" title="Share on Facebook">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48">
                        <title>facebook</title>
                        <path class="facebook" d="M34.107,3.567a45.739,45.739,0,0,0-5.334-.281c-5.288,0-8.914,3.228-8.914,9.148v5.1H13.893v6.925h5.966V42.216h7.159V24.459H32.96l.913-6.925H27.018V13.112c0-1.989.538-3.369,3.416-3.369h3.673Z" fill="currentColor"/>
                    </svg>
                </a>

                <?php
                    $title = urlencode(get_the_title());
                ?>
                <a class="button icon secondary no-margin size-s" href="#" onclick="window.open( 'https://twitter.com/share?url=<?php echo $permalink; ?>&text=<?php echo $title; ?>', 'sharer', 'toolbar=0,status=0,width=626,height=436' ); return false;" title="Share on Twitter">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path d="M17.1761 4H19.9362L13.9061 10.7774L21 20H15.4456L11.0951 14.4066L6.11723 20H3.35544L9.80517 12.7508L3 4H8.69545L12.6279 9.11262L17.1761 4ZM16.2073 18.3754H17.7368L7.86441 5.53928H6.2232L16.2073 18.3754Z" fill="currentColor"/>
                    </svg>
                </a>

                <a class="button icon secondary no-margin size-s" href="#" onclick="window.open( 'https://www.linkedin.com/shareArticle?mini=true&url=<?php echo $permalink; ?>', 'sharer', 'toolbar=0,status=0,width=626,height=436' ); return false;" title="Share on LinkedIn">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48">
                        <title>linkedin</title>
                        <g class="linkedin">
                            <rect x="7.435" y="17.44" width="7.298" height="21.916" fill="currentColor"/>
                            <path d="M15.2,10.673a3.763,3.763,0,0,0-4.069-3.782,3.8,3.8,0,0,0-4.114,3.782,3.762,3.762,0,0,0,4.025,3.781h.045A3.777,3.777,0,0,0,15.2,10.673Z" fill="currentColor"/>
                            <path d="M40.985,26.8c0-6.723-3.583-9.864-8.382-9.864a7.222,7.222,0,0,0-6.613,3.694h.045V17.44H18.759s.088,2.057,0,21.916h7.276V27.127a5.489,5.489,0,0,1,.243-1.792,3.988,3.988,0,0,1,3.737-2.654c2.632,0,3.694,2.013,3.694,4.954V39.356h7.276Z" fill="currentColor"/>
                        </g>
                    </svg>
                </a>
            </div>
        </div>
    </header>
</section>