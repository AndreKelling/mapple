<?php
/**
 * The view for the single client metadata for the location
 */

if ( ! empty( $meta['client-location'][0] ) ) {

	?><h3><?php echo esc_html( apply_filters( 'mapple-title-client-location', 'Location-code' ), 'mapple' ); ?></h3>
	<p class="mapple__client-location"><?php echo $meta['client-location'][0]; ?></p><?php

}