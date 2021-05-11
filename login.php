<?php 

session_start();
require 'vendor/autoload.php';
use Abraham\TwitterOAuth\TwitterOAuth;

$Config = require_once 'config.php';

$TwitterOAuth = new TwitterOAuth(
	$Config['consumer_key'], 
	$Config['consumer_secret']
);

$request_token = $TwitterOAuth->oauth(
	'oauth/request_token', 
	['oauth_callback' => $Config['url_callback']]
);

if($TwitterOAuth->getLastHttpCode() != 200) {
    echo "There was a problem performing this request.";
}


$_SESSION['oauth_token'] = $request_token['oauth_token'];
$_SESSION['oauth_token_secret'] = $request_token['oauth_token_secret'];

$url = $TwitterOAuth->url(
    'oauth/authenticate', ['oauth_token' => $request_token['oauth_token']]
);

 header("location: {$url}");

?>