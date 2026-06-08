<?php
/**
 * Plugin Name: Nurr Cats
 * Description: Adds cat management for the Nurr cat cafe website.
 * Version: 0.1.0
 * Author: Nurr
 * Text Domain: nurr-cats
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function nurr_cats_register_post_type() {
	$labels = array(
		'name'               => __( 'Kassid', 'nurr-cats' ),
		'singular_name'      => __( 'Kass', 'nurr-cats' ),
		'add_new'            => __( 'Lisa uus', 'nurr-cats' ),
		'add_new_item'       => __( 'Lisa uus kass', 'nurr-cats' ),
		'edit_item'          => __( 'Muuda kassi', 'nurr-cats' ),
		'new_item'           => __( 'Uus kass', 'nurr-cats' ),
		'view_item'          => __( 'Vaata kassi', 'nurr-cats' ),
		'search_items'       => __( 'Otsi kasse', 'nurr-cats' ),
		'not_found'          => __( 'Kasse ei leitud', 'nurr-cats' ),
		'not_found_in_trash' => __( 'Prügikastis kasse ei leitud', 'nurr-cats' ),
		'menu_name'          => __( 'Kassid', 'nurr-cats' ),
	);

	$args = array(
		'labels'       => $labels,
		'public'       => true,
		'has_archive'  => true,
		'menu_icon'    => 'dashicons-pets',
		'supports'     => array( 'title', 'editor', 'thumbnail' ),
		'rewrite'      => array( 'slug' => 'kassid' ),
		'show_in_rest' => true,
	);

	register_post_type( 'nurr_cat', $args );
}
add_action( 'init', 'nurr_cats_register_post_type' );

function nurr_cats_add_meta_boxes() {
	add_meta_box(
		'nurr_cat_details',
		__( 'Kassi andmed', 'nurr-cats' ),
		'nurr_cats_render_details_meta_box',
		'nurr_cat',
		'normal',
		'default'
	);
}
add_action( 'add_meta_boxes', 'nurr_cats_add_meta_boxes' );

function nurr_cats_render_details_meta_box( $post ) {
	wp_nonce_field( 'nurr_save_cat_details', 'nurr_cat_details_nonce' );

	$fields = nurr_cats_get_detail_fields();

	foreach ( $fields as $key => $field ) {
		$value = get_post_meta( $post->ID, $key, true );
		?>
		<p>
			<label for="<?php echo esc_attr( $key ); ?>"><strong><?php echo esc_html( $field['label'] ); ?></strong></label><br>
			<?php if ( isset( $field['options'] ) ) : ?>
				<select id="<?php echo esc_attr( $key ); ?>" name="<?php echo esc_attr( $key ); ?>" style="width: 100%; max-width: 420px;">
					<option value=""><?php esc_html_e( 'Vali...', 'nurr-cats' ); ?></option>
					<?php foreach ( $field['options'] as $option_value => $option_label ) : ?>
						<option value="<?php echo esc_attr( $option_value ); ?>" <?php selected( $value, $option_value ); ?>>
							<?php echo esc_html( $option_label ); ?>
						</option>
					<?php endforeach; ?>
				</select>
			<?php else : ?>
				<input
					id="<?php echo esc_attr( $key ); ?>"
					name="<?php echo esc_attr( $key ); ?>"
					type="text"
					value="<?php echo esc_attr( $value ); ?>"
					style="width: 100%; max-width: 420px;"
				>
			<?php endif; ?>
		</p>
		<?php
	}
}

function nurr_cats_get_detail_fields() {
	return array(
		'nurr_cat_age'         => array(
			'label' => __( 'Vanus', 'nurr-cats' ),
		),
		'nurr_cat_gender'      => array(
			'label'   => __( 'Sugu', 'nurr-cats' ),
			'options' => array(
				'male'   => __( 'Isane', 'nurr-cats' ),
				'female' => __( 'Emane', 'nurr-cats' ),
			),
		),
		'nurr_cat_color'       => array(
			'label' => __( 'Värv', 'nurr-cats' ),
		),
		'nurr_cat_personality' => array(
			'label'   => __( 'Iseloom', 'nurr-cats' ),
			'options' => array(
				'playful' => __( 'Mänguline', 'nurr-cats' ),
				'calm'    => __( 'Rahulik', 'nurr-cats' ),
				'curious' => __( 'Uudishimulik', 'nurr-cats' ),
			),
		),
	);
}

function nurr_cats_save_details( $post_id ) {
	if ( ! isset( $_POST['nurr_cat_details_nonce'] ) ) {
		return;
	}

	if ( ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['nurr_cat_details_nonce'] ) ), 'nurr_save_cat_details' ) ) {
		return;
	}

	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	foreach ( array_keys( nurr_cats_get_detail_fields() ) as $key ) {
		if ( isset( $_POST[ $key ] ) ) {
			update_post_meta( $post_id, $key, sanitize_text_field( wp_unslash( $_POST[ $key ] ) ) );
		}
	}
}
add_action( 'save_post_nurr_cat', 'nurr_cats_save_details' );

function nurr_cats_register_meta_fields() {
	foreach ( array_keys( nurr_cats_get_detail_fields() ) as $key ) {
		register_post_meta(
			'nurr_cat',
			$key,
			array(
				'type'              => 'string',
				'single'            => true,
				'show_in_rest'      => true,
				'sanitize_callback' => 'sanitize_text_field',
				'auth_callback'     => function() {
					return current_user_can( 'edit_posts' );
				},
			)
		);
	}
}
add_action( 'init', 'nurr_cats_register_meta_fields' );

function nurr_cats_enqueue_editor_assets( $hook ) {
	if ( 'post.php' !== $hook && 'post-new.php' !== $hook ) {
		return;
	}

	$screen = get_current_screen();

	if ( ! $screen || 'nurr_cat' !== $screen->post_type ) {
		return;
	}

	wp_enqueue_script(
		'nurr-cats-editor',
		plugins_url( 'assets/js/cat-editor.js', __FILE__ ),
		array( 'wp-plugins', 'wp-edit-post', 'wp-element', 'wp-components', 'wp-data' ),
		'0.1.0',
		true
	);
}
add_action( 'admin_enqueue_scripts', 'nurr_cats_enqueue_editor_assets' );

function nurr_cats_activate() {
	nurr_cats_register_post_type();
	flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'nurr_cats_activate' );

function nurr_cats_deactivate() {
	flush_rewrite_rules();
}
register_deactivation_hook( __FILE__, 'nurr_cats_deactivate' );
