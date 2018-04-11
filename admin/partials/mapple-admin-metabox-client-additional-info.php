<?php

/**
 * Provide the view for a metabox
 *
 * @link 		https://andrekelling.de
 * @since 		1.0.0
 *
 * @package 	Mapple
 * @subpackage 	Mapple/admin/partials
 */

wp_nonce_field( $this->plugin_name, 'client_additional_info' );

$atts 					= array();
$atts['class'] 			= 'widefat';
$atts['description'] 	= 'enter Address will autocomplete and fill geolocation field below. Change this field to fit your language. Google maps API should be fine with.';
$atts['id'] 			= 'client-address';
$atts['label'] 			= 'Address';
$atts['name'] 			= 'client-address';
$atts['placeholder'] 	= '';
$atts['type'] 			= 'text';
$atts['value'] 			= '';

if ( ! empty( $this->meta[$atts['id']][0] ) ) {

    $atts['value'] = $this->meta[$atts['id']][0];

}

apply_filters( $this->plugin_name . '-field-' . $atts['id'], $atts );

?><p><?php

include( plugin_dir_path( __FILE__ ) . $this->plugin_name . '-admin-field-text-address.php' );

?></p><?php

$atts 					= array();
$atts['class'] 			= 'widefat';
$atts['description'] 	= 'enter Geo data like "52.457072, 13.510904". If not filled client won\'t appear on map!';
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

?></p><hr><?php

$atts 					= array();
$atts['class'] 			= 'widefat';
$atts['description'] 	= 'enter full URL with http:// or https://';
$atts['id'] 			= 'client-url';
$atts['label'] 			= 'Website URL';
$atts['name'] 			= 'client-url';
$atts['placeholder'] 	= 'https://andrekelling.de';
$atts['type'] 			= 'text';
$atts['value'] 			= '';

if ( ! empty( $this->meta[$atts['id']][0] ) ) {

    $atts['value'] = $this->meta[$atts['id']][0];

}

apply_filters( $this->plugin_name . '-field-' . $atts['id'], $atts );

?><p><?php

include( plugin_dir_path( __FILE__ ) . $this->plugin_name . '-admin-field-text.php' );

$atts 					= array();
$atts['class'] 			= 'widefat';
$atts['description'] 	= 'show a different URL title';
$atts['id'] 			= 'client-urlname';
$atts['label'] 			= 'Website URL shown name';
$atts['name'] 			= 'client-urlname';
$atts['placeholder'] 	= 'andrekelling.de';
$atts['type'] 			= 'text';
$atts['value'] 			= '';

if ( ! empty( $this->meta[$atts['id']][0] ) ) {

	$atts['value'] = $this->meta[$atts['id']][0];

}

apply_filters( $this->plugin_name . '-field-' . $atts['id'], $atts );

?><p><?php

include( plugin_dir_path( __FILE__ ) . $this->plugin_name . '-admin-field-text.php' );

?></p>