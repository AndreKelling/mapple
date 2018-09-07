<?php

/**
 * Provides the markup for any image upload field
 *
 * @link 		https://andrekelling.de
 * @since 		1.5.0
 *
 * @package 	Mapple
 * @subpackage 	Mapple/admin/partials
 */

if ( ! empty( $atts['label'] ) ) { ?>
    <label for="<?php echo esc_attr( $atts['id'] ); ?>"><?php esc_html_e( $atts['label'], 'mapple' ); ?>: </label>
<?php } ?>

<input
	class="<?php echo esc_attr( $atts['class'] ); ?>"
	id="<?php echo esc_attr( $atts['id'] ); ?>"
	name="<?php echo esc_attr( $atts['name'] ); ?>"
	placeholder="<?php echo esc_attr( $atts['placeholder'] ); ?>"
	type="<?php echo esc_attr( $atts['type'] ); ?>"
	value="<?php echo esc_attr( $atts['value'] ); ?>"
/>

<p>
    <button class="button-primary" data-mappleupload="<?php echo esc_attr( $atts['id'] ); ?>">
		<?php echo esc_html_e( 'Open Media Library', 'mapple' ) ?>
    </button>
	<?php if ( ! empty( $atts['description'] ) ) { ?>
        <span class="description"><?php esc_html_e( $atts['description'], 'mapple' ); ?></span>
    <?php } ?>
</p>

<?php if ( ! empty( $atts['value'] ) ) { ?>
    <p>
        <img id="<?php echo esc_attr( $atts['id'] ); ?>-img" src="<?php echo esc_attr( $atts['value'] ); ?>" />
        <button class="button-secondary" data-mappleuploadremove="<?php echo esc_attr( $atts['id'] ); ?>">
		    <?php echo esc_html_e( 'Remove Image', 'mapple' ) ?>
        </button>
    </p>
<?php }
