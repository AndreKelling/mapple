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
 * Defines the methods for creating the templates.
 *
 * @package    Mapple
 * @subpackage Mapple/public
 *
 */
class Mapple_Template_Functions {

	/**
	 * Private static reference to this class
	 * Useful for removing actions declared here.
	 *
	 * @var 	object 		$_this
 	 */
	private static $_this;

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
	 * @param      string    $version 			The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		self::$_this = $this;

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	} // __construct()

	/**
	 * Includes the mapple-client-title template
	 *
	 * @hooked 		mapple-loop-content 		10
	 *
	 * @param 		object 		$item 		A post object
	 * @param 		array 		$meta 		The post metadata
	 */
	public function content_client_content( $item, $meta ) {

		include Mapple_get_template( 'mapple-client-content' );

	} // content_client_title()

	/**
	 * Includes the list wrap end template file
	 *
	 * @hooked 		mapple-after-loop 		10
	 */
	public function client_table_end() {

		include Mapple_get_template( 'mapple-client-table-end' );

	} // list_wrap_end()

	/**
	 * Includes the list wrap start template file
	 *
	 * @hooked 		mapple-before-loop 		10
	 */
	public function client_table_start( $atts ) {

		include Mapple_get_template( 'mapple-client-table-start' );

	} // list_wrap_start()

	/**
	 * Returns a reference to this class. Used for removing
	 * actions and/or filters declared using an object of this class.
	 *
	 * @see  	http://hardcorewp.com/2012/enabling-action-and-filter-hook-removal-from-class-based-wordpress-plugins/
	 * @return 	object 		This class
	 */
	static function this() {

		return self::$_this;

	} // this()

} // class