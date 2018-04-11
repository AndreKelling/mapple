<?php
/**
 * The view for the single client metadata for the address
 */

if ( ! empty( $meta['client-address'][0] ) ) {

	?><h2><?php echo esc_html( apply_filters( 'mapple-title-client-address', 'Address' ), 'mapple' ); ?></h2>
	<p class="mapple__client-address"><?php echo $meta['client-address'][0]; ?></p><?php

}