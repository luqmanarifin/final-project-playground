<?php
require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/dotenv-loader.php';

use Auth0\SDK\Auth0;

$domain        = getenv('AUTH0_DOMAIN');
$client_id     = getenv('AUTH0_CLIENT_ID');
$client_secret = getenv('AUTH0_CLIENT_SECRET');
$redirect_uri  = getenv('AUTH0_CALLBACK_URL');

echo $domain."</br>";
echo $client_id."</br>";
echo $client_secret."</br>";
echo $redirect_uri."</br>";

$auth0 = new Auth0(array(
    'domain'        => $domain,
    'client_id'     => $client_id,
    'client_secret' => $client_secret,
    'redirect_uri'  => $redirect_uri,
));

$profile = $auth0->getUser();

if (!$profile) {

    $authorize_url = 'https://'.$domain.'/authorize?response_type=code&scope=openid&client_id='.$client_id.'&redirect_uri=' . $redirect_uri;

    header("Location: $authorize_url");
    exit;
}

var_dump($profile);
