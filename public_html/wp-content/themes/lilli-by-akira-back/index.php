<?php get_header(); ?>

<section class="row container banner-block blog-header flex justify-center items-center" id="scroll-target">
    <div class="banner-content-block">
        <p class="mb-2 overline-1" data-aos="fade-up">
            <?php the_field('posts_page_overline', get_option( 'page_for_posts' )); ?>
        </p>
        <h1 class="mb-2" data-aos="fade-up"><?php the_field('posts_page_title', get_option( 'page_for_posts' )); ?></h1>
        <div class="banner-content mb-0" data-aos="fade-up">
            <p class="mb-0"><?php the_field('posts_page_content', get_option( 'page_for_posts' )); ?></p>
        </div>
    </div>
</section>

<div class="in-page-nav-wrap mb-12">
    <div class="in-page-nav flex flex-wrap justify-center text-center">
        <a href="<?php echo get_permalink( get_option( 'page_for_posts' ) ); ?>" class="active">All</a>
        <?php
        $args = array(
            'orderby' => 'name',
            'parent' => 0,
            //Exclude uncategorised from in page nav
            'exclude' =>array(1),
            'hide_empty' => true
        );
        $categories = get_categories( $args );
        foreach ( $categories as $category ) { ?>
            <a href="/category/<?php echo $category->slug; ?>/">
                <?php echo $category->name; ?>
            </a>
        <?php } ?>
    </div>
</div>

<?php 
//Include required listing format
if( get_blog_listing() == 'blog_1' ): 
    include 'templates/blog_listing_1.php'; 
elseif( get_blog_listing() == 'blog_2' ):
    include 'templates/blog_listing_2.php'; 
endif;
?>

<?php global $wp_query;
if( $wp_query->found_posts > '9' ): ?>
<p class="loadmore-wrapper buttons centered mb-16">
    <a href="#" class="button secondary" id="loadmore" data-posts-per-page="9" data-count-posts="<?php echo wp_count_posts('post')->publish ?>">
        Load More Articles
    </a>
</p>
<?php endif; ?>

<?php get_footer(); ?>