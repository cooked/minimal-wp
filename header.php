<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<title><?php wp_title( ' | ', true, 'right' ); ?></title>
<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_uri(); ?>" />
<?php wp_head(); ?>

<script language="javascript" type="text/javascript">
  function resizeIframe(obj) {
    obj.style.height = obj.contentWindow.document.body.scrollHeight + 'px';
  }
</script>

</head>

<body <?php body_class(); ?>>
	<div id="wrapper" class="hfeed">
		<header id="header" role="banner">
			<section id="branding">
				<div id="site-title"><?php if ( ! is_singular() ) { echo '<h1>'; } ?><a
						href="<?php echo esc_url( home_url( '/' ) ); ?>"
						title="<?php esc_attr_e( get_bloginfo( 'name' ), 'minimal_wp' ); ?>"
						rel="home"><?php echo esc_html( get_bloginfo( 'name' ) ); ?></a><?php if ( ! is_singular() ) { echo '</h1>'; } ?></div>
				<div id="site-description"><?php bloginfo( 'description' ); ?></div>
			</section>

			<nav id="menu" role="navigation">
				<nav class="primary_nav_wrap">
					<ul>
						<?php
							$variable = wp_list_categories('echo=0&orderby=name');
							$variable = preg_replace('~\((\d+)\)(?=\s*+<)~', '<div class="num">$1</num>', $variable);
							echo $variable;
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
								<?php get_search_form(); ?>
							<ul>
						</li>
					</ul>
				</nav>
				<nav class="primary_nav_wrap">
					<ul class="nav_about">
						<li><a href="http://www.stefanocottafavi.com/about/">?</a>
						</li>
					</ul>
				</nav>
			</nav>

		</header>
		<div id="container">