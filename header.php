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

			<nav id="menu" role="navigation">
				<nav class="primary_nav_wrap">
					<ul>
						<?php
							$minimal_wp_variable = wp_list_categories('echo=0&orderby=name');
							$minimal_wp_variable = preg_replace('~\((\d+)\)(?=\s*+<)~', '<div class="num">$1</num>', $variable);
							echo $minimal_wp_variable;
						?>
					</ul>
				</nav>
				<nav class="primary_nav_wrap">
					<ul>
						<li>Tags
							<?php wp_tag_cloud('format=list&orderby=count&order=DESC&smallest=10&largest=10&number=15'); ?>
						 </li>
					</ul>
				</nav>
				<nav class="primary_nav_wrap">
					<ul>
						<li>Archive
							<ul class="archives">
								<?php wp_get_archives('type=monthly&limit=12'); ?>
							</ul>
						</li>
					</ul>
				</nav>

				<nav class="primary_nav_wrap nav_search">
					<ul>
						<li>Search
							<ul class="">
								<li><?php get_search_form(); ?></li>
							</ul>
						</li>
					</ul>
				</nav>
				<?php 
				if(get_page_by_title('About')) : ?>
					<nav class="primary_nav_wrap"><ul class="nav_about"><li><a href="<?php site_url() ?>/about/">?</a></li></ul></nav>
				<?php endif;?>
			</nav>

		</header>
		<div id="container">