<?php
/**
 * Options Page
 */

// create settings menu
add_action('admin_menu', 'eawp_menu');
function eawp_menu() 
{
	//create new top-level menu
	add_menu_page(
		__( 'Envato Affiliate', 'eawp' ), 
		__( 'Envato Affiliate', 'eawp' ),
		'manage_options', 
		'eawp', 
		'eawp_page', 
		'dashicons-smiley',
		99999
	);
	
	//call register settings function
	add_action( 'admin_init', 'eawp_settings' );
}

// register options
function eawp_settings() 
{
	// API
	register_setting( 'eawp-api-settings-group', 'eawp_token' );
	register_setting( 'eawp-api-settings-group', 'eawp_ref' );
	
	// general
	register_setting( 'eawp-general-settings-group', 'eawp_shortcode' );
}

// callback
function eawp_page() 
{	
	include( plugin_dir_path( EAWP_FILE ) . 'templates/options.php' );
}