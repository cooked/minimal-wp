<div class="clear"></div>
</div>
<footer id="footer" role="contentinfo">

<div class="sidebar" id="sidebar-footer">
	<?php get_sidebar('sidebar2'); ?>
</div>

<div id="copyright">
<?php 
	$minimal_wp_options = get_option( 'minimal_wp_theme_options' );
	echo sprintf( __( '%1$s %2$s %3$s.', 'minimal_wp' ), $minimal_wp_options['minimal_wp_textbox'] , date( 'Y' ),esc_html( get_bloginfo( 'name' ) )  ); ?>
</div>
</footer>
</div>
<?php wp_footer(); ?>
</body>
</html>