<?php
/**
 * Plugin Name: Nurr Cats
 * Description: Adds cat management for the Nurr cat cafe website.
 * Version: 0.1.0
 * Author: Nurr
 * Text Domain: nurr-cats
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function nurr_cats_register_post_type() {
	$labels = array(
		'name'               => __( 'Kassid', 'nurr-cats' ),
		'singular_name'      => __( 'Kass', 'nurr-cats' ),
		'add_new'            => __( 'Lisa uus', 'nurr-cats' ),
		'add_new_item'       => __( 'Lisa uus kass', 'nurr-cats' ),
		'edit_item'          => __( 'Muuda kassi', 'nurr-cats' ),
		'new_item'           => __( 'Uus kass', 'nurr-cats' ),
		'view_item'          => __( 'Vaata kassi', 'nurr-cats' ),
		'search_items'       => __( 'Otsi kasse', 'nurr-cats' ),
		'not_found'          => __( 'Kasse ei leitud', 'nurr-cats' ),
		'not_found_in_trash' => __( 'Prügikastis kasse ei leitud', 'nurr-cats' ),
		'menu_name'          => __( 'Kassid', 'nurr-cats' ),
	);

	$args = array(
		'labels'       => $labels,
		'public'       => true,
		'has_archive'  => true,
		'menu_icon'    => 'dashicons-pets',
		'supports'     => array( 'title', 'editor', 'thumbnail' ),
		'rewrite'      => array( 'slug' => 'kassid' ),
		'show_in_rest' => true,
	);

	register_post_type( 'nurr_cat', $args );
}
add_action( 'init', 'nurr_cats_register_post_type' );

function nurr_cats_activate() {
	nurr_cats_register_post_type();
	flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'nurr_cats_activate' );

function nurr_cats_deactivate() {
	flush_rewrite_rules();
}
register_deactivation_hook( __FILE__, 'nurr_cats_deactivate' );
