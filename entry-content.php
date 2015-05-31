<div class="entry-content">
<?php if (has_post_thumbnail()): ?>
	<div class="thumb">
	<?php the_post_thumbnail(); ?>
	</div>
<?php endif; ?>
<div class="entry-links"><?php wp_link_pages('before=<p>&after=&next_or_number=next&nextpagelink=&previouspagelink=<'); wp_link_pages('before=&after='); wp_link_pages('before=&after=</p>&next_or_number=next&previouspagelink=&nextpagelink=>'); ?></div>
<?php the_content('continue...'); ?>
</div>
