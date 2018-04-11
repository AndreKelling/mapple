# Mapple
WordPress Plugin to show a client map and data table

* Requires at least: 4.7
* Tested up to: 4.9.5
* License: GPLv3.0 or later
* License URI: https://www.gnu.org/licenses/gpl-3.0.html

## Description

This plugin is for showing a list of clients. 
You can output a google map with marker and a table as a list of all clients.

![Out of Map and Table](/../<screenshots>/screenshots/fe-output.jpg?raw=true "Out of Map and Table on the Front End")

The google map is centered to all markers added. Markers got little Infowindows with client's name, website and address

![custom clients Post Type](/../<screenshots>/screenshots/be-post.jpg?raw=true "New custom clients Post Type with address autocompletion")

A few notes about technical things:

*   provides a new custom post type `clients`
*   map functionality works over the REST_API

### Shortcodes

* `[mapple_map]` will create the google map with marker
* `[mapple_clients]` will create a table with all clients

## Installation

1. Upload `mapple` directory to your `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Get a Google Maps API key and enter on this plugin's settings page
