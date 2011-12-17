<?php
/**
 * Sets up the default framework sidebars if the theme supports them. Theme 
 * developers may choose to use or not these sidebars, create new sidebars, 
 * or unregister individual sidebars. A theme must register support for 
 * 'pls-sidebars' to use them.
 *
 * @package PlacesterBlueprint
 * @subpackage Functions
 */

/** Register widget areas. */
add_action( 'widgets_init', 'pls_register_sidebars' );

/**
 * Register the default framework sidebars. Theme developers may optionally 
 * choose to support these sidebars within their themes or add more custom 
 * sidebars to the mix.
 *
 * @since 0.0.1
 * @uses register_sidebar() Registers a sidebar with WordPress.
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function pls_register_sidebars() {

	/** Get theme-supported sidebars. */
    $sidebars = get_theme_support( 'pls-sidebars' );

	/** If there is no array of sidebars IDs, return. */
    if ( ! is_array( $sidebars[0] ) )
        return;

	/** Get the theme textdomain. */
	$textdomain = pls_get_textdomain();

	/** Set up the primary sidebar arguments. */
	$primary = array(
		'id' => 'primary',
		'name' => __( 'Primary', $textdomain ),
		'description' => __( 'The main (primary) widget area, most often used as a sidebar.', $textdomain ),
		'before_widget' => '<section id="%1$s" class="widget %2$s widget-%2$s">',
		'after_widget' => '</section>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>'
	);

	/** Set up the subsidiary sidebar arguments. */
	$subsidiary = array(
		'id' => 'subsidiary',
		'name' => __( 'Subsidiary', $textdomain ),
		'description' => __( 'A widget area loaded in the footer of the site.', $textdomain ),
		'before_widget' => '<section id="%1$s" class="widget %2$s widget-%2$s">',
		'after_widget' => '</section>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>'
	);


	/** Register the primary sidebar. */
    if ( in_array( 'primary', $sidebars[0] ) )
		register_sidebar( $primary );

	/** Register the subsidiary sidebar. */
    if ( in_array( 'subsidiary', $sidebars[0] ) )
		register_sidebar( $subsidiary );

}