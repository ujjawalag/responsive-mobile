<?php
/**
 * Register widgetized area and update sidebar with default widgets.
 */
function responsive_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'responsive' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );

	register_sidebar( array(
		'name'          => __( 'Main Sidebar', 'responsive' ),
		'description'   => __( 'Area 1 - sidebar.php - Displays on Default, Blog, Blog Excerpt page templates', 'responsive' ),
		'id'            => 'main-sidebar',
		'before_title'  => '<div class="widget-title"><h3>',
		'after_title'   => '</h3></div>',
		'before_widget' => '<div id="%1$s" class="widget-wrapper %2$s">',
		'after_widget'  => '</div>'
	) );

	register_sidebar( array(
		'name'          => __( 'Right Sidebar', 'responsive' ),
		'description'   => __( 'Area 2 - sidebar-right.php - Displays on Content/Sidebar page templates', 'responsive' ),
		'id'            => 'right-sidebar',
		'before_title'  => '<div class="widget-title"><h3>',
		'after_title'   => '</h3></div>',
		'before_widget' => '<div id="%1$s" class="widget-wrapper %2$s">',
		'after_widget'  => '</div>'
	) );

	register_sidebar( array(
		'name'          => __( 'Left Sidebar', 'responsive' ),
		'description'   => __( 'Area 3 - sidebar-left.php - Displays on Sidebar/Content page templates', 'responsive' ),
		'id'            => 'left-sidebar',
		'before_title'  => '<div class="widget-title"><h3>',
		'after_title'   => '</h3></div>',
		'before_widget' => '<div id="%1$s" class="widget-wrapper %2$s">',
		'after_widget'  => '</div>'
	) );

	register_sidebar( array(
		'name'          => __( 'Left Sidebar Half Page', 'responsive' ),
		'description'   => __( 'Area 4 - sidebar-left-half.php - Displays on Sidebar Half Page/Content page templates', 'responsive' ),
		'id'            => 'left-sidebar-half',
		'before_title'  => '<div class="widget-title"><h3>',
		'after_title'   => '</h3></div>',
		'before_widget' => '<div id="%1$s" class="widget-wrapper %2$s">',
		'after_widget'  => '</div>'
	) );

	register_sidebar( array(
		'name'          => __( 'Right Sidebar Half Page', 'responsive' ),
		'description'   => __( 'Area 5 - sidebar-right-half.php - Displays on Content/Sidebar Half Page page templates', 'responsive' ),
		'id'            => 'right-sidebar-half',
		'before_title'  => '<div class="widget-title"><h3>',
		'after_title'   => '</h3></div>',
		'before_widget' => '<div id="%1$s" class="widget-wrapper %2$s">',
		'after_widget'  => '</div>'
	) );

	register_sidebar( array(
		'name'          => __( 'Home Widget 1', 'responsive' ),
		'description'   => __( 'Area 6 - sidebar-home.php - Displays on the Home Page', 'responsive' ),
		'id'            => 'home-widget-1',
		'before_title'  => '<div id="widget-title-one" class="widget-title-home"><h3>',
		'after_title'   => '</h3></div>',
		'before_widget' => '<div id="%1$s" class="widget-wrapper %2$s">',
		'after_widget'  => '</div>'
	) );

	register_sidebar( array(
		'name'          => __( 'Home Widget 2', 'responsive' ),
		'description'   => __( 'Area 7 - sidebar-home.php - Displays on the Home Page', 'responsive' ),
		'id'            => 'home-widget-2',
		'before_title'  => '<div id="widget-title-two" class="widget-title-home"><h3>',
		'after_title'   => '</h3></div>',
		'before_widget' => '<div id="%1$s" class="widget-wrapper %2$s">',
		'after_widget'  => '</div>'
	) );

	register_sidebar( array(
		'name'          => __( 'Home Widget 3', 'responsive' ),
		'description'   => __( 'Area 8 - sidebar-home.php - Displays on the Home Page', 'responsive' ),
		'id'            => 'home-widget-3',
		'before_title'  => '<div id="widget-title-three" class="widget-title-home"><h3>',
		'after_title'   => '</h3></div>',
		'before_widget' => '<div id="%1$s" class="widget-wrapper %2$s">',
		'after_widget'  => '</div>'
	) );

	register_sidebar( array(
		'name'          => __( 'Gallery Sidebar', 'responsive' ),
		'description'   => __( 'Area 9 - sidebar-gallery.php - Displays on the page after an image has been clicked in a Gallery', 'responsive' ),
		'id'            => 'gallery-widget',
		'before_title'  => '<div class="widget-title"><h3>',
		'after_title'   => '</h3></div>',
		'before_widget' => '<div id="%1$s" class="widget-wrapper %2$s">',
		'after_widget'  => '</div>'
	) );

	register_sidebar( array(
		'name'          => __( 'Colophon Widget', 'responsive' ),
		'description'   => __( 'Area 10 - sidebar-colophon.php, 100% width Footer widgets', 'responsive' ),
		'id'            => 'colophon-widget',
		'before_title'  => '<div class="widget-title"><h3>',
		'after_title'   => '</h3></div>',
		'before_widget' => '<div id="%1$s" class="colophon-widget widget-wrapper %2$s">',
		'after_widget'  => '</div>'
	) );

	register_sidebar( array(
		'name'          => __( 'Top Widget', 'responsive' ),
		'description'   => __( 'Area 11 - sidebar-top.php - Displays on the right of the header', 'responsive' ),
		'id'            => 'top-widget',
		'before_title'  => '<div class="widget-title"><h3>',
		'after_title'   => '</h3></div>',
		'before_widget' => '<div id="%1$s" class="%2$s">',
		'after_widget'  => '</div>'
	) );

	register_sidebar( array(
		'name'          => __( 'Footer Widget', 'responsive' ),
		'description'   => __( 'Area 12 - sidebar-footer.php - Maximum of 3 widgets per row', 'responsive' ),
		'id'            => 'footer-widget',
		'before_title'  => '<div class="widget-title"><h3>',
		'after_title'   => '</h3></div>',
		'before_widget' => '<div id="%1$s" class="grid col-300 %2$s"><div class="widget-wrapper">',
		'after_widget'  => '</div></div>'
	) );
}
add_action( 'widgets_init', 'responsive_widgets_init' );


/* Add fit class to third footer widget */
function footer_widgets( $params ) {

	global $footer_widget_num; //Our widget counter variable

	//Check if we are displaying "Footer Sidebar"
	if( $params[0]['id'] == 'footer-widget' ){
		$footer_widget_num++;
		$divider = 3; //This is number of widgets that should fit in one row

		//If it's third widget, add last class to it
		if( $footer_widget_num % $divider == 0 ){
			$class = 'class="fit ';
			$params[0]['before_widget'] = str_replace( 'class="', $class, $params[0]['before_widget'] );
		}

	}

	return $params;
}
add_filter( 'dynamic_sidebar_params', 'footer_widgets' );