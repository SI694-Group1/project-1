<?php 
    session_start();        //start session
    $_SESSION = array();    //clear session array  
    session_destroy();      //destroy session
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Logout</title>
  <?php
    include 'header.php'
  ?>
</head>

<body>
  <div class="page logout-page">
    <h1> <strong>Success|</strong>
      Logout
    </h1>
    <div class="login-wrapper">
      <div class="row">
        <a class="btn btn-lg btn-primary btn-block" href="login.php">Return to the login page</a>
      </div>
    </div>
  </div>

  <?php
  include 'footer.php'
  ?>
</body>
</html>
