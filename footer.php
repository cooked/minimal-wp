<div class="clear"></div>
</div>
<footer id="footer" role="contentinfo">
<div id="copyright">
<?php 
	$options = get_option( 'pu_theme_options' );
	echo sprintf( __( '%1$s %2$s %3$s.', 'minimal_wp' ), $options['pu_textbox'] , date( 'Y' ),esc_html( get_bloginfo( 'name' ) )  ); ?>
</div>
</footer>
</div>
<?php wp_footer(); ?>
</body>
</html>