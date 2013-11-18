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
add_action('admin_init', 'listening_settings_api_init' );
add_action('admin_menu','listening_plugin_menu');

add_filter('the_content','add_listening');
add_filter('sanitize_post_meta_listening','sanitize_listening_field');

function listening_plugin_menu(){
	add_plugins_page(
		'Listening Settings',
		'Listening Settings',
		'administrator',
		'listening-settings'
		,'listening_settings_display'
	);
}

function listening_settings_display(){
	do_settings_sections('listening-settings');
}


function sanitize_listening_field($input){
	return sanitize_text_field($input);
}

function add_listening($content){
	global $post;
	$post_id = $post->ID;
	$meta_values = get_post_meta($post_id,'listening');
var_dump($meta_values);
	if(count($meta_values)){
		$output = $meta_values[0];
		$output = esc_html($output);
		return "Listening to: <strong>$output</strong>";
	}
}

 // ------------------------------------------------------------------
 // Add all your sections, fields and settings during admin_init
 // ------------------------------------------------------------------
 //
 
 function listening_settings_api_init() {
 	// Add the section to reading settings so we can add our
 	// fields to it
//Settings allow HTML
//Use first song, use last song
 	add_settings_section(
		'listening-setting-section',
		'Listening Plugin Settings',
		'eg_setting_section_callback_function',
		'listening-settings'
	);
 	
 	// Add the field with the names and function to use for our new
 	// settings, put it in our new section
 	add_settings_field(
		'eg_setting_name',
		'Sanitize input',
		'eg_setting_callback_function',
		'listening-settings',
		'listening-setting-section'
	);
 	
 	// Register our setting so that $_POST handling is done for us and
 	// our callback function just has to echo the <input>
 	register_setting( 'reading', 'eg_setting_name' );
 } // eg_settings_api_init()
 
 
  
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
 	echo '<input name="eg_setting_name" id="gv_thumbnails_insert_into_excerpt" type="checkbox" value="1" class="code" ' . checked( 1, get_option( 'eg_setting_name' ), false ) . ' /> Checks for invalid UTF-8, Convert single < characters to entity, strip all tags, remove line breaks, tabs and extra white space, strip octets.';
 }
