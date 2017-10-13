<?php

/**
	* Theme Comments Template
	*
	* @package Private Forum
	* @author Sean Creagh
*/



if ( post_password_required() ) {

	return;

}

?>

<div id="Comments">

	<div class="container remove-spacing">

		<?php

		if ( have_comments() ) : ?>

		<h3>

			<?php

			$counter = get_comments_number();

			if ( $counter > 0 ) {

				echo $counter . ' replies to ' . get_the_title();

			} elseif ( $counter === 1 ) {

				echo 'One reply to ' . get_the_title();

			} else {

				echo 'Leave a Reply.';

			}

			?>

		</h3>

		<ol class="comment-list">

			<?php

			wp_list_comments( array(

				'type' => 'comment',
				'max_depth' => 2,
				'style' => 'ol',
				'per_page' => 5,
				'short_ping' => true,
				'reply_text' => __( '<i class="icon-reply"></i> reply', 'private-forum' )

			) );

			?>

		</ol>

		<?php

		echo '<div class="pagination-wrapper">';

		the_comments_pagination( array(

			'prev_text' => __( '<i class="icon-angle-left"></i>', 'private-forum' ),
			'next_text' => __( '<i class="icon-angle-right"></i>', 'private-forum' ),
			'before_page_number' => __( '', 'private-forum' )

		) );

		echo '</div>';

		endif;

		if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>

		<p><?php echo 'Comments are closed.'; ?></p>

		<?php

		endif;

		comment_form();

		?>

	</div>

</div>