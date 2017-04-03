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

class FacebookStrategy extends OpauthStrategy{

	/**
	 * Compulsory config keys, listed as unassociative arrays
	 * eg. array('app_id', 'app_secret');
	 */
	public $expects = array('app_id', 'app_secret');

	/**
	 * Optional config keys with respective default values, listed as associative arrays
	 * eg. array('scope' => 'email');
	 */
	public $defaults = array(
		'redirect_uri' => '{complete_url_to_strategy}int_callback'
	);

	/**
	 * Auth request
	 */
	public function request(){
		$url = 'https://www.facebook.com/v2.8/dialog/oauth';
		$params = array(
			'client_id' => $this->strategy['app_id'],
			'redirect_uri' => $this->strategy['redirect_uri']
		);

		if (!empty($this->strategy['scope'])) $params['scope'] = $this->strategy['scope'];
		if (!empty($this->strategy['state'])) $params['state'] = $this->strategy['state'];
		if (!empty($this->strategy['response_type'])) $params['response_type'] = $this->strategy['response_type'];
		if (!empty($this->strategy['display'])) $params['display'] = $this->strategy['display'];
		if (!empty($this->strategy['auth_type'])) $params['auth_type'] = $this->strategy['auth_type'];

		$this->clientGet($url, $params);
	}

	/**
	 * Internal callback, after Facebook's OAuth
	 */
	public function int_callback(){
		if (array_key_exists('code', $_GET) && !empty($_GET['code'])){
			$url = 'https://graph.facebook.com/oauth/access_token';
			$params = array(
				'client_id' =>$this->strategy['app_id'],
				'client_secret' => $this->strategy['app_secret'],
				'redirect_uri'=> $this->strategy['redirect_uri'],
				'code' => trim($_GET['code'])
			);
			$response = $this->serverGet($url, $params, null, $headers);
			$results = json_decode($response);
			
			if (!empty($results) && !empty($results->access_token)){
				$me = $this->me($results->access_token);
				$this->auth = array(
					'provider' => 'Facebook',
					'uid' => $me->id,
					'info' => array(
						'name' => $me->name,
						'image' => 'https://graph.facebook.com/v2.8/'.$me->id.'/picture?type=large'
					),
					'credentials' => array(
						'token' => $results->access_token,
						'expires' => date('c', time() + $results->expires_in)
					),
					'raw' => $me
				);

				if (!empty($me->email)) $this->auth['info']['email'] = $me->email;
				if (!empty($me->name)) $this->auth['info']['nickname'] = $me->name;
				if (!empty($me->first_name)) $this->auth['info']['first_name'] = $me->first_name;
				if (!empty($me->last_name)) $this->auth['info']['last_name'] = $me->last_name;
				if (!empty($me->link)) $this->auth['info']['urls']['facebook'] = $me->link;

				/**
				 * Missing optional info values
				 * - description
				 * - phone: not accessible via Facebook Graph API
				 */

				$this->callback();
			}
			else{
				$error = array(
					'provider' => 'Facebook',
					'code' => 'access_token_error',
					'message' => 'Failed when attempting to obtain access token',
					'raw' => $headers
				);

				$this->errorCallback($error);
			}
		}
		else{
			$error = array(
				'provider' => 'Facebook',
				'code' => $_GET['error_code'],
				'message' => $_GET['error_message'],
				'raw' => $_GET
			);

			$this->errorCallback($error);
		}
	}

	/**
	 * Queries Facebook Graph API for user info
	 *
	 * @param string $access_token
	 * @return array Parsed JSON results
	 */
	private function me($access_token){
		
        $fields = 'id,name,email';//default value
		if ( isset($this->strategy['fields']) ) {
			$fields = $this->strategy['fields'];
		}

		$me = $this->serverGet('https://graph.facebook.com/v2.8/me', array('access_token' => $access_token, 'fields' => $fields), null, $headers);
        
		if (!empty($me)){
			return json_decode($me);
		}
		else{
			$error = array(
				'provider' => 'Facebook',
				'code' => 'me_error',
				'message' => 'Failed when attempting to query for user information',
				'raw' => array(
					'response' => $me,
					'headers' => $headers
				)
			);

			$this->errorCallback($error);
		}
	}
}