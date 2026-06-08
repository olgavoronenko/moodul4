<?php
/**
 * Single cat profile template.
 *
 * @package Nurr
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

$gender_labels = array(
	'male'   => __( 'Isane', 'nurr' ),
	'female' => __( 'Emane', 'nurr' ),
);

$personality_labels = array(
	'playful' => __( 'Mänguline', 'nurr' ),
	'calm'    => __( 'Rahulik', 'nurr' ),
	'curious' => __( 'Uudishimulik', 'nurr' ),
);
?>

    <main>
      <?php while ( have_posts() ) : ?>
        <?php
        the_post();

        $cat_id      = get_the_ID();
        $age         = get_post_meta( $cat_id, 'nurr_cat_age', true );
        $gender      = get_post_meta( $cat_id, 'nurr_cat_gender', true );
        $color       = get_post_meta( $cat_id, 'nurr_cat_color', true );
        $personality = get_post_meta( $cat_id, 'nurr_cat_personality', true );
        ?>

        <article class="cat-profile container" aria-labelledby="cat-profile-title">
          <div class="cat-profile__gallery">
            <div class="cat-profile__main-media">
              <?php if ( has_post_thumbnail() ) : ?>
                <?php
                the_post_thumbnail(
                	'large',
                	array(
                		'class'                   => 'cat-profile__main-image',
                		'loading'                 => 'eager',
                		'data-profile-main-image' => '',
                	)
                );
                ?>
              <?php else : ?>
                <img
                  class="cat-profile__main-image"
                  src="<?php echo esc_url( nurr_asset_uri( 'images/cat-black-white-chair.webp' ) ); ?>"
                  width="900"
                  height="900"
                  alt="<?php the_title_attribute(); ?>"
                  data-profile-main-image
                >
              <?php endif; ?>
            </div>
          </div>

          <div class="cat-profile__content">
            <h1 id="cat-profile-title"><?php the_title(); ?></h1>
            <p class="cat-profile__eyebrow"><?php esc_html_e( 'Populaarseim', 'nurr' ); ?></p>

            <div class="cat-profile__description">
              <?php the_content(); ?>
            </div>

            <dl class="cat-profile__facts">
              <?php if ( $age ) : ?>
                <div>
                  <dt><?php esc_html_e( 'Vanus:', 'nurr' ); ?></dt>
                  <dd><?php echo esc_html( $age ); ?></dd>
                </div>
              <?php endif; ?>

              <?php if ( $gender ) : ?>
                <div>
                  <dt><?php esc_html_e( 'Sugu:', 'nurr' ); ?></dt>
                  <dd><?php echo esc_html( $gender_labels[ $gender ] ?? $gender ); ?></dd>
                </div>
              <?php endif; ?>

              <?php if ( $color ) : ?>
                <div>
                  <dt><?php esc_html_e( 'Värv:', 'nurr' ); ?></dt>
                  <dd><?php echo esc_html( $color ); ?></dd>
                </div>
              <?php endif; ?>

              <?php if ( $personality ) : ?>
                <div>
                  <dt><?php esc_html_e( 'Iseloom:', 'nurr' ); ?></dt>
                  <dd><?php echo esc_html( $personality_labels[ $personality ] ?? $personality ); ?></dd>
                </div>
              <?php endif; ?>
            </dl>

            <a class="button cat-profile__cta" href="<?php echo esc_url( home_url( '/broneeri/#adoption-form' ) ); ?>">
              <?php esc_html_e( 'Soovin adopteerida', 'nurr' ); ?>
            </a>
          </div>
        </article>
      <?php endwhile; ?>
    </main>

<?php
get_footer();
