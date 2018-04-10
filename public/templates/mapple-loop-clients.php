<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the archive loop.
 *
 * @link       http://slushman.com
 * @since      1.0.0
 *
 * @package    Mapple
 * @subpackage Mapple/public/partials
 */

/**
 * mapple-before-loop hook
 *
 * @hooked 		list_wrap_start 		10
 */
do_action( 'mapple-before-loop' );

foreach ( $items as $item ) {

	$meta = get_post_custom( $item->ID );

	/**
	 * mapple-before-loop-content hook
	 *
	 * @param 		object  	$item 		The post object
	 *
	 * @hooked 		content_wrap_start 		10
	 * @hooked 		content_link_start		15
	 */
	do_action( 'mapple-before-loop-content', $item, $meta );

		/**
		 * mapple-loop-content hook
		 *
		 * @param 		object  	$item 		The post object
		 *
		 * @hooked 		content_client_title 		10
		 * @hooked 		content_client_location 	15
		 */
		do_action( 'mapple-loop-content', $item, $meta );

	/**
	 * mapple-after-loop-content hook
	 *
	 * @param 		object  	$item 		The post object
	 *
	 * @hooked 		content_link_end 		10
	 * @hooked 		content_wrap_end 		90
	 */
	do_action( 'mapple-after-loop-content', $item, $meta );

} // foreach

/**
 * mapple-after-loop hook
 *
 * @hooked 		list_wrap_end 			10
 */
do_action( 'mapple-after-loop' );
