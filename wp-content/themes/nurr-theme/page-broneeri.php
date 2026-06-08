<?php
/**
 * Booking page template.
 *
 * @package Nurr
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

    <main>
      <section class="booking-page container" aria-labelledby="booking-title">
        <h1 id="booking-title"><?php esc_html_e( 'Vali, mida soovid - broneeri laud või adopteeri kass', 'nurr' ); ?></h1>

        <div class="booking-tabs" role="tablist" aria-label="<?php esc_attr_e( 'Broneeringu valik', 'nurr' ); ?>">
          <button class="booking-tab is-active" type="button" role="tab" aria-selected="true" aria-controls="table-form" data-booking-tab="table">
            <?php esc_html_e( 'Laua broneerimine', 'nurr' ); ?>
          </button>
          <button class="booking-tab" type="button" role="tab" aria-selected="false" aria-controls="adoption-form" data-booking-tab="adoption">
            <?php esc_html_e( 'Kassi adopteerimine', 'nurr' ); ?>
          </button>
        </div>

        <form class="booking-form is-active" id="table-form" action="#" method="post" data-booking-panel="table" data-booking-form>
          <div class="booking-field booking-field--name">
            <span class="booking-label"><?php esc_html_e( 'Nimi', 'nurr' ); ?></span>
            <label>
              <span class="sr-only"><?php esc_html_e( 'Nimi', 'nurr' ); ?></span>
              <input name="first-name" type="text" autocomplete="given-name" required>
              <span><?php esc_html_e( 'Nimi', 'nurr' ); ?></span>
            </label>
            <label>
              <span class="sr-only"><?php esc_html_e( 'Perekonnanimi', 'nurr' ); ?></span>
              <input name="last-name" type="text" autocomplete="family-name" required>
              <span><?php esc_html_e( 'Perekonnanimi', 'nurr' ); ?></span>
            </label>
          </div>

          <div class="booking-field">
            <label class="booking-label" for="booking-email"><?php esc_html_e( 'E-post', 'nurr' ); ?></label>
            <div>
              <input id="booking-email" name="email" type="email" autocomplete="email" required>
              <span>example@example.com</span>
            </div>
          </div>

          <div class="booking-field booking-field--short">
            <label class="booking-label" for="booking-phone"><?php esc_html_e( 'Telefon', 'nurr' ); ?></label>
            <div>
              <input id="booking-phone" name="phone" type="tel" autocomplete="tel" required>
              <span>+372 1234 5678</span>
            </div>
          </div>

          <div class="booking-field booking-field--date">
            <label class="booking-label" for="booking-date"><?php esc_html_e( 'Kuupäev', 'nurr' ); ?></label>
            <div>
              <input id="booking-date" name="date" type="text" inputmode="numeric" required>
              <span>01-01-2026</span>
            </div>
            <div>
              <input id="booking-time" name="time" type="text" inputmode="numeric" aria-label="<?php esc_attr_e( 'Kell', 'nurr' ); ?>" required>
              <span><?php esc_html_e( 'Kell', 'nurr' ); ?></span>
            </div>
          </div>

          <div class="booking-field booking-field--counter">
            <span class="booking-label"><?php esc_html_e( 'Külastajate arv', 'nurr' ); ?></span>
            <div class="guest-counter" data-counter>
              <button type="button" aria-label="<?php esc_attr_e( 'Vähenda külastajate arvu', 'nurr' ); ?>" data-counter-minus>-</button>
              <output data-counter-value>0</output>
              <button type="button" aria-label="<?php esc_attr_e( 'Suurenda külastajate arvu', 'nurr' ); ?>" data-counter-plus>+</button>
              <input type="hidden" name="guests" value="0" data-counter-input>
            </div>
          </div>

          <button class="button booking-submit" type="submit"><?php esc_html_e( 'Broneeri', 'nurr' ); ?></button>
          <p class="form-message booking-message" aria-live="polite" data-booking-message></p>
        </form>

        <form class="booking-form" id="adoption-form" action="#" method="post" data-booking-panel="adoption" data-booking-form hidden>
          <div class="booking-field booking-field--name">
            <span class="booking-label"><?php esc_html_e( 'Nimi', 'nurr' ); ?></span>
            <label>
              <span class="sr-only"><?php esc_html_e( 'Nimi', 'nurr' ); ?></span>
              <input name="first-name" type="text" autocomplete="given-name" required>
              <span><?php esc_html_e( 'Nimi', 'nurr' ); ?></span>
            </label>
            <label>
              <span class="sr-only"><?php esc_html_e( 'Perekonnanimi', 'nurr' ); ?></span>
              <input name="last-name" type="text" autocomplete="family-name" required>
              <span><?php esc_html_e( 'Perekonnanimi', 'nurr' ); ?></span>
            </label>
          </div>

          <div class="booking-field">
            <label class="booking-label" for="adoption-email"><?php esc_html_e( 'E-post', 'nurr' ); ?></label>
            <div>
              <input id="adoption-email" name="email" type="email" autocomplete="email" required>
              <span>example@example.com</span>
            </div>
          </div>

          <div class="booking-field booking-field--short">
            <label class="booking-label" for="adoption-phone"><?php esc_html_e( 'Telefon', 'nurr' ); ?></label>
            <div>
              <input id="adoption-phone" name="phone" type="tel" autocomplete="tel" required>
              <span>+372 1234 5678</span>
            </div>
          </div>

          <div class="booking-field booking-field--short">
            <label class="booking-label" for="adoption-cat"><?php esc_html_e( 'Vali kass', 'nurr' ); ?></label>
            <select id="adoption-cat" name="cat" required>
              <option value=""></option>
              <option>Miisu</option>
              <option>Kiki</option>
              <option>Tõnu</option>
              <option>Luna</option>
            </select>
          </div>

          <div class="booking-field booking-field--message">
            <label class="booking-label" for="adoption-message"><?php esc_html_e( 'Sõnum', 'nurr' ); ?></label>
            <div>
              <textarea id="adoption-message" name="message" required></textarea>
              <span><?php esc_html_e( 'Miks soovid adopteerida?', 'nurr' ); ?></span>
            </div>
          </div>

          <button class="button booking-submit" type="submit"><?php esc_html_e( 'Broneeri', 'nurr' ); ?></button>
          <p class="form-message booking-message" aria-live="polite" data-booking-message></p>
        </form>
      </section>
    </main>

<?php
get_footer();

