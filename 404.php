<?php get_header(); ?>
<div id="content" role="main">
<article id="post-0" class="post not-found">
<header class="header">
<h1 class="entry-title"><?php _e( 'Not Found', 'minimal_wp' ); ?></h1>
</header>
<div class="entry-content">
<p><?php _e( 'Nothing found for the requested page. Try a search instead?', 'minimal_wp' ); ?></p>
<?php get_search_form(); ?>
</div>
</article>
</div>
<?php get_footer(); ?>