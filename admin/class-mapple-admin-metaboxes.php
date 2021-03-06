<?php
/**
 * The metabox-specific functionality of the plugin.
 *
 * @link 		https://andrekelling.de
 * @since 		1.0.0
 *
 * @package 	Mapple
 * @subpackage 	Mapple/admin
 */

/**
 * The metabox-specific functionality of the plugin.
 *
 * @package 	Mapple
 * @subpackage 	Mapple/admin
 * @author     André Kelling <kontakt@andrekelling.de>
 */

class Mapple_Admin_Metaboxes {

	/**
	 * The post meta data
	 *
	 * @since 		1.0.0
	 * @access 		private
	 * @var 		string 			$meta    			The post meta data.
	 */
	private $meta;

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
	 * @since 		1.0.0
	 * @access 		private
	 * @var 		string 			$version 			The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since 		1.0.0
	 * @param 		string 			$Mapple 		The name of this plugin.
	 * @param 		string 			$version 			The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

		$this->set_meta();

	}

	/**
	 * Registers metaboxes with WordPress
	 *
	 * @since 	1.0.0
	 * @access 	public
	 */
	public function add_metaboxes() {

		// add_meta_box( $id, $title, $callback, $screen, $context, $priority, $callback_args );

		add_meta_box(
			'mapple_client_additional_info',
			apply_filters( $this->plugin_name . '-metabox-title-additional-info', esc_html__( 'Additional Client Info', 'mapple' ) ),
			array( $this, 'metabox' ),
			'clients',
			'normal',
			'default',
			array(
				'file' => 'client-additional-info'
			)
		);

	} // add_metaboxes()

	/**
	 * Check each nonce. If any don't verify, $nonce_check is increased.
	 * If all nonces verify, returns 0.
	 *
	 * @since 		1.0.0
	 * @access 		public
	 * @return 		int 		The value of $nonce_check
	 */
	private function check_nonces( $posted ) {

		$nonces 		= array();
		$nonce_check 	= 0;

		$nonces[] 		= 'client_additional_info';

		foreach ( $nonces as $nonce ) {

			if ( ! isset( $posted[$nonce] ) ) { $nonce_check++; }
			if ( isset( $posted[$nonce] ) && ! wp_verify_nonce( $posted[$nonce], $this->plugin_name ) ) {$nonce_check++;}

		}

		return $nonce_check;

	} // check_nonces()

	/**
	 * Returns an array of the all the metabox fields and their respective types
	 *
	 * @since 		1.0.0
	 * @access 		public
	 * @return 		array 		Metabox fields and types
	 */
	private function get_metabox_fields() {

		$fields = array();

        $fields[] = array( 'client-address', 'text' );
		$fields[] = array( 'client-location', 'text' );
		$fields[] = array( 'client-url', 'text' );
		$fields[] = array( 'client-urlname', 'text' );

		return $fields;

	} // get_metabox_fields()

	/**
	 * Calls a metabox file specified in the add_meta_box args.
	 *
	 * @since 	1.0.0
	 * @access 	public
	 * @return 	void
	 */
	public function metabox( $post, $params ) {

		if ( ! is_admin() ) { return; }
		if ( 'clients' !== $post->post_type ) { return; }

		include( plugin_dir_path( __FILE__ ) . 'partials/mapple-admin-metabox-' . $params['args']['file'] . '.php' );

	} // metabox()

	/**
	 * @param $type
	 * @param $data
	 *
	 * @return mixed|string|void
	 */
	private function sanitizer( $type, $data ) {
		//wp_die( '<pre>' . print_r( $type ) . '</pre>' );
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
	public function set_meta() {

		global $post;
		//wp_die( '<pre>' . print_r( $post ) . '</pre>' );
		if ( empty( $post ) ) { return; }
		if ( 'clients' != $post->post_type ) { return; }

		//wp_die( '<pre>' . print_r( $post->ID ) . '</pre>' );

		$this->meta = get_post_custom( $post->ID );

	} // set_meta()

	/**
	 * Saves metabox data
	 *
	 * Repeater section works like this:
	 *  	Loops through meta fields
	 *  		Loops through submitted data
	 *  		Sanitizes each field into $clean array
	 *   	Gets max of $clean to use in FOR loop
	 *   	FOR loops through $clean, adding each value to $new_value as an array
	 *
	 * @since 	1.0.0
	 * @access 	public
	 * @param 	int 		$post_id 		The post ID
	 * @param 	object 		$object 		The post object
	 * @return 	void
	 */
	public function validate_meta( $post_id, $object ) {

		//wp_die( '<pre>' . print_r( $_POST ) . '</pre>' );

		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) { return $post_id; }
		if ( ! current_user_can( 'edit_post', $post_id ) ) { return $post_id; }
		if ( 'clients' !== $object->post_type ) { return $post_id; }

		$nonce_check = $this->check_nonces( $_POST );

		if ( 0 < $nonce_check ) { return $post_id; }

		$metas = $this->get_metabox_fields();

		foreach ( $metas as $meta ) {

			$name = $meta[0];
			$type = $meta[1];

			$new_value = $this->sanitizer( $type, $_POST[$name] );

			update_post_meta( $post_id, $name, $new_value );

		} // foreach

	} // validate_meta()

	/**
	 * Add posts meta field to rest_api callback
	 */
	function filter_clients_json( $data, $post ) {
		$address = get_post_meta( $post->ID, 'client-address', true );
		$location = get_post_meta( $post->ID, 'client-location', true );
		$url = get_post_meta( $post->ID, 'client-url', true );
		$urlName = get_post_meta( $post->ID, 'client-urlname', true );

        $data->data['address'] = $address;
        $data->data['location'] = $location;
        $data->data['url'] = $url;
        $data->data['urlname'] = $urlName;

		return $data;
	}

} // class
