<?php
session_start();
require 'facebook-php-sdk-master/src/facebook.php';

$facebook = new Facebook(array(
  'appId'  => '215611218607442',
  'secret' => '6765f0d0646459dafd11b2c93929a1b6',
));


$appId = '215611218607442';
$secret = '6765f0d0646459dafd11b2c93929a1b6';

// Get User ID

$access_token = $facebook->getAccessToken();
//$facebook->setAccessToken($access_token);




$user= $facebook->getUser();

if ($user) {
  $logoutUrl = $facebook->getLogoutUrl();
} else {
// redirect to Facebook login to get a fresh user access_token
  $loginUrl = $facebook->getLoginUrl();

}

if($user)
echo "ok";
else
{
echo "not ok";
echo "<a href='$loginUrl'>Login with Facebook</a>";
}

if($user)
{
$ret_obj = $facebook->api('/me/feed', 'POST', array( 'link' => 'www.example.com', 'message' => 'Posting with the PHP SDK!', 'access_token' => $access_token));
}
?>
