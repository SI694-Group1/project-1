<?php
ob_start();
//import db.php
require 'db.php';
require 'src/facebook.php';
// Create our Application instance
$facebook = new Facebook(array(
  'appId'  => '247494068733111',
  'secret' => '4d1cf9e49da91b643565894cbdffad88',
));

// Get User ID
$user = $facebook->getUser();

// Get access token
$access_token = $facebook->getAccessToken();

if ($user) {
  try {
    // Proceed knowing you have a logged in user who's authenticated.
    $user_profile = $facebook->api('/me');
    $user_name = $user_profile['name'];
  } catch (FacebookApiException $e) {
    error_log($e);
    $user = null;
  }
}

// Login or logout url will be needed depending on current user state.
if ($user) {
  $params = array( 'next' => 'http://localhost/project-1/logout.php' );
  $logoutUrl = $facebook->getLogoutUrl($params);
} else {
  $loginUrl = $facebook->getLoginUrl();
}
mysql_select_db("facebookapi_project1");

$resultques = mysqli_query($con,"SELECT QuesText from question where QID = (SELECT max(QID) from question where UID = '$user')");

while($row = mysqli_fetch_array($resultques))
  {
  echo $row['QuesText'];
  echo "<br>";
  }
  echo "<br>";

$resultopt = mysqli_query($con,"SELECT OpText from options where QID = (SELECT max(QID) from question where UID = '$user')");

while($row = mysqli_fetch_array($resultopt))
  {
  echo $row['OpText'];
  echo "<br>";
  }
?>
