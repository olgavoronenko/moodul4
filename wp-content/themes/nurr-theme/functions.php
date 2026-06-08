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

