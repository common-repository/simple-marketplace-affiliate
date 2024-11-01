<?php
/**
 * Plugin Name: Simple Marketplace Affiliate
 * Plugin URI: https://devhats.de
 * Description: Binde mit Shortcodes beliebige Envato Produkte auf deiner WordPress Seite ein und setze in den Optionen deinen Affiliate Tag, um auch noch Geld damit zu verdienen.
 * Version: 0.1.3
 * Author: DEVHATS
 * Author URI: https://devhats.de
 * Text Domain: eawp
 * Domain Path: /languages
 * License: MIT License
 * License URI: http://opensource.org/licenses/MIT
 */
 
// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) exit;

// ================================ //
// 				Base				//
// ================================ //

// define file path
define('EAWP_FILE', __FILE__);

// make plugin translation ready
add_action('plugins_loaded', 'eawp_textdomain');
function eawp_textdomain() 
{
	load_plugin_textdomain( 
		'eawp', 
		false, 
		dirname( plugin_basename(EAWP_FILE) ) . '/languages/' 
	);
}

// backend scripts
add_action('admin_enqueue_scripts', 'eawp_backend_scripts');
function eawp_backend_scripts()
{
	// Current screen
	$screen = get_current_screen();
	
	// Current screen is eawp options page
	if( $screen->base == 'toplevel_page_eawp' ) {
		
		// Backend CSS
		wp_enqueue_style ( 'eawp-admin', plugins_url( 'assets/css/backend.css', EAWP_FILE ), false );
	}
}

// frontend scripts
add_action('wp_enqueue_scripts', 'eawp_frontend_scripts');
function eawp_frontend_scripts()
{
	// Frontend CSS
    wp_enqueue_style ( 'eawp', plugins_url( 'assets/css/frontend.css', EAWP_FILE ), false );
	
	// Frontend JS
	wp_enqueue_script( 'eawp-shortcode', plugins_url( 'assets/js/shortcode.js', __FILE__ ), array('jquery'), '1.0', true );
	wp_localize_script( 'eawp-shortcode', 'eawp', array(
		'ajax_url' => admin_url( 'admin-ajax.php' )
	));	
}

// Shorten strings
function eawp_truncate($text, $length) 
{
	$length = abs((int)$length);
	if(strlen($text) > $length) {
	$text = preg_replace("/^(.{1,$length})(\s.*|$)/s", '\\1...', $text);
	}
	return($text);
}

// Include functions
foreach ( glob( plugin_dir_path( EAWP_FILE ) . "includes/*.php" ) as $file ) 
	include_once $file;

// ================================ //
// 			Envato API				//
// ================================ //

// Envato API Request
function eawp_api($url, $id)
{	
	// Get token from options page
	$token = esc_attr( get_option('eawp_token') );
	
	// If token is not set return false
	if(!$token OR $token == FALSE OR $token == null) return false;
	
	$new_url = $url . $id;
	$curl = curl_init($new_url);
	
	$header = array();
	
	$header[] = 'Authorization: Bearer '.$token;
	$header[] = 'User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10.11; rv:41.0) Gecko/20100101 Firefox/41.0';
	$header[] = 'timeout: 20';
	
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($curl, CURLOPT_HTTPHEADER,$header);
	
	$results = curl_exec($curl);
	curl_close($curl);
	
	return json_decode($results);
}

// ================================ //
// 			Ajax Request			//
// ================================ //

add_action( 'wp_ajax_nopriv_eawp_ajax', 'eawp_ajax' );
add_action( 'wp_ajax_eawp_ajax', 'eawp_ajax' );
function eawp_ajax() 
{				
	$item = eawp_api( $_REQUEST['url'], $_REQUEST['id'] );
	$ref = esc_attr( get_option('eawp_ref') );
	$type = $_REQUEST['type'];
	
	if($item == false) {
		_e( 'Es wurde kein Token angegeben. Siehe in den Einstellungen nach.', 'eawp' );
	}
	
	else if($item == 0) {
		_e( 'Es wurde kein Produkt gefunden.', 'eawp' );
	}
	
	else {
		
		$item = array(
			'url' => esc_url($item->url),
			'icon_url' => esc_url($item->previews->icon_preview->icon_url),
			'theme_name' => esc_html($item->wordpress_theme_metadata->theme_name),
			'site' => esc_html($item->site),
			'version' => esc_html($item->wordpress_theme_metadata->version),
			'description' => esc_html($item->wordpress_theme_metadata->description),
			'author_name' => esc_html($item->wordpress_theme_metadata->author_name),
			'author_url' => $item->author_url,
			'ref' => ( $ref ? '?ref=' . $ref : '' )
 		);
		
		include( plugin_dir_path( EAWP_FILE ) . 'templates/ajax.php');
	}
	
    wp_die(); 
}

// ================================ //
// 			Shortcode				//
// ================================ //

if( esc_attr( get_option('eawp_shortcode', '') ) == 2 ) : 
add_shortcode( 'envato', 'eawp_shortcode' );
else : 
add_shortcode( 'eawp', 'eawp_shortcode' );
endif;

// The Shortcode
function eawp_shortcode( $atts )
{
	// Set shortcode defaults
    $a = shortcode_atts( array(
        'id' => 0,
		'url' => 'https://api.envato.com/v3/market/catalog/item?id=',
		'type' => 'card',
    ), $atts );
	
	// Check if ID exists
	if($a['id'] == 0) {
		return __('Es wurde kein Produkt angegeben.', 'eawp');
	}
	
	ob_start();
	
	include( plugin_dir_path( __FILE__ ) . 'templates/shortcode.php');
	
	$html = ob_get_contents();
	
	ob_end_clean();
	
	return $html;
}

// Add shortcode support for widgets
add_filter('widget_text', 'do_shortcode');
