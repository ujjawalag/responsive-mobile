<?php
/**
 * Sample implementation of the Custom Header feature
 * http://codex.wordpress.org/Custom_Headers
 *
 * @package Responsive
 */

/**
 * Setup the WordPress core custom header feature.
 *
 * @uses responsive_header_style()
 * @uses responsive_admin_header_style()
 * @uses responsive_admin_header_image()
 *
 * @package Responsive
 */
function responsive_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'responsive_custom_header_args', array(
		'default-image'          => get_template_directory_uri() . '/core/images/default-logo.png',
		'width'                  => 300,
		'height'                 => 100,
		'flex-width'             => true,
		'flex-height'            => true,
		'wp-head-callback'       => 'responsive_header_style',
		'admin-head-callback'    => 'responsive_admin_header_style',
		'admin-preview-callback' => 'responsive_admin_header_image',
	) ) );
	set_theme_mod( $name, $value );
}
add_action( 'after_setup_theme', 'responsive_custom_header_setup' );

if ( ! function_exists( 'responsive_header_style' ) ) {
/**
 * Styles the header image and text displayed on the blog
 *
 * @see responsive_custom_header_setup().
 */
function responsive_header_style() {
	$header_text_color = get_header_textcolor();

	// If no custom options for text are set, let's bail
	// get_header_textcolor() options: HEADER_TEXTCOLOR is default, hide text (returns 'blank') or any hex value
	if ( HEADER_TEXTCOLOR == $header_text_color ) {
		return;
	}

	// If we get this far, we have custom styles. Let's do this.
	?>
	<style type="text/css">
	<?php
		// Has the text been hidden?
		if ( 'blank' == $header_text_color ) :
	?>
		.site-title,
		.site-description {
			position: absolute;
			clip: rect(1px, 1px, 1px, 1px);
		}
	<?php
		// If the user has set a custom color for the text use that
		else :
	?>
		.site-title a,
		.site-description {
			color: #<?php echo $header_text_color; ?>;
		}
	<?php endif; ?>
	</style>
	<?php
}
}

if ( ! function_exists( 'responsive_admin_header_style' ) ) {
/**
 * Styles the header image displayed on the Appearance > Header admin panel.
 *
 * @see responsive_custom_header_setup().
 */
function responsive_admin_header_style() {
?>
	<style type="text/css">
		.appearance_page_custom-header #headimg {
			background-repeat: no-repeat;
			border: none;
		}
		#headimg h1,
		#desc {
		}
		#headimg h1 {
		}
		#headimg h1 a {
			color: #333333!important;
			font-weight: 700;
			text-decoration: none;
		}
		#desc {
		}
		#headimg img {
		}
	</style>
<?php
}
} // responsive_admin_header_style

if ( ! function_exists( 'responsive_admin_header_image' ) ) {
/**
 * Custom header image markup displayed on the Appearance > Header admin panel.
 *
 * @see responsive_custom_header_setup().
 */
function responsive_admin_header_image() {
	$style = sprintf( ' style="color:#%s;"', get_header_textcolor() );
?>
	<div id="headimg">
		<?php if ( get_header_image() ) : ?>
			<img src="<?php header_image(); ?>" alt="">
		<?php endif; ?>
	</div>
<?php
}
}
