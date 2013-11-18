<?php
/**
 * Plugin Name: WordPress Listening Plugin
 * Description: Displays the custom field "listening" at the bottom of posts
 * Version: 1.0.0
 * Author: Chris Boyce <christopher.d.boyce@gmail.com>
 */

add_filter('the_content','add_listening');
add_filter('sanitize_post_meta_listening','sanitize_listening_field');

function sanitize_listening_field($input){
	return sanitize_text_field($input);
}

function add_listening($content){
	global $post;
	$post_id = $post->ID;
	$meta_value = get_post_meta($post_id,'listening',true);
	if($meta_value){
		$output = "Listening to: " . esc_html($meta_value);
		return $content . "<br>" . $output;
	} else {
		return $content;
	}
}
