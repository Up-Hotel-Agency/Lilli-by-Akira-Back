<?php

/**
 * Filters the list of allowed block types.
 *
 *
 * @param array|bool $allowed_block_types Array of block type slugs, or boolean to enable/disable all.
 * @param object     $block_editor_context The current block editor context.
 *
 * @return array The filtered list of allowed block types. If the current user does not have
 *               the 'edit_theme_options' capability, the list will exclude the disallowed blocks.
 */
 
function example_disallow_block_types( $allowed_block_types, $block_editor_context ) {

	// List of disallowed blocks
		$disallowed_blocks = array(
			//Text
			'core/pullquote',
			'core/details',
			'core/verse',

			//Media
			'core/cover',
			'core/file',
			'core/media-text',

			//Design
			'core/more',
			'core/nextpage',
			
			//Widgets
			'core/archives',
			'core/calendar',
			'core/terms-list',
			'core/categories-list',
			'core/latest-comments',
			'core/latest-posts',
			'core/page-list',
			'core/rss',
			'core/search',
			'core/social-icons',
			'core/tag-cloud',

			//Theme
			'core/navigation',
			'core/site-logo',
			'core/site-title',
			'core/site-tagline',
			'core/query',
			'core/avatar',
			'core/post-title',
			'core/post-excerpt',
			'core/post-featured-image',
			'core/post-author',
			'core/post-author-name',
			'core/post-date',
			'core/post-modified-date',
			'core/post-terms',
			'core/categories',
			'core/tags',
			'core/post-navigation-link',
			'core/read-more',
			'core/comments',
			'core/post-comments-form',
			'core/loginout',
			'core/term-description',
			'core/query-title',
			'core/post-author-biography',
			'core/social-links',

			//Embeds
			'core/embed',
		);
		
		// Get all registered blocks if $allowed_block_types is not already set.
		if ( ! is_array( $allowed_block_types ) || empty( $allowed_block_types ) ) {
			$registered_blocks   = WP_Block_Type_Registry::get_instance()->get_all_registered();
			$allowed_block_types = array_keys( $registered_blocks );
		}

		// Create a new array for the allowed blocks.
		$filtered_blocks = array();

		// Loop through each block in the allowed blocks list.
		foreach ( $allowed_block_types as $block ) {

			// Check if the block is not in the disallowed blocks list.
			if ( ! in_array( $block, $disallowed_blocks, true ) ) {

				// If it's not disallowed, add it to the filtered list.
				$filtered_blocks[] = $block;
			}
		}

		// Return the filtered list of allowed blocks
		return $filtered_blocks;
	
	return $allowed_block_types;
}
add_filter( 'allowed_block_types_all', 'example_disallow_block_types', 10, 2 );