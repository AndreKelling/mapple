<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://andrekelling.de
 * @since      1.0.0
 *
 * @package    Mapple
 * @subpackage Mapple/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Mapple
 * @subpackage Mapple/admin
 * @author     André Kelling <kontakt@andrekelling.de>
 */
class Mapple_Admin {

	/**
	 * The plugin options.
	 *
	 * @since 		1.0.0
	 * @access 		private
	 * @var 		string 			$options    The plugin options.
	 */
	private $options;

	/**
	 * The ID of this plugin.
	 *
	 * @since 		1.0.0
	 * @access 		private
	 * @var 		string 			$plugin_name 		The ID of this plugin.
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
	 * @param      string    $plugin_name   The name of this plugin.
	 * @param      string    $version       The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

		$this->set_options();
	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.5.0
	 */
	function enqueue_scripts() {
		wp_enqueue_media();
		wp_register_script('media-uploader', plugins_url('js/media-uploader.js' , __FILE__ ), array('jquery'));
		wp_enqueue_script('media-uploader');
	}

	/**
	 * Adds a settings page link to a menu
	 *
	 * @link 		https://codex.wordpress.org/Administration_Menus
	 * @since 		1.0.0
	 * @return 		void
	 */
	public function add_menu() {

		// Top-level page
		// add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position );

		// Submenu Page
		// add_submenu_page( $parent_slug, $page_title, $menu_title, $capability, $menu_slug, $function);

		add_submenu_page(
			'edit.php?post_type=clients',
			apply_filters( $this->plugin_name . '-settings-page-title', esc_html__( 'Mapple Settings', 'mapple' ) ),
			apply_filters( $this->plugin_name . '-settings-menu-title', esc_html__( 'Settings', 'mapple' ) ),
			'manage_options',
			$this->plugin_name . '-settings',
			array( $this, 'page_options' )
		);
		
	} // add_menu()

	/**
	 * Creates a new custom post type
	 *
	 * @since 	1.0.0
	 * @access 	public
	 * @uses 	register_post_type()
	 */
	public static function new_cpt_clients() {
		$cap_type 	= 'post';
		$plural 	= 'Clients';
		$single 	= 'Client';
		$cpt_name 	= 'clients';
		$opts['can_export']								= TRUE;
		$opts['capability_type']						= $cap_type;
		$opts['description']							= '';
		$opts['exclude_from_search']					= FALSE;
		$opts['has_archive']							= FALSE;
		$opts['hierarchical']							= FALSE;
		$opts['map_meta_cap']							= TRUE;
		$opts['menu_icon']								= 'dashicons-location-alt';
		$opts['menu_position']							= 25;
		$opts['public']									= TRUE;
		$opts['publicly_querable']						= TRUE;
		$opts['query_var']								= TRUE;
		$opts['register_meta_box_cb']					= '';
		$opts['rewrite']								= FALSE;
		$opts['show_in_admin_bar']						= TRUE;
		$opts['show_in_menu']							= TRUE;
		$opts['show_in_nav_menu']						= TRUE;
		$opts['show_ui']								= TRUE;
		$opts['supports']								= array( 'title', 'editor', 'excerpt', 'thumbnail' );
		$opts['taxonomies']								= array('post_tag');
		$opts['show_in_rest']                           = TRUE;
  		$opts['rest_controller_class']                  = 'WP_REST_Posts_Controller';
		$opts['capabilities']['delete_others_posts']	= "delete_others_{$cap_type}s";
		$opts['capabilities']['delete_post']			= "delete_{$cap_type}";
		$opts['capabilities']['delete_posts']			= "delete_{$cap_type}s";
		$opts['capabilities']['delete_private_posts']	= "delete_private_{$cap_type}s";
		$opts['capabilities']['delete_published_posts']	= "delete_published_{$cap_type}s";
		$opts['capabilities']['edit_others_posts']		= "edit_others_{$cap_type}s";
		$opts['capabilities']['edit_post']				= "edit_{$cap_type}";
		$opts['capabilities']['edit_posts']				= "edit_{$cap_type}s";
		$opts['capabilities']['edit_private_posts']		= "edit_private_{$cap_type}s";
		$opts['capabilities']['edit_published_posts']	= "edit_published_{$cap_type}s";
		$opts['capabilities']['publish_posts']			= "publish_{$cap_type}s";
		$opts['capabilities']['read_post']				= "read_{$cap_type}";
		$opts['capabilities']['read_private_posts']		= "read_private_{$cap_type}s";
		$opts['labels']['add_new']						= esc_html__( "Add New {$single}", 'mapple' );
		$opts['labels']['add_new_item']					= esc_html__( "Add New {$single}", 'mapple' );
		$opts['labels']['all_items']					= esc_html__( $plural, 'mapple' );
		$opts['labels']['edit_item']					= esc_html__( "Edit {$single}" , 'mapple' );
		$opts['labels']['menu_name']					= esc_html__( $plural, 'mapple' );
		$opts['labels']['name']							= esc_html__( $plural, 'mapple' );
		$opts['labels']['name_admin_bar']				= esc_html__( $single, 'mapple' );
		$opts['labels']['new_item']						= esc_html__( "New {$single}", 'mapple' );
		$opts['labels']['not_found']					= esc_html__( "No {$plural} Found", 'mapple' );
		$opts['labels']['not_found_in_trash']			= esc_html__( "No {$plural} Found in Trash", 'mapple' );
		$opts['labels']['parent_item_colon']			= esc_html__( "Parent {$plural} :", 'mapple' );
		$opts['labels']['search_items']					= esc_html__( "Search {$plural}", 'mapple' );
		$opts['labels']['singular_name']				= esc_html__( $single, 'mapple' );
		$opts['labels']['view_item']					= esc_html__( "View {$single}", 'mapple' );
		$opts['rewrite']['ep_mask']						= EP_PERMALINK;
		$opts['rewrite']['feeds']						= FALSE;
		$opts['rewrite']['pages']						= TRUE;
		$opts['rewrite']['slug']						= esc_html__( strtolower( $cpt_name ), 'mapple' );
		$opts['rewrite']['with_front']					= FALSE;
		$opts = apply_filters( $cpt_name.'-cpt-options', $opts );
		register_post_type( strtolower( $cpt_name ), $opts );
	} // new_cpt_clients()

