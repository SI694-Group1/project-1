<?php
session_start();

require_once "db.php";
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
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Edit</title>
   <?php
    include 'header.php'
  ?>
</head>
<body>
  <div class="page edit-page">
    <h1> <strong>Step3|</strong>
      Edit
    </h1>
    <div class="container">
      <div class="edit-wrapper">
        <form method="post" action="input.php">
        <div class="row bottom-plus">
          <div class="form-group">
            <input type="text" name="questext" class="form-control input-hg" placeholder="Start from a question" />
            <span class="input-icon fui-new"></span>
          </div>
        </div>
        <!-- end row -->
        <div class="row bottom-minus">
          <div class="form-group">
            <input type="text" name="opt1" class="form-control input-hg" placeholder="Option 1" />
            <span class="input-icon fui-radio-unchecked"></span>
          </div>
        </div>
        <!-- end row -->
        <div class="row bottom-minus">
          <div class="form-group">
            <input type="text" name="opt2" class="form-control input-hg" placeholder="Option 2" />
            <span class="input-icon fui-radio-unchecked"></span>
          </div>
        </div>
        <!-- end row -->
        <div class="row bottom-minus">
          <div class="form-group">
            <input type="text" name="opt3" class="form-control input-hg" placeholder="Option 3" />
            <span class="input-icon fui-radio-unchecked"></span>
          </div>
        </div>
        <!-- end row -->
        <div id="addBtnRow" class="row bottom-plus">
          <div class="form-group">
            <a id="addBtn" class="btn btn-primary btn-lg btn-block btn-danger" href="#">Add</a>
          </div>
        </div>
 
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

  <script id="optionTemplate" type="text/x-jquery-tmpl">
        <div class="row bottom-minus">
          <div class="form-group">
            <h1>${optionIndex}</h1>
            <input type="text" class="form-control input-hg" placeholder="Option ${optionIndex}" />     
            <span class="input-icon"></span>
          </div>
        </div>
      </script>

  <script>
      $(document).ready(function() {
        //Do something
        var optionIndex = 3;
        $('#addBtn').click(function(event) {
          // Act on the event
          if (optionIndex >= 3) {
            optionIndex = optionIndex + 1;
          }
          $('#optionTemplate').tmpl({'optionIndex':optionIndex})
            .insertBefore('#addBtnRow').hide().slideDown();
          $('span.close').removeClass('fui-cross close');
          $('span.input-icon').last().addClass('fui-cross close');
          $('span.close').click(function(event) {
            // Act on the event
            if (optionIndex > 3) {
              optionIndex = optionIndex - 1;
            }
            $(this).parent().parent().slideUp('normal', function() { 
              $(this).remove();
              if($('span.input-icon').size() > 4) {
                $('span.input-icon').last().addClass('fui-cross close');
              }
            });
          });
        });
      });    
      </script>
</body>
</html>
