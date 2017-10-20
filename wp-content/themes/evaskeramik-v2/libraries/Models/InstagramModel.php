<?php
/**
 * Created by PhpStorm.
 * User: echibi
 * Date: 19/10/2017
 * Time: 22:15
 */

namespace Evaskeramik\Models;

use MetzWeb\Instagram\Instagram;

class InstagramModel {

	/**
	 * Instagram App ID
	 * @var string
	 */
	public $instagram_app_id;

	/**
	 * Instagram app secret
	 * @var string
	 */
	public $instagram_app_secret;

	/**
	 * Instagram redirect uri
	 * @var string
	 */
	public $instagram_app_redirect_uri;

	/**
	 * Instagram access token
	 * @var string
	 */
	public $instagram_access_token;

	/**
	 * The limit for feed
	 * @var int
	 */
	public $limit;

	/**
	 * @var Instagram
	 */
	protected $instagram_api;

	/**
	 * @param     $app_id
	 * @param     $app_secret
	 * @param     $app_redirect_uri
	 * @param int $limit
	 */
	function __construct( $app_id, $app_secret, $app_redirect_uri, $limit = 12 ) {

		// General settings
		$this->limit = $limit;

		// Instagram
		$this->instagram_app_id           = $app_id;
		$this->instagram_app_secret       = $app_secret;
		$this->instagram_app_redirect_uri = $app_redirect_uri;

		$this->instagram_api = new Instagram(
			array(
				'apiKey'      => $this->instagram_app_id,
				'apiSecret'   => $this->instagram_app_secret,
				'apiCallback' => $this->instagram_app_redirect_uri
			)
		);

	}

	/**
	 * @param $access_token
	 * @param $instagram_user_id
	 *
	 * @return array Structured feed data.
	 */
	public function get_user_feed( $access_token, $instagram_user_id ) {
		$response = array();
		$this->instagram_api->setAccessToken( $access_token );
		$result = $this->instagram_api->getUserMedia( $instagram_user_id, $this->limit );
		/*	If we need pagination use do-while
		do {
			$result = $instagram->pagination( $result );
		} while ( $result );
		*/
		if ( isset( $result->data ) ) {
			// Here we will store the data in cache
			$response = $this->_format_instagram_data( $result->data );
		}

		return $response;
	}

	/**
	 * @return string
	 */
	public function get_client_code_url() {
		return 'https://api.instagram.com/oauth/authorize/?client_id=' .
		$this->instagram_app_id . '&redirect_uri=' .
		$this->instagram_app_redirect_uri . '&response_type=code&scope=public_content';
	}

	/**
	 * @param $username
	 * @param $access_token
	 *
	 * @return string
	 */
	public function find_userid_url( $username, $access_token ) {
		return 'https://api.instagram.com/v1/users/search?q=' . $username
		. '&client_id=' . $this->instagram_app_id
		. '&access_token=' . $access_token;
	}

	/**
	 * @param $client_code
	 *
	 * @return string
	 */
	public function get_access_token( $client_code ) {
		return $this->instagram_api->getOAuthToken( $client_code );
	}

	/**
	 * Formats Instagram data into our own format
	 *
	 * @param $raw_data
	 *
	 * @return array
	 */
	protected function _format_instagram_data( $raw_data ) {

		$data = array();
		if ( empty( $raw_data ) ) {
			return $data;
		}

		foreach ( $raw_data as $item ) {
			$key                      = 'instagram_' . $item->id;
			$data[$key]['id']         = $item->id;
			$data[$key]['text']       = isset( $item->caption->text ) ? $item->caption->text : '';
			$data[$key]['type']       = 'instagram';
			$data[$key]['created_at'] = $item->created_time;
			$data[$key]['url']        = $item->link;
			$data[$key]['images']     = $item->images;
		}

		return $data;

	}
}