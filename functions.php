<?php
add_action ( 'after_setup_theme', 'minimal_wp_setup' );
function minimal_wp_setup() {
	load_theme_textdomain( 'minimal_wp', get_template_directory () . '/languages' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( "title-tag" );
	add_theme_support( "custom-header" );
	add_theme_support( "custom-background" );
	add_theme_support( 'post-thumbnails' );
	add_editor_style('style.css'); // add own stylesheet to WordPress Editor
	global $content_width;
	if (! isset ( $content_width ))
		$content_width = 640;
	register_nav_menus ( array (
			'main-menu' => __ ( 'Main Menu', 'minimal_wp' ) 
	) );
}

add_action ( 'wp_enqueue_scripts', 'minimal_wp_load_scripts' );
function minimal_wp_load_scripts() {
	wp_enqueue_script ( 'jquery' );
}

add_action ( 'comment_form_before', 'minimal_wp_enqueue_comment_reply_script' );
function minimal_wp_enqueue_comment_reply_script() {
	if (get_option ( 'thread_comments' )) {
		wp_enqueue_script ( 'comment-reply' );
	}
}

add_filter ( 'the_title', 'minimal_wp_title' );
function minimal_wp_title($title) {
	if ($title == '') {
		return '&rarr;';
	} else {
		return $title;
	}
}

add_filter ( 'wp_title', 'minimal_wp_filter_wp_title' );
function minimal_wp_filter_wp_title($title) {
	return $title . esc_attr ( get_bloginfo ( 'name' ) );
}

function minimal_wp_custom_pings($comment) {
	$GLOBALS ['comment'] = $comment;
	?>
<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>"><?php echo comment_author_link(); ?></li>
<?php
}
add_filter ( 'get_comments_number', 'minimal_wp_comments_number' );
function minimal_wp_comments_number($count) {
	if (! is_admin ()) {
		global $id;
		$comments_by_type = &separate_comments ( get_comments ( 'status=approve&post_id=' . $id ) );
		return count ( $comments_by_type ['comment'] );
	} else {
		return $count;
	}
}

/**
 * Dont Update the Theme
 *
 * If there is a theme in the repo with the same name, this prevents WP from prompting an update.
 *
 * @since  1.0.0
 * @param  array $r Existing request arguments
 * @param  string $url Request URL
 * @return array Amended request arguments

function ea_dont_update_theme( $r, $url ) {
	if ( 0 !== strpos( $url, 'https://api.wordpress.org/themes/update-check/1.1/' ) )
 		return $r; // Not a theme update request. Bail immediately.
 	$themes = json_decode( $r['body']['themes'] );
 	$child = get_option( 'stylesheet' );
	unset( $themes->themes->$child );
 	$r['body']['themes'] = json_encode( $themes );
 	return $r;
 }
 add_filter( 'http_request_args', 'ea_dont_update_theme', 5, 2 );
*/
 
 /**
  * Snippet Name: Add page break button to tinyMCE editor bar
  * Snippet URL: http://www.wpcustoms.net/snippets/add-page-break-button-to-tinymce-editor-bar/
  */
add_filter('mce_buttons','wpc_nextpage_tinyMCE');
function wpc_nextpage_tinyMCE($mce_buttons) {
 	$pos = array_search('wp_more',$mce_buttons,true);
 	if ($pos !== false) {
 		$tmp_buttons = array_slice($mce_buttons, 0, $pos+1);
 		$tmp_buttons[] = 'wp_page';
 		$mce_buttons = array_merge($tmp_buttons, array_slice($mce_buttons, $pos+1));
 	}
	return $mce_buttons;
}
 
 