# Mapple - WordPress plugin
A WordPress plugin to show a client map and data table

* Requires at least: 4.7
* Tested up to: 4.9.5
* License: GPLv3.0 or later
* License URI: https://www.gnu.org/licenses/gpl-3.0.html

## Description

This plugin is for showing a list of clients. 
You can output a google map with marker and a table as a list of all clients.
You can tag clients and show a search and filter bar.
This Plugin does not need jQuery on the FrontEnd!

![Output of Map and Table](/../screenshots/screenshots/fe-output.jpg?raw=true "Output of Map and Table on the Front End")

The google map is centered to all markers added. Markers got little Infowindows with client's name, website and address.
Map style and marker image customisation is possible.

![custom clients Post Type](/../screenshots/screenshots/be-post.jpg?raw=true "New custom clients Post Type with address autocompletion")

A few notes about technical things:

*   provides a new custom post type `clients`
*   map functionality works over the REST_API

### Shortcodes

* `[mapple_map]` will create the google map with marker
* `[mapple_clients]` will create a table with all clients

There are a few possible attributes you can provide to your `mapple_clients` shortcode.
Here a full example with all possible options:

`[mapple_clients title-name="Name" title-address="Adresse" title-desc="Beschreibung" title-tags="Branche" title-search="Suche" title-search-placeholder="lostippen..." with-tags="true" with-search="true"]`
* all `title-` attributes are for customising wordings.
`[mapple_clients title-name="Name" title-address="Adresse" title-desc="Beschreibung" title-tags="Branche" title-search="Suche" title-search-placeholder="lostippen..."]`
* all `with-` attributes activate the tags coloumn, and filter when search is also active.
`[mapple_clients with-tags="true" with-search="true"]`

## Installation

1. Upload `mapple` directory to your `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Get a Google Maps API key and enter on this plugin's settings page
