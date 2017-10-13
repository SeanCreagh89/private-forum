<?php

/**
	* Theme Custom Post Types
	*
	* @package Private Forum
	* @author Sean Creagh
*/



/* --- ******************** ******************** ******************** --- */

/* --- Bad Debt Post Type & Metaboxes --- */

/* --- ******************** ******************** ******************** --- */

function bad_debt_post_type() {

	$labels = array(
		'name' => 'Bad Debts',
		'singular_name' => 'Report',
		'add_new' => 'Add A New Report',
		'all_items' => 'All Reports',
		'add_new_item' => 'Add A New Report',
		'edit_item' => 'Edit Report',
		'new_item' => 'New Report',
		'view_item' => 'View Report',
		'search_item' => 'Search Through Reports',
		'not_found' => 'No Reports Found.',
		'not_found_in_trash' => 'No Reports Found In Trash.',
		'parent_item_colon' => 'Parent Item'
	);

	$args = array(
		'labels' => $labels,
		'public' => true,
		'has_archive' => true,
		'publicly_queryable' => true,
		'query_var' => true,
		'rewrite' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'supports' => array( 'title', 'editor', 'thumbnail', 'comments' ),
		'menu_position' => 4,
		'exclude_from_search' => false,
		'register_meta_box_cb' => 'bad_debt_metabox'
	);

	register_post_type( 'bad_debt', $args );

}

add_action( 'init', 'bad_debt_post_type' );

function bad_debt_metabox() {

	add_meta_box( 'bad_debt_metabox', 'Vehicle Details', 'bad_debt_metabox_callback', 'bad_debt', 'normal', 'high' );

}

function bad_debt_metabox_callback( $post ) {

	echo '<style>

	label { font-weight: 600; margin-bottom: 5px; display: block; }
	.meta-input { width: 200px; margin-bottom: 20px; display: block; }
	.meta-input:last-of-type { margin-bottom: 0; }

	</style>';

	wp_nonce_field( 'save_report', 'owner_nonce' );
	$owner = get_post_meta( $post->ID, '_owner_key', true );

	echo '<label for="owner_field">Vehicle Owner </label>';
	echo '<input class="meta-input" type="text" id="owner_field" name="owner_field" value="' . esc_attr( $owner ) . '" />';

	wp_nonce_field( 'save_report', 'make_nonce' );
	$make = get_post_meta( $post->ID, '_make_key', true );

	echo '<label for="make_field">Vehicle Make </label>';
	echo '<input class="meta-input" type="text" id="make_field" name="make_field" value="' . esc_attr( $make ) . '" />';

	wp_nonce_field( 'save_report', 'model_nonce' );
	$model = get_post_meta( $post->ID, '_model_key', true );

	echo '<label for="model_field">Vehicle Model </label>';
	echo '<input class="meta-input" type="text" id="model_field" name="model_field" value="' . esc_attr( $model ) . '" />';

	wp_nonce_field( 'save_report', 'registration_nonce' );
	$registration = get_post_meta( $post->ID, '_registration_key', true );

	echo '<label for="registration_field">Vehicle Registration </label>';
	echo '<input class="meta-input" type="text" id="registration_field" name="registration_field" value="' . esc_attr( $registration ) . '" />';

	wp_nonce_field( 'save_report', 'colour_nonce' );
	$colour = get_post_meta( $post->ID, '_colour_key', true );

	echo '<label for="colour_field">Vehicle Colour </label>';
	echo '<input class="meta-input" type="text" id="colour_field" name="colour_field" value="' . esc_attr( $colour ) . '" />';

}

