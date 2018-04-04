<?php
/**
 * The view for the client location used in the loop
 */

if ( ! empty( $meta['client-location'][0] ) ) {

	?><div class="client-list-location"><?php echo esc_html( $meta['client-location'][0] ); ?></div><?php

}