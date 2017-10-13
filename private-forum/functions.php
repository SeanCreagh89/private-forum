<?php

/**
	* Theme Functions and Set-up
	*
	* @package Private Forum
	* @author Sean Creagh
*/



define( 'THEME_DIR', get_template_directory() );
define( 'THEME_URI', get_template_directory_uri() );

define( 'THEME_NAME', 'private-forum' );
define( 'THEME_VERSION', '1.0' );

define( 'LIBS_DIR', THEME_DIR . '/functions' );
define( 'LIBS_URI', THEME_DIR . '/functions' );



/* --- Load Theme Functions --- */

require_once( LIBS_DIR . '/theme-head.php' );
require_once( LIBS_DIR . '/theme-identity.php' );
require_once( LIBS_DIR . '/theme-breadcrumbs.php' );
require_once( LIBS_DIR . '/theme-widgets.php' );
require_once( LIBS_DIR . '/theme-post-types.php' );



/* --- Theme Set-up --- */

function private_forum_setup() {

	/*--- Enable Custom Logos Support ---*/

	add_theme_support( 'custom-logo', array (
		'height' => 42,
		'width' => 85,
		'flex-height' => true,
		'flex-width' => true,
		'header-text' => array( 'site-title', 'site-description' )
	));

	/* --- Establish Menus --- */

	register_nav_menus( array(

		'primary' => __( 'Primary Menu | Main Navigation (Hidden)', 'private-forum' ),
		'secondary' => __( 'Secondary Menu | General Navigation', 'private-forum' ),
		'tertiary' => __( 'Tertiary Menu | Footer Navigation', 'private-forum' )

	) );

	/* --- Add Theme Support : Featured Images --- */

	add_theme_support( 'post-thumbnails' );

	/* --- Add Theme Support : Comments --- */

	add_theme_support( 'html5', array( 'comment-form', 'comment-list' ) );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {

		wp_enqueue_script( 'comment-reply' );

	}

	/* --- Hide Admin Bar : for anyone who isn't an admin --- */

	/* if ( !current_user_can( 'administrator' ) && !is_admin() ) {

		show_admin_bar( false );

	} */

	show_admin_bar( false );

}

add_action( 'after_setup_theme', 'private_forum_setup' );

/* --- Prevent General Users From Accessing wp-admin --- */

function administrator_only() {

	if ( is_admin() && !current_user_can( 'administrator' ) && !( defined( 'DOING_AJAX' ) && DOING_AJAX ) ) {

		wp_redirect( home_url() );
		exit;

	}

}

add_action( 'init', 'administrator_only' );



/* --- Login Form Functions --- */

/* --- Redirect User : from wp-login.php --- */

function redirect_login_page() {

	$page = basename( $_SERVER[ 'REQUEST_URI' ] );

	if ( $page == "wp-login.php" && $_SERVER[ 'REQUEST_METHOD' ] == 'GET' ) {

		wp_redirect( home_url() );
		exit;

	}

}

add_action( 'init', 'redirect_login_page' );

/* --- Login Failed : user doesn't exist or credentials are incorrect --- */

function login_failed() {

	wp_redirect( home_url() . '?login=failed' );
	exit;

}

add_action( 'wp_login_failed', 'login_failed' );

/* --- Login Failed : user didn't fill inputs --- */

function verify_username_password( $user, $username, $password ) {

	if ( $username == "" || $password == "" ) {

		wp_redirect( home_url() . "?login=empty" );
		exit;

	}

}

add_filter( 'authenticate', 'verify_username_password', 1, 3 );

/* --- Login Failed : user is logged out --- */

function logout_page() {

	wp_redirect( home_url() . "?login=false" );
	exit;

}

add_action( 'wp_logout', 'logout_page' );



/* --- Custom Filters --- */

/* --- Custom Login/Logout Menu Filter --- */

function menu_loginout( $items, $args ) {

	if ( current_user_can( 'administrator' ) ) {

		$items .= '<li id="menu-item-login" class="menu-item"><a href="' . get_admin_url() . '">Admin</a></li>';

	}

	if ( $args->theme_location == 'primary' ) {

		if ( is_user_logged_in() ) {

			$items .= '<li id="menu-item-logout" class="menu-item"><a href="' . wp_logout_url( home_url() ) . '">Logout</a></li>';

		}

	} else if ( $args->theme_location == 'secondary' ) {

		if ( !is_user_logged_in() ) {

			$items .= '<li id="menu-item-login" class="menu-item"><a id="Login-button">Login</a></li>';

		}

	}

	return $items;

}

add_filter( 'wp_nav_menu_items', 'menu_loginout', 10, 2 );

/* --- Custom Search Form Widget Filter --- */

function searchform( $form ) {

	$form = '<div id="Search-widget" class="wrapper">

		<h3 class="widget-title">Search For Posts</h3>

		<div class="widget-search">

			<form role="search" method="get" class="search-form" action="' . esc_url( home_url( '/' ) ) . '">

				<input type="search" class="search-field remove-spacing" placeholder="Search" value="' . get_search_query() . '" name="s" />
				<button type="submit" class="search-submit" value="' . esc_attr_x( '', 'submit-button' ) . '"><i class="icon-search"></i>

			</form>

		</div>

	</div>';
	
	return $form;

}

add_filter( 'get_search_form', 'searchform', 10 );

/* --- Custom Excerpt Length Filter --- */

function excerpt_length( $length ) {

	return 20;

}

add_filter( 'excerpt_length', 'excerpt_length', 999 );

/* --- Custom Read More Filter --- */

function excerpt_read_more( $more ) {

	return '...<div><a class="button" href="' . get_permalink( get_the_ID() ) . '">' . __('Read More', '') . '</a></div>';

}

add_filter( 'excerpt_more', 'excerpt_read_more' );



/* --- Custom Function : Get the time the post was published --- */

function get_the_time_posted( $type = 'post' ) {

	$time = 'comment' == $type ? 'get_comment_time' : 'get_post_time';
    return human_time_diff( $time( 'U' ), current_time( 'timestamp' ) ) . " " . __( 'ago' );

}

?>