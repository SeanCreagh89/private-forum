<?php

/**
	* Theme Single Template
	*
	* @package Private Forum
	* @author Sean Creagh
*/



?>

<?php if ( is_user_logged_in() ) {

	get_header(); ?>

	<div id="Single-blog" class="single wrapper">

		<div class="content container remove-spacing">

			<?php

			if ( have_posts() ) :

				while ( have_posts() ) : the_post(); ?>

				<h2 class="post-title"><?php echo get_the_title(); ?></h2>

				<div class="post-meta">

					<ul>

						<li><strong>Author:</strong> <?php echo get_the_author_posts_link(); ?>.</li>
						<li><strong>Posted on:</strong> <?php echo get_the_date(); ?></li>
						<li>at <?php echo get_the_time(); ?>.</li>

					</ul>

				</div>

				<?php

				$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );

				if ( $thumbnail != '' ) { ?>

				<div class="post-thumbnail">

					<a href="<?php echo get_the_permalink(); ?>">

						<img src="<?php echo $thumbnail[0]; ?>" />

					</a>

				</div>

				<?php } ?>

				<div class="post-content">

					<?php echo get_the_content(); ?>

				</div>

				<?php endwhile;

			endif;

			comments_template( '', true ); ?>

		</div>

	</div>

	<?php get_footer();

} else {

	wp_redirect( home_url() );
	exit;

} ?>