<?php

/**
	* Theme Header
	*
	* @package Private Forum
	* @author Sean Creagh
*/



?>

<!DOCTYPE html>

<html>

<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<?php wp_head(); ?>
</head>

<body>

	<header>

	<?php

	if ( !is_user_logged_in() ) {

		get_template_part( 'templates/login/login' );

	}

	?>

		<div id="Top-bar" class="wrapper">

			<div class="container remove-spacing clearfix">

				<div id="Site-identity">

					<?php theme_identity(); ?>

				</div>

				<div id="Navigation-bar">

					<div id="Navigation">

						<?php

						if ( is_user_logged_in() ) {

							wp_nav_menu( array( 'theme_location' => 'primary' ) );

						} else {

							wp_nav_menu( array( 'theme_location' => 'secondary' ) );

						}

						?>

					</div>

					<div id="Navimobile">

						<div id="Navicon">

							<?php for ($i = 0; $i < 3; $i++) echo '<span class="navicon-bar"></span>'; ?>

						</div>

						<div id="Navimenu">

							<span class="menu-cancel"><i class="icon-times"></i></span>

							<?php

							if ( is_user_logged_in() ) {

								wp_nav_menu( array( 'theme_location' => 'primary' ) );

							} else {

								wp_nav_menu( array( 'theme_location' => 'secondary' ) );

							}

							?>

						</div>

					</div>

				</div>

			</div>

		</div>

		<?php theme_breadcrumbs(); ?>

	</header>

	<div id="Content">