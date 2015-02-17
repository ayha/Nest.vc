<?php
/*

**************************************************************************

Plugin Name:  Shortcode Toggle
Plugin URI:   http://www.arefly.com/shortcode-toggle/
Description:  Add Useful Toggle Menu to your blog simply by shortcode.
Version:      1.0.9
Author:       Arefly
Author URI:   http://www.arefly.com/
Text Domain:  shortcode-toggle
Domain Path:  /lang/

**************************************************************************

	Copyright 2014  Arefly  (email : eflyjason@gmail.com)

	This program is free software; you can redistribute it and/or modify
	it under the terms of the GNU General Public License, version 2, as 
	published by the Free Software Foundation.

	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.

	You should have received a copy of the GNU General Public License
	along with this program; if not, write to the Free Software
	Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA

**************************************************************************/

define("SHORTCODE_TOGGLE_PLUGIN_URL", plugin_dir_url( __FILE__ ));
define("SHORTCODE_TOGGLE_FULL_DIR", plugin_dir_path( __FILE__ ));
define("SHORTCODE_TOGGLE_TEXT_DOMAIN", "shortcode-toggle");

/* Plugin Localize */
function shortcode_toggle_load_plugin_textdomain() {
	load_plugin_textdomain(SHORTCODE_TOGGLE_TEXT_DOMAIN, false, dirname(plugin_basename( __FILE__ )).'/lang/');
}
add_action('plugins_loaded', 'shortcode_toggle_load_plugin_textdomain');

include_once SHORTCODE_TOGGLE_FULL_DIR."help.php";

/* Add Links to Plugins Management Page */
function shortcode_toggle_action_links($links){
	$links[] = '<a href="'.get_admin_url(null, 'tools.php?page='.SHORTCODE_TOGGLE_TEXT_DOMAIN.'-help').'">'.__("Help", SHORTCODE_TOGGLE_TEXT_DOMAIN).'</a>';
	return $links;
}
add_filter('plugin_action_links_'.plugin_basename(__FILE__), 'shortcode_toggle_action_links');

function shortcode_toggle_enqueue_styles() {
	wp_enqueue_style(SHORTCODE_TOGGLE_TEXT_DOMAIN.'-css', SHORTCODE_TOGGLE_PLUGIN_URL.'style.min.css');
}
add_action('wp_enqueue_scripts', 'shortcode_toggle_enqueue_styles');
add_action('admin_enqueue_scripts', 'shortcode_toggle_enqueue_styles');

function shortcode_toggle_enqueue_script(){
	wp_enqueue_script(SHORTCODE_TOGGLE_TEXT_DOMAIN.'-js', SHORTCODE_TOGGLE_PLUGIN_URL.'script.min.js', array('jquery'));
}
add_action('wp_enqueue_scripts', 'shortcode_toggle_enqueue_script');
add_action('admin_enqueue_scripts', 'shortcode_toggle_enqueue_script');

function shortcode_toggle($atts, $content = null){
	str_replace(array("<br />[", "<br/>[", "<br>["), "[", $content);
	str_replace(array("]<br />", "]<br/>", "]<br>"), "]", $content);
	$content = trim(do_shortcode($content));
	extract(shortcode_atts(array("title" => ''), $atts));
	return '<div class="toggle_title">'.$title.'</div><div class="toggle_content">'.$content.'</div>';
}
add_shortcode('toggle', 'shortcode_toggle');
