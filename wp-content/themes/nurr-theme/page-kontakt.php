<?php
/**
 * Contact page template.
 *
 * @package Nurr
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$contact_result = null;

if ( 'POST' === $_SERVER['REQUEST_METHOD'] && isset( $_POST['nurr_contact_form'] ) ) {
	$nonce = isset( $_POST['nurr_contact_nonce'] ) ? sanitize_text_field( wp_unslash( $_POST['nurr_contact_nonce'] ) ) : '';

	if ( ! wp_verify_nonce( $nonce, 'nurr_contact_form' ) ) {
		$contact_result = array(
			'type'    => 'error',
			'message' => __( 'Vormi saatmine ebaõnnestus. Palun proovi uuesti.', 'nurr' ),
		);
	} else {
		$first_name = isset( $_POST['first_name'] ) ? sanitize_text_field( wp_unslash( $_POST['first_name'] ) ) : '';
		$last_name  = isset( $_POST['last_name'] ) ? sanitize_text_field( wp_unslash( $_POST['last_name'] ) ) : '';
		$email      = isset( $_POST['email'] ) ? sanitize_email( wp_unslash( $_POST['email'] ) ) : '';
		$message    = isset( $_POST['message'] ) ? sanitize_textarea_field( wp_unslash( $_POST['message'] ) ) : '';

		if ( '' === $first_name || '' === $last_name || '' === $email || '' === $message || ! is_email( $email ) ) {
			$contact_result = array(
				'type'    => 'error',
				'message' => __( 'Palun täida kõik väljad korrektsete andmetega.', 'nurr' ),
			);
		} else {
			$subject = sprintf(
				/* translators: %s: sender name */
				__( 'Uus sõnum Nurr lehelt: %s', 'nurr' ),
				$first_name . ' ' . $last_name
			);

			$body = sprintf(
				"Nimi: %s %s\nE-post: %s\n\nSõnum:\n%s",
				$first_name,
				$last_name,
				$email,
				$message
			);

			$sent = wp_mail(
				get_option( 'admin_email' ),
				$subject,
				$body,
				array( 'Reply-To: ' . $first_name . ' ' . $last_name . ' <' . $email . '>' )
			);

			$contact_result = array(
				'type'    => $sent ? 'success' : 'error',
				'message' => $sent
					? __( 'Aitäh! Sinu sõnum on saadetud.', 'nurr' )
					: __( 'Sõnumit ei õnnestunud saata. Palun kirjuta info@nurr.ee.', 'nurr' ),
			);
		}
	}
}

get_header();
?>

    <main>
      <section class="contact-page container" aria-labelledby="contact-title">
        <h1 id="contact-title"><?php esc_html_e( 'Võta meiega ühendust - ootame sind külla!', 'nurr' ); ?></h1>

        <div class="contact-grid">
          <section class="contact-form-block" aria-labelledby="write-title">
            <h2 id="write-title"><?php esc_html_e( 'Kirjuta meile', 'nurr' ); ?></h2>

            <form class="contact-form" action="<?php echo esc_url( get_permalink() ); ?>" method="post">
              <input type="hidden" name="nurr_contact_form" value="1">
              <?php wp_nonce_field( 'nurr_contact_form', 'nurr_contact_nonce' ); ?>
              <div class="form-row">
                <label>
                  <span class="sr-only"><?php esc_html_e( 'Nimi', 'nurr' ); ?></span>
                  <input name="first_name" type="text" placeholder="<?php esc_attr_e( 'Nimi', 'nurr' ); ?>" autocomplete="given-name" required>
                </label>

                <label>
                  <span class="sr-only"><?php esc_html_e( 'Perekonnanimi', 'nurr' ); ?></span>
                  <input name="last_name" type="text" placeholder="<?php esc_attr_e( 'Perekonnanimi', 'nurr' ); ?>" autocomplete="family-name" required>
                </label>
              </div>

              <label>
                <span class="sr-only"><?php esc_html_e( 'E-post', 'nurr' ); ?></span>
                <input name="email" type="email" placeholder="<?php esc_attr_e( 'E-post', 'nurr' ); ?>" autocomplete="email" required>
              </label>

              <label>
                <span class="sr-only"><?php esc_html_e( 'Sõnum', 'nurr' ); ?></span>
                <textarea name="message" placeholder="<?php esc_attr_e( 'Sõnum', 'nurr' ); ?>" required></textarea>
              </label>

              <button class="button contact-form__submit" type="submit"><?php esc_html_e( 'Saada', 'nurr' ); ?></button>
              <p class="form-message form-message--<?php echo esc_attr( $contact_result['type'] ?? 'idle' ); ?>" aria-live="polite">
                <?php
                if ( $contact_result ) {
                  echo esc_html( $contact_result['message'] );
                }
                ?>
              </p>
            </form>
          </section>

          <aside class="contact-info" aria-labelledby="info-title">
            <h2 id="info-title"><?php esc_html_e( 'Kontaktinfo', 'nurr' ); ?></h2>
            <address>
              <p>
                <a href="https://maps.google.com/?q=Kopli%201%20Tallinn">Kopli 1<br>Tallinn</a>
              </p>
              <p><a href="tel:+37251234567">+372 5123 4567</a></p>
              <p><a href="mailto:info@nurr.ee">info@nurr.ee</a></p>
              <p>E-P<br>10:00-20:00</p>
            </address>
          </aside>
        </div>

        <section class="map-section" aria-labelledby="map-title">
          <h2 id="map-title"><?php esc_html_e( 'Kaart', 'nurr' ); ?></h2>
          <div class="map-box">
            <iframe
              title="<?php esc_attr_e( 'Nurr kassikohviku asukoht kaardil', 'nurr' ); ?>"
              src="https://www.google.com/maps?q=Kopli%201%20Tallinn&output=embed"
              loading="lazy"
              referrerpolicy="no-referrer-when-downgrade"
              allowfullscreen
            ></iframe>
          </div>
        </section>
      </section>
    </main>

<?php
get_footer();
