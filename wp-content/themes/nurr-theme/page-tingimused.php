<?php
/**
 * Terms page template.
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
        <h1><?php esc_html_e( 'Teenustingimused', 'nurr' ); ?></h1>
        <p>
          <?php esc_html_e( 'Broneeringu tegemisel palume sisestada õiged kontaktandmed. Kui plaanid külastust muuta või tühistada, anna meile sellest teada esimesel võimalusel.', 'nurr' ); ?>
        </p>
        <p>
          <?php esc_html_e( 'Kassidega kohtumisel palume järgida kohviku töötajate juhiseid ning hoida loomade heaolu esikohal. Lapsi ootame külla koos täiskasvanud saatjaga.', 'nurr' ); ?>
        </p>
      </section>
    </main>

<?php
get_footer();

