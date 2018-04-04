<?php
/**
 * The template for displaying all single mapples posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Mapple
 */

//if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly

/**
 * Get a custom header-employee.php file, if it exists.
 * Otherwise, get default header.
 */
get_header( 'mapple' );

if ( have_posts() ) :

	/**
	 * mapple-single-before-loop hook
	 *
	 * @hooked 		mapple_single_content_wrap_start 		10
	 */
	do_action( 'mapple-single-before-loop' );

	while ( have_posts() ) : the_post();

		include Mapple_get_template( 'single-content' );

	endwhile;

	/**
	 * mapple-single-after-loop hook
	 *
	 * @hooked 		mapple_single_content_wrap_end 		90
	 */
	do_action( 'mapple-single-after-loop' );

endif;

get_footer( 'mapple' );