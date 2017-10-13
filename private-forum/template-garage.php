<?php

/**
	* Theme Garage Template
	*
	* Template Name: Garage
	*
	* @package Private Forum
	* @author Sean Creagh
*/



?>

<?php get_header(); ?>

<div id="Garage-posts" class="wrapper">

	<div class="content container remove-spacing">

		<?php if ( is_user_logged_in() ) { ?>

		<div class="form-print-wrapper clearfix">

			<input type="submit" id="form-print" name="form-print" value="Register a Garage" />
			<span id="success-log"></span>

		</div>

		<div class="form-wrapper clearfix">

			<div class="form-wrapper clearfix">

				<form id="Garage-post" class="remove-spacing">

					<?php wp_nonce_field( basename( __FILE__ ), 'user-submitted-garage' ); ?>

					<div class="form-control-full">

						<div class="form-group clearfix">

							<span id="required">* Required</span>
							<span class="cancel"><i class="icon-times"></i></span>

						</div>

					</div>

					<div class="form-control-half remove-spacing">

						<div class="form-group">
						
							<input class="remove-spacing" type="text" id="garage_name_field" name="garage_name_field" placeholder="Name *" />
							<span class="error-message" id="garage_name_message"></span>

						</div>

					</div>

					<div class="form-control-half remove-spacing">

						<div class="form-group">

							<input class="remove-spacing" type="text" id="garage_owner_field" name="garage_owner_field" placeholder="Owner *" />
							<span class="error-message" id="garage_owner_message"></span>

						</div>

					</div>

					<div class="form-control-half remove-spacing">

						<div class="form-group">

							<input class="remove-spacing" type="email" id="garage_email_field" name="garage_email_field" placeholder="Email" />
							<span class="error-message" id="garage_email_message"></span>

						</div>

					</div>

					<div class="form-control-half remove-spacing">

						<div class="form-group">

							<input class="remove-spacing" type="tel" id="garage_number_field" name="garage_number_field" placeholder="Number *" />
							<span class="error-message" id="garage_number_message"></span>

						</div>

					</div>

					<div class="form-control-half remove-spacing">

						<div class="form-group">

							<input class="remove-spacing" type="text" id="garage_address_line_1_field" name="garage_address_line_1_field" placeholder="Address Line 1 *" />
							<span class="error-message" id="garage_address_line_1_message"></span>

						</div>

					</div>

					<div class="form-control-half remove-spacing">

						<div class="form-group">

							<input class="remove-spacing" type="text" id="garage_address_line_2_field" name="garage_address_line_2_field" placeholder="Address Line 2 *" />
							<span class="error-message" id="garage_address_line_2_message"></span>

						</div>

					</div>

					<div class="form-control-half remove-spacing">

						<div class="form-group">

							<input class="remove-spacing" type="text" id="garage_county_field" name="garage_county_field" placeholder="County *" />
							<span class="error-message" id="garage_county_message"></span>

						</div>

					</div>

					<div class="form-control-half remove-spacing">

						<div class="form-group">

							<input class="remove-spacing" type="text" id="garage_eircode_field" name="garage_eircode_field" placeholder="Eircode" />
							<span class="error-message" id="garage_eircode_message"></span>

						</div>

					</div>

					<div class="form-control-full remove-spacing">

						<div class="form-group">

							<input class="remove-spacing" type="text" id="garage_map_field" name="garage_map_field" placeholder="Map" />
							<span class="error-message" id="garage_map_message"></span>
							<span class="guide">If you're unsure how to add a map to your garage please follow the steps provided in this <a href="<?php echo THEME_URI . '/assets/guide.docx'; ?>">guide</a>.</span>

						</div>

					</div>

					<div class="form-control-full remove-spacing">

						<div class="form-group">

							<input type="text" id="o66" name="<?php echo apply_filters( 'honeypot_name', 'date-submitted' ); ?>" value="" style="display: none;" />
							<input type="submit" id="garage-submit" name="garage-submit" value="Submit" />

						</div>

					</div>

				</form>

			</div>

		</div>

		<?php }

		global $wp_query;
		$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;

		query_posts( array(

			'post_type' => 'garage',
			'posts_per_page' => 18,
			'paged' => $paged,
			'orderby' => 'title',
			'order' => 'ASC'

		) ); 

		if ( have_posts() ) : ?>

			<div id="Garage" class="post-container" <?php if ( ! is_user_logged_in() ) { echo 'style="margin: 0;"'; } ?>>

				<div class="post-repository">

					<?php while ( have_posts() ) : the_post(); ?>

					<div class="post-wrapper remove-spacing">

						<?php

						$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
						$default_thumbnail = THEME_URI . '/assets/garage-icon.jpg';

						if ( $thumbnail != '' ) { ?>

						<div class="post-thumbnail custom">

							<a href="<?php echo get_the_permalink(); ?>">

								<img src="<?php echo $thumbnail[0]; ?>" />

							</a>

						</div>

						<?php } else { ?>

						<div class="post-thumbnail default">

							<a href="<?php echo get_the_permalink(); ?>">

								<img src="<?php echo $default_thumbnail; ?>" />

							</a>

						</div>

						<?php }

						$name = get_post_meta( $post->ID, '_garage_name_key', true );
						$owner = get_post_meta( $post->ID, '_garage_owner_key', true );
						$email = get_post_meta( $post->ID, '_garage_email_key', true );
						$number = get_post_meta( $post->ID, '_garage_number_key', true );

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

						<div class="post-meta remove-spacing">

							<h2 class="post-title"><a href="<?php echo get_the_permalink(); ?>"><?php echo $name; ?></a></h2>
							<span class="post-owner">Owned by <?php echo $owner; ?></span>

							<?php if ( $email != null ) { ?>

								<span class="contact-details"><i class="icon-mobile"></i><a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a></span>

							<?php }

							if ( $number != null ) { ?>

								<span class="contact-details"><i class="icon-email"></i><a href="tel:<?php echo $clean_number; ?>"><?php echo $number; ?></a></span>

							<?php } ?>

						</div>

					</div>

					<?php endwhile; ?>

				</div>

				<?php if ( $wp_query->max_num_pages > 1 ) { ?>

				<div class="pagination-wrapper">

					<?php the_posts_pagination( array(

						'prev_text' => __( '<i class="icon-angle-left"></i>', 'private-forum' ),
						'next_text' => __( '<i class="icon-angle-right"></i>', 'private-forum' ),
						'before_page_number' => __( '', 'private-forum' )

					) ); ?>

				</div>

				<?php } ?>

			</div>

		<?php endif; ?>

	</div>

</div>

<?php get_footer(); ?>