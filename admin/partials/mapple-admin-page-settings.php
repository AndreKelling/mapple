<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://andrekelling.de
 * @since      1.0.0
 *
 * @package    Mapple
 * @subpackage Mapple/admin/partials
 */

?><h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
<form method="post" action="options.php"><?php

	settings_fields( $this->plugin_name . '-options' );

	do_settings_sections( $this->plugin_name );

	submit_button( 'Save Settings' );

	?></form>
<h4>Info</h4>
<p>
    <?php echo __( 'You can get an Google Maps API key here:', 'mapple' ); ?>
    <a href="https://developers.google.com/maps/documentation/javascript/get-api-key">https://developers.google.com/maps/documentation/javascript/get-api-key</a>.<br>
    <?php echo __( 'Just Works correct with WordPress since Version 4.7. As REST_API is used for creating the Map.', 'mapple' ); ?></p>
<h2><?php echo __( 'Help', 'mapple' ); ?></h2>
<h4>Shortcodes</h4>
<p><?php echo __( 'You can use two shortcodes with this plugin. It is possible to use them multiple times on a same site.', 'mapple' ); ?></p>
<ul>
    <li><code>[mapple_map]</code> <?php echo __( 'will create the google map with marker', 'mapple' ); ?></li>
    <li><code>[mapple_clients]</code> <?php echo __( 'will create a table with all clients', 'mapple' ); ?></li>
</ul>
<h4>Templates</h4>
<p>
    <?php echo __( 'You can overwrite Templates in your Theme by adding exact same names and same path in your Theme:', 'mapple' ); ?>
</p>
<p>
    <code>mapple/public/templates/{$name}.php</code>
</p>
<p>
    <code>YourTheme/mapple/public/templates/{$name}.php</code>
</p>

<h4>Style</h4>
<p>
    <?php echo __( 'There is just a very basic styling with CSS classes. You can remove and use your own by doing following in your themes\' functions.php', 'mapple' ); ?>
</p>
<p>
    <code>
        function project_dequeue_unnecessary_styles() {<br>
          wp_dequeue_style( 'mapple' );<br>
          wp_deregister_style( 'mapple' );<br>
        }<br>
        add_action( 'wp_print_styles', 'project_dequeue_unnecessary_styles' );<br>
    </code>
</p>

<h4>JavaScript</h4>
<p>
    <?php echo __( 'This plugin does not need jQuery. Instead it makes usage of ECMA script 6. So watch your Browser checklist or bring the plugin\'s used script into a fallback compiler', 'mapple' ); ?>
</p>

<h4>Post Type</h4>
<p>
    <?php echo __( 'This plugin creates a custom post type', 'mapple' ); ?>
    <code>
        clients
    </code>
</p>

<h4>Remove Plugin and Data</h4>
<p><?php echo __( 'If you are going to remove the plugin. You can clean up the database by removing all `client` posts and all `client-*` posts meta data created by this plugin.', 'mapple' ); ?></p>