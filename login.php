<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Login</title>
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
  <div class="page login-page">
    <h1> <strong>Step1|</strong>
      Login
    </h1>
    <div class="login-wrapper">
      <div class="login-icon">
        <img src="./images/login/facebook.png" alt="Welcome to Vote" />
        <h4>
          Welcome to
          <small>Vote</small>
        </h4>
      </div>

      <div class="login-form">
        <div class="form-group">
          <input type="text" class="form-control login-field" value="" placeholder="Username" id="login-name" />
          <label class="login-field-icon fui-user" for="login-name"></label>
        </div>

        <div class="form-group">
          <input type="password" class="form-control login-field" value="" placeholder="Password" id="login-pass" />
          <label class="login-field-icon fui-lock" for="login-pass"></label>
        </div>

        <!-- <a class="btn btn-primary btn-lg btn-block" href="#">Login</a>
        <a class="login-link" href="$loginUrl">Please login with your facebook account</a> -->
        
        
        <?php

require 'facebook-php-sdk-master/src/facebook.php';

$facebook = new Facebook(array(
  'appId'  => '215611218607442',
  'secret' => '6765f0d0646459dafd11b2c93929a1b6',
));

// Get User ID
$userx = $facebook->getUser();

// We may or may not have this data based on whether the user is logged in.
//
// If we have a $user id here, it means we know the user is logged into
// Facebook, but we don't know if the access token is valid. An access
// token is invalid if the user logged out of Facebook.

if ($userx) {
  try {
    // Proceed knowing you have a logged in user who's authenticated.
    $user_profile = $facebook->api('/me');
  } catch (FacebookApiException $e) {
    error_log($e);
    $userx = null;
  }
}

// Login or logout url will be needed depending on current user state.
if ($userx) {
  $params = array( 'next' => 'http://localhost:8888/project-1/login.php' );
  $logoutUrl = $facebook->getLogoutUrl($params);
  session_destroy();
} else {
  $loginUrl = $facebook->getLoginUrl();
}

?>
        
        
    <?php if ($userx): ?>
      <a href="<?php echo $logoutUrl; ?>">Logout</a>
    <?php else: ?>
      <div>
        <a href="<?php echo $loginUrl; ?>">Login with Facebook</a>
      </div>
    <?php endif ?>
        
        
        <?php if($userx): ?>
          <h3> Welcome, </h3>
          <img src="https://graph.facebook.com/<?php echo $userx; ?>/picture">
        
        <?php endif ?>
        
      </div>
    </div>
  </div>

  <!-- Load JS here for greater good -->
  <script src="js/jquery-1.8.3.min.js"></script>
  <script src="js/jquery-ui-1.10.3.custom.min.js"></script>
  <script src="js/jquery.ui.touch-punch.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/bootstrap-select.js"></script>
  <script src="js/bootstrap-switch.js"></script>
  <script src="js/flatui-checkbox.js"></script>
  <script src="js/flatui-radio.js"></script>
  <script src="js/jquery.tagsinput.js"></script>
  <script src="js/jquery.placeholder.js"></script>
  <script>
      $(document).ready(function() {
          //Do something
        });
      </script>
</body>
</html>
