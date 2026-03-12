<?php get_header(); ?>

	<header class="row container banner-block blog-header flex justify-center items-center" id="scroll-target">
		<div class="banner-content-block">
			


			<?php
			$s=get_search_query();
			$args = array(
				's' =>$s
			);
			// The Query
			$the_query = new WP_Query( $args );
			if ( $the_query->have_posts() ) {
					?><h1 class="mb-2 text-left" data-aos="fade-up">Search Results</h1>
					<div class="banner-content mb-8 text-left" data-aos="fade-up">
						<div class="subtitle-1 mb-0 text-left"><?php echo "'" . get_query_var('s') . "'";?></div>
					</div>
					<?php
				}else{
			?>
					<h1 class="mb-2 text-left" data-aos="fade-up">Nothing Found</h1>
					<div class="banner-content mb-8 text-left" data-aos="fade-up">
						<div class="subtitle-1 mb-0 text-left">Sorry, but nothing matched your search criteria. Please try again with some different keywords.</div>
					</div>
			<?php } ?>

			<form action="<?php echo home_url(); ?>" class="search-bar-general" id="search-form" method="get">
                <svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><g><line x1="20.39" y1="20.39" x2="12.91" y2="12.91" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/><circle cx="9.059" cy="9.059" r="5.449" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/></g></svg>
                <label for="search" class="visuallyhidden">Search: </label>
                <input type="text" name="s" id="s" placeholder="Search..." id="search" class="text-input js-filter-mob" value="" /></label>
            </form>
		</div>
	</header>

	<div class="container">
		<div class="results">
		<?php $total_posts = $the_query->found_posts;
			if ($total_posts != 0):
				echo '<p class="total-results size-s mb-4">' . $total_posts . ' results</p>';
			endif;
			while ( $the_query->have_posts() ) {
			$the_query->the_post();
			$post_id = get_the_ID();
				?>
					<a class="callout-result" href="<?php the_permalink(); ?>">
						<?php if ( has_post_thumbnail( $post_id ) ) : ?>
							<div class="result-img">
								<?php echo get_the_post_thumbnail( $post_id, 'medium' ); // You can change 'medium' to any size ?>
							</div>
						<?php endif; ?>
						<div class="">
							<div class="result-title mb-0"><?php the_title(); ?></div>
							<p class="result-slug size-s mb-3"><?php the_title(); ?></p>
							<p class="result-subtitle size-s mb-0"><?php the_title(); ?></p>
						</div>
					</a>
				<?php
			}
		?>
		</div>
	</div>
<?php get_footer(); ?>