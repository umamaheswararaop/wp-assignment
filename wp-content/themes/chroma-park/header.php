<!DOCTYPE html>
<html <?php language_attributes();?> >
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>"/>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div id="container">

<header role="banner">
<nav role="navigation" id="skip" aria-label="<?php echo esc_attr_x('Skip links', 'ARIA label', 'chroma-park'); ?>">
	<?php if (is_active_sidebar('left-sidebar')) : ?>
	<a class="tab-shortcut" id="shortcut-left-sidebar" href="#left"><?php is_active_sidebar('right-sidebar') ? esc_html_e('Skip to first sidebar', 'chroma-park') : esc_html_e('Skip to sidebar', 'chroma-park'); ?></a>
	<?php endif; ?>
	<a class="tab-shortcut" id="shortcut-content" href="#content"><?php esc_html_e('Skip to content', 'chroma-park'); ?></a>
	<?php if (is_active_sidebar('right-sidebar')) : ?>
	<a class="tab-shortcut" id="shortcut-right-sidebar" href="#right"><?php is_active_sidebar('left-sidebar') ? esc_html_e('Skip to second sidebar', 'chroma-park') : esc_html_e('Skip to sidebar', 'chroma-park'); ?></a>
	<?php endif; ?>
</nav> <!-- /skip -->


<div id="header">
		<a href="<?php echo esc_url(home_url()); ?>">
			<div id="blog-name"><?php bloginfo('name'); ?></div>
			<div id="blog-tagline"><?php bloginfo('description'); ?></div>
		</a>
</div> <!-- /header -->

<?php
	wp_nav_menu(
		array(
			'theme_location' => 'header_menu',
			'menu_id' => 'header-menu-content',
			'fallback_cb' => false,
			'container' => 'nav',
			'container_id' => 'header-menu',
			'container_aria_label' => _x('Header menu', 'ARIA label', 'chroma-park')
		)
	);
?> <!-- /header-menu -->
</header>

<div id="wrapper">
	<div id="responsive">
	
	<?php if (is_active_sidebar('left-sidebar')) : ?>
	<!-- begin left sidebar -->
	<aside role="complementary" id="left" class="sidebar" aria-label="<?php echo is_active_sidebar('right-sidebar') ? esc_attr_x('First Sidebar', 'ARIA label', 'chroma-park') : esc_attr_x('Sidebar', 'ARIA label', 'chroma-park') ?>">
		<ul>
			<?php dynamic_sidebar('left-sidebar'); ?>
		</ul>
	</aside> <!-- end left sidebar -->
	<?php endif; ?>
		<div id="content">
			<main id="main" role="main">
