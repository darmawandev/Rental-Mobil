<?php
/**
 * Citadela Theme Paths
 *
 */

/**
 * Initializes all predefined paths on first use,
 * then is returning all those paths
 * @return stdClass
 */
function citadelaPaths()
{
	static $_citadelaPaths;

	if(is_null($_citadelaPaths)){

		$_citadelaPaths = new stdClass;
		$theme_url = get_template_directory_uri();
		$theme_dir = get_template_directory();

		$_citadelaPaths->url = (object) array(
			'root'		=> home_url(),
			'cache'		=> citadelaSetCachePath('url'),
			'citadela'	=> $theme_url . '/citadela-theme',
			'admin'		=> $theme_url . '/citadela-theme/admin',
			'settings'	=> $theme_url . '/citadela-theme/admin/settings',
			'blocks'	=> $theme_url . '/citadela-theme/blocks',
			'config'	=> $theme_url . '/citadela-theme/config',
			'assets'	=> $theme_url . '/citadela-theme/assets',
			'design' 	=> $theme_url . '/design',
			'css'	 	=> $theme_url . '/design/css',
			'js' 		=> $theme_url . '/design/js',
			'fonts'		=> $theme_url . '/design/fonts',
			'faJSON'	=> $theme_url . '/design/css/assets/fontawesome/json',

		);

		$_citadelaPaths->dir = (object) array(
			'root'		=> realpath(ABSPATH),
			'cache'		=> citadelaSetCachePath('dir'),
			'citadela'	=> $theme_dir . '/citadela-theme',
			'admin'		=> $theme_dir . '/citadela-theme/admin',
			'settings'	=> $theme_dir . '/citadela-theme/admin/settings',
			'blocks'	=> $theme_dir . '/citadela-theme/blocks',
			'config'	=> $theme_dir . '/citadela-theme/config',
			'assets'	=> $theme_dir . '/citadela-theme/assets',
			'libs'		=> $theme_dir . '/citadela-theme/libs',
			'design' 	=> $theme_dir . '/design',
			'css'	 	=> $theme_dir . '/design/css',
			'js' 		=> $theme_dir . '/design/js',
			'fonts'		=> $theme_dir . '/design/fonts',
			'faJSON'	=> $theme_dir . '/design/css/assets/fontawesome/json'
		);

		return $_citadelaPaths;

	}else{
		return $_citadelaPaths;
	}
}

function citadelaSetCachePath($type)
{
	$uploadsDir = wp_upload_dir();
	$citadelaCacheFolder = '/cache/citadela-theme';
	$dir = $uploadsDir['basedir'] . $citadelaCacheFolder;
	$url = $uploadsDir['baseurl'] . $citadelaCacheFolder;
	$url = set_url_scheme($url);

	if(!file_exists($dir)){
		wp_mkdir_p($dir);
	}

	return $type == 'dir' ? $dir : $url;
}
