<?php
function minimal_wp_setup() {
	load_theme_textdomain( 'minimal_wp', get_template_directory () . '/languages' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( "title-tag" );
	add_theme_support( "custom-header" );
	add_theme_support( "custom-background" );
	add_editor_style('style.css'); // add own stylesheet to WordPress Editor
	global $content_width;
	if (! isset ( $content_width ))
		$content_width = 640;
	register_nav_menus ( array (
			'main-menu' => __ ( 'Main Menu', 'minimal_wp' ) 
	) );
}
add_action ( 'after_setup_theme', 'minimal_wp_setup' );

function minimal_wp_enqueue_google_font() {
	$query_args = array(
			'family' => 'Lato:300,700,300italic,700italic'
	);
	wp_register_style( 'google-fonts', add_query_arg( $query_args, "//fonts.googleapis.com/css" ), array(), null );
	wp_enqueue_style( 'google-fonts' );
}
add_action( 'wp_enqueue_scripts', 'minimal_wp_enqueue_google_font' );

function minimal_wp_enqueue_comments_reply() {
	if( get_option( 'thread_comments' ) )  {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'comment_form_before', 'minimal_wp_enqueue_comments_reply' );

function minimal_wp_load_scripts() {
	wp_enqueue_script ( 'jquery' );
}
add_action( 'wp_enqueue_scripts', 'minimal_wp_load_scripts' );

function minimal_wp_title($title) {
	if ($title == '') {
		return '&rarr;';
	} else {
		return $title;
	}
}
add_filter( 'the_title', 'minimal_wp_title' );

function minimal_wp_filter_title($title) {
	return $title . esc_attr ( get_bloginfo ( 'name' ) );
}
add_filter ( 'wp_title', 'minimal_wp_filter_title' );

function minimal_wp_widgets_init() {
	register_sidebar( array(
			'name' 			=> __( 'Sidebar 1', 'minimal_wp' ),
			'id' 			=> 'sidebar1',
			'description'   => __( 'sidebar1', 'minimal_wp' ),
			'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
			'after_widget' 	=> "</li>",
			'before_title' 	=> '<h3 class="widget-title">',
			'after_title' 	=> '</h3>' 
	) );
	register_sidebar(array(
			'name' 			=> __( 'Sidebar 2', 'minimal_wp' ),
			'id' 			=> 'sidebar2',
			'description'   => __( 'sidebar2', 'minimal_wp' ),
			'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
			'after_widget' 	=> "</li>",
			'before_title' 	=> '<h3 class="widget-title">',
			'after_title' 	=> '</h3>' 
	));
}
add_action( 'widgets_init', 'minimal_wp_widgets_init' );

function minimal_wp_custom_pings($comment) {
	$GLOBALS ['comment'] = $comment;
	?>
<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>"><?php echo comment_author_link(); ?></li>
<?php
}

function minimal_wp_comments_number($count) {
	if (! is_admin ()) {
		global $id;
		$comments_by_type = &separate_comments ( get_comments ( 'status=approve&post_id=' . $id ) );
		return count ( $comments_by_type ['comment'] );
	} else {
		return $count;
	}
}
add_filter ( 'get_comments_number', 'minimal_wp_comments_number' );
 