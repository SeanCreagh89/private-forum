<?php

/**
	* Theme Footer Full Width Widget Template
	*
	* @package Private Forum
	* @author Sean Creagh
*/



?>

<div class="full-width">

	<div class="widget remove-spacing">

		<?php if ( is_active_sidebar( 'footer-widget-1' ) ) {

			dynamic_sidebar( 'footer-widget-1' );

		} elseif ( is_active_sidebar( 'footer-widget-2' ) ) {

			dynamic_sidebar( 'footer-widget-2' );

		} elseif ( is_active_sidebar( 'footer-widget-3' ) ) {

			dynamic_sidebar( 'footer-widget-3' );

		} elseif ( is_active_sidebar( 'footer-widget-4' ) ) {

			dynamic_sidebar( 'footer-widget-4' );

		} ?>

	</div>

</div>