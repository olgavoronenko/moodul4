<?php
/**
 * Theme setup and assets.
 *
 * @package Nurr
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function nurr_theme_setup() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
}
add_action( 'after_setup_theme', 'nurr_theme_setup' );

function nurr_asset_uri( $path ) {
	return get_template_directory_uri() . '/assets/' . ltrim( $path, '/' );
}

function nurr_enqueue_assets() {
	wp_enqueue_style(
		'nurr-fonts',
		'https://fonts.googleapis.com/css2?family=DM+Sans:opsz,wght@9..40,400;9..40,500;9..40,700&family=Fredoka:wght@500;600;700&display=swap',
		array(),
		null
	);

	wp_enqueue_style(
		'nurr-theme',
		get_template_directory_uri() . '/assets/css/styles.css',
		array( 'nurr-fonts' ),
		'0.1.0'
	);

	wp_enqueue_script(
		'nurr-main',
		get_template_directory_uri() . '/assets/js/main.js',
		array(),
		'0.1.0',
		true
	);
}
add_action( 'wp_enqueue_scripts', 'nurr_enqueue_assets' );