	/**
	 * Creates the options page
	 *
	 * @since 		1.0.0
	 * @return 		void
	 */
	public function page_options() {
		include( plugin_dir_path( __FILE__ ) . 'partials/mapple-admin-page-settings.php' );
	} // page_options()

	/**
	 * Creates a text field
	 *
	 * @param 	array 		$args 			The arguments for the field
	 * @return 	string 						The HTML field
	 */
	public function field_text( $args ) {

		$defaults['class'] 			= 'widefat';
		$defaults['description'] 	= '';
		$defaults['label'] 			= '';
		$defaults['name'] 			= $this->plugin_name . '-options[' . $args['id'] . ']';
		$defaults['placeholder'] 	= '';
		$defaults['type'] 			= 'text';
		$defaults['value'] 			= '';

		apply_filters( $this->plugin_name . '-field-text-options-defaults', $defaults );

		$atts = wp_parse_args( $args, $defaults );

		if ( ! empty( $this->options[$atts['id']] ) ) {

			$atts['value'] = $this->options[$atts['id']];

		}

		include( plugin_dir_path( __FILE__ ) . 'partials/' . $this->plugin_name . '-admin-field-text.php' );

	} // field_text()

	/**
	 * Creates a textarea field
	 *
	 * @param 	array 		$args 			The arguments for the field
	 * @return 	string 						The HTML field
	 */
	public function field_textarea( $args ) {

		$defaults['class'] 			= 'widefat';
		$defaults['description'] 	= '';
		$defaults['label'] 			= '';
		$defaults['name'] 			= $this->plugin_name . '-options[' . $args['id'] . ']';
		$defaults['placeholder'] 	= '';
		$defaults['value'] 			= '';
		$defaults['rows'] 			= 6;

		apply_filters( $this->plugin_name . '-field-text-options-defaults', $defaults );

		$atts = wp_parse_args( $args, $defaults );

		if ( ! empty( $this->options[$atts['id']] ) ) {

			$atts['value'] = $this->options[$atts['id']];

		}

		include( plugin_dir_path( __FILE__ ) . 'partials/' . $this->plugin_name . '-admin-field-textarea.php' );

	} // field_textarea()

	/**
	 * Creates a image upload field
	 *
	 * @param 	array 		$args 			The arguments for the field
	 * @return 	string 						The HTML field
	 */
	public function field_image( $args ) {

		$defaults['class'] 			= 'widefat';
		$defaults['description'] 	= '';
		$defaults['label'] 			= '';
		$defaults['name'] 			= $this->plugin_name . '-options[' . $args['id'] . ']';
		$defaults['placeholder'] 	= '';
		$defaults['type'] 			= 'text';
		$defaults['value'] 			= '';

		apply_filters( $this->plugin_name . '-field-text-options-defaults', $defaults );

		$atts = wp_parse_args( $args, $defaults );

		if ( ! empty( $this->options[$atts['id']] ) ) {

			$atts['value'] = $this->options[$atts['id']];

		}

		include( plugin_dir_path( __FILE__ ) . 'partials/' . $this->plugin_name . '-admin-field-image.php' );

	} // field_image()