function save_report( $post_id ) {

	if ( ! isset( $_POST[ 'owner_nonce' ] ) ) return;
	if ( ! wp_verify_nonce( $_POST[ 'owner_nonce' ], 'save_report' ) ) return;
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
	if ( ! current_user_can( 'edit_post', $post_id ) ) return;
	if ( ! isset( $_POST[ 'owner_field' ] ) ) return;

	$owner = sanitize_text_field( $_POST[ 'owner_field' ] );
	update_post_meta( $post_id, '_owner_key', $owner );

	if ( ! isset( $_POST[ 'make_nonce' ] ) ) return;
	if ( ! wp_verify_nonce( $_POST[ 'make_nonce' ], 'save_report' ) ) return;
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
	if ( ! current_user_can( 'edit_post', $post_id ) ) return;
	if ( ! isset( $_POST[ 'make_field' ] ) ) return;

	$make = sanitize_text_field( $_POST[ 'make_field' ] );
	update_post_meta( $post_id, '_make_key', $make );

	if ( ! isset( $_POST[ 'model_nonce' ] ) ) return;
	if ( ! wp_verify_nonce( $_POST[ 'model_nonce' ], 'save_report' ) ) return;
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
	if ( ! current_user_can( 'edit_post', $post_id ) ) return;
	if ( ! isset( $_POST[ 'model_field' ] ) ) return;

	$model = sanitize_text_field( $_POST[ 'model_field' ] );
	update_post_meta( $post_id, '_model_key', $model );

	if ( ! isset( $_POST[ 'registration_nonce' ] ) ) return;
	if ( ! wp_verify_nonce( $_POST[ 'registration_nonce' ], 'save_report' ) ) return;
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
	if ( ! current_user_can( 'edit_post', $post_id ) ) return;
	if ( ! isset( $_POST[ 'registration_field' ] ) ) return;

	$registration = sanitize_text_field( $_POST[ 'registration_field' ] );
	update_post_meta( $post_id, '_registration_key', $registration );

	if ( ! isset( $_POST[ 'colour_nonce' ] ) ) return;
	if ( ! wp_verify_nonce( $_POST[ 'colour_nonce' ], 'save_report' ) ) return;
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
	if ( ! current_user_can( 'edit_post', $post_id ) ) return;
	if ( ! isset( $_POST[ 'colour_field' ] ) ) return;

	$colour = sanitize_text_field( $_POST[ 'colour_field' ] );
	update_post_meta( $post_id, '_colour_key', $colour );

}

add_action( 'save_post', 'save_report' );

function process_bad_debt() {

	if ( ! empty( $_POST[ 'submission' ] ) ) {

		wp_send_json_error( 'Honeypot Check Failed' );

	}
	
	if ( ! check_ajax_referer( 'user-submitted-report', 'security' ) ) {

		wp_send_json_error( 'Security Check Failed' );

	}

	$report = array(

		'post_title' => sprintf( '%s %s',
			sanitize_text_field( $_POST[ 'data' ][ 'owner_field' ] ),
			sanitize_text_field( $_POST[ 'data' ][ 'registration_field' ] )
		),
		'post_status' => 'publish',
		'post_type' => 'bad_debt',
		'post_content' => sanitize_text_field( $_POST[ 'data' ][ 'description_field' ] )

	);

	$post_id = wp_insert_post( $report, true );

	if ( $post_id ) {

		update_post_meta( $post_id, '_owner_key', sanitize_text_field( $_POST[ 'data' ][ 'owner_field' ] ) );
		update_post_meta( $post_id, '_make_key', sanitize_text_field( $_POST[ 'data' ][ 'make_field' ] ) );
		update_post_meta( $post_id, '_model_key', sanitize_text_field( $_POST[ 'data' ][ 'model_field' ] ) );
		update_post_meta( $post_id, '_registration_key', sanitize_text_field( $_POST[ 'data' ][ 'registration_field' ] ) );
		update_post_meta( $post_id, '_colour_key', sanitize_text_field( $_POST[ 'data' ][ 'colour_field' ] ) );

	}

	wp_send_json_success( $post_id );

}

add_action( 'wp_ajax_process_bad_debt', 'process_bad_debt' );
add_action( 'wp_ajax_nopriv_process_bad_debt', 'process_bad_debt' );



/* --- ******************** ******************** ******************** --- */

/* --- Garage Post Type & Metaboxes --- */

/* --- ******************** ******************** ******************** --- */

