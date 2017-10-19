<?php
/**
 * Created by PhpStorm.
 * User: echibi
 * Date: 19/10/2017
 * Time: 22:23
 */

namespace Evaskeramik\Controllers;

use Evaskeramik\Models\InstagramModel;

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

		return $instaModel->get_user_feed( instagram_access_token, '5618304533' );
	}

	public function getUserInfo(){

	}
}