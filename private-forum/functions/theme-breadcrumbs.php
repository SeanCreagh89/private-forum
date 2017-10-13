<?php

/**
    * Theme Breadcrumbs Output
    *
    * @package Private Forum
    * @author Sean Creagh
*/



function theme_breadcrumbs() {

	global $post, $wp_query;

	$home = '<li><a href="' . get_home_url() . '">' . get_the_title( get_option( 'page_on_front' ) ) . '</a></li>';
	$blog = '<li><a href="' . get_permalink( get_option( 'page_for_posts' ) ) . '">' . get_the_title( get_option( 'page_for_posts' ) ) . '</a></li>';
	$separator = '<li class="separator">-</li>';

	$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
	$default_thumbnail = THEME_URI . '/assets/parallax.jpg';
	$class; $style;

	if ( is_home( get_option( 'page_for_posts' ) ) || is_search() || is_author() ) {

		$style = 'style="background-image: url( ' . $default_thumbnail . ' );"';

	} else if ( $thumbnail != "" ) {

		$style = 'style="background-image: url( ' . $thumbnail[0] . ' );"';

	} else {

		$style = 'style="background-image: url( ' . $default_thumbnail . ' );"';

	}

	if ( !is_front_page() ) { ?>

	<div id="Breadcrumbs-bar" class="wrapper parallax" <?php echo '' . $style; ?>>

		<div class="container remove-spacing clearfix">

			<div id="Breadcrumbs">

				<ol class="clearfix">

					<?php

					echo $home;
					echo $separator;

					if ( is_page() ) {

						if ( $post->post_parent ) {

							$ancestor = get_post_ancestors( $post->ID );
							$ancestor = array_reverse( $ancestor );

							if ( !isset( $parents ) ) $parents = null;

							foreach ( $ancestor as $ancestors ) {

								$parents = '<li><a href="' . get_permalink( $ancestors ) . '">' . get_the_title( $ancestors ) . '</a></li>';

							}

							echo $parents;
							echo $separator;
							echo '<li><span>' . get_the_title() . '</span></li>';

						} else {

							echo '<li><span>' . get_the_title() . '</span></li>';

						}

					} elseif ( is_home( get_option( 'page_for_posts' ) ) ) {

                        echo '<li><span>' . get_the_title( get_option( 'page_for_posts' ) ) . '</span></li>';

                    } elseif ( is_single() ) {

						$post_type = get_post_type();

						if ( $post_type === "bad_debt" ) {

							$pages = get_pages( array( 'meta_key' => '_wp_page_template', 'meta_value' => 'template-report.php' ) );

							foreach( $pages as $page ) {

								echo '<li><a href="' . get_the_permalink( $page->ID ) . '">' . get_the_title( $page->ID ) . '</a></li>';

							}

							echo $separator;
							echo '<li><span>' . get_the_title() . '</span></li>';

						} elseif ( $post_type === "garage" ) {

							$pages = get_pages( array( 'meta_key' => '_wp_page_template', 'meta_value' => 'template-garage.php' ) );

							foreach( $pages as $page ) {

								echo '<li><a href="' . get_the_permalink( $page->ID ) . '">' . get_the_title( $page->ID ) . '</a></li>';

							}

							echo $separator;
							echo '<li><span>' . get_post_meta( get_the_ID(), '_garage_name_key', true ) . '</span></li>';

						} else {

							echo $blog;
							echo $separator;
							echo '<li><span>' . get_the_title() . '</span></li>';

						}

					} elseif ( is_author() ) {

						global $author;
						$userdata = get_userdata ( $author );

						echo '<li><span>Posts by ' . $userdata->display_name . '</span></li>';

					} elseif ( is_search() ) {

						$result_counter = $wp_query->found_posts;
						echo '<li><span>' . $result_counter . ' results found for: '. get_search_query() . '</span></li>';

					} elseif ( is_404() ) {

						echo '<li><span>404 Error</span></li>';

					} ?>

				</ol>

			</div>

			<?php

			if ( is_active_sidebar( 'header-widget-1' ) || is_active_sidebar( 'header-widget-2' ) || is_active_sidebar( 'header-widget-3' ) ) { ?>

			<div id="Breadcrumb-widgets">

				<?php if ( is_user_logged_in() ) {

					if ( is_active_sidebar( 'header-widget-1' ) ) { ?>

					<div class="widgets"><?php dynamic_sidebar( 'header-widget-1' ); ?></div>

					<?php }

					if ( is_active_sidebar( 'header-widget-2' ) ) { ?>

					<div class="widgets"><?php dynamic_sidebar( 'header-widget-2' ); ?></div>

					<?php }

				} else {

					if ( is_active_sidebar( 'header-widget-3' ) ) { ?>

					<div class="widgets"><?php dynamic_sidebar( 'header-widget-3' ); ?></div>

					<?php }

				} ?>
				
			</div>

			<?php } ?>

		</div>

	</div>

	<?php }

} ?>