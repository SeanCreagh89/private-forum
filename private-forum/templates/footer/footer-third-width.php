<?php

/**
	* Theme Footer 1/3 Width Widget Template
	*
	* @package Private Forum
	* @author Sean Creagh
*/



?>

<?php

if ( is_active_sidebar( 'footer-widget-1' )) { ?>

<div class="third-width">

	<div class="widget remove-spacing">

		<?php dynamic_sidebar( 'footer-widget-1' ); ?>

	</div>

</div>

<?php }

if ( is_active_sidebar( 'footer-widget-2' )) { ?>

<div class="third-width">

	<div class="widget remove-spacing">

		<?php dynamic_sidebar( 'footer-widget-2' ); ?>

	</div>

</div>
	
<?php }

if ( is_active_sidebar( 'footer-widget-3' )) { ?>

<div class="third-width">

	<div class="widget remove-spacing">

		<?php dynamic_sidebar( 'footer-widget-3' ); ?>

	</div>

</div>
	
<?php }

if ( is_active_sidebar( 'footer-widget-4' )) { ?>

<div class="third-width">

	<div class="widget remove-spacing">

		<?php dynamic_sidebar( 'footer-widget-4' ); ?>

	</div>

</div>
	
<?php } ?>