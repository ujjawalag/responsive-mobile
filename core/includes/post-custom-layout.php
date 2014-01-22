<?php

// Exit if accessed directly
if( !defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Theme Custom Post Meta
 *
 *
 * @file           post-custom-meta.php
 * @package        Responsive
 * @author         Emil Uzelac
 * @copyright      2003 - 2013 ThemeID
 * @license        license.txt
 * @version        Release: 1.1
 * @filesource     wp-content/themes/responsive/includes/post-custom-meta.php
 * @since          available since Release 1.0
 */

/**
 * Globalize Theme options
 */
global $responsive_options;
$responsive_options = responsive_get_options();

// e.g. get_responsive_grid( 'col-4' );

// @TODO Add support for 'grid-right' & 'rtl-fit'

function get_responsive_grid( $col, $last = false ) {

	global $responsive_options;
	$responsive_options = responsive_get_options();
	$grid = $responsive_options['compatibility'];

	$col_bs = array (
		'col-1'  => 'col-md-1',
		'col-2'  => 'col-md-2',
		'col-3'  => 'col-md-3',
		'col-4'  => 'col-md-4',
		'col-5'  => 'col-md-5',
		'col-6'  => 'col-md-6',
		'col-7'  => 'col-md-7',
		'col-8'  => 'col-md-8',
		'col-9'  => 'col-md-9',
		'col-10' => 'col-md-10',
		'col-11' => 'col-md-11',
		'col-12' => 'col-md-12',
	);

	$col_r1 = array (
		'col-1'  => 'col-60',
		'col-2'  => 'col-140',
		'col-3'  => 'col-220',
		'col-4'  => 'col-300',
		'col-5'  => 'col-380',
		'col-6'  => 'col-460',
		'col-7'  => 'col-540',
		'col-8'  => 'col-620',
		'col-9'  => 'col-700',
		'col-10' => 'col-780',
		'col-11' => 'col-860',
		'col-12' => 'col-940',
	);

	if ( 0 == $grid ) {
		$classes[] = $col_bs[ $col ];
	} else {
		$classes[] = 'grid';
		$classes[] = $col_r1[ $col ];
		$classes[] = false == $last ? '' : 'fit';
	}

	$classes = implode( ' ', $classes );

	return $classes;

}

//TODO not sure how this will work with the BS classes
/**
 * Get content classes
 */
function responsive_get_content_classes() {
	$content_classes = array();
	$layout          = responsive_get_layout();
	if( in_array( $layout, array( 'default', 'content-sidebar-page' ) ) ) {
		$content_classes[] = 'grid';
		$content_classes[] = 'col-620';
	} elseif ( 'sidebar-content-page' == $layout ) {
		$content_classes[] = 'grid-right';
		$content_classes[] = 'col-620';
		$content_classes[] = 'fit';
	} elseif ( 'content-sidebar-half-page' == $layout ) {
		$content_classes[] = 'grid';
		$content_classes[] = 'col-460';
	} elseif ( 'sidebar-content-half-page' == $layout ) {
		$content_classes[] = 'grid-right';
		$content_classes[] = 'col-460';
		$content_classes[] = 'fit';
	} elseif ( 'full-width-page' == $layout ) {
		$content_classes[] = 'grid';
		$content_classes[] = 'col-940';
	}

	$content_classes = apply_filters( 'responsive_content_classes', $content_classes );

	$content_classes = implode( ' ', $content_classes );

	return $content_classes;
}

//TODO not sure how this will work with the BS classes
/**
 * Get sidebar classes
 */
function responsive_get_sidebar_classes() {
	$sidebar_classes = array();
	$layout          = responsive_get_layout();
	if( in_array( $layout, array( 'default', 'content-sidebar-page' ) ) ) {
		$sidebar_classes[] = 'grid';
		$sidebar_classes[] = 'col-300';
		$sidebar_classes[] = 'fit';
	} elseif ( 'sidebar-content-page' == $layout ) {
		$sidebar_classes[] = 'grid-right';
		$sidebar_classes[] = 'col-300';
		$sidebar_classes[] = 'rtl-fit';
	} elseif ( 'content-sidebar-half-page' == $layout ) {
		$sidebar_classes[] = 'grid';
		$sidebar_classes[] = 'col-460';
		$sidebar_classes[] = 'fit';
	} elseif ( 'sidebar-content-half-page' == $layout ) {
		$sidebar_classes[] = 'grid-right';
		$sidebar_classes[] = 'col-460';
		$sidebar_classes[] = 'rtl-fit';
	}

	$sidebar_classes = apply_filters( 'responsive_sidebar_classes', $sidebar_classes );

	$sidebar_classes = implode( ' ', $sidebar_classes );

	return $sidebar_classes;
}

/**
 * Get current layout
 */
function responsive_get_layout() {
	/* 404 pages */
	if( is_404() ) {
		return 'default';
	}
	$layout = '';
	/* Get Theme options */
	global $responsive_options;
	$responsive_options = responsive_get_options();
	/* Get valid layouts */
	$valid_layouts = responsive_get_valid_layouts();
	/* For singular pages, get post meta */
	if( is_singular() ) {
		global $post;
		$layout_meta_value = ( false != get_post_meta( $post->ID, '_responsive_layout', true ) ? get_post_meta( $post->ID, '_responsive_layout', true ) : 'default' );
		$layout_meta       = ( array_key_exists( $layout_meta_value, $valid_layouts ) ? $layout_meta_value : 'default' );
	}
	/* Static pages */
	if( is_page() ) {
		$page_template = get_post_meta( $post->ID, '_wp_page_template', true );
		/* If custom page template is defined, use it first */
		if( 'default' != $page_template ) {
			if( in_array( $page_template, array( 'blog.php', 'blog-excerpt.php' ) ) ) {
				$layout = $responsive_options['blog_posts_index_layout_default'];
			} else {
				$layout = $responsive_options['static_page_layout_default'];
			}
		}
		/* Else, if post custom meta is set, use it */
		elseif( 'default' != $layout_meta ) {
			$layout = $layout_meta;
		}
		/* Else, use the default */
		else {
			$layout = $responsive_options['static_page_layout_default'];
		}

	}
	/* Single blog posts */
	else {
		if( is_single() ) {
			/* If post custom meta is set, use it */
			if( 'default' != $layout_meta ) {
				$layout = $layout_meta;
			}
			/* Else, use the default */
			else {
				$layout = $responsive_options['single_post_layout_default'];
			}

		}
		/* Posts index */
		elseif( is_home() || is_archive() || is_search() ) {
			$layout = $responsive_options['blog_posts_index_layout_default'];
		}
		/* Fallback */
		else {
			$layout = 'default';
		}

	}

	return apply_filters( 'responsive_get_layout', $layout );
}

/**
 * Get valid layouts
 */
function responsive_get_valid_layouts() {
	$layouts = array(
		'content-sidebar-page'      => __( 'Content/Sidebar', 'responsive' ),
		'sidebar-content-page'      => __( 'Sidebar/Content', 'responsive' ),
		'content-sidebar-half-page' => __( 'Content/Sidebar Half Page', 'responsive' ),
		'sidebar-content-half-page' => __( 'Sidebar/Content Half Page', 'responsive' ),
		'full-width-page'           => __( 'Full Width Page (no sidebar)', 'responsive' )
	);

	return apply_filters( 'responsive_valid_layouts', $layouts );
}

/**
 * Add Layout Meta Box
 *
 * @link    http://codex.wordpress.org/Function_Reference/_2            __()
 * @link    http://codex.wordpress.org/Function_Reference/add_meta_box    add_meta_box()
 */
function responsive_add_layout_meta_box( $post ) {
	global $post, $wp_meta_boxes;

	$context  = apply_filters( 'responsive_layout_meta_box_context', 'side' ); // 'normal', 'side', 'advanced'
	$priority = apply_filters( 'responsive_layout_meta_box_priority', 'default' ); // 'high', 'core', 'low', 'default'

	add_meta_box(
		'responsive_layout', __( 'Layout', 'responsive' ), 'responsive_layout_meta_box', 'post', $context, $priority
	);
}

// Hook meta boxes into 'add_meta_boxes'
add_action( 'add_meta_boxes', 'responsive_add_layout_meta_box' );

/**
 * Define Layout Meta Box
 *
 * Define the markup for the meta box
 * for the "layout" post custom meta
 * data. The metabox will consist of
 * radio selection options for "default"
 * and each defined, valid layout
 * option for single blog posts or
 * static pages, depending on the
 * context.
 *
 * @uses    responsive_get_option_parameters()    Defined in \functions\options.php
 * @uses    checked()
 * @uses    get_post_custom()
 */
function responsive_layout_meta_box() {
	global $post;
	$custom        = ( get_post_custom( $post->ID ) ? get_post_custom( $post->ID ) : false );
	$layout        = ( isset( $custom['_responsive_layout'][0] ) ? $custom['_responsive_layout'][0] : 'default' );
	$valid_layouts = responsive_get_valid_layouts();
	?>
	<p>
		<input type="radio" name="_responsive_layout" <?php checked( 'default' == $layout ); ?> value="default"/>
		<label><?php _e( 'Default', 'responsive' ); ?></label><br/>
		<?php foreach( $valid_layouts as $slug => $name ) { ?>
			<input type="radio" name="_responsive_layout" <?php checked( $slug == $layout ); ?> value="<?php echo $slug; ?>"/>
			<label><?php echo $name; ?></label><br/>
		<?php } ?>
	</p>
<?php
}

/**
 * Validate, sanitize, and save post metadata.
 *
 * Validates the user-submitted post custom
 * meta data, ensuring that the selected layout
 * option is in the array of valid layout
 * options; otherwise, it returns 'default'.
 *
 * @link    http://codex.wordpress.org/Function_Reference/update_post_meta    update_post_meta()
 *
 * @link    http://php.net/manual/en/function.array-key-exists.php            array_key_exists()
 *
 * @uses    responsive_get_option_parameters()    Defined in \functions\options.php
 */
function responsive_save_layout_post_metadata() {
	global $post;
	if( !isset( $post ) || !is_object( $post ) ) {
		return;
	}
	$valid_layouts = responsive_get_valid_layouts();
	$layout        = ( isset( $_POST['_responsive_layout'] ) && array_key_exists( $_POST['_responsive_layout'], $valid_layouts ) ? $_POST['_responsive_layout'] : 'default' );

	update_post_meta( $post->ID, '_responsive_layout', $layout );
}

// Hook the save layout post custom meta data into
// publish_{post-type}, draft_{post-type}, and future_{post-type}
add_action( 'publish_post', 'responsive_save_layout_post_metadata' );
add_action( 'publish_page', 'responsive_save_layout_post_metadata' );
add_action( 'draft_post', 'responsive_save_layout_post_metadata' );
add_action( 'draft_page', 'responsive_save_layout_post_metadata' );
add_action( 'future_post', 'responsive_save_layout_post_metadata' );
add_action( 'future_page', 'responsive_save_layout_post_metadata' );
