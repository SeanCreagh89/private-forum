<?php

/**
	* Theme Enqueue Styles & Scripts
	*
	* @package Private Forum
	* @author Sean Creagh
*/



/* --- Enqueue Theme Styles --- */
function theme_styles() {

	wp_enqueue_style( 'style', get_stylesheet_uri(), false, THEME_VERSION, 'all' );
	wp_enqueue_style( 'private-forum-layout', THEME_URI . '/styles/layout.css', false, THEME_VERSION, 'all' );
	wp_enqueue_style( 'private-forum-responsive', THEME_URI . '/styles/responsive.css', false, THEME_VERSION, 'all' );
	wp_enqueue_style( 'private-forum-color', THEME_URI . '/styles/color.css', false, THEME_VERSION, 'all' );
	wp_enqueue_style( 'private-forume-font', THEME_URI . '/styles/font.css', false, THEME_VERSION, 'all' );

}

add_action( 'wp_enqueue_scripts', 'theme_styles' );



/* --- Enqueue Theme Scripts --- */
function theme_script() {

	wp_enqueue_script( 'jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js', false, THEME_VERSION, true );
	wp_enqueue_script( 'private-forum-script', THEME_URI . '/scripts/script.js', false, THEME_VERSION, true );

	$post_id = get_the_ID();

	if ( is_user_logged_in() ) {

		if ( get_page_template_slug( $post_id ) === "template-report.php" ) { 

			wp_enqueue_script( 'private-forum-report-functions', THEME_URI . '/scripts/report-functions.js', false, THEME_VERSION, true );
			wp_localize_script( 'private-forum-report-functions', 'screen_reader_text', array(

				'admin_ajax' => admin_url( 'admin-ajax.php' ),
				'security' => wp_create_nonce( 'user-submitted-report' )

			) );

		}

		if ( get_page_template_slug( $post_id ) === "template-garage.php" ) {

			wp_enqueue_script( 'private-forum-garage-functions', THEME_URI . '/scripts/garage-functions.js', false, THEME_VERSION, true );
			wp_localize_script( 'private-forum-garage-functions', 'screen_reader_text', array(

				'admin_ajax' => admin_url( 'admin-ajax.php' ),
				'security' => wp_create_nonce( 'user-submitted-garage' )

			) );

		}

	}

}

add_action( 'wp_enqueue_scripts', 'theme_script' );



/* --- Enqueue Theme Fonts --- */
function theme_fonts() {
 
    wp_enqueue_style( 'font-awesome', THEME_URI. '/fonts/font-awesome/css/font-awesome.min.css', false, THEME_VERSION, 'all' );
    wp_enqueue_style( 'roboto', 'https://fonts.googleapis.com/css?family=Roboto|Roboto+Condensed' );
 
}

add_action( 'wp_enqueue_scripts', 'theme_fonts' );

?>