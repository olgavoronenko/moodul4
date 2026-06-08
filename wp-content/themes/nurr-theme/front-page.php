<?php
/**
 * Front page template.
 *
 * @package Nurr
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

    <main>
      <section class="hero container" aria-labelledby="hero-title">
        <div class="hero__content">
          <h1 id="hero-title">Kohv, pai ja <span class="hero-title__nowrap">nurruvad sõbrad</span></h1>
          <p>
            Tule veeda aega meie armsate kasside seltsis. Naudi värskelt röstitud kohvi,
            maitsvaid kooke ja palju kassipai. Kõik meie kassid on päästetud ja ootavad
            armastavat kodu.
          </p>
          <a class="button" href="<?php echo esc_url( home_url( '/broneeri/' ) ); ?>"><?php esc_html_e( 'Broneeri laud', 'nurr' ); ?></a>
        </div>

        <picture class="hero__image">
          <source srcset="<?php echo esc_url( nurr_asset_uri( 'images/hero-cafe-two-cats.webp' ) ); ?>" type="image/webp">
          <img
            src="<?php echo esc_url( nurr_asset_uri( 'images/hero-cafe-two-cats.webp' ) ); ?>"
            width="1536"
            height="1024"
            alt="<?php esc_attr_e( 'Hubane kassikohvik kahe kassiga, üks neist oranž toolil', 'nurr' ); ?>"
          >
        </picture>
      </section>

      <section class="story container" aria-labelledby="story-title">
        <h2 id="story-title"><?php esc_html_e( 'Meie lugu', 'nurr' ); ?></h2>
        <p>
          Meie kohvik on koduks päästetud kassidele, kes otsivad püsivat peret. Iga tass kohvi,
          mida jood, aitab meil kasside eest hoolitseda. Tule naudi ning ehk leiad endale uue
          nurruva sõbra!
        </p>

        <ul class="stats" aria-label="<?php esc_attr_e( 'Nurr kohviku näitajad', 'nurr' ); ?>">
          <li>
            <img class="story-icon" src="<?php echo esc_url( nurr_asset_uri( 'icons/cat.svg' ) ); ?>" width="44" height="44" alt="" aria-hidden="true">
            <span><?php esc_html_e( '9 nurruvat sõpra', 'nurr' ); ?></span>
          </li>
          <li>
            <img class="story-icon" src="<?php echo esc_url( nurr_asset_uri( 'icons/coffee.svg' ) ); ?>" width="44" height="44" alt="" aria-hidden="true">
            <span><?php esc_html_e( '50+ tassi päevas', 'nurr' ); ?></span>
          </li>
          <li>
            <img class="story-icon" src="<?php echo esc_url( nurr_asset_uri( 'icons/house.svg' ) ); ?>" width="44" height="44" alt="" aria-hidden="true">
            <span><?php esc_html_e( '8 kassi leidnud kodu', 'nurr' ); ?></span>
          </li>
        </ul>

        <a class="button" href="<?php echo esc_url( home_url( '/kassid/' ) ); ?>"><?php esc_html_e( 'Tutvu meie kassidega', 'nurr' ); ?></a>
      </section>

      <section class="section container" id="cats" aria-labelledby="new-cats-title">
        <h2 id="new-cats-title"><?php esc_html_e( 'Uued kassid', 'nurr' ); ?></h2>
        <p class="section__lead"><?php esc_html_e( 'Tutvu meie uusimate elanikega', 'nurr' ); ?></p>

        <div class="new-cats">
          <article class="cat-tile cat-tile--featured">
            <span class="cat-tile__ribbon"><?php esc_html_e( 'Populaarseim kass!', 'nurr' ); ?></span>
            <img src="<?php echo esc_url( nurr_asset_uri( 'images/cat-black-white-chair.webp' ) ); ?>" width="320" height="320" loading="lazy" alt="<?php esc_attr_e( 'Miisu puhkab kohviku toolil', 'nurr' ); ?>">
            <h3><?php esc_html_e( 'Miisu', 'nurr' ); ?></h3>
            <p><?php esc_html_e( '2 aastat', 'nurr' ); ?></p>
            <p><?php esc_html_e( 'Mänguline', 'nurr' ); ?></p>
          </article>

          <article class="cat-tile">
            <img src="<?php echo esc_url( nurr_asset_uri( 'images/cat-orange-counter.webp' ) ); ?>" width="320" height="320" loading="lazy" alt="<?php esc_attr_e( 'Kiki istub kohvikuletti ees', 'nurr' ); ?>">
            <h3><?php esc_html_e( 'Kiki', 'nurr' ); ?></h3>
            <p><?php esc_html_e( '8 kuud', 'nurr' ); ?></p>
            <p><?php esc_html_e( 'Uudishimulik', 'nurr' ); ?></p>
          </article>

          <article class="cat-tile">
            <img src="<?php echo esc_url( nurr_asset_uri( 'images/cat-tabby-floor.webp' ) ); ?>" width="320" height="320" loading="lazy" alt="<?php esc_attr_e( 'Tõnu vaatab kohvikus ringi', 'nurr' ); ?>">
            <h3><?php esc_html_e( 'Tõnu', 'nurr' ); ?></h3>
            <p><?php esc_html_e( '5 aastat', 'nurr' ); ?></p>
            <p><?php esc_html_e( 'Rahulik', 'nurr' ); ?></p>
          </article>

          <article class="cat-tile">
            <img src="<?php echo esc_url( nurr_asset_uri( 'images/cat-orange-counter.webp' ) ); ?>" width="320" height="320" loading="lazy" alt="<?php esc_attr_e( 'Luna istub hubases kassikohvikus', 'nurr' ); ?>">
            <h3><?php esc_html_e( 'Luna', 'nurr' ); ?></h3>
            <p><?php esc_html_e( '4 aastat', 'nurr' ); ?></p>
            <p><?php esc_html_e( 'Mänguline', 'nurr' ); ?></p>
          </article>
        </div>
      </section>

      <section class="section section--events container" aria-labelledby="events-title">
        <h2 id="events-title"><?php esc_html_e( 'Sündmused', 'nurr' ); ?></h2>
        <p class="section__lead"><?php esc_html_e( 'Tule osale meie erilistel üritustel', 'nurr' ); ?></p>

        <div class="events">
          <article class="event-card">
            <time datetime="2026-06-14T12:00">14.06 • 12:00</time>
            <h3><?php esc_html_e( 'Joogatund kassidega', 'nurr' ); ?></h3>
            <p><?php esc_html_e( 'Alusta päeva rahulikult - jooga ja 12 nurruva kaaslasega.', 'nurr' ); ?></p>
            <a href="<?php echo esc_url( home_url( '/broneeri/' ) ); ?>"><?php esc_html_e( 'Registreeri', 'nurr' ); ?></a>
          </article>

          <article class="event-card">
            <time datetime="2026-06-18T18:00">18.06 • 18:00</time>
            <h3><?php esc_html_e( 'Kasside mänguõhtu', 'nurr' ); ?></h3>
            <p><?php esc_html_e( 'Tule mängi meie kassidega! Mänguasjad ja maiused kohapeal.', 'nurr' ); ?></p>
            <a href="<?php echo esc_url( home_url( '/broneeri/' ) ); ?>"><?php esc_html_e( 'Registreeri', 'nurr' ); ?></a>
          </article>

          <article class="event-card">
            <time datetime="2026-06-21T12:00">21.06 • 12:00</time>
            <h3><?php esc_html_e( 'Adopteerimispäev', 'nurr' ); ?></h3>
            <p><?php esc_html_e( 'Otsid uut sõpra? Tule kohtuma ja leia oma puslepala.', 'nurr' ); ?></p>
            <a href="<?php echo esc_url( home_url( '/broneeri/' ) ); ?>"><?php esc_html_e( 'Registreeri', 'nurr' ); ?></a>
          </article>
        </div>
      </section>

      <section class="section container" aria-labelledby="popular-title">
        <h2 id="popular-title"><?php esc_html_e( 'Populaarsed kassid', 'nurr' ); ?></h2>
        <p class="section__lead"><?php esc_html_e( 'Meie külastajate lemmikud', 'nurr' ); ?></p>

        <div class="popular-cats">
          <article class="popular-card">
            <div class="popular-card__media">
              <img src="<?php echo esc_url( nurr_asset_uri( 'images/cat-black-white-chair.webp' ) ); ?>" width="220" height="220" loading="lazy" alt="<?php esc_attr_e( 'Miisu lamab kohviku toolil', 'nurr' ); ?>">
            </div>
            <div class="popular-card__content">
              <h3><?php esc_html_e( 'Miisu', 'nurr' ); ?></h3>
              <p><?php esc_html_e( '2 aastat', 'nurr' ); ?></p>
              <p><?php esc_html_e( 'Mänguline', 'nurr' ); ?></p>
              <p><?php esc_html_e( 'Parim pallipüüdja', 'nurr' ); ?></p>
              <a href="<?php echo esc_url( home_url( '/miisu/' ) ); ?>"><?php esc_html_e( 'Tutvu', 'nurr' ); ?></a>
            </div>
          </article>

          <article class="popular-card">
            <div class="popular-card__media">
              <img src="<?php echo esc_url( nurr_asset_uri( 'images/cat-orange-counter.webp' ) ); ?>" width="220" height="220" loading="lazy" alt="<?php esc_attr_e( 'Kiki istub hubases kohvikus', 'nurr' ); ?>">
            </div>
            <div class="popular-card__content">
              <h3><?php esc_html_e( 'Kiki', 'nurr' ); ?></h3>
              <p><?php esc_html_e( '8 kuud', 'nurr' ); ?></p>
              <p><?php esc_html_e( 'Uudishimulik', 'nurr' ); ?></p>
              <p><?php esc_html_e( 'Alati esimene uksel', 'nurr' ); ?></p>
              <a href="<?php echo esc_url( home_url( '/miisu/' ) ); ?>"><?php esc_html_e( 'Tutvu', 'nurr' ); ?></a>
            </div>
          </article>

          <article class="popular-card">
            <div class="popular-card__media">
              <img src="<?php echo esc_url( nurr_asset_uri( 'images/cat-tabby-floor.webp' ) ); ?>" width="220" height="220" loading="lazy" alt="<?php esc_attr_e( 'Tõnu kassikohviku põrandal', 'nurr' ); ?>">
            </div>
            <div class="popular-card__content">
              <h3><?php esc_html_e( 'Tõnu', 'nurr' ); ?></h3>
              <p><?php esc_html_e( '5 aastat', 'nurr' ); ?></p>
              <p><?php esc_html_e( 'Rahulik', 'nurr' ); ?></p>
              <p><?php esc_html_e( 'Kõige pehmem kass', 'nurr' ); ?></p>
              <a href="<?php echo esc_url( home_url( '/miisu/' ) ); ?>"><?php esc_html_e( 'Tutvu', 'nurr' ); ?></a>
            </div>
          </article>
        </div>
      </section>
    </main>

<?php
get_footer();

