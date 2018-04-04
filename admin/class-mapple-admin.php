<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://example.com
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
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $mapple    The ID of this plugin.
	 */
	private $mapple;

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
			'edit.php?post_type=mapple',
			apply_filters( $this->plugin_name . '-settings-page-title', esc_html__( 'Mapple Settings', 'mapple' ) ),
			apply_filters( $this->plugin_name . '-settings-menu-title', esc_html__( 'Settings', 'mapple' ) ),
			'manage_options',
			$this->plugin_name . '-settings',
			array( $this, 'page_options' )
		);
		
	} // add_menu()

	/**
	 * Register the stylesheets for the admin area.
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

		wp_enqueue_style( $this->mapple, plugin_dir_url( __FILE__ ) . 'css/mapple-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
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

		wp_enqueue_script( $this->mapple, plugin_dir_url( __FILE__ ) . 'js/mapple-admin.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Creates a new custom post type
	 *
	 * @since 	1.0.0
	 * @access 	public
	 * @uses 	register_post_type()
	 */
	public static function new_cpt_map_entry() {
		$cap_type 	= 'post';
		$plural 	= 'Clients';
		$single 	= 'Client';
		$cpt_name 	= 'mapple';
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
		$opts['supports']								= array( 'title', 'editor', 'thumbnail' );
		$opts['taxonomies']								= array();
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
		$opts['rewrite']['slug']						= esc_html__( strtolower( 'clients' ), 'mapple' );
		$opts['rewrite']['with_front']					= FALSE;
		$opts = apply_filters( 'mapple-cpt-options', $opts );
		register_post_type( strtolower( $cpt_name ), $opts );
	} // new_cpt_map_entry()

	/**
	 * Creates a new taxonomy for a custom post type
	 *
	 * @todo: add taxonomy if needed
	 *
	 * @since 	1.0.0
	 * @access 	public
	 * @uses 	register_taxonomy()
	 */
	public static function new_taxonomy_type() {
		$plural 	= 'Types';
		$single 	= 'Type';
		$tax_name 	= 'mapple_type';
		$opts['hierarchical']							= TRUE;
		//$opts['meta_box_cb'] 							= '';
		$opts['public']									= TRUE;
		$opts['query_var']								= $tax_name;
		$opts['show_admin_column'] 						= FALSE;
		$opts['show_in_nav_menus']						= TRUE;
		$opts['show_tag_cloud'] 						= TRUE;
		$opts['show_ui']								= TRUE;
		$opts['sort'] 									= '';
		//$opts['update_count_callback'] 					= '';
		$opts['capabilities']['assign_terms'] 			= 'edit_posts';
		$opts['capabilities']['delete_terms'] 			= 'manage_categories';
		$opts['capabilities']['edit_terms'] 			= 'manage_categories';
		$opts['capabilities']['manage_terms'] 			= 'manage_categories';
		$opts['labels']['add_new_item'] 				= esc_html__( "Add New {$single}", 'mapple' );
		$opts['labels']['add_or_remove_items'] 			= esc_html__( "Add or remove {$plural}", 'mapple' );
		$opts['labels']['all_items'] 					= esc_html__( $plural, 'mapple' );
		$opts['labels']['choose_from_most_used'] 		= esc_html__( "Choose from most used {$plural}", 'mapple' );
		$opts['labels']['edit_item'] 					= esc_html__( "Edit {$single}" , 'mapple');
		$opts['labels']['menu_name'] 					= esc_html__( $plural, 'mapple' );
		$opts['labels']['name'] 						= esc_html__( $plural, 'mapple' );
		$opts['labels']['new_item_name'] 				= esc_html__( "New {$single} Name", 'mapple' );
		$opts['labels']['not_found'] 					= esc_html__( "No {$plural} Found", 'mapple' );
		$opts['labels']['parent_item'] 					= esc_html__( "Parent {$single}", 'mapple' );
		$opts['labels']['parent_item_colon'] 			= esc_html__( "Parent {$single}:", 'mapple' );
		$opts['labels']['popular_items'] 				= esc_html__( "Popular {$plural}", 'mapple' );
		$opts['labels']['search_items'] 				= esc_html__( "Search {$plural}", 'mapple' );
		$opts['labels']['separate_items_with_commas'] 	= esc_html__( "Separate {$plural} with commas", 'mapple' );
		$opts['labels']['singular_name'] 				= esc_html__( $single, 'mapple' );
		$opts['labels']['update_item'] 					= esc_html__( "Update {$single}", 'mapple' );
		$opts['labels']['view_item'] 					= esc_html__( "View {$single}", 'mapple' );
		$opts['rewrite']['ep_mask']						= EP_NONE;
		$opts['rewrite']['hierarchical']				= FALSE;
		$opts['rewrite']['slug']						= esc_html__( strtolower( $tax_name ), 'mapple' );
		$opts['rewrite']['with_front']					= FALSE;
		$opts = apply_filters( 'mapple-taxonomy-options', $opts );
		register_taxonomy( $tax_name, 'map', $opts );
	} // new_taxonomy_type()

	/**
	 * Creates the options page
	 *
	 * @since 		1.0.0
	 * @return 		void
	 */
	public function page_options() {
		include( plugin_dir_path( __FILE__ ) . 'partials/mapple-admin-page-settings.php' );
	} // page_options()

}
