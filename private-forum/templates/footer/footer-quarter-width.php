<?php

/**
	* Theme Footer 1/4 Width Widget Template
	*
	* @package Private Forum
	* @author Sean Creagh
*/



?>

<div class="quarter-width">

	<div class="widget remove-spacing">

		<?php 

		if ( is_active_sidebar( 'footer-widget-1' ) ) {

			dynamic_sidebar( 'footer-widget-1' );

		}

		?>

	</div>

</div>

<div class="quarter-width">

	<div class="widget remove-spacing">

		<?php 

		if ( is_active_sidebar( 'footer-widget-2' ) ) {

			dynamic_sidebar( 'footer-widget-2' );

		}

		?>

	</div>

</div>

<div class="quarter-width">

	<div class="widget remove-spacing">

		<?php 

		if ( is_active_sidebar( 'footer-widget-3' ) ) {

			dynamic_sidebar( 'footer-widget-3' );

		}

		?>

	</div>

</div>

<div class="quarter-width">

	<div class="widget remove-spacing">

		<?php 

		if ( is_active_sidebar( 'footer-widget-4' ) ) {

			dynamic_sidebar( 'footer-widget-4' );

		}

		?>

	</div>

</div>