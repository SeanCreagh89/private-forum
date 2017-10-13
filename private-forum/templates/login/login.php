<?php

/**
	* Theme Login Template
	*
	* @package Private Forum
	* @author Sean Creagh
*/



?>

<?php 

$login  = (isset($_GET['login']) ) ? $_GET['login'] : 0;
$style;

if ( $login != '' && $login != 'false' ) {

	$style = 'style="display: block"';

}

?>

<div id="Login-form" class="wrapper" <?php echo $style; ?>>

	<div class="container remove-spacing">

		<span class="cancel"><i class="icon-times"></i></span>

		<?php

		$args = array(

			'redirect' => home_url(),
			'id_username' => 'user',
			'id_password' => 'pass',

		);

		wp_login_form( $args );

		if ( $login === "failed" ) {

			echo '<p class="login-error"><strong>ERROR:</strong> Invalid entry. Please check your credentials.</p>';

		} else if ( $login === "empty" ) {

			echo '<p class="login-error"><strong>ERROR:</strong> Invalid entry. Please make sure to fill both fields.</p>';

		} else if ( $login === "false" ) {

			echo '<p class="login-error"><strong>ERROR:</strong> You are logged out.</p>';

		}

		?>

	</div>

</div>