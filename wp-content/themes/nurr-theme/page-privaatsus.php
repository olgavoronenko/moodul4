<?php
/**
 * Privacy page template.
 *
 * @package Nurr
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

    <main>
      <section class="legal-page container">
        <h1><?php esc_html_e( 'Privaatsuspoliitika', 'nurr' ); ?></h1>
        <p>
          <?php esc_html_e( 'Kasutame vormides sisestatud andmeid ainult sinu päringule vastamiseks, broneeringu kinnitamiseks või adopteerimissoovi täpsustamiseks.', 'nurr' ); ?>
        </p>
        <p>
          <?php esc_html_e( 'Me ei jaga sinu kontaktandmeid kolmandate osapooltega. Soovi korral saad paluda oma andmete kustutamist, kirjutades aadressile info@nurr.ee.', 'nurr' ); ?>
        </p>
      </section>
    </main>

<?php
get_footer();