function garage_post_type() {

	$labels = array(
		'name' => 'Garages',
		'singular_name' => 'Garage',
		'add_new' => 'Add A New Garage',
		'all_items' => 'All Garages',
		'add_new_item' => 'Add A New Garage',
		'edit_item' => 'Edit Garage',
		'new_item' => 'New Garage',
		'view_item' => 'View Garage',
		'search_item' => 'Search Through Garages',
		'not_found' => 'No Garages Found.',
		'not_found_in_trash' => 'No Garages Found In Trash.',
		'parent_item_colon' => 'Parent Item'
	);

	$args = array(
		'labels' => $labels,
		'public' => true,
		'has_archive' => true,
		'publicly_queryable' => true,
		'query_var' => true,
		'rewrite' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'supports' => array( 'title', 'thumbnail' ),
		'menu_position' => 5,
		'exclude_from_search' => false,
		'register_meta_box_cb' => 'garage_metabox'
	);

	register_post_type( 'garage', $args );

}

add_action( 'init', 'garage_post_type' );

function garage_metabox() {

	add_meta_box( 'garage_metabox', 'Garage Details', 'garage_metabox_callback', 'garage', 'normal', 'high' );

}

function garage_metabox_callback( $post ) {

	echo '<style>

	label { font-weight: 600; margin-bottom: 5px; display: block; }
	.meta-input { width: 200px; margin-bottom: 20px; display: block; }
	.meta-input:last-of-type { margin-bottom: 0; }

	</style>';

	wp_nonce_field( 'save_garage', 'garage_name_nonce' );
	$garage_name = get_post_meta( $post->ID, '_garage_name_key', true );

	echo '<label for="garage_name_field">Garage Name </label>';
	echo '<input class="meta-input" type="text" id="garage_name_field" name="garage_name_field" value="' . esc_attr( $garage_name ) . '" />';

	wp_nonce_field( 'save_garage', 'garage_owner_nonce' );
	$garage_owner = get_post_meta( $post->ID, '_garage_owner_key', true );

	echo '<label for="garage_owner_field">Garage Owner </label>';
	echo '<input class="meta-input" type="text" id="garage_owner_field" name="garage_owner_field" value="' . esc_attr( $garage_owner ) . '" />';

	wp_nonce_field( 'save_garage', 'garage_email_nonce' );
	$garage_email = get_post_meta( $post->ID, '_garage_email_key', true );

	echo '<label for="garage_email_field">Email </label>';
	echo '<input class="meta-input" type="email" id="garage_email_field" name="garage_email_field" value="' . esc_attr( $garage_email ) . '" />';

	wp_nonce_field( 'save_garage', 'garage_number_nonce' );
	$garage_number = get_post_meta( $post->ID, '_garage_number_key', true );

	echo '<label for="garage_number_field">Number </label>';
	echo '<input class="meta-input" type="tel" id="garage_number_field" name="garage_number_field" value="' . esc_attr( $garage_number ) . '" />';

	wp_nonce_field( 'save_garage', 'garage_address_line_1_nonce' );
	$garage_address_line_1 = get_post_meta( $post->ID, '_garage_address_line_1_key', true );

	echo '<label>Garage Address </label>';
	echo '<input class="meta-input" type="text" id="garage_address_line_1_field" name="garage_address_line_1_field" value="' . esc_attr( $garage_address_line_1 ) . '" placeholder="Address Line 1" />';

	wp_nonce_field( 'save_garage', 'garage_address_line_2_nonce' );
	$garage_address_line_2 = get_post_meta( $post->ID, '_garage_address_line_2_key', true );

	echo '<input class="meta-input" type="text" id="garage_address_line_2_field" name="garage_address_line_2_field" value="' . esc_attr( $garage_address_line_2 ) . '" placeholder="Address Line 2" />';

	wp_nonce_field( 'save_garage', 'garage_county_nonce' );
	$garage_county = get_post_meta( $post->ID, '_garage_county_key', true );

	echo '<input class="meta-input" type="text" id="garage_county_field" name="garage_county_field" value="' . esc_attr( $garage_county ) . '" placeholder="County" />';

	wp_nonce_field( 'save_garage', 'garage_eircode_nonce' );
	$garage_eircode = get_post_meta( $post->ID, '_garage_eircode_key', true );

	echo '<input class="meta-input" type="text" id="garage_eircode_field" name="garage_eircode_field" value="' . esc_attr( $garage_eircode ) . '" placeholder="Eircode" />';

	wp_nonce_field( 'save_garage', 'garage_map_nonce' );
	$garage_map = get_post_meta( $post->ID, '_garage_map_key', true );

	echo '<label for="garage_map_field">Garage Map </label>';
	echo '<input class="meta-input" type="url" id="garage_map_field" name="garage_map_field" value="' . esc_attr( $garage_map ) . '" placeholder="Google Maps" />';

}

