<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the archive loop.
 *
 * @link       https://andrekelling.de
 * @since      1.0.0
 *
 * @package    Mapple
 * @subpackage Mapple/public/partials
 */

/**
 * mapple-before-loop hook
 *
 * @hooked 		client_table_start 		10
 */
do_action( 'mapple-before-loop', $atts );

foreach ( $items as $item ) {

	$meta = get_post_custom( $item->ID );

    /**
     * mapple-loop-content hook
     *
     * @param 		object  	$item 		The post object
     *
     * @hooked 		content_client_content 		10
     */
    do_action( 'mapple-loop-content', $item, $meta );

} // foreach

/**
 * mapple-after-loop hook
 *
 * @hooked 		client_table_end 			10
 */
do_action( 'mapple-after-loop' );
