<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Invax
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php
	if ( function_exists( 'wp_body_open' ) ) {
	            wp_body_open(); 
	        }else{
	         do_action( 'wp_body_open' );
	     } 
	?>
	<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'invax' ); ?></a>
	<div class="header-area">
		<div class="container">
			<div class="row">
				<div class="col-md-3 logo_col">
					
				
			<div class="site-logo txt-logo">
				<h2>
					<?php 
						if (  has_custom_logo() ) {
						   		the_custom_logo();
						  }else{ ?>
						  	<a href="<?php echo esc_url(home_url('/')); ?>">
								<?php  echo esc_html(bloginfo( 'name' )); ?>
							</a>
						<?php  } ?>
				</h2> 
			</div>
									
                
			</div>
				<div class="col-md-9 menu_col">
					<div class="finance-responsive-menu"></div>
                    <div class="mainmenu nav-menu">
                    	<nav id="site-navigation" class="main-navigation">
                    		
	                        <?php
								wp_nav_menu( array(
									'theme_location' => 'menu-1',
									'menu_id'        => 'primary-menu',
								) );
							?>
						</nav>
                    </div>
				</div>
			</div>
		</div>
	</div>
	<div id="content" class="site-content">

	