<?php

/**
	* Theme Report Template
	*
	* Template Name: Report
	*
	* @package Private Forum
	* @author Sean Creagh
*/



?>

<?php if ( is_user_logged_in() ) {

	get_header(); ?>

	<div id="Report-posts" class="wrapper">

		<div class="content container remove-spacing">

			<div class="form-print-wrapper clearfix">

				<input type="submit" id="form-print" name="form-print" value="Report a Bad Debt" />
				<span id="success-log"></span>

			</div>

			<div class="form-wrapper clearfix">

				<form id="Report-post" class="remove-spacing">

					<?php wp_nonce_field( basename( __FILE__ ), 'user-submitted-report' ); ?>

					<div class="form-control-full">

						<div class="form-group clearfix">

							<span id="required">* Required</span>
							<span class="cancel"><i class="icon-times"></i></span>

						</div>

					</div>

					<div class="form-control-full remove-spacing">

						<div class="form-group">

							<input class="remove-spacing" type="text" id="owner_field" name="owner_field" placeholder="Owner *" />
							<span class="error-message" id="owner_message"></span>

						</div>

					</div>

					<div class="form-control-half remove-spacing">

						<div class="form-group">

							<input class="remove-spacing" type="text" id="make_field" name="make_field" placeholder="Make *" />
							<span class="error-message" id="make_message"></span>

						</div>

					</div>

					<div class="form-control-half remove-spacing">

						<div class="form-group">

							<input class="remove-spacing" type="text" id="model_field" name="model_field" placeholder="Model *" />
							<span class="error-message" id="model_message"></span>

						</div>

					</div>

					<div class="form-control-half remove-spacing">

						<div class="form-group">

							<input class="remove-spacing" type="text" id="registration_field" name="registration_field" placeholder="Registration *" />
							<span class="error-message" id="registration_message"></span>

						</div>

					</div>

					<div class="form-control-half remove-spacing">

						<div class="form-group">

							<input class="remove-spacing" type="text" id="colour_field" name="colour_field" placeholder="Colour *" />
							<span class="error-message" id="colour_message"></span>

						</div>

					</div>

					<div class="form-control-full remove-spacing">

						<div class="form-group">

							<textarea class="remove-spacing" type="text" id="description_field" name="description_field" placeholder="Description *"></textarea>
							<span class="error-message" id="description_message"></span>

						</div>

					</div>

					<div class="form-control-full remove-spacing">

						<div class="form-group">

							<input class="remove-spacing" type="text" id="o66" name="<?php echo apply_filters( 'honeypot_name', 'date-submitted' ); ?>" value="" style="display: none;" />
							<input type="submit" id="report-submit" name="report-submit" value="Submit" />

						</div>

					</div>

				</form>

			</div>

			<?php

			global $wp_query;
			$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;

			query_posts( array(

				'post_type' => 'bad_debt',
				'posts_per_page' => 30,
				'paged' => $paged,
				'orderby' => 'date',
				'order' => 'DESC'

			) );

			if ( have_posts() ) : ?>

				<div id="Report" class="post-container">

					<?php while ( have_posts() ) : the_post(); ?>

					<div class="post-wrapper remove-spacing clearfix">

						<div class="post-title">

							<h2><a href="<?php echo get_the_permalink(); ?>"><?php echo get_the_title(); ?></a></h2>
							<span><?php echo 'Author: ' . get_the_author_posts_link() . '. Posted on: ' . get_the_date() . ' at ' . get_the_time(); ?>.</span>

						</div>

						<div class="post-meta">

							<span><?php echo 'Posted: ' . get_the_time_posted(); ?></span>
							<span><?php echo get_comments_number() . ' replies'; ?></span>
							
						</div>

					</div>

					<?php endwhile; ?>

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

	<?php get_footer();

} else {

	wp_redirect( home_url() );
	exit;

} ?>