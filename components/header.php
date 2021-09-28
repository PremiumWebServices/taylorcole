<?php
/**
 * Header
 *
 * @package EDGE\EDGECreative\Components
 */

$header_image = get_template_directory_uri() . '/dist/svg/logo_taylor-cole.svg#logo-taylor-cole';
$header_name = get_bloginfo( 'name' );
$header_size = '283 182';

if(
	is_page_template( 'page-templates/page-lettings.php' )
	) {
	$header_image = get_template_directory_uri() . '/dist/svg/logo_taylor-cole-lettings.svg#logo-taylor-cole-lettings';
	$header_name = 'Taylor Cole Residential Lettings';
	$header_size = '283 173';
}

if(
	is_page_template( 'page-templates/page-fine-village.php' ) ||
	'2' === $tc_get_property_theme = get_post_meta(
		get_the_ID(),
		'branchID',
		true
	)
	) {
	$header_image = get_template_directory_uri() . '/dist/svg/logo_taylor-cole-signature.svg#logo-taylor-cole-signature';
	$header_name = 'Taylor Cole Signature';
	$header_size = '226 184';
}

?>

<header class="c-site-header">

	<div class="c-site-header__container">

		<div class="c-site-header__masthead c-masthead">

			<a class="c-logo-wrap"
				href="<?php echo esc_url( get_home_url() ); ?>">
				<svg
					class="c-logo"
					viewBox="<?php echo esc_attr( '0 0 ' . $header_size ); ?>"
					>
					<title><?php echo esc_html( $header_name ); ?></title>
					<use xlink:href="<?php echo esc_url( $header_image ); ?>"></use>
				</svg>
			</a>
		</div>

		<nav
			class="c-navigation c-menu c-menu--right"
			data-js="site-menu"
			id=""
			>
			<?php
				get_template_part(
					'components/navigation'
				);
			?>
		</nav>

		<aside class="c-site-header_menu-button">
			<a
				href="<?php echo esc_url( home_url( '/?s' ) ); ?>"
			>
				<svg
					class="c-icon c-icon--search"
					viewBox=" 0 0 21 21"
					>
					<title>Search</title>
					<use xlink:href="<?php echo esc_url( get_template_directory_uri() . '/dist/svg/icons/icon--search.svg#icon--search' ); ?>"></use>
				</svg>
			</a>
			<a
				data-js="site-menu-toggle"
				href="#site-menu"
				>
				<svg
					class="c-icon c-icon--menu"
					viewBox=" 0 0 21 21"
					>
					<title>Toggle Menu</title>
					<use xlink:href="<?php echo esc_url( get_template_directory_uri() . '/dist/svg/icons/icon--menu.svg#icon--menu' ); ?>"></use>
				</svg>
			</a>
		</aside>

	</div>

</header>
