<?php
/**
 * Citadela Theme Customizer
 *
 */

function citadelaTheme_customize_register( $wp_customize ) {

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'citadelaCustomizePartialBlogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'citadelaCustomizePartialBlogdescription',
		) );
	}

	/*
	*	Hide site title and tagline control
	*/

	$wp_customize->add_setting(
		'citadela_setting_hideTaglineSitetitle',
		array(
			'type'				=> 'theme_mod',
			'default'           => false,
			'sanitize_callback' => 'citadelaSanitizeCheckbox',
			'transport'         => 'refresh'
		)
	);

	$wp_customize->add_control( new WP_Customize_Control (
		$wp_customize,
		'citadela_setting_hideTaglineSitetitle',
		array(
			'type' => 'checkbox',
			//'priority' => 1,
			'section' => 'title_tagline',
			'label' => __( 'Hide Site Title and Tagline', 'citadela' ),
			'active_callback' => '',
		)
	));


	/*
	*	Footer copyright text
	*/

	$wp_customize->add_setting(
		'citadela_setting_footerText',
		array(
			'type'				=> 'theme_mod',
			'sanitize_callback' => 'citadelaSanitizeFooterText',
			'default'           => __( 'Created with Citadela WordPress Theme by AitThemes', 'citadela' ),
		)
	);

	$wp_customize->add_control( new WP_Customize_Control(
	    $wp_customize,
		'citadela_setting_footerText',
		array(
			'type' => 'textarea',
			'label' => __( 'Footer Text', 'citadela' ),
			//'priority' => 1,
			'section' => 'title_tagline',
			'settings' => 'citadela_setting_footerText'
			)
		)
    );

    if (!defined('CITADELA_PRO_PLUGIN')) {
        add_action( 'customize_controls_enqueue_scripts', function() {
            wp_enqueue_style( 'citadela-customizer-style',
                citadelaPaths()->url->css . '/admin/customizer-style.css',
                [],
                filemtime( citadelaPaths()->dir->css . '/admin/customizer-style.css' )
            );

        } );

        $wp_customize->add_setting( 'citadela_upsell_control', ['sanitize_callback' => 'sanitize_text_field'] );
        // var_dump(citadelaPaths());
        $wp_customize->add_control(
            new \Citadela\Customizer\Controls\CitadelaUpsellControl( $wp_customize,
                'citadela_upsell_control',
                [
                    'section' => 'citadela_upsells_section',
                    'cta_url' => esc_url(admin_url('themes.php?page=citadela-settings')),
                    'listing_image' => esc_url(citadelaPaths()->url->settings . '/templates/img/ctdl-listing-opt.jpg'),
                    'business_image' => esc_url(citadelaPaths()->url->settings . '/templates/img/ctdl-business-opt.jpg'),

                ]
            )
        );

        $wp_customize->add_section( 'citadela_upsells_section', [
            'priority' => 10,
            'title'    => esc_html__( 'Pro Features', 'citadela' ),
        ]);

        $wp_customize->register_control_type( '\Citadela\Customizer\Controls\CitadelaUpsellControl' );
    }
}
add_action( 'customize_register', 'citadelaTheme_customize_register' );

function citadelaCustomizePartialBlogname() {
	bloginfo( 'name' );
}

function citadelaCustomizePartialBlogdescription() {
	bloginfo( 'description' );
}

function citadelaSanitizeCheckbox( $checked, $setting ){
	return ( ( isset( $checked ) && true == $checked ) ? true : false );
}

function citadelaSanitizeText( $text, $setting ){
	return sanitize_text_field( $text );
}

function citadelaSanitizeFooterText ( $text, $setting ){
	$allowedHtml = array(
		'p' => array(),
		'a' => array(
				'href' => array(),
        		'title' => array(),
        		'target' => array(),
        		'follow' => array()
        	),
		'br' => array(),
		'em' => array(),
		'strong' => array(),
		'i' => array(),
	);
	return wp_kses($text, $allowedHtml);
}

function citadelaTheme_customize_preview_js() {
	wp_enqueue_script( 'citadela-theme-customizer', citadelaPaths()->url->js . '/customizer.js', array( 'customize-preview' ), filemtime(citadelaPaths()->dir->js . '/customizer.js'), true );
}
add_action( 'customize_preview_init', 'citadelaTheme_customize_preview_js' );


