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

function nurr_create_default_pages() {
	$pages = array(
		array(
			'title' => 'Kassid',
			'slug'  => 'kassid',
		),
		array(
			'title' => 'Broneeri',
			'slug'  => 'broneeri',
		),
		array(
			'title' => 'Kontakt',
			'slug'  => 'kontakt',
		),
		array(
			'title' => 'Teenustingimused',
			'slug'  => 'tingimused',
		),
		array(
			'title' => 'Privaatsuspoliitika',
			'slug'  => 'privaatsus',
		),
	);

	$created_pages = array();
	$failed_pages  = array();

	foreach ( $pages as $page ) {
		if ( get_page_by_path( $page['slug'] ) ) {
			continue;
		}

		$page_id = wp_insert_post(
			array(
				'post_title'   => $page['title'],
				'post_name'    => $page['slug'],
				'post_status'  => 'publish',
				'post_type'    => 'page',
				'post_content' => '',
			),
			true
		);

		if ( is_wp_error( $page_id ) ) {
			$failed_pages[] = $page['title'] . ': ' . $page_id->get_error_message();
			continue;
		}

		if ( $page_id ) {
			$created_pages[] = $page['title'];
		}
	}

	if ( $created_pages ) {
		update_option( 'nurr_created_pages_notice', implode( ', ', $created_pages ) );
	}

	if ( $failed_pages ) {
		update_option( 'nurr_failed_pages_notice', implode( '; ', $failed_pages ) );
	}
}
add_action( 'after_switch_theme', 'nurr_create_default_pages' );
add_action( 'wp_loaded', 'nurr_create_default_pages' );

function nurr_show_default_pages_notice() {
	$created_pages = get_option( 'nurr_created_pages_notice' );
	$failed_pages  = get_option( 'nurr_failed_pages_notice' );

	if ( $created_pages ) {
		printf(
			'<div class="notice notice-success is-dismissible"><p>%s</p></div>',
			esc_html( 'Nurr pages created: ' . $created_pages )
		);
		delete_option( 'nurr_created_pages_notice' );
	}

	if ( $failed_pages ) {
		printf(
			'<div class="notice notice-error is-dismissible"><p>%s</p></div>',
			esc_html( 'Nurr page creation failed: ' . $failed_pages )
		);
		delete_option( 'nurr_failed_pages_notice' );
	}
}
add_action( 'admin_notices', 'nurr_show_default_pages_notice' );

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
