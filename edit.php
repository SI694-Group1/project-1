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

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <?php
  include 'header.php'
  ?>
  <script type="text/javascript">
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '1423350391211975', // replace your app id here
      status     : true, 
      cookie     : true, 
      xfbml      : true  
    });
  };
  (function(d){
    var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
    if (d.getElementById(id)) {return;}
    js = d.createElement('script'); js.id = id; js.async = true;
    js.src = "//connect.facebook.net/en_US/all.js";
    ref.parentNode.insertBefore(js, ref);
  }(document));
  
  function FBLogout(){
    FB.logout(function(response) {
      window.location.href = "logout.php";
    });
  }
  </script>
</head>
<body>
  <div class="page edit-page">
   <div class="navbar navbar-inverse navbar-fixed-top">
    <div class="navbar-header">
      <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target="#nav-collapse-01"></button>
    </div>
    <div class="navbar-collapse collapse" id="nav-collapse-01">
      <ul class="nav">
        <li>
          <a href="login.php">
            <i class="fui-user"></i>
            <span>Step1</span>
          </a>
        </li>
        <li class="active">
          <a href="edit.php">
            <i class="fui-new"></i>
            <span>Step2</span>
          </a>
        </li>
        <li>
          <a href="friend.php">
            <i class="fui-search"></i>
            <span>Step3-Friend</span>
          </a>
        </li>
        <li>
          <a href="result.php">
            <i class="fui-eye"></i>
            <span>Step4-Result</span>
          </a>
        </li>
      </ul><!-- /left nav -->
      <ul class="nav pull-right">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            Welcome, <?php echo $user_profile['name']; ?> <b class="caret"></b>
          </a>
          <ul class="dropdown-menu">
            <li>
              <a onclick="FBLogout();">
                <span class="fui-user" style="padding-left: 5px;"></span>
                <span style="padding-left: 10px;">Logout</span>
              </a>
            </li>
          </ul>
        </li>
      </ul><!-- /right nav -->
    </div>
  </div><!-- /navbar -->    
  <h1> <strong>Step3|</strong>
    Edit
  </h1>
  <div class="container">
    <div class="edit-wrapper">
      <div class="row bottom-plus">
        <div class="form-group">
          <input type="text" class="form-control input-hg" placeholder="Start from a question" />
          <span class="input-icon fui-new"></span>
        </div>
      </div>
      <!-- end row -->
      <div class="row bottom-minus">
        <div class="form-group">
          <input type="text" class="form-control input-hg" placeholder="Option 1" />
          <span class="input-icon fui-radio-unchecked"></span>
        </div>
      </div>
      <!-- end row -->
      <div class="row bottom-minus">
        <div class="form-group">
          <input type="text" class="form-control input-hg" placeholder="Option 2" />
          <span class="input-icon fui-radio-unchecked"></span>
        </div>
      </div>
      <!-- end row -->
      <div class="row bottom-minus">
        <div class="form-group">
          <input type="text" class="form-control input-hg" placeholder="Option 3" />
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
          <a id="submitBtn" class="btn btn-primary btn-lg btn-block" href="do_edit.php">Submit</a>
        </div>
      </div>
    </div>
  </div>
</div>

<?php
include 'footer.php'
?>

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
