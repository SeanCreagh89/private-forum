<?php

/**
	* Theme Author Template
	*
	* @package Private Forum
	* @author Sean Creagh
*/



?>

<?php if ( is_user_logged_in() ) {

	get_header(); ?>

	<div id="Results" class="wrapper">

		<div class="content container remove-spacing">

			<?php

			global $wp_query;
			$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
			$author = ( isset( $_GET[ 'author_name' ] ) ) ? get_user_by( 'slug', $author_name ) : get_userdata( intval( $author ) );

			query_posts( array(

				'author' => $author->ID,
				'post_type' => array( 'post', 'bad_debt', 'garage' ),
				'posts_per_page' => 30,
				'paged' => $paged,
				'orderby' => 'title',
				'order' => 'ASC'

			) );

			if ( have_posts() ) :

				while ( have_posts() ) : the_post(); ?>

				<div class="post-wrapper remove-spacing clearfix">

					<?php

					$post_type;
					$post_type_url;

					if ( get_post_type() == 'bad_debt' ) {

						$report_page = get_pages( array( 'meta_key' => '_wp_page_template', 'meta_value' => 'template-report.php' ) );

						if ( ! empty( $report_page ) && 0 < count( $report_page) ) :

							$post_type_url = get_permalink( $report_page[0]->ID );

						endif;

						$post_type = 'Post type: <a href="' . $post_type_url . '">Report</a>';

					} else if ( get_post_type() == 'garage' ) {

						$garage_page = get_pages( array( 'meta_key' => '_wp_page_template', 'meta_value' => 'template-garage.php' ) );

						if ( ! empty( $garage_page ) && 0 < count( $garage_page ) ) :

							$post_type_url = get_permalink( $garage_page[0]->ID );

						endif;
						
						$post_type = 'Post type: <a href="' . $post_type_url . '">Garage</a>';

					} else {

						$post_type = 'Post type: <a href="' . get_permalink( get_option( 'page_for_posts' ) ) . '">Post</a>';

					}

					?>

					<div class="post-meta">

						<h2><a href="<?php echo get_the_permalink(); ?>"><?php echo get_the_title(); ?></a></h2>
						<span><?php echo 'Author: ' . get_the_author_posts_link() . '. Posted on: ' . get_the_date() . ' at ' . get_the_time(); ?>. <?php echo $post_type; ?>.</span>

					</div>

					<div class="read-more">

						<a href="<?php echo get_the_permalink(); ?>" class="read-more">Read More</a>

					</div>

				</div>

				<?php endwhile;

				if ( $wp_query->max_num_pages > 1 ) { ?>

				<div class="pagination-wrapper">

					<?php the_posts_pagination( array(

						'prev_text' => __( '<i class="icon-angle-left"></i>', 'private-forum' ),
						'next_text' => __( '<i class="icon-angle-right"></i>', 'private-forum' ),
						'before_page_number' => __( '', 'private-forum' )

					) ); ?>

				</div>

				<?php } ?>

			<?php else : echo '<strong>ERROR:</strong>: This author has not posted anything yet.';

			endif;

			?>

		</div>

	</div>

	<?php get_footer();

} else {

	wp_redirect( home_url() );
	exit;

} ?>