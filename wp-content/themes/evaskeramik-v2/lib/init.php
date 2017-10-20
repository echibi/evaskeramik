<?php

namespace Roots\Sage\Init;

use Roots\Sage\Assets;

/**
 * Theme setup
 */
function setup() {
	// Make theme available for translation
	// Community translations can be found at https://github.com/roots/sage-translations
	load_theme_textdomain( 'sage', get_template_directory() . '/lang' );

	// Enable plugins to manage the document title
	// http://codex.wordpress.org/Function_Reference/add_theme_support#Title_Tag
	add_theme_support( 'title-tag' );

	// Register wp_nav_menu() menus
	// http://codex.wordpress.org/Function_Reference/register_nav_menus
	register_nav_menus(
		[
			'primary_navigation' => __( 'Primary Navigation', 'sage' )
		]
	);

	// Add post thumbnails
	// http://codex.wordpress.org/Post_Thumbnails
	// http://codex.wordpress.org/Function_Reference/set_post_thumbnail_size
	// http://codex.wordpress.org/Function_Reference/add_image_size
	add_theme_support( 'post-thumbnails' );

	// Add post formats
	// http://codex.wordpress.org/Post_Formats
	//add_theme_support( 'post-formats', [ 'aside', 'gallery', 'link', 'image', 'quote', 'video', 'audio' ] );

	// Add HTML5 markup for captions
	// http://codex.wordpress.org/Function_Reference/add_theme_support#HTML5
	add_theme_support( 'html5', [ 'caption', 'comment-form', 'comment-list' ] );

	// Tell the TinyMCE editor to use a custom stylesheet
	add_editor_style( Assets\asset_path( 'styles/editor-style.css' ) );

	add_image_size( 'huge', 1680, 0, false );

}

add_action( 'after_setup_theme', __NAMESPACE__ . '\\setup' );


function add_excerpts_to_pages() {
	add_post_type_support( 'page', 'excerpt' );
}

add_action( 'init', __NAMESPACE__ . '\\add_excerpts_to_pages' );

/**
 * Register sidebars
 */
function widgets_init() {
	/*
	register_sidebar( [
		'name'          => __( 'Primary', 'sage' ),
		'id'            => 'sidebar-primary',
		'before_widget' => '<section class="widget %1$s %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3>',
		'after_title'   => '</h3>'
	] );
	*/
	register_sidebar(
		[
			'name'          => __( 'Footer', 'sage' ),
			'id'            => 'sidebar-footer',
			'before_widget' => '<section class="widget %1$s %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h3>',
			'after_title'   => '</h3>'
		]
	);
}

add_action( 'widgets_init', __NAMESPACE__ . '\\widgets_init' );


/**
 * Disable the emoji's
 */
function disable_emojis() {
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' );
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
	add_filter( 'tiny_mce_plugins', __NAMESPACE__ . '\\disable_emojis_tinymce' );
}

add_action( 'init', __NAMESPACE__ . '\\disable_emojis' );

/**
 * Filter function used to remove the tinymce emoji plugin.
 *
 * @param    array $plugins
 *
 * @return   array             Difference betwen the two arrays
 */
function disable_emojis_tinymce( $plugins ) {
	if ( is_array( $plugins ) ) {
		return array_diff( $plugins, array( 'wpemoji' ) );
	} else {
		return array();
	}
}
