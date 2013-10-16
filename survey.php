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

// while($row = mysqli_fetch_array($resultques))
//   {
//   echo $row['QuesText'];
//   echo "<br>";
//   }
//   echo "<br>";

$resultopt = mysqli_query($con,"SELECT OpText from options where QID = (SELECT max(QID) from question where UID = '$user')");

// while($row = mysqli_fetch_array($resultopt))
//   {
//   echo $row['OpText'];
//   echo "<br>";
//   }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Edit</title>
  <?php
    include 'header.php'
  ?>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Loading Bootstrap -->
  <link href="bootstrap/css/bootstrap.css" rel="stylesheet">

  <!-- Loading Flat UI -->
  <link href="css/flat-ui.css" rel="stylesheet">
  <link rel="shortcut icon" href="images/favicon.ico">

  <!-- Loading customized UI -->
  <link href="css/style.css" rel="stylesheet">

  <!-- HTML5 shim, for IE6-8 support of HTML5 elements. All other JS at the end of file. -->
  <!--[if lt IE 9]>
  <script src="js/html5shiv.js"></script>
  <![endif]-->
</head>
<body>
  <div class="page edit-page">
    <h1>
      Survey
    </h1>
    <div class="container">
      <div class="edit-wrapper">
        <form method="post" action="input.php">
        <div class="row bottom-plus">
          <div class="form-group">
            <label class="radio">
              <?php 
                while($row = mysqli_fetch_array($resultques)) {
                  echo $row['QuesText'];
                 }
              ?>
            </label>
          </div>
        </div>
        <!-- end row -->
        <div class="row">
          <div class="form-group">
            <label class="radio">
              <input type="radio" name="group1" value="1" data-toggle="radio">
              <?php 
                while($row = mysqli_fetch_array($resultopt)) {
                  echo $row['OpText'];
                }
              ?>
            </label>
          </div>
        </div>
        <!-- end row -->
        <div class="row">
          <div class="form-group">
            <label class="radio">
              <input type="radio" name="group1" value="1" data-toggle="radio">
              <?php 
                while($row = mysqli_fetch_array($resultopt)) {
                  echo $row['OpText'];
                }
              ?>
            </label>
          </div>
        </div>
        <!-- end row -->
        <div class="row">
          <div class="form-group">
            <label class="radio">
              <input type="radio" name="group1" value="1" data-toggle="radio">
              <?php 
                while($row = mysqli_fetch_array($resultopt)) {
                  echo $row['OpText'];
                }
              ?>
            </label>
          </div>
        </div>
        <!-- end row -->
 
        <div id="submitBtnRow" class="row">
          <div class="form-group">
            <input type ="submit" id="submitBtn" class="btn btn-primary btn-lg btn-block" value="Submit">
          </div>
        </div>

      </form>
      </div>
    </div>
  </div>
  <!-- Load JS here for greater good -->
  <script src="js/jquery-1.8.3.min.js"></script>
  <script src="js/jquery-ui-1.10.3.custom.min.js"></script>
  <script src="js/jquery.ui.touch-punch.min.js"></script>
  <script src="js/jquery.tmpl.min.js"></script>
  <script src="js/jquery.tagsinput.js"></script>
  <script src="js/jquery.placeholder.js"></script>

  <script src="js/bootstrap.min.js"></script>
  <script src="js/bootstrap-select.js"></script>
  <script src="js/bootstrap-switch.js"></script>

  <script src="js/flatui-checkbox.js"></script>
  <script src="js/flatui-radio.js"></script>

</body>
</html>
