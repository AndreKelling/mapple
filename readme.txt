=== Plugin Name ===
Contributors: andrekelling
Donate link: https://andrekelling.de/
Tags: google maps, client map, client table
Requires at least: 4.7
Tested up to: 4.9.5
Stable tag: 1.0.0
Requires PHP: 7
License: GPLv3.0 or later
License URI: https://www.gnu.org/licenses/gpl-3.0.html

To show a google map with the locations of your clients. You can output additionally a sorted listing table of all your clients. Just with shortcodes.

== Description ==

This plugin is for showing your clients.
You can output a google map with markers and a table as a list of all clients.

The google map is centered shown to all markers added. Markers got little Infowindows with client's name, website and address

A few notes about technical things:

*   provides a new custom post type `clients`
*   map functionality works over the REST_API

### Shortcodes

* `[mapple_map]` will create the google map with marker
* `[mapple_clients]` will create a table with all clients

== Installation ==

1. Upload the plugin files to the `/wp-content/plugins/plugin-name` directory, or install the plugin through the WordPress plugins screen directly.
2. Activate the plugin through the 'Plugins' screen in WordPress
3. Use the Clients->Settings screen to configure the plugin. Get a Google Maps API key and enter on this plugin's settings page.

== Screenshots ==

1. Output of Map and Table on the Front End. In between some text. You can place your shortcodes around.
2. New custom clients Post Type with address autocompletion

== Changelog ==

= 1.0.0 =
* Initial version