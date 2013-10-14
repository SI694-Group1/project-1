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
  <div class="page result-page">
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
        <li>
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
        <li class="active">
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
  <div class="row">
    <h1> <strong>Step4|</strong>
      Result
    </h1>
  </div>
  <div class="container">
    <div class="result-wrapper">
      <div class="row">
        <div class="col-md-4">
          <nav id="dr-menu" class="dr-menu">
            <div class="dr-trigger">
              <span class="dr-icon dr-icon-menu"></span>
              <a class="dr-label">Question</a>
            </div>
            <ul>
              <li>
                <span class="input-icon fui-radio-unchecked"></span>
                <a href="#">option 1&nbsp;-&nbsp;55%</a>
              </li>
              <li>
                <span class="input-icon fui-radio-unchecked"></span>
                <a href="#">option 2&nbsp;-&nbsp;25%</a>
              </li>
              <li>
                <span class="input-icon fui-radio-unchecked"></span>
                <a href="#">option 3&nbsp;-&nbsp;20%</a>
              </li>
            </ul>
          </nav>
        </div>
        <div class="col-md-8">
          <div id="chartBG">
            <div id="barChartContainer" style="max-width:700px;height: 300px;"></div>
          </div>
        </div>
      </div>
      <div class="row top-plus">
        <div class="col-md-8 col-md-offset-4">
          <div id="commentBG">
            <div id="resultComments" class="fb-comments" data-href="http://localhost/project-1/result.php" data-numposts="5" data-width="670px"></div>            
          </div>
        </div>
      </div>
    </div>
    <!-- /result-wrapper --> </div>
  </div>

  <?php
  include 'footer.php'
  ?>
  <script>
  
  $(document).ready(function() {
        //Do something
        $("#barChartContainer").dxChart({
          dataSource: [
          {option: "option1", value: 55},
          {option: "option2", value: 25},
          {option: "option3", value: 20},
          ],
          series: {
            argumentField: "option",
            valueField: "value",
            name: "percentage",
            type: "bar",
            color: '#ffa500'
          },
          tooltip: {
            enabled: true,
            customizeText: function () {
              return this.seriesName + ": " + this.valueText + " %";
            }
          },
          title: {
            text: "Bar Chart Result",
            font: { 
              color: '#fff',
              size: 24,
            }
          },
          argumentAxis: {
            label: {
              font: { 
                color: '#fff',
                size: 18, 
              }
            }
          },
          legend: {
            font: { 
              color: '#fff',
              size: 18, 
            }
          },
          scale: {
            label: {
              font: {
                color: '#fff',
                size: 18,
              }
            }
          }                               
        });

var YTMenu = (function() {
  function init() {
    [].slice.call( document.querySelectorAll( '.dr-menu' ) ).forEach( function( el, i ) {

      var trigger = el.querySelector( 'div.dr-trigger' ),
      icon = trigger.querySelector( 'span.dr-icon-menu' ),
      open = false;

      trigger.addEventListener( 'click', function( event ) {
        if( !open ) {
          el.className += ' dr-menu-open';
          open = true;
        }
      }, false );

      icon.addEventListener( 'click', function( event ) {
        if( open ) {
          event.stopPropagation();
          open = false;
          el.className = el.className.replace(/\bdr-menu-open\b/,'');
          return false;
        }
      }, false );

    } );
  }
  init();
})();
});
</script>
</body>
</html>