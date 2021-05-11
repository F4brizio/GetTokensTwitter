<?php
session_start();
require_once 'vendor/autoload.php';
use Abraham\TwitterOAuth\TwitterOAuth;

$Config = require_once 'config.php';

$oauth_verifier = filter_input(INPUT_GET, 'oauth_verifier');

if (empty($oauth_verifier) || 
	empty($_SESSION['oauth_token']) || 
	empty($_SESSION['oauth_token_secret'])){
    header("Location: {$config['url_login']}");
}

$connection = new TwitterOAuth(
    $Config['consumer_key'],
    $Config['consumer_secret'],
    $_SESSION['oauth_token'],
    $_SESSION['oauth_token_secret']
);

$token = $connection->oauth(
    'oauth/access_token', ['oauth_verifier' => $oauth_verifier]
);

?>

<pre>
	<?php print_r([$token["oauth_token"],$token["oauth_token_secret"]]) ?>
</pre>