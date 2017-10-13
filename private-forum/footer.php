<?php

/**
	* Theme Footer
	*
	* @package Private Forum
	* @author Sean Creagh
*/



?>

	</div>

	<footer>

		<?php if ( is_user_logged_in() ) {

			if ( is_active_sidebar( 'footer-widget-1' ) || is_active_sidebar( 'footer-widget-2' )
				|| is_active_sidebar( 'footer-widget-3' ) || is_active_sidebar( 'footer-widget-4' ) ) { ?>

			<div id="Footer-widgets-bar" class="wrapper">

				<div class="container remove-spacing clearfix">

					<?php $i = 0;

					if ( is_active_sidebar( 'footer-widget-1' ) ) { ++$i; }
					if ( is_active_sidebar( 'footer-widget-2' ) ) { ++$i; }
					if ( is_active_sidebar( 'footer-widget-3' ) ) { ++$i; }
					if ( is_active_sidebar( 'footer-widget-4' ) ) { ++$i; }

					if ( $i == 1 ) {

						get_template_part( 'templates/footer/footer-full-width' );

					} elseif ( $i == 2 ) {

						get_template_part( 'templates/footer/footer-half-width' );

					} elseif ( $i == 3 ) {

						get_template_part( 'templates/footer/footer-third-width' );

					} else if ( $i == 4 ) {

						get_template_part( 'templates/footer/footer-quarter-width' );

					} ?>

				</div>

				<div id="Footer-divider"></div>

			</div>

			<?php }

		} ?>

		<div id="Footnote-bar" class="wrapper">

			<div class="container remove-spacing">

				<?php if ( is_active_sidebar( 'footer-widget-fn' ) ) {

					dynamic_sidebar( 'footer-widget-fn' );

				} else {

					$title = get_bloginfo( 'name', 'raw' );
					echo '<p>&copy;' . date( 'Y' ) . ' ' . $title . '. All Rights Reserved. Developed by Sean Creagh.</p>';

				} ?>

			</div>

		</div>

	</footer>

<?php wp_footer(); ?>

</body>

</html>