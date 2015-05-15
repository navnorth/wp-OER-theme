<?php
/**
 * The Header template for our theme
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->

<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<!-- force IE to disable compatibility mode on IE9+, due to ed.gov intranet -->
<meta http-equiv="X-UA-Compatible" content="IE=9" />

<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php // Loads HTML5 JavaScript file to add support for HTML5 elements in older IE versions. ?>
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-39699979-1', 'auto');
  ga('send', 'pageview');

</script>

<div id="page" class="hfeed site">
	<header id="masthead" class="site-header" role="banner">
	  <div class="cntnr">
		<!-- #site-logo -->
			<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php //theme_logo(); ?><img src="<?php echo get_template_directory_uri();?>/img/free-logo.png" alt="Theme Logo"/></a></h1>

		<div class="search_form">
			<form id="searchform" class="searchform" action="<?php echo site_url(); ?>" method="get" role="search">
			<div class="search_flds">
				<input id="s" type="text" name="s" value="" placeholder="Search">
				<input id="searchbtn" type="submit" value="">
			</div>
			</form>
		</div>

		<!-- #site-navigation -->
		<nav id="site-navigation" class="main-navigation" role="navigation">
			<h3 class="menu-toggle"><?php _e( 'Menu', 'twentytwelve' ); ?></h3>
			<a class="assistive-text" href="#content" title="<?php esc_attr_e( 'Skip to content', 'twentytwelve' ); ?>"><?php _e( 'Skip to content', 'twentytwelve' ); ?></a>
			<?php wp_nav_menu( array( 'theme_location' => 'header_menu', 'menu_class' => 'nav-menu' ) ); ?>
		</nav>
       </div>


		<!-- #site-slider -->
        <?php if(is_front_page())
		{?>

            <div class="oer_slider_wrapper">
              <div class="cntnr">
				<?php echo do_shortcode("[smoothslider id='1']"); ?>
              </div>
            </div>
		<?php
		}
		?>

		<?php if ( get_header_image() ) : ?>
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php header_image(); ?>" class="header-image" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="" /></a>
		<?php endif; ?>

	</header><!-- #masthead -->

	<div id="main" class="wrapper">
