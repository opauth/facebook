Opauth-Facebook
===============
[Opauth][1] strategy for Facebook authentication.

Implemented based on https://developers.facebook.com/docs/authentication/


Getting Started
---------------
1. Set up [Opauth][1]
2. Place this at `path_to_opauth/lib/Opauth/Strategy/Facebook/`
3. Add the following to Opauth config's `Strategy` array:

	```php
	<?php
		'Facebook' => array(
			'app_id' => 'YOUR OWN FACEBOOK APP ID',
			'app_secret' => 'YOUR OWN FACEBOOK APP SECRET KEY'
		)
	```

4. Send users to `://path_to_opauth/facebook` for authentication.

Strategy parameters
-----------------------

### Required
`app_id`, `app_secret`

### Optional
`scope`, `state`, `response_type`, `display`

Refer to Facebook's [OAuth Dialog documentation](https://developers.facebook.com/docs/reference/dialogs/oauth/) for details on these parameters

License
---------
The MIT License  
Copyright © 2012 U-Zyn Chua (http://uzyn.com)

[1]: https://github.com/uzyn/opauth