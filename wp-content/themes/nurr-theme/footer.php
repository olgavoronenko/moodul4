<?php
/**
 * Site footer.
 *
 * @package Nurr
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
    <footer class="site-footer">
      <div class="footer__inner container">
        <div class="footer__brand">
          <a class="logo logo--footer" href="<?php echo esc_url( home_url( '/' ) ); ?>" aria-label="<?php esc_attr_e( 'Nurr avaleht', 'nurr' ); ?>">
            <img src="<?php echo esc_url( nurr_asset_uri( 'icons/nurr-logo-footer.svg' ) ); ?>" width="54" height="54" alt="">
          </a>
        </div>

        <div>
          <h2><?php esc_html_e( 'Menüü', 'nurr' ); ?></h2>
          <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Avaleht', 'nurr' ); ?></a>
          <a href="<?php echo esc_url( home_url( '/kassid/' ) ); ?>"><?php esc_html_e( 'Kassid', 'nurr' ); ?></a>
          <a href="<?php echo esc_url( home_url( '/broneeri/' ) ); ?>"><?php esc_html_e( 'Broneeri', 'nurr' ); ?></a>
          <a href="<?php echo esc_url( home_url( '/kontakt/' ) ); ?>"><?php esc_html_e( 'Kontakt', 'nurr' ); ?></a>
        </div>

        <div>
          <h2><?php esc_html_e( 'Informatsioon', 'nurr' ); ?></h2>
          <a href="<?php echo esc_url( home_url( '/tingimused/' ) ); ?>"><?php esc_html_e( 'Teenustingimused', 'nurr' ); ?></a>
          <a href="<?php echo esc_url( home_url( '/privaatsus/' ) ); ?>"><?php esc_html_e( 'Privaatsuspoliitika', 'nurr' ); ?></a>
        </div>
      </div>
    </footer>

    <?php wp_footer(); ?>
  </body>
</html>

