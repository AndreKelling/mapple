<?php
/**
 * The view for the single client metadata for the location
 */

if ( ! empty( $meta['client-location'][0] ) ) {

	?><h2><?php echo esc_html( apply_filters( 'mapple-title-client-location', 'Location' ), 'mapple' ); ?></h2>
	<p class="<?php echo esc_attr( 'client-location' ); ?>"><?php echo $meta['client-location'][0]; ?></p><?php

}