<?php

require_once get_template_directory() . '/inc/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'invax_register_required_plugins' );


function invax_register_required_plugins() {

	$plugins = array(
			array(
			'name'      => 'Display Popular Post',
			'slug'      => 'most-popular-post',
			'required'  => false,
		),
		array(
			'name'      => 'Theme Option',
			'slug'      => 'redux-framework',
			'required'  => false,
		)
	);

	$config = array(
		'id'           => 'invax',
		'default_path' => '',
		'menu'         => 'invax-install-plugins',
		'has_notices'  => true,       
		'dismissable'  => true,
		'dismiss_msg'  => '',
		'is_automatic' => false,
		'message'      => '',

	);

	tgmpa( $plugins, $config );
}
