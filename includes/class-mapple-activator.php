<?php

/**
 * Fired during plugin activation
 *
 * @link       https://andrekelling.de
 * @since      1.0.0
 *
 * @package    Mapple
 * @subpackage Mapple/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Mapple
 * @subpackage Mapple/includes
 * @author     André Kelling <kontakt@andrekelling.de>
 */
class Mapple_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
	    require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-mapple-admin.php';

        Mapple_Admin::new_cpt_clients();

        flush_rewrite_rules(false);
	}

}
