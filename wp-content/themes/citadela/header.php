<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'citadela' ); ?></a>

	<header id="masthead" class="site-header">
		<div class="grid-main">

		<?php $textHiddenClass = esc_attr( get_theme_mod('citadela_setting_hideTaglineSitetitle') ) ? 'text-hidden' : ''; ?>

		<div class="site-branding <?php echo esc_attr($textHiddenClass); ?>">
			<?php
			the_custom_logo();
			?>
			<div class="text-logo">
			<?php
			if ( is_front_page() && is_home() ) :
				?>
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<?php
			else :
				?>
				<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
				<?php
			endif;
			if ( get_bloginfo( 'description', 'display' ) || is_customize_preview() ) :
				?>
				<p class="site-description"><?php bloginfo( 'description' ); ?></p>
			<?php endif; ?>
			</div><!-- .text-logo -->
		</div><!-- .site-branding -->

		<nav id="site-navigation" class="main-navigation menu-hidden">
			<?php
			wp_nav_menu( array(
				'theme_location' => 'main-menu',
				'menu_id'        => 'main-menu',
			) );
			?>
		
		<?php do_action( 'citadela_render_woocommerce_minicart' ); ?>
		
		</nav><!-- #site-navigation -->


		</div><!-- .grid-main -->
	</header><!-- #masthead -->

	<div id="content" class="site-content">
