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
namespace Opauth\Strategy\Facebook;

use Opauth\AbstractStrategy;
use Opauth\HttpClient;
use Opauth\Response;

class Strategy extends AbstractStrategy {

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
		HttpClient::redirect($url, $params);
	}

	/**
	 * Internal callback, after Facebook's OAuth
	 */
	public function callback() {
		if (!array_key_exists('code', $_GET) || empty($_GET['code'])) {
			return $this->codeError();
		}

		$url = 'https://graph.facebook.com/oauth/access_token';
		$params = $this->buildParams();
		$response = HttpClient::get($url, $params);
		parse_str($response, $results);

		if (empty($results) || empty($results['access_token'])) {
			return $this->tokenError();
		}

		$me = $this->me($results['access_token']);

		$response = new Response($this->strategy['provider'], $me);
		$response->credentials = array(
			'token' => $results['access_token'],
			'expires' => date('c', time() + $results['expires'])
		);
		$response->info['image'] = 'https://graph.facebook.com/'. $me['id'] . '/picture?type=square';
		$response->setMap($this->responseMap);
		return $response;
	}

	/**
	 * Helper method for callback()
	 *
	 * @return array Parameter array
	 */
	protected function buildParams() {
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
			'provider' => $this->strategy['provider'],
			'code' => $_GET['error'],
			'message' => $_GET['error_description'],
			'raw' => $_GET
		);

		return $this->errorCallback($error);
	}

	/**
	 *
	 * @return returns
	 */
	protected function tokenError() {
		$error = array(
			'provider' => $this->strategy['provider'],
			'code' => 'access_token_error',
			'message' => 'Failed when attempting to obtain access token',
			'raw' => HttpClient::$responseHeaders
		);

		return $this->errorCallback($error);
	}

	/**
	 * Queries Facebook Graph API for user info
	 *
	 * @param string $access_token
	 * @return array Parsed JSON results
	 */
	protected function me($access_token) {
		$me = HttpClient::get('https://graph.facebook.com/me', array('access_token' => $access_token));
		if (empty($me)) {
			$error = array(
				'provider' => 'Facebook',
				'code' => 'me_error',
				'message' => 'Failed when attempting to query for user information',
				'raw' => array(
					'response' => $me,
					'headers' => HttpClient::$responseHeaders
				)
			);

			return $this->errorCallback($error);
		}
		return $this->recursiveGetObjectVars(json_decode($me));
	}
}