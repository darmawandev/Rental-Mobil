<?php
   if ( ! defined( 'ABSPATH' )){
        exit; // Exit if accessed directly
    }

    //-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
    // ReduxFramework  Config File
    // For full documentation, please visit: https://docs.reduxframework.com
    //-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-

    if ( ! class_exists( 'Redux' ) ) {
        return;
    }

    
    //-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
    // This is your option name where all the Redux data is stored.
    //-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-

    $inavx_opt_name = "invax_option";


    /**
     * SET ARGUMENTS
     * All the possible arguments for Redux.
     * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
     * */

    $inavx_theme = wp_get_theme(); // For use with some settings. Not necessary.

    $invax_args = array(
        // TYPICAL -> Change these values as you need/desire
        'opt_name'             => $inavx_opt_name,
        // This is where your data is stored in the database and also becomes your global variable name.
        'display_name'         => $inavx_theme->get( 'invax' ),
        // Name that appears at the top of your panel
        'display_version'      => $inavx_theme->get( 'Version' ),
        // Version that appears at the top of your panel
        'menu_type'            => 'menu',
        //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
        'allow_sub_menu'       => false,
        // Show the sections below the admin menu item or not
        'menu_title'           =>  sprintf( esc_html__( 'Theme Option', 'invax' ), $inavx_theme->get( 'Name' ) ),
        'page_title'           => sprintf( esc_html__( 'Theme Option', 'invax' ), $inavx_theme->get( 'Name' ) ),
        // You will need to generate a Google API key to use this feature.
        // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
        'google_api_key'       => '',
        // Set it you want google fonts to update weekly. A google_api_key value is required.
        'google_update_weekly' => FALSE,
        // Must be defined to add google fonts to the typography module
        'async_typography'     => TRUE,
        // Use a asynchronous font on the front end or font string
        //'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
        'admin_bar'            => false,
        // Show the panel pages on the admin bar
        'admin_bar_icon'       => 'dashicons-admin-generic',
        // Choose an icon for the admin bar menu
        'admin_bar_priority'   => 50,
        // Choose an priority for the admin bar menu
        'global_variable'      => '',
        // Set a different name for your global variable other than the inavx_opt_name
        'dev_mode'             => FALSE,
        // Show the time the page took to load, etc
        'update_notice'        => false,
        // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
        'customizer'           => TRUE,
        // Enable basic customizer support
        //'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
        //'disable_save_warn' => true,                    // Disable the save warning when a user changes a field

        // OPTIONAL -> Give you extra features
        'page_priority'        => '40',
        // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
        'page_parent'          => 'themes.php',
        // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
        'page_permissions'     => 'manage_options',
        // Permissions needed to access the options panel.
        'menu_icon'            => '',
        // Specify a custom URL to an icon
        'last_tab'             => '',
        // Force your panel to always open to a specific tab (by id)
        'page_icon'            => 'icon-themes',
        // Icon displayed in the admin panel next to your menu_title
        'page_slug'            => '',
        // Page slug used to denote the panel, will be based off page title then menu title then inavx_opt_name if not provided
        'save_defaults'        => TRUE,
        // On load save the defaults to DB before user clicks save or not
        'default_show'         => FALSE,
        // If true, shows the default value next to each field that is not the default value.
        'default_mark'         => '',
        // What to print by the field's title if the value shown is default. Suggested: *
        'show_import_export'   => TRUE,
        // Shows the Import/Export panel when not used as a field.

        // CAREFUL -> These options are for advanced use only
        'transient_time'       => 60 * MINUTE_IN_SECONDS,
        'output'               => TRUE,
        // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
        'output_tag'           => TRUE,
        // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
        'footer_credit'        => sprintf( '%s Theme Options', 'invax' ), $inavx_theme->get( 'Name'  ),
        // Disable the footer credit of Redux. Please leave if you can help it.

        // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
        'database'             => '',
        // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
        'use_cdn'              => TRUE,
        // If you prefer not to use the CDN for Select2, Ace Editor, and others, you may download the Redux Vendor Support plugin yourself and run locally or embed it in your code.

        // HINTS
        'hints'                => array(
            'icon'          => 'el el-question-sign',
            'icon_position' => 'right',
            'icon_color'    => 'lightgray',
            'icon_size'     => 'normal',
            'tip_style'     => array(
                'color'   => 'red',
                'shadow'  => TRUE,
                'rounded' => FALSE,
                'style'   => '',
            ),
            'tip_position'  => array(
                'my' => 'top left',
                'at' => 'bottom right',
            ),
            'tip_effect'    => array(
                'show' => array(
                    'effect'   => 'slide',
                    'duration' => '500',
                    'event'    => 'mouseover',
                ),
                'hide' => array(
                    'effect'   => 'slide',
                    'duration' => '500',
                    'event'    => 'click mouseleave',
                ),
            ),
        )
    );

    Redux::setArgs( $inavx_opt_name, $invax_args );

   
    //-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
    // Generel setting
    //-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
    Redux::setSection( $inavx_opt_name, array(
        'icon'   => 'el el-cogs',
        'title'  => esc_html__('INFO For Settings', 'invax'),
        'fields' => array(
            array(
                'id'    => 'info_success',
                'type'  => 'info',
                'style' => 'success',
                'title' => __('Theme Option', 'invax'),
                'icon'  => 'el-icon-info-sign',
                'desc'  => __( 'New Theme option will add in every week. If you need any support or feature mail me hsagor9@gmail.com ', 'invax')
            )
        )
    ));

    //-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
    // Top bar setting
    //-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
  //   Redux::setSection( $inavx_opt_name, array(
  //       'icon'   => 'el el-cogs',
  //       'title'  => esc_html__('Top Bar Settings', 'invax'),
  //       'fields' => array(
  //          array(
  //           'id'       => 'topbar',
  //           'type'     => 'switch',
  //           'title'    => esc_html__(' Topbar', 'invax'),
  //           'subtitle' => esc_html__('Show or Hide Your Website  Top Bar', 'invax'),
  //           'on'       => esc_html__('Show', 'invax'),
  //           'off'      => esc_html__('Hide', 'invax'),
  //           'default'  => FALSE,
  //           ),           
  //          array(
  //           'id'       => 'left-content',
  //           'type'     => 'textarea',
  //           'required' => array('topbar', '=', '1'),
  //           'title'    => esc_html__(' Topbar Left Content', 'invax'),
  //           'subtitle' => esc_html__('Write Top Bar Left Content', 'invax'),
  //       ), 
  //       array(
  //           'id'       => 'right-content',
  //           'type'     => 'textarea',
  //           'required' => array('topbar', '=', '1'),
  //           'title'    => esc_html__(' Right Left Content', 'invax'),
  //           'subtitle' => esc_html__('Write Top Bar Right Content', 'invax'),
  //       ),
  //       )
  //   ));


  //    //-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
  //   // Logo settings
  //   //-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
  //   Redux::setSection( $inavx_opt_name, array(
  //       'icon'   => 'el-icon-slideshare',
  //       'title'  => esc_html__('Logo Settings', 'invax'),
  //       'fields' => array(
  //           array(
  //               'id'       => 'text-logo',
  //               'type'     => 'text',
  //               'title'    => esc_html__('Logo Text', 'invax'),
  //               'subtitle' => esc_html__('Change your logo text, You Can Upload your Logo easily from customize->Site Identy', 'invax'),
  //               'default'=>'invax'
  //           ),
  //          array(
  //               'id'       => 'call-us-nmber',
  //               'type'     => 'text',
  //               'title'    => esc_html__(' Mobile Number', 'invax'),
  //               'subtitle' => esc_html__('Write Your Mobile Number', 'invax'),
  //               'default' => esc_html__( '+088 1 858 244 547', 'invax' )
  //           ),
  //           array(
  //               'id'       =>'logo-right-btn-txt',
  //               'type'     => 'text',
  //               'title'    => esc_html__(' Right Button Text', 'invax'),
  //               'subtitle' => esc_html__('You can keap blank to remove it', 'invax'),
  //               'default' => esc_html__( 'contact', 'invax' ),
  //           ),          
  //           array(
  //               'id'       =>'logo-right-btn-url',
  //               'type'     => 'text',
  //               'title'    => esc_html__(' Right Button Url', 'invax'),
  //               'default' => esc_html__( '#', 'invax' ),
  //           ),
  //       )
  //   ));



  // //-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
  //   // Presets settings
  //   //-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
  //   Redux::setSection( $inavx_opt_name, array(
  //       'icon'   => 'el-icon-brush',
  //       'title'  => esc_html__('Preset color', 'invax'),
  //       'fields' => array(
  //           array(
  //               'id'       => 'title-color',
  //               'type'     => 'color',
  //               'title'    => __( 'Post Title color', 'invax' ),
  //               'subtitle' => __( 'Pick Color For Post Title (default: #212121).', 'invax' ),
  //               'default'  => '#212121',
  //               'output'   => array(  '.blog-content a' )
  //           ),

  //           array(
  //               'id'       => 'Widget-sidebar-title-color',
  //               'type'     => 'color',
  //               'title'    => __( 'Sidebar Widget Title Color', 'invax' ),
  //               'subtitle' => __( 'Pick Color For Widget Title (default: #212121).', 'invax' ),
  //               'default'  => '#212121',
  //               'output'   => array( 'h3.widget-title' )
  //           ),

  //       )
  //   )); //end 


  //    //-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
  //   // Search settings
  //   //-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
  //   Redux::setSection( $inavx_opt_name, array(
  //       'icon'   => 'el-icon-file-edit',
  //       'title'  => esc_html__('404 Settings', 'invax'),
  //       'fields' => array(
  //     array(
  //           'id'       => 'title-404',
  //           'type'     => 'text',
  //           'title'    => esc_html__('404 Title', 'invax'),
  //           'subtitle' => esc_html__('Write 404 Page Title', 'invax'),
  //           'default'=>'404'
  //       ),
  //      array(
  //           'id'       => 'sub-title-404',
  //           'type'     => 'text',
  //           'title'    => esc_html__('404 Sub Title', 'invax'),
  //           'subtitle' => esc_html__('Write 404 Page Sub Title', 'invax'),
  //           'default'=> esc_html__('PAGE NOT FOUND!', 'invax')
  //       ),
  //      array(
  //           'id'       => 'content-404',
  //           'type'     => 'text',
  //           'title'    => esc_html__('404 Content', 'invax'),
  //           'subtitle' => esc_html__('Write 404 Content', 'invax'),
  //           'default'=>esc_html__('Sorry, we couldn\'t find the content you were looking for.', 'invax'),
  //       ),
  //        array(
  //           'id'       => 'icon-404',
  //           'type'     => 'text',
  //           'title'    => esc_html__('404 Icon', 'invax'),
  //           'subtitle' => esc_html__('Insert 404 Font Awesome Icon', 'invax'),
  //           'default'=>'fa fa-exclamation-triangle'
  //       ),
  //       )
  //   ));

  //   //-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
  //   // Blog settings
  //   //-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-

  //       Redux::setSection( $inavx_opt_name, array(
  //       'icon'   => 'el-icon-file-edit',
  //       'title'  => esc_html__('Blog Settings', 'invax'),
  //       'fields' => array(
  //           array(
  //               'id'       => 'blog-title',
  //               'type'     => 'text',
  //               'title'    => esc_html__('Blog Page Title', 'invax'),
  //               'subtitle' => esc_html__('Enter Blog page title here, if leave blank then site title will appear', 'invax'),
  //               'default'  => 'Home'
  //           )

  //       )
  //   )); //end blog sidebar

  //    //-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
  //   // Breadcrumb
  //   //-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-

  //   Redux::setSection( $inavx_opt_name, array(
  //       'icon'   => 'el el-list-alt',
  //       'title'  => esc_html__('Breadcrumb', 'invax'),
  //       'fields' => array(
  //       //blog breadcrumb
  //       array(
  //               'id'       => 'breadcrumb-image-1',
  //               'type'     => 'media',
  //               'title'    => esc_html__('Breadcrumb Image One', 'invax'),
  //               'subtitle' => esc_html__('Upload breadcrumb image one', 'invax'),
  //               'default'=>'invax'
  //           ),
  //           array(
  //               'id'       => 'breadcrumb-image-1',
  //               'type'     => 'media',
  //               'title'    => esc_html__('Breadcrumb Image One', 'invax'),
  //               'subtitle' => esc_html__('Upload breadcrumb image one', 'invax'),
  //               'default'=>''
  //           ),            
  //           array(
  //               'id'       => 'breadcrumb-image-2',
  //               'type'     => 'media',
  //               'title'    => esc_html__('Breadcrumb Image Two', 'invax'),
  //               'subtitle' => esc_html__('Upload breadcrumb image two', 'invax'),
  //               'default'=>''
  //           ),          
  //           array(
  //               'id'       => 'breadcrumb-image-3',
  //               'type'     => 'media',
  //               'title'    => esc_html__('Breadcrumb Image Three', 'invax'),
  //               'subtitle' => esc_html__('Upload breadcrumb image three', 'invax'),
  //               'default'=>''
  //           ),            
  //           array(
  //               'id'       => 'breadcrumb-bg-image',
  //               'type'     => 'media',
  //               'title'    => esc_html__('Breadcrumb Background Image', 'invax'),
  //               'subtitle' => esc_html__('Upload breadcrumb background image', 'invax'),
  //               'default'  => ''
  //           ),


  //       )
  //   )); //end breadcumb

  //    //-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
  //   //Footer
  //   //-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-

  //       Redux::setSection( $inavx_opt_name, array(
  //       'icon'   => 'el-icon-photo',
  //       'title'  => esc_html__('Footer Settings', 'invax'),
  //       'fields' => array(
  //           array(
  //               'id'       => 'copyright-left',
  //               'type'     => 'textarea',
  //               'title'    => esc_html__('Enter Copyright Left Content', 'invax'),
  //               'default'  => __( 'Copyright © 2019 Gullfoss by SmartSoftCode. All Rights Reserved', 'invax' )
  //           ),            
  //           array(
  //               'id'       => 'copyright-Right',
  //               'type'     => 'textarea',
  //               'title'    => esc_html__('Enter Copyright Right Content', 'invax'),
  //               'default'  => ''
  //           ),

  //       )
  //   )); //end blog sidebar