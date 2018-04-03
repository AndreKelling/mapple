<?php

/**
 * Provide the view for a metabox
 *
 * @link 		http://example.com
 * @since 		1.0.0
 *
 * @package 	Mapple
 * @subpackage 	Mapple/admin/partials
 */

wp_nonce_field( $this->plugin_name, 'client_additional_info' );

$atts 					= array();
$atts['class'] 			= 'widefat';
$atts['description'] 	= 'enter Geo data like "52.457072, 13.510904" (without ")';
$atts['id'] 			= 'client-location';
$atts['label'] 			= 'Location';
$atts['name'] 			= 'client-location';
$atts['placeholder'] 	= '52.457072, 13.510904';
$atts['type'] 			= 'text';
$atts['value'] 			= '';

if ( ! empty( $this->meta[$atts['id']][0] ) ) {

	$atts['value'] = $this->meta[$atts['id']][0];

}

apply_filters( $this->plugin_name . '-field-' . $atts['id'], $atts );

?><p><?php

include( plugin_dir_path( __FILE__ ) . $this->plugin_name . '-admin-field-text.php' );

?></p>