<?php
class FacebookStrategy extends OpauthStrategy {

    public $expects = array('app_id', 'app_secret');

    public $defaults = array(
        'redirect_uri' => '{complete_url_to_strategy}int_callback',
        'scope' => 'email', // Default scope for necessary permissions
    );

    private $api_version = 'v17.0'; // Update to the latest supported version

    public function request() {
        $params = array(
            'client_id' => $this->strategy['app_id'],
            'redirect_uri' => $this->strategy['redirect_uri'],
            'scope' => $this->strategy['scope'],
        );

        if (!empty($this->strategy['api_version'])) {
            $params['api_version'] = $this->strategy['api_version'];
            $this->api_version = $this->strategy['api_version'];
        }
        $url = "https://www.facebook.com/{$this->api_version}/dialog/oauth";

        // Other optional parameters
        if (!empty($this->strategy['state'])) $params['state'] = $this->strategy['state'];
        if (!empty($this->strategy['response_type'])) $params['response_type'] = $this->strategy['response_type'];
        if (!empty($this->strategy['display'])) $params['display'] = $this->strategy['display'];
        if (!empty($this->strategy['auth_type'])) $params['auth_type'] = $this->strategy['auth_type'];

        $this->clientGet($url, $params);
    }

    public function int_callback() {
        if (empty($_GET['code'])) {
            $error = array(
                'provider' => 'Facebook',
                'code' => isset($_GET['error_code']) ? $_GET['error_code'] : 'unknown_error',
                'message' => isset($_GET['error_message']) ? $_GET['error_message'] : 'Unknown error occurred',
                'raw' => $_GET
            );

            $this->errorCallback($error);
            return;
        }

        $url = 'https://graph.facebook.com/oauth/access_token';
        $params = array(
            'client_id' => $this->strategy['app_id'],
            'client_secret' => $this->strategy['app_secret'],
            'redirect_uri' => $this->strategy['redirect_uri'],
            'code' => trim($_GET['code'])
        );

        $response = $this->serverGet($url, $params, null, $headers);
        $results = json_decode($response);

        if (empty($results) || empty($results->access_token)) {
            $error = array(
                'provider' => 'Facebook',
                'code' => 'access_token_error',
                'message' => 'Failed when attempting to obtain access token',
                'raw' => $headers
            );

            $this->errorCallback($error);
            return;
        }

        // Store the access token securely, for example, in a session or database
        $securely_stored_access_token = $results->access_token;

        // Fetch user info using the access token
        $me = $this->me($securely_stored_access_token);
        if (empty($me)) {
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
            return;
        }

        // Prepare the user information for Opauth callback
        $this->auth = array(
            'provider' => 'Facebook',
            'uid' => $me->id,
            'info' => array(
                'name' => $me->name,
                'image' => "https://graph.facebook.com/{$this->api_version}/{$me->id}/picture?type=large"
            ),
            'credentials' => array(
                'token' => $securely_stored_access_token,
                'expires' => date('c', time() + $results->expires_in)
            ),
            'raw' => $me
        );

        // Optional user info
        if (!empty($me->email)) $this->auth['info']['email'] = $me->email;
        if (!empty($me->name)) $this->auth['info']['nickname'] = $me->name;
        if (!empty($me->first_name)) $this->auth['info']['first_name'] = $me->first_name;
        if (!empty($me->last_name)) $this->auth['info']['last_name'] = $me->last_name;
        if (!empty($me->link)) $this->auth['info']['urls']['facebook'] = $me->link;

        $this->callback();
    }

    private function me($access_token) {
        $fields = 'id,name,email'; // Default fields
        if (isset($this->strategy['fields'])) {
            $fields = $this->strategy['fields'];
        }

        if (!empty($this->strategy['api_version'])) {
            $this->api_version = $this->strategy['api_version'];
        }

        $me = $this->serverGet(
            "https://graph.facebook.com/{$this->api_version}/me",
            array(
                'appsecret_proof' => hash_hmac('sha256', $access_token, $this->strategy['app_secret']),
                'access_token' => $access_token,
                'fields' => $fields
            ),
            null,
            $headers
        );

        if (empty($me)) {
            return null;
        }

        return json_decode($me);
    }
}
