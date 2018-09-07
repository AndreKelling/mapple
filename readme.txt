=== Mapple ===
Contributors: andrekelling
Donate link: https://andrekelling.de/
Tags: google maps, client cpt, shortcode, no jquery, no style
Requires at least: 4.7
Tested up to: 4.9.5
Stable tag: 1.5.0
Requires PHP: 7.0
License: GPLv3.0 or later
License URI: https://www.gnu.org/licenses/gpl-3.0.html

To show a google map with the locations of your clients. You can output additionally a sorted listing table of all your clients. Just with shortcodes.

== Description ==

This plugin is for showing your clients.
You can output a google map with markers and a table as a list of all clients.
You can tag clients and show a search and filter bar.
This Plugin does not need jQuery on the FrontEnd!

The google map is centered shown to all markers added. Markers got little Infowindows with client's name, website and address.
Map style and marker image customisation is possible.

A few notes about technical things:

*   provides a new custom post type `clients`
*   map functionality works over the REST_API

### Shortcodes

* `[mapple_map]` will create the google map with marker
* `[mapple_clients]` will create a table with all clients

There are a few possible attributes you can provide to your `mapple_clients` shortcode.
Here a full example with all possible options:

`[mapple_clients title-name="Name" title-address="Adresse" title-desc="Beschreibung" title-tags="Branche" title-search="Suche" title-search-placeholder="lostippen..." title-filter-label="Nach Branche filtern" with-tags="true" with-search="true"]`
all `title-` attributes are for customising wordings.

`[mapple_clients title-name="Name" title-address="Adresse" title-desc="Beschreibung" title-tags="Branche" title-search="Suche" title-search-placeholder="lostippen..." title-filter-label="Nach Branche filtern"]`

all `with-` attributes activate the tags coloumn, and filter when search is also active.

`[mapple_clients with-tags="true" with-search="true"]`

### Credit

* Plugin banner image taken from <a href="https://unsplash.com/@rawpixel?utm_medium=referral&amp;utm_campaign=photographer-credit&amp;utm_content=creditBadge" target="_blank" rel="noopener noreferrer" title="Download free do whatever you want high-resolution photos from rawpixel">rawpixel</a>

== Installation ==

1. Upload the plugin files to the `/wp-content/plugins/plugin-name` directory, or install the plugin through the WordPress plugins screen directly.
2. Activate the plugin through the 'Plugins' screen in WordPress
3. Use the Clients->Settings screen to configure the plugin. Get a Google Maps API key and enter on this plugin's settings page.

== Screenshots ==

1. Output of Map and Table on the Front End. In between some text. You can place your shortcodes around.
2. custom styled Map with open infowindow
3. New custom clients Post Type with address autocompletion
4. Enable search and filter section for clients in the table

== Changelog ==

= 1.5.0 =
* enable google maps marker image customisation
* fix infowindow opening when thumbnail image size missing
* remove nowrap style from table title column

= 1.4.1 =
* fix JS error appearing on pages without mapple_clients table output

= 1.4.0 =
* enable google maps style customisation
* remove unused `php_vars` from wp_localize_script

= 1.3.0 =
* enable shortcode attribute `title-filter-label` to customise tag filter label
* enable cpt clients featured image to get used in maps info window

= 1.2.0 =
* fix to show just the tags used by custom post type clients and not all

= 1.1.0 =
* enable tag's for custom post type "clients"
* add optional show tag's column in clients table
* add optional search and filter section for clients table
* enable shortcode attributes to customise table headings

= 1.0.0 =
* Initial version
