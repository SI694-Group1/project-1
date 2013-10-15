<?php
session_start();
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


//getting the vaues from the POST 

$QuesText = $_POST['questext'];
$opt1 = $_POST['opt1'];
$opt2 = $_POST['opt2'];
$opt3 = $_POST['opt3'];

mysql_select_db("facebookapi_project1");
//inserting question details
$question = "INSERT INTO question
      		(UID, QuesText)
      		VALUES
      		('$user',
      		'$QuesText');";
//inserting option details
mysqli_query($con, $question);  //execute question details insert

$opt_details1 = "INSERT INTO options
     			(QID, OpText)
      			SELECT QID, '".$opt1."'
      			FROM question
      			WHERE UID=$user;";

$opt_details2 = "INSERT INTO options
     			(QID, OpText)
      			SELECT QID, '".$opt2."'
      			FROM question
      			WHERE UID=$user;";
$opt_details3 = "INSERT INTO options
     			(QID, OpText)
      			SELECT QID, '".$opt3."'
      			FROM question
      			WHERE UID=$user;";

/*"INSERT INTO options (QID, OpText)
				SELECT q.QID, o.OpText
				FROM  (
   					VALUES
      					('$user', '$opt1')
     					,('$user', '$opt2')
     					,('$user', '$opt3')
   						) o (UID, OpText)
					LEFT JOIN question q USING (UID);";*/
mysqli_query($con, $opt_details1);
mysqli_query($con, $opt_details2);
mysqli_query($con, $opt_details3);  //execute options insert
header("Location: friend.php");
?>