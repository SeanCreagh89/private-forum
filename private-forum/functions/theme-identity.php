<?php

/**
	* Theme Indentity Output
	*
	* @package Private Forum
	* @author Sean Creagh
*/



function theme_identity() {

	if ( function_exists( 'the_custom_logo' ) ) {

		$logo = get_custom_logo();
		$title = get_bloginfo( 'name', 'raw' ); ?>

		<div id="Site-identity">

		<?php if ( !empty( $logo ) ) {

			echo $logo;

		} elseif ( $title !== null ) {

			echo '<h2 id="Site-title"><a href="' . get_home_url() . '">' . $title . '</a></h2>';

		} ?>

		</div>

	<?php }

}

?>