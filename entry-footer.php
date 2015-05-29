<footer class="entry-footer">
<span class="cat-links"><?php _e( 'Categories: ', 'minimal_wp' ); ?>
<?php

// see: https://codex.wordpress.org/Template_Tags/wp_list_categories#Display_Categories_Assigned_to_a_Post

$taxonomy = 'category';

// get the term IDs assigned to post.
$post_terms = wp_get_object_terms( $post->ID, $taxonomy, array( 'fields' => 'ids' ) );
// separator between links
$separator = ', ';

if ( !empty( $post_terms ) && !is_wp_error( $post_terms ) ) {

	$term_ids = implode( ',' , $post_terms );
	$terms = wp_list_categories( 'title_li=&style=none&echo=0&taxonomy=' . $taxonomy . '&include=' . $term_ids );
	$terms = rtrim( trim( str_replace( '<br />',  $separator, $terms ) ), $separator );

	// display post categories
	echo  $terms;
}
?></span>
<span class="tag-links"><?php the_tags(); ?></span>
</footer> 