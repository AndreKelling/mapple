<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://andrekelling.de
 * @since             1.0.0
 * @package           Mapple
 *
 * @wordpress-plugin
 * Plugin Name:       Mapple
 * Plugin URI:        https://andrekelling.de/
 * Description:       To show a google map with the locations of your clients. You can output additionally a sorted listing table of all your clients. Just with shortcodes.
 * Version:           1.5.0
 * Author:            André Kelling
 * Author URI:        https://andrekelling.de/about
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       mapple
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'MAPPLE_VERSION', '1.5.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-mapple-activator.php
 */
function activate_mapple() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-mapple-activator.php';
	Mapple_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-mapple-deactivator.php
 */
function deactivate_mapple() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-mapple-deactivator.php';
	Mapple_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_mapple' );
register_deactivation_hook( __FILE__, 'deactivate_mapple' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-mapple.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_mapple() {

	$plugin = new Mapple();
	$plugin->run();

}
run_mapple();
