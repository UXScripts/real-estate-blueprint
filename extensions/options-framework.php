<?php 

/** Initialize and modify some of the default framework settings. */
PLS_Options_Framework::init();

/**
 * This function sets the unique identifier used to store the options in the 
 * database. By default it uses the theme name. This can be filtered using 
 * "pls_theme_options_menu_page".
 */
if ( ! function_exists( 'optionsframework_option_name' ) ) { 

    function optionsframework_option_name() {

        /** Get the theme name from the stylesheet (lowercase and without spaces). */
        $options_id = get_theme_data( STYLESHEETPATH . '/style.css' );
        $options_id = $options_id['Name'];
        $options_id = preg_replace( "/\W/", "", strtolower( $options_id ) );

        /** Filter the options unique identifier. */
        $options_id = apply_filters( 'pls_theme_options_menu_page', $options_id );
        
        /** Set the Options Framework id to the theme name. */
        $optionsframework_settings = get_option( 'optionsframework' );
        $optionsframework_settings['id'] = $options_id;
        update_option( 'optionsframework', $optionsframework_settings );
    }
}

function pls_get_option ($option, $default = '') {
    if ($option !== '') {
        return of_get_option($option, $default);
    } else {
        return false;
    }
}

class PLS_Options_Framework {

    static function init(){

        /** Initialize the framework constant and import it. */
        if ( ! function_exists( 'optionsframework_init' ) && ! defined( 'OPTIONS_FRAMEWORK_URL' ) && ! defined( 'OPTIONS_FRAMEWORK_DIRECTORY' ) ) {

            /** Set the file path based on whether the Options Framework Theme is a parent theme or child theme. */
            define( 'OPTIONS_FRAMEWORK_DIRECTORY', trailingslashit( PLS_EXT_URL ) . 'options-framework/' );
            define( 'OPTIONS_FRAMEWORK_URL', trailingslashit( PLS_EXT_DIR ) . 'options-framework/' );

            require_once ( trailingslashit( OPTIONS_FRAMEWORK_URL ) . 'options-framework.php' );
        }

        /** Add some setup changes. */
        add_action( 'init', array( __CLASS__, 'setup' ) );

        /** Remove the default admin bar item and add our own. */
        remove_action( 'wp_before_admin_bar_render', 'optionsframework_adminbar' );
        add_action( 'wp_before_admin_bar_render', array( __CLASS__, 'adminbar' ) );
    }

    static function setup() {

        /** Replace the admin submenu with a page. */
        remove_action( 'admin_menu', 'optionsframework_add_page' );

        add_action( 'admin_menu', array( __CLASS__, 'add_page' ) );

        /** 
         * This action hook has been been added by hacking the 
         * options-framework.php file. 
         * The actions happen after loading of the options.php file.
         */
        add_action( 'optionsframework_after_options_load', array( __CLASS__, 'add_default_options' ) );
    }

    /**
     * Returns default options for when the 'options.php' file or the 
     * 'optionsframework_options()' functions are missing.
     * 
     */
    static function add_default_options() {

        if ( ! function_exists( 'optionsframework_options' ) ) {
            function optionsframework_options() { 

                $options = array(); 

                $options[] = array( 
                    'name' => __( 'Information', pls_get_textdomain() ),
                    'type' => 'heading'
                );

                $options[] = array( 
                    'name' => __( 'Information', pls_get_textdomain() ),
                    'desc' => __( 'Looks like you activated the theme options. To jump into using them you need to create an <code>options.php</code> file in you theme root directory. That file needs to contain a <code>optionsframework_options()</code> function that returns the option array. Check out our documentation for more information.', pls_get_textdomain() ),
                    'type' => 'info'
                );

                return $options;

            }
        }
    }


    /**
     * Add an admin bar item.
     * 
     * Its name can be filtered using "pls_admin_bar_menu_page".
     */
    static function adminbar() {

        global $wp_admin_bar;

        /** Add filtering for the name of options page. */
        $page_name = apply_filters( 'pls_admin_bar_menu_page', __( 'Theme Options', pls_get_textdomain() ) );

				// Commented out for WordPress theme submission
        $wp_admin_bar->add_menu( array(
            'id' => 'of_theme_options',
            'title' => $page_name,
            'href' => admin_url( 'admin.php?page=pls-theme-options' )
        ));
    }

    /**
     * Add a menu page called "Theme Options".
     *
     * Its title can be filtered using "pls_theme_options_menu_page_title".
     */
    static function add_page() {

        /** Add filtering for the name of options page. */
        $page_name = apply_filters( 'pls_theme_options_menu_page_title', __( 'Theme Options', pls_get_textdomain() ) );

				// Commented out for WordPress theme submission
        /** Add the menu page. */
        $of_page = add_object_page( 
            $page_name, 
            $page_name, 
            'edit_theme_options', 
            'pls-theme-options', 
            'optionsframework_page', 
            trailingslashit( PLS_IMG_URL ) . 'icons/theme_options.png', 
            '3c' /* position between 3 and 4 */ );

        /** Adds actions to hook in the required css and javascript. */
        add_action( "admin_print_styles-$of_page", 'optionsframework_load_styles' );
        add_action( "admin_print_scripts-$of_page", 'optionsframework_load_scripts' );
    }
}
