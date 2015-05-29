<?php get_header(); ?>
<section id="content" role="main">
<article id="post-0" class="post not-found">
<header class="header">
<h1 class="entry-title"><?php _e( 'Not Found', 'minimal_wp' ); ?></h1>
</header>
<section class="entry-content">
<p><?php _e( 'Nothing found for the requested page. Try a search instead?', 'minimal_wp' ); ?></p>
<?php get_search_form(); ?>
</section>
</article>
</section>
<?php get_sidebar(); ?>
<?php get_footer(); ?>