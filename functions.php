<?php
add_action ( 'after_setup_theme', 'minimal_wp_setup' );
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


/**
 * Callback function to the add_theme_page
 * Will display the theme options page
 */
function pu_theme_menu() {
	add_theme_page( 
			'Footer', 
			'Footer', 
			'manage_options', 
			'pu_theme_options.php', 
			'pu_theme_page');
}

function pu_theme_page() {
	?>
    <div class="section panel">
      <h1>Custom Theme Options</h1>
      <form method="post" enctype="multipart/form-data" action="options.php">
        <?php 
          settings_fields('pu_theme_options'); 
          do_settings_sections('pu_theme_options.php');
        ?>
            <p class="submit"> <input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" /></p>  
            
      </form>
      
      <p>Created by <a href="http://www.paulund.co.uk">Paulund</a>.</p>
    </div>
    <?php
}

add_action('admin_menu', 'pu_theme_menu');

function pu_register_settings()
{
	// Register the settings with Validation callback
	register_setting( 'pu_theme_options', 'pu_theme_options', 'pu_validate_settings' );

	// Add settings section
	add_settings_section( 'pu_text_section', 'Text box Title', 'pu_display_section', 'pu_theme_options.php' );

	// Create textbox field
	$field_args = array(
			'type'      => 'text',
			'id'        => 'pu_textbox',
			'name'      => 'pu_textbox',
			'desc'      => 'Example of textbox description',
			'std'       => '',
			'label_for' => 'pu_textbox',
			'class'     => 'css_class'
	);

	add_settings_field( 'example_textbox', 'Example Textbox', 'pu_display_setting', 'pu_theme_options.php', 'pu_text_section', $field_args );
}
add_action( 'admin_init', 'pu_register_settings' );


function pu_display_section($section){

}
/**
 * Function to display the settings on the page
 * This is setup to be expandable by using a switch on the type variable.
 * In future you can add multiple types to be display from this function,
 * Such as checkboxes, select boxes, file upload boxes etc.
 */
function pu_display_setting($args)
{
	extract( $args );

	$option_name = 'pu_theme_options';

	$options = get_option( $option_name );

	switch ( $type ) {
		case 'text':
			$options[$id] = stripslashes($options[$id]);
			$options[$id] = esc_attr( $options[$id]);
			echo "<input class='regular-text$class' type='text' id='$id' name='" . $option_name . "[$id]' value='$options[$id]' />";
			echo ($desc != '') ? "<br /><span class='description'>$desc</span>" : "";
			break;
	}
}

/**
 * Callback function to the register_settings function will pass through an input variable
 * You can then validate the values and the return variable will be the values stored in the database.
 */
function pu_validate_settings($input)
{
	/*foreach($input as $k => $v)
	{
		$newinput[$k] = trim($v);

		// Check the input is a letter or a number
		if(!preg_match('/^[A-Z0-9 _]*$/i', $v)) {
			$newinput[$k] = '';
		}
	}*/

	return $input;
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

// see https://themes.trac.wordpress.org/ticket/20672
// NOTE: seriously??? with a space between add_action and ( will fail WP validation !?!?!?!?!
add_action( 'widgets_init', 'minimal_wp_widget' );
function minimal_wp_widget() {
	register_sidebar( array(
			'name' 			=> __( 'Sidebar Widget Area', 'minimal_wp' ),
			'id' 			=> 'primary-widget-area',
			'description'   => __( 'sidebar', 'minimal_wp' ),
			'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
			'after_widget' 	=> "</li>",
			'before_title' 	=> '<h3 class="widget-title">',
			'after_title' 	=> '</h3>' 
	) );
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
 