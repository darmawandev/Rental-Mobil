<?php
/**
 * Citadela Theme Register sidebars
 */

function citadelaTheme_sidebars() {

	$sidebars = array(
		array(
			'id'            => 'home-sidebar',
			'class'         => 'home-sidebar',
			'name'          => __( 'Home widgets area', 'citadela' ),
			'description'   => __( 'Widgets displayed on home page.', 'citadela' ),
		),
		array(
			'id'            => 'blog-sidebar',
			'class'         => 'blog-sidebar',
			'name'          => __( 'Blog page widgets area', 'citadela' ),
			'description'   => __( 'Widgets displayed on blog page.', 'citadela' ),
		),
		array(
			'id'            => 'pages-sidebar',
			'class'         => 'pages-sidebar',
			'name'          => __( 'Pages widgets area', 'citadela' ),
			'description'   => __( 'Widgets displayed on pages.', 'citadela' ),
		),
		array(
			'id'            => 'posts-sidebar',
			'class'         => 'posts-sidebar',
			'name'          => __( 'Posts widgets area', 'citadela' ),
			'description'   => __( 'Widgets displayed on posts.', 'citadela' ),
		),
		array(
			'id'            => 'archives-sidebar',
			'class'         => 'archives-sidebar',
			'name'          => __( 'Archives widgets area', 'citadela' ),
			'description'   => __( 'Widgets displayed on archive pages.', 'citadela' ),
		),
		array(
			'id'            => 'search-sidebar',
			'class'         => 'search-sidebar',
			'name'          => __( 'Search results widgets area', 'citadela' ),
			'description'   => __( 'Widgets displayed on search results page.', 'citadela' ),
		),
		array(
			'id'            => '404-sidebar',
			'class'         => '404-sidebar',
			'name'          => __( '404 page widgets area', 'citadela' ),
			'description'   => __( 'Widgets displayed on 404 page.', 'citadela' ),
		),
		array(
			'id'            => 'footer-widgets-area',
			'class'         => 'footer-widgets-area',
			'name'          => __( 'Footer widgets area', 'citadela' ),
			'description'   => __( 'Widgets displayed in the footer.', 'citadela' ),
		),
	);
	
	if( CitadelaTheme::get_instance()->is_active_woocommerce() ) {
		$sidebars[] = array(
			'id'            => 'woocommerce-shop-sidebar',
			'class'         => 'woocommerce-shop-sidebar',
			'name'          => __( 'Woocommerce Shop widgets area', 'citadela' ),
			'description'   => __( 'Widgets displayed on Shop page.', 'citadela' ),
		);
	}

	$defaults = array(
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => "</div></div>",
		'before_title'  => '<div class="widget-title">',
		'after_title'   => '</div><div class="widget-container">',
	);

	foreach ($sidebars as $sidebar) {
		$args = array_merge( $sidebar, $defaults );
		register_sidebar( $args );
	}
}
add_action( 'widgets_init', 'citadelaTheme_sidebars' );

//get default args for the_widget() function
function citadelaTheme_get_widget_defaults() {
	return array(
				'before_widget' => '<div class="widget %1$s">',
				'after_widget'  => "</div></div>",
				'before_title'  => '<div class="widget-title">',
				'after_title'   => '</div><div class="widget-container">',
			);
}

function citadelaTheme_widget_title($title, $instance = array(), $idBase = '') {

	//do not show title for woocommerce minicart in header
	if( isset( $instance['citadela-woocommerce-minicart-widget'] ) && $instance['citadela-woocommerce-minicart-widget'] ) return '';

	$hasTitle = (trim(str_replace('&nbsp;', '', $title)) !== '');

	if($hasTitle){
		// default filters were removed, so apply these function manualy to title
		$title = esc_html(convert_chars(wptexturize($title)));
		if($idBase === 'rss'){
			return $title;
		}else{
			return "<h3>{$title}</h3>";
		}
	}
	// if title is empty return whitespace thus condition for checking
	// emptyness of the title in default WP widget will always pass
	// and will outputs $before_title . ' ' . $after_title
	return '<!-- citadela-no-widget-title -->';
}
remove_filter('widget_title', 'wptexturize');
remove_filter('widget_title', 'convert_chars');
remove_filter('widget_title', 'esc_html');
add_filter('widget_title', 'citadelaTheme_widget_title', 3, 1999);


/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function citadelaTheme_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'citadelaTheme_pingback_header' );
