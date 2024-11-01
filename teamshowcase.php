<?php
/*
Plugin Name: Webiots Team Showcase and slider
Plugin URI: https://demo.webiots.com/plugins/teamshowcase
Description: Webiots Team showcase
Version: 1.0
Author: Webiots
Author URI: https://www.webiots.com
License: GPLv2 or later
Text Domain: webiots-ts
*/
define("WEBIOTSTEAMSHOWCASEPATH",dirname(__FILE__));
//Include the Functions File
include('includes/functions.php');

add_action( 'wp_enqueue_scripts', 'webiots_teamshowcase_scripts_styles' );

function webiots_teamshowcase_shortcode() {
    add_shortcode( 'webiots-team', 'webiots_shortcode_teamshowcase' );
}
add_action( 'init', 'webiots_teamshowcase_shortcode' );

add_action( 'vc_before_init', 'addon_vc_with_webiots_teamshowcase' );
add_action( 'init', 'webiots_teamshowcase_department' );