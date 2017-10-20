<?php
/**
 * Created by PhpStorm.
 * User: echibi
 * Date: 20/10/2017
 * Time: 22:58
 */

namespace Evaskeramik\Entities;

/**
 * Class ImagePost
 * @package Evaskeramik\Entities
 */
class FrontpageImage {
	/**
	 * @var \WP_Post
	 */
	public $post;

	/**
	 * @var string
	 */
	public $class;

	/**
	 * @var bool
	 */
	public $vertical;

	/**
	 * @var string
	 */
	public $src;

	/**
	 * @var string
	 */
	public $alt;

	/**
	 * @param \WP_Post $post
	 */
	function __construct( \WP_Post $post ) {
		$this->post  = $post;
	}
}