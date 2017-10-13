<?php

/**
	* Theme Single Bad Debt Template
	*
	* @package Private Forum
	* @author Sean Creagh
*/



?>

<?php if ( is_user_logged_in() ) {

	get_header(); ?>

	<div id="Single-bad-debt" class="single wrapper">

		<div class="content container remove-spacing">

			<?php

			if ( have_posts() ) :

				while ( have_posts() ) : the_post(); ?>

					<div class="post-title">

						<h2><?php echo get_the_title(); ?></h2>

					</div>

					<div class="post-meta">

						<ul>

							<li><strong>Author:</strong> <?php echo get_the_author_posts_link(); ?>.</li>
							<li><strong>Posted on:</strong> <?php echo get_the_date(); ?></li>
							<li>at <?php echo get_the_time(); ?>.</li>

						</ul>

					</div>

					<div class="post-wrapper clearfix">

						<div class="report-details vehicle remove-spacing">

							<ul>

								<li><strong>Owner:</strong> <?php echo get_post_meta( $post->ID, '_owner_key', true ); ?></li>
								<li><strong>Make:</strong> <?php echo get_post_meta( $post->ID, '_make_key', true ); ?></li>
								<li><strong>Model:</strong> <?php echo get_post_meta( $post->ID, '_model_key', true ); ?></li>
								<li><strong>Registration:</strong> <?php echo get_post_meta( $post->ID, '_registration_key', true ); ?></li>
								<li><strong>Colour:</strong> <?php echo get_post_meta( $post->ID, '_colour_key', true ); ?></li>

							</ul>

						</div>

						<div class="report-details work remove-spacing">

							<p><?php the_content(); ?></p>

						</div>

					</div>

				<?php endwhile;

			endif;

			comments_template( '', true );

			?>

		</div>

	</div>

	<?php get_footer();

} else {

	wp_redirect( home_url() );
	exit;

} ?>