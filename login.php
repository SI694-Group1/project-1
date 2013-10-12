<?php

require 'src/facebook.php';

// Create our Application instance
$facebook = new Facebook(array(
  'appId'  => '1423350391211975',
  'secret' => '8fdbeefaefd334de090d7ebe8c27d92d',
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
  $logoutUrl = $facebook->getLogoutUrl();
} else {
  $loginUrl = $facebook->getLoginUrl();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Login</title>
  <?php
    include 'header.php'
  ?>
</head>
<body>
  <div class="page login-page">
    <h1> <strong>Step1|</strong>
      Login
    </h1>
    <div class="login-wrapper">
      <div class="row">
        <div class="col-md-2">
          <?php 
          if($user) {
            echo '<img src="https://graph.facebook.com/'.$user.'/picture?width=100&height=100">';
            echo '<h5>Hi, '.$user_name.'</h5>';
          } else {
            echo '<h5>Welcome to Vote App!</h5>';
          }    
          ?>
        </div>
        <div class="col-md-10">
          <div class="login-form">
            <?php if ($user): ?>
            <a class="btn btn-primary btn-lg btn-block" href="friend.php">Already Login. Let's Get Start!</a>
          <?php else: ?>
          <div>
            <a class="btn btn-primary btn-lg btn-block" href="<?php echo $loginUrl; ?>">Please Login to Facebook</a>
          </div>
        <?php endif ?>
      </div>
    </div>
  </div>
</div>
</div>

<?php
  include 'footer.php'
?>

</body>
</html>
