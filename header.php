<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything
 * up until <div id="content">.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package EDGE\Toolkit
 */
?>
<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1 maximum-scale=2.0">
		<link rel="profile" href="http://gmpg.org/xfn/11">
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
		<script>
		document.documentElement.className=document.documentElement.className.replace("no-js","js");
		</script>
		<?php wp_head(); ?>


	<!-- Favicons -->
	<link rel="apple-touch-icon" sizes="180x180" href="<?php echo esc_url( get_stylesheet_directory_uri() . '/dist/gui/favicons/apple-touch-icon.png' ); ?>">
	<link rel="icon" type="image/png" sizes="32x32" href="<?php echo esc_url( get_stylesheet_directory_uri() . '/dist/gui/favicons/favicon-32x32.png' ); ?>">
	<link rel="icon" type="image/png" sizes="16x16" href="<?php echo esc_url( get_stylesheet_directory_uri() . '/dist/gui/favicons/favicon-16x16.png' ); ?>">
	<link rel="manifest" href="<?php echo esc_url( get_stylesheet_directory_uri() . '/dist/gui/favicons/site.webmanifest' ); ?>">
	<link rel="mask-icon" href="<?php echo esc_url( get_stylesheet_directory_uri() . '/dist/gui/favicons/safari-pinned-tab.svg' ); ?>" color="#133157">
	<link rel="shortcut icon" href="<?php echo esc_url( get_stylesheet_directory_uri() . '/dist/gui/favicons/favicon.ico' ); ?>">
	<meta name="msapplication-TileColor" content="#133157">
	<meta name="msapplication-config" content="<?php echo esc_url( get_stylesheet_directory_uri() . '/dist/gui/favicons/browserconfig.xml' ); ?>">
	<meta name="theme-color" content="#133157">
	<!-- Favicons -->	
		
	<!-- Google Tag Manager -->
	<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
	new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
	j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
	'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
	})(window,document,'script','dataLayer','GTM-WFB56NR');</script>
	<!-- End GTM -->

	</head>

<body <?php body_class(); ?>>

	<!-- Google Tag Manager (noscript) -->
	<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-WFB56NR"
	height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
	<!-- End GTM -->
	
<?php

	/**
	 * Functions hooked into `wp_body_open` action
	 *
	 * @hooked edge_google_tag_manager                 - 10
	 */
	do_action(
		'wp_body_open'
	);
?>

<?php
	do_action(
		'EDGE\Header\Prepend'
	);
?>

<?php

	/**
	 * Functions hooked into `EDGE\Header` action.
	 */
	do_action(
		'EDGE\Header'
	);
?>

<?php
	do_action(
		'EDGE\Header\Append'
	);
?>
