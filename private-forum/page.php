<?php

/**
	* Theme Page Template
	*
	* @package Private Forum
	* @author Sean Creagh
*/



get_header();

if ( !is_front_page() ) {

	echo '<div class="wrapper"><div class="content container remove-spacing clearfix">';

}

if ( have_posts() ) :

	while ( have_posts() ) : the_post();

		$content = get_the_content();

		if ( $content ) {

			the_content();

		} else {

			if ( is_front_page() ) {

				echo '<div class="wrapper"><div class="content container remove-spacing clearfix">';
				echo '<strong>' . get_the_title() . '</strong> currently has no content.';
				echo '</div></div>';


			} else {

				echo '<strong>' . get_the_title() . '</strong> currently has no content.';

			}

		}

	endwhile;

endif;

if ( !is_front_page() ) {

	echo '</div></div>';

}

get_footer();

?>