<?php

/**
 * Provides the markup for a text with address autocompletion field
 * works if google API key is already filled in settings
 *
 * @link 		http://example.com
 * @since 		1.0.0
 *
 * @package 	Mapple
 * @subpackage 	Mapple/admin/partials
 */

if ( ! empty( $atts['label'] ) ) {

	?><label for="<?php echo esc_attr( $atts['id'] ); ?>"><?php esc_html_e( $atts['label'], 'mapple' ); ?>: </label><?php

}
$id         = esc_attr( $atts['id'] );
$options 	= get_option( $this->plugin_name . '-options' );
$apiKey 	= $options['gmap-api-key'];

if(! empty($apiKey)){
    wp_enqueue_script($this->plugin_name.'gmaps' , 'https://maps.googleapis.com/maps/api/js?key='.$apiKey.'&libraries=places&callback=initAutocomplete', '', $this->version, true );
    $disabled   = '';
    $placeholder = esc_attr( $atts['placeholder'] );
    $description = $atts['description'];
    ?>
    <script>
        var autocomplete;

        function initAutocomplete() {
            autocomplete = new google.maps.places.Autocomplete(
                /** @type {!HTMLInputElement} */(document.getElementById('<?php echo $id; ?>')),
                {types: ['geocode']});
            autocomplete.addListener('place_changed', fillInAddress);
        }

        function fillInAddress() {
            var place = autocomplete.getPlace().geometry.location;
            document.getElementById('client-location').value = place.lat()+', '+place.lng();
        }
    </script>
<?php
} else {
    $disabled   = 'disabled';
    $placeholder = __( 'please enter a valid google maps API key in Settings page!', 'mapple' );
    $description = __( 'this address field works with google maps autocomplete functionality', 'mapple' );
}
?>

<input
	class="<?php echo esc_attr( $atts['class'] ); ?>"
	id="<?php echo $id; ?>"
	name="<?php echo esc_attr( $atts['name'] ); ?>"
	placeholder="<?php echo $placeholder; ?>"
	type="<?php echo esc_attr( $atts['type'] ); ?>"
	value="<?php echo esc_attr( $atts['value'] ); ?>"
    autocomplete="off"
    <?php echo $disabled; ?> /><?php

if ( ! empty( $description ) ) {

	?><span class="description"><?php esc_html_e( $description, 'mapple' ); ?></span><?php

}; ?>