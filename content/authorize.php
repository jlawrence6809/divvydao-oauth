<?php

if(!$_SESSION['accessToken']){
	// If we don't have an authorization code then get one
	if (!isset($_GET['code'])) {

	    // Fetch the authorization URL from the provider; this returns the
	    // urlAuthorize option and generates and applies any necessary parameters
	    // (e.g. state).
	    $authorizationUrl = getProvider()->getAuthorizationUrl();

	    // Get the state generated for you and store it to the session.
	    $_SESSION['oauth2state'] = getProvider()->getState();

	    // Redirect the user to the authorization URL.
	    error_log("redirecting to mattermost auth endpoint");
	    header('Location: ' . $authorizationUrl);
	    exit;

	// Check given state against previously stored one to mitigate CSRF attack
	} elseif (empty($_GET['state']) || ($_GET['state'] !== $_SESSION['oauth2state'])) {
		error_log('state not in session. possible csrf attack');
	    unset($_SESSION['oauth2state']);
	    exit('Invalid state');
	} else {
	    try {
	        // Try to get an access token using the authorization code grant.
	        $accessToken = getProvider()->getAccessToken('authorization_code', [
	            'code' => $_GET['code']
	        ]);

	        $_SESSION['accessToken'] = $accessToken;

	        // We have an access token, which we may use in authenticated
	        // requests against the service provider's API.
	        error_log('Access token info:');
	        error_log( $accessToken->getToken());
	        error_log( $accessToken->getRefreshToken());
	        error_log( $accessToken->getExpires());
	        error_log( ($accessToken->hasExpired() ? 'expired' : 'not expired') . "\n");
	        header('Location: '.'/'.config('root'));
	    } catch (\League\OAuth2\Client\Provider\Exception\IdentityProviderException $e) {
	    	error_log('could not get token');
	        // Failed to get the access token or user details.
	        exit($e->getMessage());
	    }
	}
} else {
	print('already authorized');
	header('Location: '.'/'.config('root'));
}