<?php
/**
 * Booking page template.
 *
 * @package Nurr
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function nurr_booking_post_value( $key ) {
	return isset( $_POST[ $key ] ) ? sanitize_text_field( wp_unslash( $_POST[ $key ] ) ) : '';
}

function nurr_booking_send_email( $type, $data ) {
	$subjects = array(
		'table'    => __( 'Uus lauabroneering Nurr lehelt', 'nurr' ),
		'adoption' => __( 'Uus adopteerimissoov Nurr lehelt', 'nurr' ),
	);

	$body_lines = array(
		'Nimi: ' . $data['first_name'] . ' ' . $data['last_name'],
		'E-post: ' . $data['email'],
		'Telefon: ' . $data['phone'],
	);

	if ( 'table' === $type ) {
		$body_lines[] = 'Kuupäev: ' . $data['date'];
		$body_lines[] = 'Kell: ' . $data['time'];
		$body_lines[] = 'Külastajate arv: ' . $data['guests'];
	}

	if ( 'adoption' === $type ) {
		$body_lines[] = 'Kass: ' . $data['cat'];
		$body_lines[] = '';
		$body_lines[] = 'Sõnum:';
		$body_lines[] = $data['message'];
	}

	return wp_mail(
		get_option( 'admin_email' ),
		$subjects[ $type ],
		implode( "\n", $body_lines ),
		array( 'Reply-To: ' . $data['first_name'] . ' ' . $data['last_name'] . ' <' . $data['email'] . '>' )
	);
}

$booking_result = null;
$active_panel   = 'table';
$posted_type    = isset( $_POST['nurr_booking_form'] ) ? sanitize_key( wp_unslash( $_POST['nurr_booking_form'] ) ) : '';

if ( 'POST' === $_SERVER['REQUEST_METHOD'] && in_array( $posted_type, array( 'table', 'adoption' ), true ) ) {
	$active_panel = $posted_type;
	$nonce        = isset( $_POST['nurr_booking_nonce'] ) ? sanitize_text_field( wp_unslash( $_POST['nurr_booking_nonce'] ) ) : '';

	if ( ! wp_verify_nonce( $nonce, 'nurr_booking_form' ) ) {
		$booking_result = array(
			'type'    => 'error',
			'form'    => $posted_type,
			'message' => __( 'Vormi saatmine ebaõnnestus. Palun proovi uuesti.', 'nurr' ),
		);
	} else {
		$data = array(
			'first_name' => nurr_booking_post_value( 'first_name' ),
			'last_name'  => nurr_booking_post_value( 'last_name' ),
			'email'      => sanitize_email( wp_unslash( $_POST['email'] ?? '' ) ),
			'phone'      => nurr_booking_post_value( 'phone' ),
			'date'       => nurr_booking_post_value( 'date' ),
			'time'       => nurr_booking_post_value( 'time' ),
			'guests'     => absint( $_POST['guests'] ?? 0 ),
			'cat'        => nurr_booking_post_value( 'cat' ),
			'message'    => isset( $_POST['message'] ) ? sanitize_textarea_field( wp_unslash( $_POST['message'] ) ) : '',
		);

		$has_required_details = '' !== $data['first_name'] && '' !== $data['last_name'] && '' !== $data['email'] && '' !== $data['phone'] && is_email( $data['email'] );
		$is_valid_table      = 'table' === $posted_type && '' !== $data['date'] && '' !== $data['time'] && $data['guests'] > 0;
		$is_valid_adoption   = 'adoption' === $posted_type && '' !== $data['cat'] && '' !== $data['message'];

		if ( ! $has_required_details || ( ! $is_valid_table && ! $is_valid_adoption ) ) {
			$booking_result = array(
				'type'    => 'error',
				'form'    => $posted_type,
				'message' => __( 'Palun täida kõik väljad korrektsete andmetega.', 'nurr' ),
			);
		} else {
			$sent = nurr_booking_send_email( $posted_type, $data );

			$booking_result = array(
				'type'    => $sent ? 'success' : 'error',
				'form'    => $posted_type,
				'message' => $sent
					? __( 'Aitäh! Saatsime sinu soovi edukalt teele.', 'nurr' )
					: __( 'Sõnumit ei õnnestunud saata. Palun kirjuta info@nurr.ee.', 'nurr' ),
			);
		}
	}
}

$cats = get_posts(
	array(
		'post_type'      => 'nurr_cat',
		'posts_per_page' => -1,
		'orderby'        => 'title',
		'order'          => 'ASC',
	)
);

get_header();
?>

    <main>
      <section class="booking-page container" aria-labelledby="booking-title">
        <h1 id="booking-title"><?php esc_html_e( 'Vali, mida soovid - broneeri laud või adopteeri kass', 'nurr' ); ?></h1>

        <div class="booking-tabs" role="tablist" aria-label="<?php esc_attr_e( 'Broneeringu valik', 'nurr' ); ?>">
          <button class="booking-tab <?php echo 'table' === $active_panel ? 'is-active' : ''; ?>" type="button" role="tab" aria-selected="<?php echo 'table' === $active_panel ? 'true' : 'false'; ?>" aria-controls="table-form" data-booking-tab="table">
            <?php esc_html_e( 'Laua broneerimine', 'nurr' ); ?>
          </button>
          <button class="booking-tab <?php echo 'adoption' === $active_panel ? 'is-active' : ''; ?>" type="button" role="tab" aria-selected="<?php echo 'adoption' === $active_panel ? 'true' : 'false'; ?>" aria-controls="adoption-form" data-booking-tab="adoption">
            <?php esc_html_e( 'Kassi adopteerimine', 'nurr' ); ?>
          </button>
        </div>

        <form class="booking-form <?php echo 'table' === $active_panel ? 'is-active' : ''; ?>" id="table-form" action="<?php echo esc_url( get_permalink() ); ?>#table-form" method="post" data-booking-panel="table" <?php echo 'table' === $active_panel ? '' : 'hidden'; ?>>
          <input type="hidden" name="nurr_booking_form" value="table">
          <?php wp_nonce_field( 'nurr_booking_form', 'nurr_booking_nonce' ); ?>

          <div class="booking-field booking-field--name">
            <span class="booking-label"><?php esc_html_e( 'Nimi', 'nurr' ); ?></span>
            <label>
              <span class="sr-only"><?php esc_html_e( 'Nimi', 'nurr' ); ?></span>
              <input name="first_name" type="text" autocomplete="given-name" value="<?php echo 'table' === $posted_type ? esc_attr( nurr_booking_post_value( 'first_name' ) ) : ''; ?>" required>
              <span><?php esc_html_e( 'Nimi', 'nurr' ); ?></span>
            </label>
            <label>
              <span class="sr-only"><?php esc_html_e( 'Perekonnanimi', 'nurr' ); ?></span>
              <input name="last_name" type="text" autocomplete="family-name" value="<?php echo 'table' === $posted_type ? esc_attr( nurr_booking_post_value( 'last_name' ) ) : ''; ?>" required>
              <span><?php esc_html_e( 'Perekonnanimi', 'nurr' ); ?></span>
            </label>
          </div>

          <div class="booking-field">
            <label class="booking-label" for="booking-email"><?php esc_html_e( 'E-post', 'nurr' ); ?></label>
            <div>
              <input id="booking-email" name="email" type="email" autocomplete="email" value="<?php echo 'table' === $posted_type ? esc_attr( nurr_booking_post_value( 'email' ) ) : ''; ?>" required>
              <span>example@example.com</span>
            </div>
          </div>

          <div class="booking-field booking-field--short">
            <label class="booking-label" for="booking-phone"><?php esc_html_e( 'Telefon', 'nurr' ); ?></label>
            <div>
              <input id="booking-phone" name="phone" type="tel" autocomplete="tel" value="<?php echo 'table' === $posted_type ? esc_attr( nurr_booking_post_value( 'phone' ) ) : ''; ?>" required>
              <span>+372 1234 5678</span>
            </div>
          </div>

          <div class="booking-field booking-field--date">
            <label class="booking-label" for="booking-date"><?php esc_html_e( 'Kuupäev', 'nurr' ); ?></label>
            <div>
              <input id="booking-date" name="date" type="text" inputmode="numeric" value="<?php echo 'table' === $posted_type ? esc_attr( nurr_booking_post_value( 'date' ) ) : ''; ?>" required>
              <span>01-01-2026</span>
            </div>
            <div>
              <input id="booking-time" name="time" type="text" inputmode="numeric" aria-label="<?php esc_attr_e( 'Kell', 'nurr' ); ?>" value="<?php echo 'table' === $posted_type ? esc_attr( nurr_booking_post_value( 'time' ) ) : ''; ?>" required>
              <span><?php esc_html_e( 'Kell', 'nurr' ); ?></span>
            </div>
          </div>

          <div class="booking-field booking-field--counter">
            <span class="booking-label"><?php esc_html_e( 'Külastajate arv', 'nurr' ); ?></span>
            <div class="guest-counter" data-counter>
              <button type="button" aria-label="<?php esc_attr_e( 'Vähenda külastajate arvu', 'nurr' ); ?>" data-counter-minus>-</button>
              <output data-counter-value><?php echo 'table' === $posted_type ? esc_html( absint( $_POST['guests'] ?? 0 ) ) : '0'; ?></output>
              <button type="button" aria-label="<?php esc_attr_e( 'Suurenda külastajate arvu', 'nurr' ); ?>" data-counter-plus>+</button>
              <input type="hidden" name="guests" value="<?php echo 'table' === $posted_type ? esc_attr( absint( $_POST['guests'] ?? 0 ) ) : '0'; ?>" data-counter-input>
            </div>
          </div>

          <button class="button booking-submit" type="submit"><?php esc_html_e( 'Broneeri', 'nurr' ); ?></button>
          <?php if ( $booking_result && 'table' === $booking_result['form'] ) : ?>
            <p class="form-message booking-message form-message--<?php echo esc_attr( $booking_result['type'] ); ?>" aria-live="polite"><?php echo esc_html( $booking_result['message'] ); ?></p>
          <?php endif; ?>
        </form>

        <form class="booking-form <?php echo 'adoption' === $active_panel ? 'is-active' : ''; ?>" id="adoption-form" action="<?php echo esc_url( get_permalink() ); ?>#adoption-form" method="post" data-booking-panel="adoption" <?php echo 'adoption' === $active_panel ? '' : 'hidden'; ?>>
          <input type="hidden" name="nurr_booking_form" value="adoption">
          <?php wp_nonce_field( 'nurr_booking_form', 'nurr_booking_nonce' ); ?>

          <div class="booking-field booking-field--name">
            <span class="booking-label"><?php esc_html_e( 'Nimi', 'nurr' ); ?></span>
            <label>
              <span class="sr-only"><?php esc_html_e( 'Nimi', 'nurr' ); ?></span>
              <input name="first_name" type="text" autocomplete="given-name" value="<?php echo 'adoption' === $posted_type ? esc_attr( nurr_booking_post_value( 'first_name' ) ) : ''; ?>" required>
              <span><?php esc_html_e( 'Nimi', 'nurr' ); ?></span>
            </label>
            <label>
              <span class="sr-only"><?php esc_html_e( 'Perekonnanimi', 'nurr' ); ?></span>
              <input name="last_name" type="text" autocomplete="family-name" value="<?php echo 'adoption' === $posted_type ? esc_attr( nurr_booking_post_value( 'last_name' ) ) : ''; ?>" required>
              <span><?php esc_html_e( 'Perekonnanimi', 'nurr' ); ?></span>
            </label>
          </div>

          <div class="booking-field">
            <label class="booking-label" for="adoption-email"><?php esc_html_e( 'E-post', 'nurr' ); ?></label>
            <div>
              <input id="adoption-email" name="email" type="email" autocomplete="email" value="<?php echo 'adoption' === $posted_type ? esc_attr( nurr_booking_post_value( 'email' ) ) : ''; ?>" required>
              <span>example@example.com</span>
            </div>
          </div>

          <div class="booking-field booking-field--short">
            <label class="booking-label" for="adoption-phone"><?php esc_html_e( 'Telefon', 'nurr' ); ?></label>
            <div>
              <input id="adoption-phone" name="phone" type="tel" autocomplete="tel" value="<?php echo 'adoption' === $posted_type ? esc_attr( nurr_booking_post_value( 'phone' ) ) : ''; ?>" required>
              <span>+372 1234 5678</span>
            </div>
          </div>

          <div class="booking-field booking-field--short">
            <label class="booking-label" for="adoption-cat"><?php esc_html_e( 'Vali kass', 'nurr' ); ?></label>
            <select id="adoption-cat" name="cat" required>
              <option value=""></option>
              <?php foreach ( $cats as $cat ) : ?>
                <option value="<?php echo esc_attr( $cat->post_title ); ?>" <?php selected( 'adoption' === $posted_type ? nurr_booking_post_value( 'cat' ) : '', $cat->post_title ); ?>>
                  <?php echo esc_html( $cat->post_title ); ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>

          <div class="booking-field booking-field--message">
            <label class="booking-label" for="adoption-message"><?php esc_html_e( 'Sõnum', 'nurr' ); ?></label>
            <div>
              <textarea id="adoption-message" name="message" required><?php echo 'adoption' === $posted_type ? esc_textarea( $_POST['message'] ?? '' ) : ''; ?></textarea>
              <span><?php esc_html_e( 'Miks soovid adopteerida?', 'nurr' ); ?></span>
            </div>
          </div>

          <button class="button booking-submit" type="submit"><?php esc_html_e( 'Broneeri', 'nurr' ); ?></button>
          <?php if ( $booking_result && 'adoption' === $booking_result['form'] ) : ?>
            <p class="form-message booking-message form-message--<?php echo esc_attr( $booking_result['type'] ); ?>" aria-live="polite"><?php echo esc_html( $booking_result['message'] ); ?></p>
          <?php endif; ?>
        </form>
      </section>
    </main>

<?php
get_footer();
