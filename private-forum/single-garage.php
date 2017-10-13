<?php

/**
	* Theme Single Garage Template
	*
	* @package Private Forum
	* @author Sean Creagh
*/



?>

<?php get_header(); ?>

<div id="Single-garage" class="single wrapper">

	<div class="content container remove-spacing clearfix">

		<?php

		if ( have_posts() ) :

			while ( have_posts() ) : the_post();

				$name = get_post_meta( $post->ID, '_garage_name_key', true );
				$owner = get_post_meta( $post->ID, '_garage_owner_key', true );
				$email = get_post_meta( $post->ID, '_garage_email_key', true );
				$number = get_post_meta( $post->ID, '_garage_number_key', true );
				$add1 = get_post_meta( $post->ID, '_garage_address_line_1_key', true );
				$add2 = get_post_meta( $post->ID, '_garage_address_line_2_key', true );
				$county = get_post_meta( $post->ID, '_garage_county_key', true );
				$eircode = get_post_meta( $post->ID, '_garage_eircode_key', true );
				$map = get_post_meta( $post->ID, '_garage_map_key', true );

				/* --- remove white spaces and hypens --- */

				$raw_number = $number;
				$patterns = array ( '/\s+/', '/-+/' );
				$replacement = ( '' );
				$clean_number = preg_replace( $patterns, $replacement, $raw_number);

				/* --- remove international call code --- */

				$raw_number = $clean_number;
				$patterns = array ( '(+353)', '+353' );
				$replacement = ( '0' );
				$clean_number = str_replace( $patterns, '0', $raw_number );

				?>

				<div class="post-title">

					<h2><?php echo get_the_title(); ?></h2>

				</div>

				<div class="post-wrapper">

					<?php

					$class = "";

					if ( $map == "" ) {

						$class = "no-map";

					} ?>

					<div class="garage-details <?php echo $class; ?> remove-spacing clearfix">

						<?php

						$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
						$default_thumbnail = THEME_URI . '/assets/garage-icon.jpg';

						if ( $thumbnail != '' ) { ?>

						<div class="post-thumbnail remove-spacing ">

							<img src="<?php echo $thumbnail[0]; ?>" />

						</div>

						<?php } else { ?>

						<div class="post-thumbnail remove-spacing ">

							<img src="<?php echo $default_thumbnail; ?>" />

						</div>

						<?php } ?>

						<ul class="garage-name remove-spacing">

							<li><strong>Name:</strong> <?php echo $name; ?>.</li>
							<li><strong>Owner:</strong> <?php echo $owner; ?>.</li>

						</ul>

						<ul class="garage-address remove-spacing">

							<li><strong>Address:</strong></li>
							<li><?php echo $add1; ?>,</li>
							<li><?php echo $add2; ?>,</li>
							<li><?php echo $county; ?>.</li>

							<?php if ( $eircode != "" ) { ?>

								<li><?php echo $eircode; ?>.</li>

							<?php } ?>

						</ul>

						<ul class="garage-contact remove-spacing">

							<li><strong>Contact Details:</strong></li>

							<?php if ( $email != "" ) { ?>

								<li><i class="icon-email"></i><a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a></li>

							<?php } ?>

							<li><i class="icon-mobile"></i><a href="tel:<?php echo $clean_number; ?>"><?php echo $number; ?></a></li>
						</ul>

					</div>

					

					<?php if ( $map != "" ) { ?>

						<div class="post-map remove-spacing">

							<iframe src="<?php echo $map; ?>" class="remove-spacing" frameborder="0" allowfullscreen></iframe>

						</div>

					<?php } ?>

					</div>

				</div>

			<?php endwhile;

		endif;

		?>

	</div>

</div>

<?php get_footer(); ?>