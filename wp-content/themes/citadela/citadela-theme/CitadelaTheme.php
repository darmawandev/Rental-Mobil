<?php
/**
 * Citadela Theme
 *
 */

class CitadelaTheme {

	public $themeCodeName = 'citadela-theme';
	public $themeClassPrefix = 'CitadelaTheme';
	public $themeConfig;
	public $themeCustomizerConfig;
	public $themePaths;

	private static $instance;

	public function run(){

		$this->load_textdomain();

		$this->themeConfig = $this->get_config();
		$this->themePaths = $this->get_paths();

		spl_autoload_register( array( $this, 'autoload' ) );
		add_action( 'init', array( $this, 'on_init' ) );
		add_action( 'wp_head', array( $this, 'wp_head' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'early_styles' ), 9 );
		add_action( 'wp_enqueue_scripts', array( $this, 'theme_assets' ), 10 );
        add_action( 'admin_enqueue_scripts', array( $this, 'admin_theme_assets' ) );
        add_action( 'enqueue_block_editor_assets', array( $this, 'block_editor_assets' ), 9999 );

		add_filter( 'body_class', array( $this, 'body_classes' ) );

		add_filter( 'nav_menu_item_id', array( $this, 'menu_items_id' ), 10, 3 );
		add_filter( 'wp_nav_menu_args', array( $this, 'menu_args' ) );
		
		if( $this->is_active_woocommerce() ){
			add_filter( 'woocommerce_breadcrumb_defaults',  array( $this, 'woocommerce_breadcrumb_defaults' ) );
		}

		if( is_admin() ){

			CitadelaThemeSettings::run();

			// Change the name of Default Template in page templates selection
			add_filter( 'default_page_template_title', array( $this, 'change_default_page_template_title' ) );

		}

	}

	
	public function wp_head(){
		
		if( $this->is_active_woocommerce() ){
			// 	remove product taxonomy description from template.
			//	description is displayed with title via page_title.php
			remove_action( 'woocommerce_archive_description', 'woocommerce_taxonomy_archive_description', 10);
			
			//	remove breadcrumbs from default woocommerce hook, breadcrumbs are moved in woocommerce template
			//	except Product page
			if( ! is_product() ){
				remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);
			}
			
		}
	}
		

	public function on_init(){

        foreach ( [ 'page', 'special_page' ] as $post_type ) {

            register_meta( 'post', '_citadela_hide_page_title', [
                'object_subtype' => $post_type,
                'show_in_rest' => true,
                'type' => 'string',
                'single' => true,
                'auth_callback' => function() {
                    return current_user_can( 'edit_posts' );
                }
            ] );

            register_meta( 'post', '_citadela_remove_header_space', [
                'object_subtype' => $post_type,
                'show_in_rest' => true,
                'type' => 'string',
                'single' => true,
                'auth_callback' => function() {
                    return current_user_can( 'edit_posts' );
                }
            ] );

        }

        $theme_editor_asset_file = include( $this->themePaths->dir->js . '/build/editor.asset.php' );
        wp_register_script(
            'citadela-theme-editor-js',
            $this->themePaths->url->js . '/build/editor.js',
            array_merge( [ 'wp-plugins', 'wp-edit-post', 'wp-i18n', 'wp-element' ], $theme_editor_asset_file[ 'dependencies' ] ) ,
            filemtime( $this->themePaths->dir->js . '/build/editor.js' ),
            true
        );
    }

    public function block_editor_assets() {
        wp_enqueue_script( 'citadela-theme-editor-js' );
    }

	public function load_textdomain(){
		load_theme_textdomain( 'citadela', get_template_directory() . '/languages' );
	}


	/**
	 * Enqueue scripts and styles.
	 */

	//
	public function early_styles() {
		wp_enqueue_style( 'citadela-reset', $this->themePaths->url->css . '/reset.css', array(), filemtime( $this->themePaths->dir->css . '/reset.css' ) );
		wp_enqueue_style( 'citadela-base', $this->themePaths->url->css . '/base.css', array(), filemtime( $this->themePaths->dir->css . '/base.css' ) );
	}
	public function theme_assets() {
		// embed Google fonts in case the Citadela Pro Plugin is not active
		if( ! $this->is_active_pro_plugin() ){
			wp_enqueue_style( $this->themeCodeName . '-google-fonts', 'https://fonts.googleapis.com/css?family=Open+Sans:400,700,800&amp;subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese' );
        }

        $compileThemeDefault = isset($_REQUEST['compile-theme-default']);
        if ($compileThemeDefault || !$this->is_active_pro_plugin() ) {

            wp_enqueue_style( 'citadela-theme-default-style', $this->themePaths->url->css . '/theme-default-style.css', array(), file_exists($this->themePaths->dir->css . '/theme-default-style.css' ) ? filemtime($this->themePaths->dir->css . '/theme-default-style.css' ) : '' );
        } else {
            $cacheFileName = is_customize_preview() ? '/citadela-theme-cache-preview-style.css' : '/citadela-theme-cache-style.css';
            wp_enqueue_style( 'citadela-theme-general-styles', $this->themePaths->url->cache . $cacheFileName, array(), file_exists($this->themePaths->dir->cache . $cacheFileName) ? filemtime($this->themePaths->dir->cache . $cacheFileName) : '' );
        }




		$citadela_styles = $this->themeConfig->styles->frontend;
		if (is_array($citadela_styles) ){
			foreach ($citadela_styles as $fileHandle => $fileData) {
				$this->enqueue_theme_file( 'css', $fileHandle, $fileData);
			}
		}

		$citadela_assets_css = $this->themeConfig->assets->frontend->css;
		if (is_array($citadela_assets_css) ){
			foreach ($citadela_assets_css as $fileHandle => $fileData) {
				$this->enqueue_asset_file( 'css', $fileHandle, $fileData);
			}
		}

		$citadela_assets_js = $this->themeConfig->assets->frontend->js;
		if (is_array($citadela_assets_js) ){
			foreach ($citadela_assets_js as $fileHandle => $fileData) {
				$this->enqueue_asset_file( 'js', $fileHandle, $fileData);
			}
		}

		$citadela_scripts = $this->themeConfig->scripts->frontend;
		if (is_array($citadela_scripts) ){
			foreach ($citadela_scripts as $fileHandle => $fileData) {
				$this->enqueue_theme_file( 'js', $fileHandle, $fileData);
			}
		}

		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}


	public function admin_theme_assets() {

		$currentScreenObject = get_current_screen();
		$currentScreen = ( $currentScreenObject && isset($currentScreenObject->id) ) ? $currentScreenObject->id : '';

		$citadela_styles = $this->themeConfig->styles->admin;
		if (is_array($citadela_styles) ){
			foreach ($citadela_styles as $fileHandle => $fileData) {
				$this->enqueue_theme_file( 'css', $fileHandle, $fileData);
			}
		}

		$citadela_scripts = $this->themeConfig->scripts->admin;
		if (is_array($citadela_scripts) ){
			foreach ($citadela_scripts as $fileHandle => $fileData) {
				if( $this->enqueue_on_admin_screen( $fileData, $currentScreen ) )
				  $this->enqueue_theme_file( 'js', $fileHandle, $fileData);
			}
		}

		$citadela_assets_js = $this->themeConfig->assets->admin->js;
		if (is_array($citadela_assets_js) ){
			foreach ($citadela_assets_js as $fileHandle => $fileData) {
				if( $this->enqueue_on_admin_screen( $fileData, $currentScreen ) )
				  $this->enqueue_asset_file( 'js', $fileHandle, $fileData);
			}
		}

		$citadela_assets_css = $this->themeConfig->assets->admin->css;
		if (is_array($citadela_assets_css) ){
			foreach ($citadela_assets_css as $fileHandle => $fileData) {
				$this->enqueue_asset_file( 'css', $fileHandle, $fileData);
			}
		}

	}

	public function enqueue_on_admin_screen( $fileData, $currentScreen ){
		if( isset( $fileData['pages'] ) && !in_array($currentScreen, $fileData['pages']) ){
			return false;
		}else{
			return true;
		}
	}

	public function enqueue_theme_file($fileType, $fileHandle, $fileData){

		switch ($fileType) {
			case 'css':
				wp_enqueue_style( 	$fileHandle,
									$this->themePaths->url->css . '/' . $fileData['file'],
									$fileData['deps'],
									$fileData['ver']//filemtime( $this->themePaths->dir->css . '/' . $fileData['file'] )
				);
				break;
			case 'js':
				wp_enqueue_script( 	$fileHandle,
									$this->themePaths->url->js . '/' . $fileData['file'],
									$fileData['deps'],
									$fileData['ver'],//filemtime( $this->themePaths->dir->js . '/' . $fileData['file'] )
									true //in footer
				);
				break;
			default:
				return;
		}

	}

	public function enqueue_asset_file($fileType, $fileHandle, $fileData){

		switch ($fileType) {
			case 'css':
				wp_enqueue_style( 	$fileHandle,
									$this->themePaths->url->assets . '/' . $fileData['file'],
									$fileData['deps'],
									$fileData['ver']//filemtime( $this->themePaths->dir->assets . '/' . $fileData['file'] )
				);
				break;
			case 'js':
				wp_enqueue_script( 	$fileHandle,
									$this->themePaths->url->assets . '/' . $fileData['file'],
									$fileData['deps'],
									$fileData['ver'],//filemtime( $this->themePaths->dir->js . '/' . $fileData['file'] )
									true //in footer
				);
				break;
			default:
				return;
		}
	}


	public function body_classes( $classes ){
		global $post;

		$classes[] = $this->get_layout( 'themeLayout' ) . '-theme-layout';
		$classes[] = $this->get_layout( 'headerLayout' ) . '-header-layout';
		$classes[] = $this->get_layout( 'themeDesign' ) . '-theme-design';

		$classes[] = $this->get_page_template_type();

		//classes from customizer options
		if( sanitize_html_class( get_theme_mod( 'citadela_setting_headerColorOverlay', false ) ) ){
			$classes[] = 'header-color-overlay';
		}
		//hide/show page title, from Page settings
		$classes[] = $this->get_page_meta( '_citadela_hide_page_title' ) ? 'no-page-title' : 'is-page-title';

		//remove space under header, from Page settings
		if( $this->get_page_meta( '_citadela_remove_header_space' ) ){
			$classes[] = 'no-header-space';
		}

		//support for woocommerce
		if( $this->is_active_woocommerce() ){
			
			// product has title in content, there is no standard page title
			if( is_product() ){
				if ( ($key = array_search( 'is-page-title', $classes ) ) !== false) {
		            unset( $classes[$key] );
		        }
				$classes[] = 'no-page-title';
			}
		}

		//support for Citadela Directory plugin special pages
		if( $this->is_active_directory_plugin() ){
			$isSpecialPage = false;
			if (is_singular( 'citadela-item' ) ) {
            	$post_id = CitadelaDirectoryLayouts::getSpecialPageId( 'single-item' );
            	$isSpecialPage = true;
	        }
	        if (is_tax( 'citadela-item-category' ) ) {
	            $post_id = CitadelaDirectoryLayouts::getSpecialPageId( 'item-category' );
	            $isSpecialPage = true;
	        }
	        if (is_tax( 'citadela-item-location' ) ) {
	            $post_id = CitadelaDirectoryLayouts::getSpecialPageId( 'item-location' );
	            $isSpecialPage = true;
	        }
	        if ( is_search() && isset( $_REQUEST['ctdl'] ) ) {
	            $post_id = CitadelaDirectoryLayouts::getSpecialPageId( 'search-results' );
	            $isSpecialPage = true;
	        }

	        if( $isSpecialPage ){
				//if we are in special page, we need remove classes first and then check meta with special page ID
				if ( ($key = array_search( 'no-page-title', $classes ) ) !== false) {
	            	unset( $classes[$key] );
		        }
		        if ( ($key = array_search( 'is-page-title', $classes ) ) !== false) {
		            unset( $classes[$key] );
		        }
		        if ( ($key = array_search( 'no-header-space', $classes ) ) !== false) {
		            unset( $classes[$key] );
		        }

	        	$hide_page_title = get_post_meta( $post_id, '_citadela_hide_page_title', true );
				$classes[] = $hide_page_title ? 'no-page-title' : 'is-page-title';
				$remove_header_space = get_post_meta( $post_id, '_citadela_remove_header_space', true );
				$classes[] = $remove_header_space ? 'no-header-space' : '';
			}


		}

		return $classes;
    }

	public function menu_items_id( $id, $item, $args ) {
		return $id;
	}

	public function menu_args( $args ){
		$args['container_class'] = 'citadela-menu-container';
		if($args['theme_location']){
			$args['container_class'] .= ' citadela-menu-' . $args['theme_location'];
		}
		$args['menu_class'] = 'citadela-menu';
		$args['fallback_cb'] = array( $this, 'menu_fallback' );

		return $args;
	}

	public function menu_fallback( $args ){
		$defaults = array(
			'sort_column' => 'menu_order, post_title',
			'menu_class' => 'menu'
		);

		$args = wp_parse_args($args, $defaults);
		$list_args = $args;
		$list_args['echo'] = false;
		$list_args['title_li'] = '';
		$menu = str_replace( array( "\r", "\n", "\t" ), '', wp_list_pages($list_args) );
		$menu = '<ul class="' . esc_attr($args['menu_class']) . '">' . $menu . '</ul>';
		$containerClass = esc_attr($args['container_class']);
		$menu = '<div class="' . $containerClass . '">' . $menu . "</div>\n";
		echo $menu; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}

	public function get_page_template_type() {
		$f_bar = 'page-fullwidth';
		$l_bar = 'left-sidebar';
		$r_bar = 'right-sidebar';

		if ( is_front_page() && is_home() ) {
			// Latest posts homepage defined in Reading Settings
			if ( is_active_sidebar( 'blog-sidebar' ) ) {
		    	return $r_bar;
			}else{
				return $f_bar;
			}

		} elseif ( is_front_page() ) {
			// Static page homepage defined in Reading Settings
			if ( is_page_template( 'default' ) ) {
		        return $f_bar;
		    }elseif ( is_page_template( 'page-templates/left-sidebar.php' ) && is_active_sidebar( 'home-sidebar' ) ) {
		    	return $l_bar;
			}elseif ( is_page_template( 'page-templates/right-sidebar.php' ) && is_active_sidebar( 'home-sidebar' ) ) {
		    	return $r_bar;
			}else{
				return $f_bar;
			}

		} elseif ( is_home() ) {
			// Blog page defined in Reading Settings
			if ( is_active_sidebar( 'blog-sidebar' ) ) {
		    	return $r_bar;
			}else{
				return $f_bar;
			}

		} else {
			// other types
			if( is_page() ){
				if ( is_page_template( 'default' ) ) {
			        return $f_bar;
			    }elseif ( is_page_template( 'page-templates/left-sidebar.php' ) && is_active_sidebar( 'pages-sidebar' ) ) {
			    	return $l_bar;
				}elseif ( is_page_template( 'page-templates/right-sidebar.php' ) && is_active_sidebar( 'pages-sidebar' ) ) {
			    	return $r_bar;
				}else{
					return $f_bar;
				}

			}elseif( is_attachment() ){
				return $f_bar;

			}elseif( is_single() ){
				$post_type = get_post_type();
				switch ($post_type) {
					case 'post':
						if ( is_active_sidebar( 'posts-sidebar' ) )
							return $r_bar;
						break;
					case 'citadela-item':
						if ( is_active_sidebar( 'item-sidebar' ) )
							return $r_bar;
						break;
					default:
						return $f_bar;
						break;
				}

			}elseif( is_tax() ){
				if( is_tax( 'citadela-item-category' ) && is_active_sidebar( 'item-category-sidebar' ) ){
					return $r_bar;
				}
				if( is_tax( 'citadela-item-location' ) && is_active_sidebar( 'item-location-sidebar' ) ){
					return $r_bar;
				}
				return $f_bar;

			}elseif( is_archive() && is_active_sidebar( 'archives-sidebar' ) ){
				return $r_bar;

			}elseif( is_404() && is_active_sidebar( '404-sidebar' ) ){
				return $r_bar;

			}elseif( is_search() && is_active_sidebar( 'search-sidebar' ) ){
				return $r_bar;

			}elseif( $this->is_active_woocommerce()){
				if( is_shop() && is_active_sidebar( 'woocommerce-shop-sidebar' ) ){	
					return $r_bar;
				}

			}
			else{
				return $f_bar;
			}
		}

		//if no one of previous types, show fullwidth
		return $f_bar;
	}


	public function get_page_meta( $metaId = '' ) {

		if(!$metaId) return false;

		global $post;

		if ( is_front_page() && is_home() ) {
			//Latest Posts homepage defined in Reading Settings
			return false;

		}elseif ( is_home() ) {
			//Blog Page defined in Reading Settings
			// blog page doesn't have custom meta data
			return false;

		}elseif( get_post_type() == 'page' ){

			$meta = get_post_meta( $post->ID, $metaId, true );
			if($meta) return $meta;

		}elseif( $this->is_active_woocommerce() && is_shop() ){	
			// Woocommerce shop page
			$meta = get_post_meta( get_option( 'woocommerce_shop_page_id' ), $metaId, true );
			if($meta) return $meta;
			
		}else{
			return false;
		}
	}


	public function render_posts_pagination( $args = array() ) {

		$defaults = array(
		    'mid_size' => 2,
		    'prev_text' => __( 'Previous', 'citadela' ),
		    'next_text' => __( 'Next', 'citadela' ),
		    //'screen_reader_text' => __( 'Posts navigation' ),
		);

		$args = empty($args) ? $defaults : $args;

		the_posts_pagination($args);
	}

	
	public function woocommerce_breadcrumb_defaults( $defaults ) {
		$defaults['delimiter'] = '<span></span>';
		return $defaults;
	}


	public function change_default_page_template_title() {
		 return __( 'Fullwidth page', 'citadela' );
	}


    public function get_current_locale() {
		return get_locale();
	}


	public function get_current_language_code() {
		$locale = get_locale();
		if($locale == 'zh_CN' ){
			return 'cn';
		}elseif($locale == 'zh_TW' ){
			return 'tw';
		}elseif($locale == 'pt_BR' ){
			return 'br';
		}else{
			return substr($locale, 0, 2);
		}
	}

	public function get_layout( $layout ){
		if( ! $this->is_active_pro_plugin() ){
			return $this->themeConfig->defaultLayouts[$layout];
		}else{
			return sanitize_html_class( get_theme_mod( 'citadela_setting_'.$layout, $this->themeConfig->defaultLayouts[$layout]) );
		}
	}

	public function get_config(){
		return citadelaConfig();
	}

	public function get_paths(){
		return citadelaPaths();
	}

	public function is_active_pro_plugin(){
		return defined( 'CITADELA_PRO_PLUGIN' ) ? true : false;
	}

	public function is_active_directory_plugin(){
		return defined( 'CITADELA_DIRECTORY_PLUGIN' ) ? true : false;
	}

	public function is_active_blocks_plugin(){
		return defined( 'CITADELA_BLOCKS_PLUGIN' ) ? true : false;
	}

	public function is_active_woocommerce(){
		return class_exists( 'woocommerce' ) ? true : false;
	}

	/* ************ helper methods ********** */

	public function autoload($class)
	{
        // autoload namespaced classes within ./customizer folder
        if(substr($class, 0, 20) === 'Citadela\Customizer\\' ){ // starts with
            $filename = str_replace(['Citadela\Customizer\\', '\\'], ['', '/'], $class);
            $file = __DIR__ . "/customizer/{$filename}.php";
		    if($file and file_exists($file) ){
		        require_once $file; // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
		        return;
		    }
        }

		$file = '';
		//paths from /citadela-theme folder
		$loadPaths = array(
					'/admin/settings',
				);

		foreach ($loadPaths as $path) {

			if(substr($class, 0, 13) === $this->themeClassPrefix){
				$file = $this->themePaths->dir->citadela . $path . "/{$class}.php";
			}

			if($file and file_exists($file) ){
				require_once $file; // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
			}

        }
	}

	public static function get_instance() {
		if(!self::$instance){
			self::$instance = new self;
		}

		return self::$instance;
	}

}
