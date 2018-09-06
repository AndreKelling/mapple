<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://andrekelling.de
 * @since      1.0.0
 *
 * @package    Mapple
 * @subpackage Mapple/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Mapple
 * @subpackage Mapple/public
 * @author     André Kelling <kontakt@andrekelling.de>
 */
class Mapple_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Mapple_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Mapple_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/mapple-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Mapple_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Mapple_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/mapple-public.js', array($this->plugin_name.'gmaps'), $this->version, true );

		$options 	= get_option( $this->plugin_name . '-options' );
		$apiKey 	= $options['gmap-api-key'];
		$styleJSON 	= $options['gmap-style-json'];

		if(! empty($apiKey)){
			wp_enqueue_script($this->plugin_name.'gmaps' , 'https://maps.googleapis.com/maps/api/js?key='.$apiKey, '', $this->version, true );

			if(! empty($styleJSON)){
				$dataToBePassed = array(
					'styleJSON'            => json_decode($styleJSON)
				);
				wp_localize_script( $this->plugin_name, 'mapple_vars', $dataToBePassed );
			}
		}
	}

	/**
	 * Processes shortcode mapple_map
	 * output just a div which will self initialise the google map
	 *
	 * @return string
	 */
	public function mappleMap() {
		return '<div class="mapple__canvas" data-mapple="initMap"></div>';
	} // mappleMap()

	/**
	 * Processes shortcode mapple_clients
	 *
	 * @param   array	$atts		The attributes from the shortcode
	 *
	 * @uses	get_layout
	 *
	 * @return	mixed	$output		Output of the buffer
	 */
	public function mappleClients( $atts = array() ) {

		ob_start();

		$titles = ['name', 'address', 'desc', 'tags', 'search', 'search-placeholder'];
		$defautTitles = [ __( 'Title', 'mapple' ),  __( 'Address', 'mapple' ), __( 'Description', 'mapple' ), __( 'Keywords', 'mapple' ), __( 'Search', 'mapple' ), __( 'start typing...', 'mapple' )];

		if (empty($atts)){
			$atts = array();
		}
		foreach ($titles as $key=>$value){
			if ( empty( $atts['title-'.$value] ) ) {
				$atts['title-'.$value] = $defautTitles[$key];
			}
		}

		$defaults['loop-template'] 	= $this->plugin_name . '-loop-clients';
		$defaults['orderby'] 		= 'title';
		$defaults['quantity'] 		= 0;

		$shared 					= new Mapple_Shared( $this->plugin_name, $this->version );
		// @todo: find a better approach to get the tags without the need calling `get_clients` a second time below
		$clientTagNames             = $shared->get_clients_tags($defaults);
		// @todo: find better approach to include the tagsNames in the template as via shortcode attributes var
		$atts['clientTagNames']     = $clientTagNames;

		$args						= shortcode_atts( $defaults, $atts, 'mapple' );
		$items 						= $shared->get_clients( $args );

		if ( is_array( $items ) || is_object( $items ) ) {

			include mapple_get_template( $args['loop-template'] );

		} else {

			echo $items;

		}

		$output = ob_get_contents();

		ob_end_clean();

		return $output;

	} // mappleClients()

	/**
	 * Registers all shortcodes at once
	 *
	 * @return [type] [description]
	 */
	public function register_shortcodes() {

		add_shortcode( 'mapple_map', array( $this, 'mappleMap' ) );
		add_shortcode( 'mapple_clients', array( $this, 'mappleClients' ) );

	} // register_shortcodes()
}
