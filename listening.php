<?php
/**
 * Plugin Name: WordPress Listening Plugin
 * Plugin URI: http://URI_Of_Page_Describing_Plugin_and_Updates
 * Description: Displays the custom field "listening" at the bottom of posts
 * Version: 0.1.0
 * Author: Chris Boyce <christopher.d.boyce@gmail.com>
 * License: MIT
 */

//@TODO translation _()
add_action('admin_menu','listening_plugin_menu');

function listening_plugin_menu(){
	add_plugins_page(
		'Listening Settings',
		'Listening Settings',
		'administrator',
		'listening-settings'
		,'listening_settings_display'
	);
	/*
	add_submenu_page(
		'plugins.php',
		'Listening Settings',
		'Listening Settings',
		'manage_options',
		'listening-options',
		'listening_menu_page'
	);
	*/
}

function listening_settings_display(){
	do_settings_sections('listening-settings');
	echo "foo";
}
function listening_menu_page(){
	return "foo";
}


add_filter('the_content','add_listening');

function add_listening($content){
	global $post;
	$post_id = $post->ID;
	$meta_values = get_post_meta($post_id);
	var_dump($meta_values);
	return "foo";
}

 // ------------------------------------------------------------------
 // Add all your sections, fields and settings during admin_init
 // ------------------------------------------------------------------
 //
 
 function eg_settings_api_init() {
 	// Add the section to reading settings so we can add our
 	// fields to it
 	add_settings_section(
		'eg_setting_section',
		'Example settings section in reading',
		'eg_setting_section_callback_function',
		'listening-settings'
	);
 	
 	// Add the field with the names and function to use for our new
 	// settings, put it in our new section
 	add_settings_field(
		'eg_setting_name',
		'Example setting Name',
		'eg_setting_callback_function',
		'listening-settings',
		'eg_setting_section'
	);
 	
 	// Register our setting so that $_POST handling is done for us and
 	// our callback function just has to echo the <input>
 	register_setting( 'reading', 'eg_setting_name' );
 } // eg_settings_api_init()
 
 add_action( 'admin_init', 'eg_settings_api_init' );
 
  
 // ------------------------------------------------------------------
 // Settings section callback function
 // ------------------------------------------------------------------
 //
 // This function is needed if we added a new section. This function 
 // will be run at the start of our section
 //
 
 function eg_setting_section_callback_function() {
 	echo '<p>Intro text for our settings section</p>';
 }
 
 // ------------------------------------------------------------------
 // Callback function for our example setting
 // ------------------------------------------------------------------
 //
 // creates a checkbox true/false option. Other types are surely possible
 //
 
 function eg_setting_callback_function() {
 	echo '<input name="eg_setting_name" id="gv_thumbnails_insert_into_excerpt" type="checkbox" value="1" class="code" ' . checked( 1, get_option( 'eg_setting_name' ), false ) . ' /> Explanation text';
 }
