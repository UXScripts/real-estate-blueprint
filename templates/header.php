<?php
/**
 * Header Template
 *
 * The header template is generally used on every page of your site. Nearly all other templates call it 
 * somewhere near the top of the file. It is used mostly as an opening wrapper, which is closed with the 
 * footer.php file. It also executes key functions needed by the theme, child themes, and plugins. 
 *
 * @package PlacesterBlueprint
 * @subpackage Template
 */
?>
<!doctype html itemscope itemtype="http://schema.org/LocalBusiness">
<!--[if lt IE 7]> <html class="no-js ie6 oldie" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]> <html class="no-js ie7 oldie" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]> <html class="no-js ie8 oldie" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">

    <!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame
    Remove this if you use the .htaccess -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

    <!-- Mobile viewport optimized: j.mp/bplateviewport -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?php pls_document_title(); ?></title>

		<?php if ( pls_get_option('pls-site-favicon') ) { ?>
		<link href="<?php echo pls_get_option('pls-site-favicon'); ?>" rel="shortcut icon" type="image/x-icon" />
		<?php } ?>

		<?php if ( (pls_get_option('pls-css-options')) && (pls_get_option('pls-custom-css')) ) { ?>
			<style type="text/css"><?php echo pls_get_option('pls-custom-css'); ?></style>
		<?php } ?>

		<?php //Required by WordPress
		if ( is_singular() ) wp_enqueue_script( "comment-reply" ); ?>

    <link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>" type="text/css" media="all" />

  	<!-- SEO Tags -->
  	<meta name="description" content="<?php echo get_bloginfo( 'description' ); ?>">
  	<meta name="author" content="<?php echo @PLS_Plugin_API::get_user_details()->first_name . ' ' . @PLS_Plugin_API::get_user_details()->last_name; ?>">

  	<meta property="og:site_name" content="<?php echo get_bloginfo( 'name' ) ?>" />
  	<meta property="og:title" content="<?php pls_document_title(); ?>" />
  	<meta property="og:url" content="<?php echo $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] ?>" />

    <meta itemprop="name" content="<?php echo @pls_get_option('pls-company-name') ?>">
    <meta itemprop="email" content="<?php echo @pls_get_option('pls-company-email') ?>">
    <meta itemprop="address" content="<?php echo @pls_get_option('pls-company-street') ?><?php echo @pls_get_option('pls-company-locality') ?><?php echo @pls_get_option('pls-company-region') ?>">
    <meta itemprop="description" content="<?php echo @pls_get_option('pls-company-description') ?>">
    <meta itemprop="url" content="<?php echo $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] ?>">

    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

	<?php pls_do_atomic( 'open_body' ); ?>
    <div class="container_12 clearfix">

    	<?php pls_do_atomic( 'before_header' ); ?>
        <header id="branding" role="banner" itemscope itemtype="http://schema.org/Organization">

            <?php pls_do_atomic( 'open_header' ); ?>
            <div class="wrapper">
                <hgroup>

									<?php if (pls_get_option('pls-site-logo')): ?>
										<div id="logo">
											<img src="<?php echo pls_get_option('pls-site-logo') ?>" alt="<?php bloginfo( 'name' ); ?>" itemprop="image">
										</div>
									<?php endif; ?>

									<?php if (pls_get_option('pls-site-title')): ?>
										<h1 id="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo pls_get_option('pls-site-title'); ?>" rel="home" itemprop="url"><?php echo pls_get_option('pls-site-title'); ?></a></h1>

										<?php if (pls_get_option('pls-site-subtitle')): ?>
											<h2 id="site-description" itemprop="description"><?php echo pls_get_option('pls-site-subtitle'); ?></h2>
										<?php endif ?>
									<?php endif; ?>

									<?php if (!pls_get_option('pls-site-logo') && !pls_get_option('pls-site-title')): ?>
										<h1 id="site-title" itemprop="name"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home" itemprop="url"><?php bloginfo( 'name' ); ?></a></h1>
										<h2 id="site-description" itemprop="description"><?php bloginfo( 'description' ); ?></h2>
									<?php endif; ?>
									
									
                    
                </hgroup>
                <div class="header-membership"><?php echo PL_Membership::placester_lead_control_panel(array()); ?></div>
                <?php pls_do_atomic( 'header' ); ?>    
            </div>

            <?php pls_do_atomic( 'close_header' ); ?>
        </header>
    <?php pls_do_atomic( 'after_header' ); ?>
    <?php PLS_Route::get_template_part( 'menu', 'primary' ); // Loads the menu-primary.php template. ?>