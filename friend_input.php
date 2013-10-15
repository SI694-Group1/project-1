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

/*function is_iterable($var)
{
    return $var !== null 
        && (is_array($var) 
            || $var instanceof Iterator 
            || $var instanceof IteratorAggregate
            );
}*/

//getting the vaues from the POST 
/*echo ($_POST['json']);*/
$userarray = $_POST['json'];
$userarrayToDb = explode(",", $userarray);
/*$userarrayToDb = implode("array_separator", $userarray);*/
echo($userarrayToDb[0]);
mysql_select_db("facebookapi_project1");
//inserting question details

$results1 = "INSERT INTO results
          (UID)
          VALUES
          ('$user');";
//inserting option details
mysqli_query($con, $results1);  //execute question details insert

    foreach ($userarrayToDb as $value) 
    {
      $results2 = "INSERT INTO results (UID) VALUES ('$value');";
      echo "$results2";
      mysqli_query($con, $results2);  //execute question details insert
    }

$results3 = "UPDATE results
              SET QID = (SELECT max(QID) from question WHERE UID = '$user')
              WHERE QID IS NULL;";
//inserting option details
mysqli_query($con, $results3);  //execute question details insert
$userpost = "SELECT max(QID) from question WHERE UID = '$user';";
if($user)
{
$ret_obj = $facebook->api('/me/feed', 'POST', array( 'link' => 'http://localhost/project-1/participant-response.php/?qid=', 'message' => 'Please take this survey', 'access_token' => $access_token));
}

?>