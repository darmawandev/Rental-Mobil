<?php
/**
 * Citadela Theme Configuration
 *
 */

function citadelaConfig() {

	static $_citadelaConfiguration;

	if(is_null($_citadelaConfiguration)){

		$_citadelaConfiguration = new stdClass;

		$_citadelaConfiguration->menus = (object) array(
			'main'   => __('Main menu', 'citadela'),
			'footer' => __('Footer menu', 'citadela'),
		);

		$_citadelaConfiguration->assets = (object) array(
			'frontend' => (object) array(
				'js' => array(
					'citadela-modernizr-touch' 	=> array(
													'file' 	=> 'modernizr/modernizr.touch.min.js',
													'deps' 	=> array(),
													'ver'	=> '3.3.1'
												),
					'citadela-waypoints' 			=> array(
													'file' 	=> 'waypoints/jquery.waypoints.min.js',
													'deps' 	=> array(),
													'ver'	=> '4.0.1'
												),
					'citadela-photoswipe' 		=> array(
													'file' 	=> 'photoswipe/photoswipe.min.js',
													'deps' 	=> array(),
													'ver'	=> '4.1.3'
												),
					'citadela-photoswipe-ui' 		=> array(
													'file' 	=> 'photoswipe/photoswipe-ui-default.min.js',
													'deps' 	=> array(),
													'ver'	=> '4.1.3'
												),
					'citadela-focus-within-polyfil' => array(
													'file' 	=> 'polyfills/focus-within-polyfill.min.js',
													'deps' 	=> array(),
													'ver'	=> '5.0.4'
												),

				),

				'css' => array(
					'citadela-photoswipe-css' 	=> array(
													'file' 	=> 'photoswipe/photoswipe.css',
													'deps' 	=> array(),
													'ver'	=> '4.1.3'
												),
					'citadela-photoswipe-css-default-skin'
											 	=> array(
													'file' 	=> 'photoswipe/default-skin/default-skin.css',
													'deps' 	=> array(),
													'ver'	=> '4.1.3'
												),

				),
			),

			'admin' => (object) array(
				'js' => array(

				),

				'css' => array(

				),
			),

		);


		$_citadelaConfiguration->styles = (object) array(
			'frontend' => array(
				'citadela-fontawesome'	=> array(
										'file'	=> 'assets/fontawesome/css/all.min.css',
										'deps' 	=> array(),
										'ver'	=> '5.8.2',
									),
			),

			'admin' => array(
				'citadela-fontawesome'	=> array(
										'file'	=> 'assets/fontawesome/css/all.min.css',
										'deps' 	=> array(),
										'ver'	=> '5.8.2',
									),
				'citadela-admin-styles' => array(
								'file' 	=> 'admin/admin-style.css',
								'deps' 	=> array(),
								'ver'	=> filemtime( citadelaPaths()->dir->css . '/admin/admin-style.css' ),
							),
			),

		);

		$_citadelaConfiguration->scripts = (object) array(
			'frontend' => array(
				'citadela-script' 		=> array(
										'file' 	=> 'script.js',
										'deps' 	=> array('jquery'),
										'ver'	=> filemtime( citadelaPaths()->dir->js . '/script.js' ),
									),
				'citadela-fancybox' 	=> array(
										'file' 	=> 'fancybox.js',
										'deps' 	=> array('jquery'),
										'ver'	=> filemtime( citadelaPaths()->dir->js . '/script.js' ),
									),
				'citadela-menu' 		=> array(
										'file' 	=> 'menu.js',
										'deps' 	=> array('jquery', 'citadela-script'),
										'ver'	=> filemtime( citadelaPaths()->dir->js . '/menu.js' ),
									),
				'citadela-mobile-js'	=> array(
										'file' 	=> 'mobile.js',
										'deps' 	=> array('jquery', 'citadela-modernizr-touch'),
										'ver'	=> filemtime( citadelaPaths()->dir->js . '/mobile.js' ),
									),
			),
			'admin' => array(

			),
		);

		$_citadelaConfiguration->frontendAjax = array(

		);

		$_citadelaConfiguration->defaultLayouts = array(
			'themeLayout' 		=> 'classic',
			'headerLayout' 		=> 'classic',
			'themeDesign' 		=> 'default',
		);

		return $_citadelaConfiguration;

	}else{
		return $_citadelaConfiguration;
	}

}