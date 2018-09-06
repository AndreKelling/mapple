<?php

/**
 * Provides the markup for any text field
 *
 * @link 		https://andrekelling.de
 * @since 		1.0.0
 *
 * @package 	Mapple
 * @subpackage 	Mapple/admin/partials
 */

if ( ! empty( $atts['label'] ) ) {

	?><label for="<?php echo esc_attr( $atts['id'] ); ?>"><?php esc_html_e( $atts['label'], 'mapple' ); ?>: </label><?php

}

?><textarea
	class="<?php echo esc_attr( $atts['class'] ); ?>"
	id="<?php echo esc_attr( $atts['id'] ); ?>"
	name="<?php echo esc_attr( $atts['name'] ); ?>"
	placeholder="<?php echo esc_attr( $atts['placeholder'] ); ?>"
	rows="<?php echo esc_attr( $atts['rows'] ); ?>"><?php echo esc_attr( $atts['value'] ); ?></textarea>

<?php

if ( ! empty( $atts['description'] ) ) {

	?><span class="description"><?php esc_html_e( $atts['description'], 'mapple' ); ?></span><?php

}