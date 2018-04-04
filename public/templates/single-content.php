<?php
/**
 * The template for displaying all single client posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Mapple
 */

$meta = get_post_custom( $post->ID );

/**
 * mapple-before-single hook
 */
do_action( 'mapple-before-single', $meta );

?><div class="wrap-client"><?php

	/**
	 * mapple-before-single-content hook
	 */
	do_action( 'mapple-before-single-content', $meta );

		/**
		 * mapple-single-content hook
		 */
		do_action( 'mapple-single-content', $meta );

	/**
	 * mapple-after-single-content hook
	 */
	do_action( 'mapple-after-single-content', $meta );

?></div><!-- .wrap-employee --><?php

/**
 * mapple-after-single hook
 */
do_action( 'mapple-after-single', $meta );