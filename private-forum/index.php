<?php

/**
	* Theme Index Template
	*
	* @package Private Forum
	* @author Sean Creagh
*/



?>

<?php if ( is_user_logged_in() ) {

	get_header(); ?>

	<div id="Blog-posts" class="wrapper">

		<div class="content container remove-spacing clearfix">

			<?php

			global $wp_query;
			$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;

			query_posts( array(

				'post_type' => 'post',
				'posts_per_page' => 9,
				'paged' => $paged,
				'orderby' => 'date',
				'order' => 'DESC'

			) ); 

			if ( have_posts() ) : ?>

				<div class="post-repository">

					<?php while ( have_posts() ) : the_post(); ?>

					<div class="post-wrapper remove-spacing">

						<?php

						$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
						$default_thumbnail = THEME_URI . '/assets/placeholder.jpg';

						if ( $thumbnail != '' ) { ?>

						<div class="post-thumbnail custom">

							<a href="<?php echo get_the_permalink(); ?>">

								<img src="<?php echo $thumbnail[0]; ?>" />

								<h3><?php echo get_the_title(); ?></h3>

							</a>

						</div>

						<?php } else { ?>

						<div class="post-thumbnail default">

							<a href="<?php echo get_the_permalink(); ?>">

								<img src="<?php echo $default_thumbnail; ?>" />

								<h3><?php echo get_the_title(); ?></h3>

							</a>

						</div>

						<?php } ?>

						<div class="post-excerpt remove-spacing clearfix">

							<?php echo get_the_excerpt(); ?>

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

			<?php endif; ?>

		</div>

	</div>

	<?php get_footer();

} else {

	wp_redirect( home_url() );
	exit;

} ?>