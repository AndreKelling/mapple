<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://slushman.com
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
	 * Includes the link end template file
	 *
	 * @hooked 		mapple-after-loop-content 		10
	 *
	 * @param 		object 		$item 		A post object
	 * @param 		array 		$meta 		The post metadata
	 */
	public function content_link_end( $item, $meta ) {

		include Mapple_get_template( 'mapple-content-link-end' );

	} // content_link_end()

	/**
	 * Includes the link start template file
	 *
	 * @hooked 		mapple-before-loop-content 		15
	 *
	 * @param 		object 		$item 		A post object
	 * @param 		array 		$meta 		The post metadata
	 */
	public function content_link_start( $item, $meta ) {

		include Mapple_get_template( 'mapple-content-link-start' );

	} // content_link_start()

	/**
	 * Includes the content wrap end template file
	 *
	 * @hooked 		mapple-after-loop-content 		90
	 *
	 * @param 		object 		$item 		A post object
	 * @param 		array 		$meta 		The post metadata
	 */
	public function content_wrap_end( $item, $meta ) {

		include Mapple_get_template( 'mapple-content-wrap-end' );

	} // content_wrap_end()

	/**
	 * Includes the content wrap start template file
	 *
	 * @hooked 		mapple-before-loop-content 		10
	 */
	public function content_wrap_start() {

		include Mapple_get_template( 'mapple-content-wrap-start' );

	} // content_wrap_start()

	/**
	 * Returns an array of the featured image details
	 *
	 * @param 	int 	$postID 		The post ID
	 * @return 	array 					Array of info about the featured image
	 */
	public function get_featured_images( $postID ) {

		if ( empty( $postID ) ) { return FALSE; }

		$imageID = get_post_thumbnail_id( $postID );

		if ( empty( $imageID ) ) { return FALSE; }

		return wp_prepare_attachment_for_js( $imageID );

	} // get_featured_images()

	/**
	 * Includes the list wrap end template file
	 *
	 * @hooked 		mapple-after-loop 		10
	 */
	public function list_wrap_end() {

		include Mapple_get_template( 'mapple-list-wrap-end' );

	} // list_wrap_end()

	/**
	 * Includes the list wrap start template file
	 *
	 * @hooked 		mapple-before-loop 		10
	 */
	public function list_wrap_start() {

		include Mapple_get_template( 'mapple-list-wrap-start' );

	} // list_wrap_start()

	/**
	 * Includes the single client post content
	 *
	 * @hooked 		mapple-single-content 	15
	 */
	public function single_post_content() {

		include Mapple_get_template( 'single-client-post-content' );

	} // single_post_content()

	/**
	 * Includes the single client post metadata for location
	 *
	 * @hooked 		mapple-single-content 	25
	 *
	 * @param 		array 		$meta 		The post metadata
	 */
	public function single_post_location( $meta ) {

		include Mapple_get_template( 'single-client-meta-location' );

	} // single_post_location()

	/**
	 * Includes the single client post metadata for location
	 *
	 * @hooked 		mapple-single-content 	20
	 *
	 * @param 		array 		$meta 		The post metadata
	 */
	public function single_post_url( $meta ) {

		include Mapple_get_template( 'single-client-meta-url' );

	} // single_post_location()

	/**
	 * Includes the single client post title
	 *
	 * @hooked 		mapple-single-content 		10
	 */
	public function single_post_title() {

		include Mapple_get_template( 'single-client-post-title' );

	} // single_post_title()

	/**
	 * Includes the single client post thumbnail
	 *
	 * @hooked 		mapple-single-thumbnail 		5
	 */
	public function single_post_thumbnail() {

		include Mapple_get_template( 'single-client-post-thumbnail' );

	} // single_post_title()

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