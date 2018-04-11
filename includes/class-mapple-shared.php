<?php

/**
 * The public & admin-facing shared functionality of the plugin.
 *
 * @link 		https://andrekelling.de
 * @since 		1.0.0
 *
 * @package 	Mapple
 * @subpackage 	Mapple/includes
 */

 // Prevent direct file access
if ( ! defined ( 'ABSPATH' ) ) { exit; }

class Mapple_Shared {

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

	}

	/**
	 * Returns a post object of mapple posts
	 *
	 * @param 	array 		$params 			An array of optional parameters
	 * 							types 			An array of clients item type slugs
	 * 							quantity		Number of posts to return
	 * @param 	string 		$cache 				String to create a new cache of posts
	 *
	 * @return 	object 		A post object
	 */
	public function get_clients( $params, $cache = '' ) {

		$return 	= '';
		$cache_name = $this->plugin_name . '_clients_posts';

		if ( ! empty( $cache ) ) {

			$cache_name .= '_' . $cache;

		}

		$return = wp_cache_get( $cache_name, $this->plugin_name . '_clients_posts' );



		if ( false === $return ) {

			$args 	= $this->set_args( $params );
			$query 	= new WP_Query( $args );

			if ( is_wp_error( $query ) ) {

//				$options 	= get_option( $this->plugin_name . '-options' );
//				$return 	= $options['message-no-openings'];
				$return 	= 'no clients';

			} else {

				wp_cache_set( $cache_name, $query->posts, $this->plugin_name . '_clients_posts', 5 * MINUTE_IN_SECONDS );

				$return = $query->posts;

			}
		}

		return $return;

	} // get_openings()

	/**
	 * Sets the args array for a WP_Query call
	 *
	 * @param 	array 		$params 		Array of shortcode parameters
	 * @return 	array 						An array of parameters for WP_Query
	 */
	private function set_args( $params ) {

		if ( empty( $params ) ) { return; }

		$args = array();

		$args['no_found_rows']			= true;
		$args['orderby'] 				= $params['orderby'];
        $args['order']                  = 'ASC';
		$args['posts_per_page'] 		= absint( $params['quantity'] );
		$args['post_status'] 			= 'publish';
		$args['post_type'] 				= 'clients';
		$args['update_post_term_cache'] = false;

		unset( $params['orderby'] );
		unset( $params['quantity'] );
		unset( $params['listview'] );
		unset( $params['singleview'] );

		if ( empty( $params ) ) { return $args; }

		$args = wp_parse_args( $params, $args );

		return $args;

	} // set_args()

} // class