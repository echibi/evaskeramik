<?php
/**
 * Created by PhpStorm.
 * User: echibi
 * Date: 19/10/2017
 * Time: 22:23
 */

namespace Evaskeramik\Controllers;

use Evaskeramik\Models\InstagramModel;
use phpFastCache\Helper\Psr16Adapter;

class InstagramController {

	/**
	 * @param int $limit
	 *
	 * @return array|bool
	 */
	public function getList( $limit = 12 ) {

		if ( ! defined( 'instagram_client_secret' ) ) {
			return false;
		}
		$instaModel = new InstagramModel(
			instagram_client_id,
			instagram_client_secret,
			instagram_redirect_url,
			$limit
		);

		$user_id      = '5618304533';
		$Psr16Adapter = new Psr16Adapter( 'files' );
		$key          = $user_id . '_' . $limit;
		if ( ! $Psr16Adapter->has( $key ) ) {
			// Here we will store the data in cache
			$response = $instaModel->get_user_feed( instagram_access_token, $user_id );
			$Psr16Adapter->set( $key, $response, 3600 );// 1 h
		} else {
			// Getter action
			$response = $Psr16Adapter->get( $key );
		}

		return $response;
	}

	public function getUserInfo() {

	}
}