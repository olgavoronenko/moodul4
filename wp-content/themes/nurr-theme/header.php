<?php
/**
 * Site header.
 *
 * @package Nurr
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<!doctype html>
<html <?php language_attributes(); ?>>
  <head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
  </head>
  <body <?php body_class(); ?>>
    <?php wp_body_open(); ?>
    <header class="site-header">
      <nav class="nav container" aria-label="<?php esc_attr_e( 'Peamenüü', 'nurr' ); ?>">
        <a class="nav__link" href="<?php echo esc_url( home_url( '/kassid/' ) ); ?>"><?php esc_html_e( 'Kassid', 'nurr' ); ?></a>
        <a class="nav__link" href="<?php echo esc_url( home_url( '/broneeri/' ) ); ?>"><?php esc_html_e( 'Broneeri', 'nurr' ); ?></a>
        <a class="nav__link" href="<?php echo esc_url( home_url( '/kontakt/' ) ); ?>"><?php esc_html_e( 'Kontakt', 'nurr' ); ?></a>

        <a class="logo" href="<?php echo esc_url( home_url( '/' ) ); ?>" aria-label="<?php esc_attr_e( 'Nurr avaleht', 'nurr' ); ?>">
          <img src="<?php echo esc_url( nurr_asset_uri( 'icons/nurr-logo-header.svg' ) ); ?>" width="52" height="52" alt="">
        </a>

        <button class="nav__toggle" type="button" aria-expanded="false" aria-controls="mobile-menu">
          <span class="sr-only"><?php esc_html_e( 'Ava menüü', 'nurr' ); ?></span>
          <span></span>
          <span></span>
          <span></span>
        </button>

        <a class="button button--small nav__cta" href="<?php echo esc_url( home_url( '/broneeri/' ) ); ?>"><?php esc_html_e( 'Broneeri', 'nurr' ); ?></a>
      </nav>

      <div class="mobile-menu container" id="mobile-menu" hidden>
        <a href="<?php echo esc_url( home_url( '/kassid/' ) ); ?>"><?php esc_html_e( 'Kassid', 'nurr' ); ?></a>
        <a href="<?php echo esc_url( home_url( '/broneeri/' ) ); ?>"><?php esc_html_e( 'Broneeri', 'nurr' ); ?></a>
        <a href="<?php echo esc_url( home_url( '/kontakt/' ) ); ?>"><?php esc_html_e( 'Kontakt', 'nurr' ); ?></a>
      </div>
    </header>

