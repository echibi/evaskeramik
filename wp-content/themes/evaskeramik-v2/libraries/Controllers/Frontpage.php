<?php
/**
 * Created by PhpStorm.
 * User: echibi
 * Date: 20/10/2017
 * Time: 22:49
 */

namespace Evaskeramik\Controllers;


use Evaskeramik\Entities\FrontpageImage;

class Frontpage {
	/**
	 * @param int $limit
	 *
	 * @return array
	 */
	public function get_images( $limit = - 1 ) {
		global $post;
		$args   = array(
			'numberposts'    => $limit, // Using -1 loads all posts
			'orderby'        => 'date menu_order', // This ensures images are in the order set in the page media manager
			'order'          => 'desc',
			'post_mime_type' => 'image', // Make sure it doesn't pull other resources, like videos
			'post_parent'    => $post->ID, // Important part - ensures the associated images are loaded
			'post_status'    => null,
			'post_type'      => 'attachment'
		);
		$images = get_children( $args );
		if ( empty( $images ) ) {
			return $images;
		}
		$response = array();
		foreach ( $images as $id => $image ) {
			$imagePost           = new FrontpageImage( $image );
			$meta                = wp_get_attachment_metadata( $id );
			$imagePost->vertical = ( $meta['width'] < $meta['height'] );

			$image_src      = wp_get_attachment_image_src( $id, 'huge', false );
			$imagePost->src = $image_src[0];
			$imagePost->alt = get_post_meta( $id, '_wp_attachment_image_alt', true );

			$response[$id] = $imagePost;
		}

		return $response;
	}
}