function save_garage( $post_id ) {

	if ( ! isset( $_POST[ 'garage_name_nonce' ] ) ) return;
	if ( ! wp_verify_nonce( $_POST[ 'garage_name_nonce' ], 'save_garage' ) ) return;
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
	if ( ! current_user_can( 'edit_post', $post_id ) ) return;
	if ( ! isset( $_POST[ 'garage_name_field' ] ) ) return;

	$garage_owner = sanitize_text_field( $_POST[ 'garage_name_field' ] );
	update_post_meta( $post_id, '_garage_name_key', $garage_owner );

	if ( ! isset( $_POST[ 'garage_owner_nonce' ] ) ) return;
	if ( ! wp_verify_nonce( $_POST[ 'garage_owner_nonce' ], 'save_garage' ) ) return;
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
	if ( ! current_user_can( 'edit_post', $post_id ) ) return;
	if ( ! isset( $_POST[ 'garage_owner_field' ] ) ) return;

	$garage_owner = sanitize_text_field( $_POST[ 'garage_owner_field' ] );
	update_post_meta( $post_id, '_garage_owner_key', $garage_owner );

	if ( ! isset( $_POST[ 'garage_email_nonce' ] ) ) return;
	if ( ! wp_verify_nonce( $_POST[ 'garage_email_nonce' ], 'save_garage' ) ) return;
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
	if ( ! current_user_can( 'edit_post', $post_id ) ) return;
	if ( ! isset( $_POST[ 'garage_email_field' ] ) ) return;

	$garage_email = sanitize_text_field( $_POST[ 'garage_email_field' ] );
	update_post_meta( $post_id, '_garage_email_key', $garage_email );

	if ( ! isset( $_POST[ 'garage_number_nonce' ] ) ) return;
	if ( ! wp_verify_nonce( $_POST[ 'garage_number_nonce' ], 'save_garage' ) ) return;
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
	if ( ! current_user_can( 'edit_post', $post_id ) ) return;
	if ( ! isset( $_POST[ 'garage_number_field' ] ) ) return;

	$garage_number = sanitize_text_field( $_POST[ 'garage_number_field' ] );
	update_post_meta( $post_id, '_garage_number_key', $garage_number );

	if ( ! isset( $_POST[ 'garage_address_line_1_nonce' ] ) ) return;
	if ( ! wp_verify_nonce( $_POST[ 'garage_address_line_1_nonce' ], 'save_garage' ) ) return;
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
	if ( ! current_user_can( 'edit_post', $post_id ) ) return;
	if ( ! isset( $_POST[ 'garage_address_line_1_field' ] ) ) return;

	$garage_address_line_1 = sanitize_text_field( $_POST[ 'garage_address_line_1_field' ] );
	update_post_meta( $post_id, '_garage_address_line_1_key', $garage_address_line_1 );

	if ( ! isset( $_POST[ 'garage_address_line_2_nonce' ] ) ) return;
	if ( ! wp_verify_nonce( $_POST[ 'garage_address_line_2_nonce' ], 'save_garage' ) ) return;
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
	if ( ! current_user_can( 'edit_post', $post_id ) ) return;
	if ( ! isset( $_POST[ 'garage_address_line_2_field' ] ) ) return;

	$garage_address_line_2 = sanitize_text_field( $_POST[ 'garage_address_line_2_field' ] );
	update_post_meta( $post_id, '_garage_address_line_2_key', $garage_address_line_2 );

	if ( ! isset( $_POST[ 'garage_county_nonce' ] ) ) return;
	if ( ! wp_verify_nonce( $_POST[ 'garage_county_nonce' ], 'save_garage' ) ) return;
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
	if ( ! current_user_can( 'edit_post', $post_id ) ) return;
	if ( ! isset( $_POST[ 'garage_county_field' ] ) ) return;

	$garage_county = sanitize_text_field( $_POST[ 'garage_county_field' ] );
	update_post_meta( $post_id, '_garage_county_key', $garage_county );

	if ( ! isset( $_POST[ 'garage_eircode_nonce' ] ) ) return;
	if ( ! wp_verify_nonce( $_POST[ 'garage_eircode_nonce' ], 'save_garage' ) ) return;
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
	if ( ! current_user_can( 'edit_post', $post_id ) ) return;
	if ( ! isset( $_POST[ 'garage_eircode_field' ] ) ) return;

	$garage_eircode = sanitize_text_field( $_POST[ 'garage_eircode_field' ] );
	update_post_meta( $post_id, '_garage_eircode_key', $garage_eircode );

	if ( ! isset( $_POST[ 'garage_map_nonce' ] ) ) return;
	if ( ! wp_verify_nonce( $_POST[ 'garage_map_nonce' ], 'save_garage' ) ) return;
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
	if ( ! current_user_can( 'edit_post', $post_id ) ) return;
	if ( ! isset( $_POST[ 'garage_map_field' ] ) ) return;

	$garage_map = sanitize_text_field( $_POST[ 'garage_map_field' ] );
	update_post_meta( $post_id, '_garage_map_key', $garage_map );

}

