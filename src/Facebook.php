<?php
/**
 * Facebook strategy for Opauth
 * based on https://developers.facebook.com/docs/authentication/server-side/
 *
 * More information on Opauth: http://opauth.org
 *
 * @copyright    Copyright © 2012 U-Zyn Chua (http://uzyn.com)
 * @link         http://opauth.org
 * @package      Opauth.FacebookStrategy
 * @license      MIT License
 */
namespace Opauth\Facebook\Strategy;

use Opauth\Opauth\AbstractStrategy;

class Facebook extends AbstractStrategy {

	/**
	 * Compulsory config keys, listed as unassociative arrays
	 * eg. array('app_id', 'app_secret');
	 */
	public $expects = array('app_id', 'app_secret');

	/**
	 * Map response from raw data
	 *
	 * @var array
	 */
	public $responseMap = array(
		'name' => 'username',
		'uid' => 'id',
		'info.name' => 'name',
		'info.email' => 'email',
		'info.nickname' => 'username',
		'info.first_name' => 'first_name',
		'info.last_name' => 'last_name',
		'info.location' => 'location.name',
		'info.urls.website' => 'website'
	);

	/**
	 * Auth request
	 */
	public function request() {
		$url = 'https://www.facebook.com/dialog/oauth';
		$strategyKeys = array(
			'scope',
			'state',
			'response_type',
			'display',
			'auth_type',
			'app_id' => 'client_id'
		);
		$params = $this->addParams($strategyKeys);
		$params['redirect_uri'] = $this->callbackUrl();
		$this->http->redirect($url, $params);
	}

	/**
	 * Internal callback, after Facebook's OAuth
	 */
	public function callback() {
		if (!array_key_exists('code', $_GET) || empty($_GET['code'])) {
			return $this->codeError();
		}

		$url = 'https://graph.facebook.com/oauth/access_token';
		$params = $this->callbackParams();
		$response = $this->http->get($url, $params);
		parse_str($response, $results);

		if (empty($results['access_token'])) {
			return $this->tokenError($response);
		}

		$me = $this->me($results['access_token']);
		if (!$me) {
			$error = array(
				'code' => 'me_error',
				'message' => 'Failed when attempting to query for user information'
			);
			return $this->response(null, $error);
		}

		$response = $this->response($me);
		$response->credentials = array(
			'token' => $results['access_token'],
			'expires' => date('c', time() + $results['expires'])
		);
		$response->info['image'] = 'https://graph.facebook.com/'. $me['id'] . '/picture?type=square';
		return $response;
	}

	/**
	 * Helper method for callback()
	 *
	 * @return array Parameter array
	 */
	protected function callbackParams() {
		$params = array(
			'redirect_uri'=> $this->callbackUrl(),
			'code' => trim($_GET['code'])
		);
		$strategyKeys = array(
			'app_id' => 'client_id',
			'app_secret' => 'client_secret'
		);
		return $this->addParams($strategyKeys, $params);
	}

	/**
	 *
	 * @return type
	 */
	protected function codeError() {
		$error = array(
			'code' => $_GET['error'],
			'message' => $_GET['error_description'],
		);

		return $this->response($_GET, $error);
	}

	/**
	 *
	 * @return returns
	 */
	protected function tokenError($raw) {
		$error = array(
			'code' => 'access_token_error',
			'message' => 'Failed when attempting to obtain access token',
		);

		return $this->response($raw, $error);
	}

	/**
	 * Queries Facebook Graph API for user info
	 *
	 * @param string $access_token
	 * @return array Parsed JSON results
	 */
	protected function me($access_token) {
		$me = $this->http->get('https://graph.facebook.com/me', array('access_token' => $access_token));
		if (empty($me)) {
			return false;
		}
		return $this->recursiveGetObjectVars(json_decode($me));
	}
}
