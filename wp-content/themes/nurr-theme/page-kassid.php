<?php
/**
 * Cats listing page template.
 *
 * @package Nurr
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

$cats = new WP_Query(
	array(
		'post_type'      => 'nurr_cat',
		'posts_per_page' => -1,
		'orderby'        => 'menu_order title',
		'order'          => 'ASC',
	)
);
?>

    <main>
      <section class="cats-page container" aria-labelledby="cats-title">
        <h1 id="cats-title"><?php esc_html_e( 'Tutvu kõigi meie nurruvate sõpradega!', 'nurr' ); ?></h1>

        <div class="cats-layout">
          <aside class="cat-filters" aria-label="<?php esc_attr_e( 'Kasside filtrid', 'nurr' ); ?>">
            <fieldset>
              <legend><?php esc_html_e( 'Vanus', 'nurr' ); ?></legend>
              <label><input type="radio" name="age" value="kitten"> <?php esc_html_e( 'Kassipoeg', 'nurr' ); ?></label>
              <label><input type="radio" name="age" value="adult"> <?php esc_html_e( 'Täiskasvanu', 'nurr' ); ?></label>
              <label><input type="radio" name="age" value="senior"> <?php esc_html_e( 'Seenior', 'nurr' ); ?></label>
            </fieldset>

            <fieldset>
              <legend><?php esc_html_e( 'Sugu', 'nurr' ); ?></legend>
              <label><input type="radio" name="gender" value="male"> <?php esc_html_e( 'Isane', 'nurr' ); ?></label>
              <label><input type="radio" name="gender" value="female"> <?php esc_html_e( 'Emane', 'nurr' ); ?></label>
            </fieldset>

            <fieldset>
              <legend><?php esc_html_e( 'Iseloom', 'nurr' ); ?></legend>
              <label><input type="radio" name="personality" value="playful"> <?php esc_html_e( 'Mänguline', 'nurr' ); ?></label>
              <label><input type="radio" name="personality" value="calm"> <?php esc_html_e( 'Rahulik', 'nurr' ); ?></label>
              <label><input type="radio" name="personality" value="curious"> <?php esc_html_e( 'Uudishimulik', 'nurr' ); ?></label>
            </fieldset>
          </aside>

          <div class="cats-grid" data-cats-grid>
            <?php if ( $cats->have_posts() ) : ?>
              <?php
              while ( $cats->have_posts() ) :
                $cats->the_post();

                $age         = get_post_meta( get_the_ID(), 'nurr_cat_age', true );
                $gender      = get_post_meta( get_the_ID(), 'nurr_cat_gender', true );
                $personality = get_post_meta( get_the_ID(), 'nurr_cat_personality', true );
                ?>
                <article
                  class="cat-card"
                  data-age="<?php echo esc_attr( sanitize_title( $age ) ); ?>"
                  data-gender="<?php echo esc_attr( sanitize_title( $gender ) ); ?>"
                  data-personality="<?php echo esc_attr( sanitize_title( $personality ) ); ?>"
                >
                  <?php if ( has_post_thumbnail() ) : ?>
                    <?php the_post_thumbnail( 'medium', array( 'loading' => 'lazy' ) ); ?>
                  <?php else : ?>
                    <img src="<?php echo esc_url( nurr_asset_uri( 'images/cat-black-white-chair.webp' ) ); ?>" width="220" height="220" loading="lazy" alt="">
                  <?php endif; ?>
                  <h2><?php the_title(); ?></h2>
                  <?php if ( $age ) : ?>
                    <p><?php echo esc_html( $age ); ?></p>
                  <?php endif; ?>
                  <a href="<?php the_permalink(); ?>"><?php esc_html_e( 'Tutvu', 'nurr' ); ?></a>
                </article>
                <?php
              endwhile;
              wp_reset_postdata();
              ?>
            <?php else : ?>
              <p><?php esc_html_e( 'Kasse ei ole veel lisatud.', 'nurr' ); ?></p>
            <?php endif; ?>
          </div>
        </div>
      </section>
    </main>

<?php
get_footer();