	/**
	 * Returns an array of options names, fields types, and default values
	 *
	 * @return 		array 			An array of options
	 */
	public static function get_options_list() {

		$options = array();

		$options[] = array( 'gmap-api-key', 'text', '' );
		$options[] = array( 'gmap-style-json', 'text', '' );
		$options[] = array( 'gmap-marker-image', 'text', '' );

		return $options;

	} // get_options_list()

	/**
	 * Registers settings fields with WordPress
	 */
	public function register_fields() {
		//wp_die( print_r( $this ) );
		// add_settings_field( $id, $title, $callback, $menu_slug, $section, $args );

		add_settings_field(
			'gmap-api-key',
			apply_filters( $this->plugin_name . 'label-gmap-api-key', esc_html__( 'Google Maps API key', 'mapple' ) ),
			array( $this, 'field_text' ),
			$this->plugin_name,
			$this->plugin_name . '-api',
			array(
				'description' 	=> esc_html__( 'Enter your key and save.', 'mapple' ),
				'id' 			=> 'gmap-api-key',
				'placeholder'   => 'tHiSwIlLbEyOuRkEyToGoOgLeMaPsApI'
			)
		);

		add_settings_field(
			'gmap-style-json',
			apply_filters( $this->plugin_name . 'label-gmap-style-json', esc_html__( 'Google Maps Style JSON', 'mapple' ) ),
			array( $this, 'field_textarea' ),
			$this->plugin_name,
			$this->plugin_name . '-api',
			array(
				'description' 	=> esc_html__( 'There is a nice tool https://mapstyle.withgoogle.com/ to create the JSON.', 'mapple' ),
				'id' 			=> 'gmap-style-json',
				'placeholder'   => esc_html__( 'put your JSON code inside here', 'mapple' ),
				'rows'          => 24,
			)
		);

		add_settings_field(
			'gmap-marker-image',
			apply_filters( $this->plugin_name . 'label-gmap-marker-image', esc_html__( 'Google Maps Marker Image', 'mapple' ) ),
			array( $this, 'field_image' ),
			$this->plugin_name,
			$this->plugin_name . '-api',
			array(
				'description' 	=> esc_html__( 'Upload Image or paste in URL', 'mapple' ), // @todo add size info
				'id' 			=> 'gmap-marker-image',
				'placeholder'   => esc_html__( 'image path here...', 'mapple' ),
			)
		);
	} // register_fields()

	/**
	 * Registers settings sections with WordPress
	 */
	public function register_sections() {

		// add_settings_section( $id, $title, $callback, $menu_slug );
		//wp_die( print_r( $this->options ) );

		add_settings_section(
			$this->plugin_name . '-api',
			apply_filters( $this->plugin_name . 'section-title-api', esc_html__( 'Google Maps', 'mapple' ) ),
			array( $this, 'section_api' ),
			$this->plugin_name
		);

	} // register_sections()

	/**
	 * Registers plugin settings
	 *
	 * @since 		1.0.0
	 * @return 		void
	 */
	public function register_settings() {

		//wp_die( print_r( $this ) );
		// register_setting( $option_group, $option_name, $sanitize_callback );

		register_setting(
			$this->plugin_name . '-options',
			$this->plugin_name . '-options',
			array( $this, 'validate_options' )
		);

	} // register_settings()

	/**
	 * Creates a settings section
	 *
	 * @since 		1.0.0
	 * @param 		array 		$params 		Array of parameters for the section
	 * @return 		mixed 						The settings section
	 */
	public function section_api(  ) {

		include( plugin_dir_path( __FILE__ ) . 'partials/mapple-admin-settings-section-api.php' );

	} // section_api()

	private function sanitizer( $type, $data ) {

		if ( empty( $type ) ) { return; }
		if ( empty( $data ) ) { return; }

		$return 	= '';
		$sanitizer 	= new Mapple_Sanitize();

		$sanitizer->set_data( $data );
		$sanitizer->set_type( $type );

		$return = $sanitizer->clean();

		unset( $sanitizer );

		return $return;

	} // sanitizer()

	/**
	 * Sets the class variable $options
	 */
	private function set_options() {

		$this->options = get_option( $this->plugin_name . '-options' );

	} // set_options()

	/**
	 * Validates saved options
	 *
	 * @since 		1.0.0
	 * @param 		array 		$input 			array of submitted plugin options
	 * @return 		array 						array of validated plugin options
	 */
	public function validate_options( $input ) {

		$valid 		= array();
		$options 	= $this->get_options_list();

		//wp_die( print_r( $options ) );

		foreach ( $options as $option ) {

			$name = $option[0];
			$type = $option[1];

			$valid[$option[0]] = $this->sanitizer( $type, $input[$name] );
		}

		return $valid;

	} // validate_options()

}
