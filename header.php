<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package strategicfactory
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<link rel="preconnect" href="https://fonts.gstatic.com">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link sr-only" href="#content"><?php esc_html_e( 'Skip to content', 'strategicfactory' ); ?></a>

	<?php 
	if ( is_active_sidebar( 'alert' ) ) : ?>
		<div class="site-alert p-3 text-center">
			<div class="container">
				<?php dynamic_sidebar( 'alert' ); ?>
			</div>
		</div>
	<?php endif; ?>

	<header id="masthead" class="site-header">
		<nav class="minor-nav bg-primary">
			<?php
				wp_nav_menu( array(
					'theme_location' => 'secondary-nav',
					'menu_id'        => 'secondary-nav',
					'fallback_cb'    => 'WP_Bootstrap_Navwalker::fallback',
					'walker'         => new WP_Bootstrap_Navwalker(),
				) );
				?>
		</nav>
		<nav class="navbar">
			<?php
			the_custom_logo(); ?>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="primary-menu" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarNav">
				<?php
				wp_nav_menu( array(
					'theme_location' => 'primary-nav',
					'menu_id'        => 'primary-menu',
					'fallback_cb'    => 'WP_Bootstrap_Navwalker::fallback',
					'walker'         => new WP_Bootstrap_Navwalker(),
				) );
				?>
			</div>
		</nav>
		
	</header><!-- #masthead -->

	<div id="content" class="site-content">
