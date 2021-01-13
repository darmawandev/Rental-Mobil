<?php
/**
 * Citadela Theme Settings screen
 *
 */
class CitadelaThemeSettings {

	public static function run() {
		add_action( 'admin_menu', [ __CLASS__, 'create_menu' ], 10 );
	}



	public static function create_menu() {

		add_theme_page(
			__('Citadela Theme', 'citadela'),
			__('Citadela Theme', 'citadela'),
			'edit_dashboard',
			'citadela-settings',
			[ __CLASS__, 'render_settings_page' ]
		);
	}



    public static function render_settings_page()
    {
    	$themeInstance = CitadelaTheme::get_instance();
		$activePro = $themeInstance->is_active_pro_plugin();
		$activeDirectory = $themeInstance->is_active_directory_plugin();
		$activeBlocks = $themeInstance->is_active_blocks_plugin();

		if (
			( CITADELA_THEME_PACKAGE === 'free' )
			and ( $activePro or $activeDirectory or $activeBlocks )
		) {
            get_template_part('citadela-theme/admin/settings/templates/citadela-pro-screen');
		} elseif ( CITADELA_THEME_PACKAGE === 'themeforest' ) {
            get_template_part('citadela-theme/admin/settings/templates/citadela-tf-screen');
		} else {
            get_template_part('citadela-theme/admin/settings/templates/citadela-free-screen');
       }
	}



	public static function get_instance()
	{
		if(!self::$instance){
			self::$instance = new self;
		}

		return self::$instance;
	}

}
