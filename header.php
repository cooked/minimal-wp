<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_uri(); ?>" />
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<div id="wrapper" class="hfeed">
		<header id="header" role="banner">
			<section id="branding">
				<div id="site-title"><h1><a
						href="<?php echo esc_url( home_url( '/' ) ); ?>"
						title="<?php esc_attr_e( get_bloginfo( 'name' ), 'minimal-wp' ); ?>"
						rel="home"><?php echo esc_html( get_bloginfo( 'name' ) ); ?></a></h1></div>
				<div id="site-description"><?php bloginfo( 'description' ); ?></div>
			</section>
			
			
			
			
				<?php get_sidebar('sidebar-1'); ?>
		
			
		</header>
		<div id="container">