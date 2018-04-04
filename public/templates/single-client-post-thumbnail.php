<?php
/**
 * The view for the employee image used in the single-employee template
 */

if ( has_post_thumbnail() ) {

	$thumb_atts['class'] 	= 'alignleft img-client photo';
	$thumb_atts['itemtype'] = 'image';

	apply_filters( 'mapple-single-post-featured-image-attributes', $thumb_atts );

	the_post_thumbnail( 'medium', $thumb_atts );

}