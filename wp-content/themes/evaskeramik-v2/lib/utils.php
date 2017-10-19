<?php

namespace Roots\Sage\Utils;

/**
 * Tell WordPress to use searchform.php from the templates/ directory
 */
function get_search_form() {
	$form = '';
	locate_template( '/templates/searchform.php', true, false );

	return $form;
}

add_filter( 'get_search_form', __NAMESPACE__ . '\\get_search_form' );


function is_element_empty( $element ) {
	$element = trim( $element );

	return ! empty( $element );
}

/**
 * @return string
 */
function get_frontpage_excerpt() {
	$frontpage_id = get_option( 'page_on_front' );
	$return       = get_post_field( 'post_excerpt', $frontpage_id, 'raw' );

	return $return;
}


