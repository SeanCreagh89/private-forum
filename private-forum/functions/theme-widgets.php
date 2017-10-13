<?php

/**
	* Theme Widgets and Sidebars
	*
	* @package Private Forum
	* @author Sean Creagh
*/



function theme_widgets() {

	/* --- Header Widgets --- */

	for ($i = 1; $i <= 2; $i++) {

		register_sidebar( array(

			'name' => __( 'Header', 'theme-widgets' ) . ' | #' . $i,
			'id' => 'header-widget-' . $i,
			'description' => __( 'Appears beside the sites breadcrumbs. Hidden to general public', 'private-forum' ),
			'before_title' => '<h1>',
			'after_title' => '</h1>'

		) );

	}

	register_sidebar( array(

		'name' => __( 'Header', 'theme-widgets' ) . ' | #3',
		'id' => 'header-widget-3',
		'description' => __( 'Appears beside the sites breadcrumbs.', 'private-forum' ),
		'before_title' => '<h1>',
		'after_title' => '</h1>'

	) );



	/* --- Footer Widgets  --- */
	
	for ($i = 1; $i <= 4; $i++) {

		register_sidebar( array(

			'name' => __( 'Footer', 'theme-widgets' ) . ' | #' . $i,
			'id' => 'footer-widget-' . $i,
			'description' => __( 'Appears in the footer section of the site.', 'private-forum' ),
			'before_title' => '<h1>',
			'after_title' => '</h1>'

		) );

	}

	register_sidebar( array(

		'name' => __( 'Footer | Footnote', 'theme-widgets' ),
		'id' => 'footer-widget-fn',
		'description' => __( 'Appears in the footnote section of the site', 'private-forum' ),
		'before_title' => '<h1>',
		'after_title' => '</h1>'

	) );

}

add_action( 'widgets_init', 'theme_widgets' );



/* --- Custom Recent Reports Widget --- */

class Recent_Reports extends WP_Widget {

	public function __construct() {

		$widget_options = array(

			'classname' => 'recent-reports-widget',
			'description' => 'Displays most recent reports.'

		);

		parent::__construct( 'recent-reports', 'Recent Reports', $widget_options );

	}

	/* --- front-end display of widget --- */

	public function widget( $args, $instance ) {

		echo $args[ 'before_widget' ]; ?>

		<div id="Recent-reports-widget" class="wrapper">

			<?php if ( $instance[ 'title' ] != "" ) {

				echo '<h3 class="widget-title">' . $instance[ 'title' ] . '</h3>';

			}

			if ( have_posts() ) :

				query_posts( array(

					'post_type' => 'bad_debt',
					'posts_per_page' => $instance[ 'report_count' ],
					'orderby' => 'date',
					'order' => 'DESC'

				) );

				while ( have_posts() ) : the_post(); ?>

				<div class="reports-widget-wrapper clearfix">

					<span><a href="<?php echo get_the_permalink(); ?>"><?php echo get_the_title(); ?></a></span>
					<span><?php echo 'by ' . get_the_author_posts_link(); ?></span>
					<span><?php echo 'on ' . get_the_date();?></span>
					<span><?php echo 'at ' . get_the_time(); ?></span>

				</div>

				<?php endwhile;

			endif;

			?>

		</div>

		<?php echo $args[ 'after_widget' ];

	}

	/* --- back-end display of widget --- */

	public function form( $instance ) {

		$title = '';
		$report_count = 1;

		if ( isset( $instance[ 'title' ] ) ) {

			$title = $instance[ 'title' ];

		}

		if ( isset( $instance[ 'report_count' ] ) ) {

			$report_count = $instance[ 'report_count' ];

		}

		echo '<style> label { margin: 10px 0; display: block; } input { width: 100%; margin-bottom: 10px; display: block; } </style>';

		echo '<label for"' . $this->get_field_id( 'title' ) . '">Title: </label>';
		echo '<input type="text" value="' . $title . '" name="' . $this->get_field_name( 'title' ) . '" id="' . $this->get_field_id( 'title' ) . '" />';

		echo '<label for="' . $this->get_field_id( 'report_count' ) . '">How manys posts to display: </label>';
		echo '<input type="number" value="' . $report_count . '" name="' . $this->get_field_name( 'report_count' ) . '" id="' . $this->get_field_id( 'report_count' ) . '" min="1" max="5" / >';

	}