add_action( 'save_post', 'save_garage' );

function process_garage() {

	if ( ! empty( $_POST[ 'submission' ] ) ) {

		wp_send_json_error( 'Honeypot Check Failed' );

	}
	
	if ( ! check_ajax_referer( 'user-submitted-garage', 'security' ) ) {

		wp_send_json_error( 'Security Check Failed' );

	}

	$garage = array(

		'post_title' => sprintf( '%s owned by %s',
			sanitize_text_field( $_POST[ 'data' ][ 'garage_name_field' ] ),
			sanitize_text_field( $_POST[ 'data' ][ 'garage_owner_field' ] )
		),
		'post_status' => 'publish',
		'post_type' => 'garage'

	);

	$post_id = wp_insert_post( $garage, true );

	if ( $post_id ) {

		update_post_meta( $post_id, '_garage_name_key', sanitize_text_field( $_POST[ 'data' ][ 'garage_name_field' ] ) );
		update_post_meta( $post_id, '_garage_owner_key', sanitize_text_field( $_POST[ 'data' ][ 'garage_owner_field' ] ) );
		update_post_meta( $post_id, '_garage_email_key', sanitize_email( $_POST[ 'data' ][ 'garage_email_field' ] ) );
		update_post_meta( $post_id, '_garage_number_key', $_POST[ 'data' ][ 'garage_number_field' ] );
		update_post_meta( $post_id, '_garage_address_line_1_key', sanitize_text_field( $_POST[ 'data' ][ 'garage_address_line_1_field' ] ) );
		update_post_meta( $post_id, '_garage_address_line_2_key', sanitize_text_field( $_POST[ 'data' ][ 'garage_address_line_2_field' ] ) );
		update_post_meta( $post_id, '_garage_county_key', sanitize_text_field( $_POST[ 'data' ][ 'garage_county_field' ] ) );
		update_post_meta( $post_id, '_garage_eircode_key', sanitize_text_field( $_POST[ 'data' ][ 'garage_eircode_field' ] ) );
		update_post_meta( $post_id, '_garage_map_key', sanitize_text_field( $_POST[ 'data' ][ 'garage_map_field' ] ) );

	}

	wp_send_json_success( $post_id );

}

add_action( 'wp_ajax_process_garage', 'process_garage' );
add_action( 'wp_ajax_nopriv_process_garage', 'process_garage' );

?>