	public function update( $new_instance, $old_instance ) {

		$instance = array();
		$instance[ 'title' ] = $new_instance[ 'title' ];
		$instance[ 'report_count' ] = $new_instance[ 'report_count' ];
		return $instance;
	
	}

}

function recent_reports_widget() {

	register_widget( 'Recent_Reports' );

}

add_action( 'widgets_init', 'recent_reports_widget' );



/* --- Custom Button Widget --- */

class Button_Widget extends WP_Widget {

	public function __construct() {

		$widget_options = array(

			'classname' => 'button-widget',
			'description' => 'Displays a custom button.'

		);

		parent::__construct( 'button-widget', 'Button', $widget_options );

	}

	/* --- front-end display of widget --- */

	public function widget( $args, $instance ) {

		echo $args[ 'before_widget' ];

		if ( $instance[ 'button_url' ] != "" || $instance[ 'button_text' ] != "" ) { ?>

		<div id="Button-widget" class="wrapper">

			<?php

			$style = "";

			if ( $instance[ 'title' ] != "" ) {

				echo '<h3 class="widget-title">' . $instance[ 'title' ] . '</h3>';

			} else {

				$style = 'style="margin-top: 10px;"';

			} ?>

			<div class="button-wrapper" <?php echo $style; ?>>

				<a class="button-widget" href="<?php echo $instance[ 'button_url' ]; ?>"><?php echo $instance[ 'button_text' ]; ?></a>

			</div>

		</div>

		<?php } else {

			echo '<p style="margin-top: 10px;">Please fill out all widget settings</p>';

		}

		echo $args[ 'after_widget' ];

	}

	/* --- back-end display of widget --- */

	public function form( $instance ) {

		$title = '';
		$button_text = '';
		$button_url = '';

		if ( isset( $instance[ 'title' ] ) ) {

			$title = $instance[ 'title' ];

		}

		if ( isset( $instance[ 'button_text' ] ) ) {

			$button_text = $instance[ 'button_text' ];

		}

		if ( isset( $instance[ 'button_url' ] ) ) {

			$button_url = $instance[ 'button_url' ];

		}

		echo '<style> label { margin: 10px 0; display: block; } input { width: 100%; margin-bottom: 10px; display: block; } </style>';

		echo '<label for"' . $this->get_field_id( 'title' ) . '">Title: </label>';
		echo '<input type="text" value="' . $title . '" name="' . $this->get_field_name( 'title' ) . '" id="' . $this->get_field_id( 'title' ) . '" />';

		echo '<label for"' . $this->get_field_id( 'button_text' ) . '">Button Text: </label>';
		echo '<input type="text" value="' . $button_text . '" name="' . $this->get_field_name( 'button_text' ) . '" id="' . $this->get_field_id( 'button_text' ) . '" />';

		echo '<label for"' . $this->get_field_id( 'button_url' ) . '">Button URL: </label>';
		echo '<input type="url" value="' . $button_url . '" name="' . $this->get_field_name( 'button_url' ) . '" id="' . $this->get_field_id( 'button_url' ) . '" />';

	}

	public function update( $new_instance, $old_instance ) {

		$instance = array();
		$instance[ 'title' ] = $new_instance[ 'title' ];
		$instance[ 'button_text' ] = $new_instance[ 'button_text' ];
		$instance[ 'button_url' ] = $new_instance[ 'button_url' ];
		return $instance;
	
	}

}

function button_widget() {

	register_widget( 'Button_Widget' );

}

add_action( 'widgets_init', 'button_widget' );

?>