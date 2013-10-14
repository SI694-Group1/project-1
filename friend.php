<?php

session_start();
require_once "db.php";
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
    $friends = $facebook->api('/me/friends');
  } catch (FacebookApiException $e) {
    error_log($e);
    $user = null;
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Friend</title>
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
  <div class="page friend-page">
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
          <li class="active">
            <a href="friend.php">
              <i class="fui-search"></i>
              <span>Step3-Friend</span>
            </a>
          </li>
          <li>
            <a href="result.php">
              <i class="fui-eye"></i>
              <span>Step4</span>
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
    <h1>
      <strong>Step3|</strong>
      Friend
    </h1>
    <div class="container">
      <div class="friend-wrapper">
        <div class="row" id="search-bar">
          <div class="col-md-5 col-md-offset-3">
            <div class="todo-search">
              <input id="weird-name" name="weird-name" type="text" class="todo-search-field autocomplete weird-names" autocomplete="off"></div>
            </div>
            <div class="col-md-1">
              <input type="submit" value="Search" class="btn btn-lg btn-info" id="searchBtn"></div>
            </div><!-- /search-bar -->

            <div id="gallery-container">
              <div id="gallery"></div>
            </div><!-- /gallery-container -->

            <div id="submitBtnRow" class="row top-plus">
              <div class="col-md-12">
                <div class="form-group">
                  <a id="submitBtn" class="btn btn-info btn-lg btn-block" href="#">Submit</a>
                </div>
              </div>
            </div><!-- /submitBtnRow -->
          </div><!-- /friend-wrapper -->
        </div><!-- /container -->
      </div>

    <?php
    include 'footer.php'
    ?>

  <script id="friendTemplate" type="text/x-jquery-tmpl">
    <div class="col-md-3">
      <div class="tile ch-item" data-id="${id}" data-name="${name}">
        <div class="ch-info">
          <h3>${name}</h3>
        </div>
        <img src="${img}" alt="friendPhoto" class="tile-image big-illustration" style="border-radius: 50%;">
        <a class="btn btn-info btn-large btn-block btn-add" href="#fakelink">ADD</a>
      </div>
    </div>
  </script>

  <script>
    $(document).ready(function() {
      var friendData = [<?php
        foreach ($friends["data"] as $value) {
          echo json_encode(array('id'=>$value["id"], 'name'=>$value["name"], 'img'=>'https://graph.facebook.com/' . $value["id"] . '/picture?width=100&height=100'));
          echo ",";
        }
        ?>];
    console.log(_.where(friendData, {name:'Nikki Candelore Roda'}) );

    $('#friendTemplate').tmpl(friendData)
    .appendTo('#gallery');

    function addOrRemove(array, value) {
          var index = array.indexOf(value);
          if (index === -1) {
            array.push(value);
          } else {
            array.splice(index, 1);
          }
        }

        var idToDb = [];
        var nameToDb = [];
        var friendToDb ={};
        $('.btn-add').click(function(e){
          e.preventDefault();
          $(this).toggleClass('btn-info btn-success');
          $(this).toggleClass('friend-selected');
          $(this).html($(this).html() == "Selected" ? "Add" : "Selected");
          addOrRemove(idToDb, $(this).parent().data('id'));
        // addOrRemove(nameToDb, $(this).parent().data('name'));
        // friendToDb = _.object(idToDb, nameToDb)
        // The list of uid from friends who are selected
        // console.log(JSON.stringify(friendToDb));
      })
      // Advanced matching example
      var weird_names_list = [
      <?php
      foreach ($friends["data"] as $value) {
        echo json_encode(array('text'=>$value["name"]));
        echo ",";
      }
      ?>
      ];

      $("input.autocomplete.weird-names").autocomplete({
        list: weird_names_list,
        timeout: 0,
        matcher: function(typed) {
          if (!typed || typed.length === 0) {
            return undefined;
          }
          var reg = new RegExp("\\b" + typed, "i");
          reg.typed = typed;
          return reg;
        },
        match: function(element, matcher) {
          if (!matcher) { return false; }
          var typed = matcher.typed;
          element.typed = typed;
          element.pre_match = element.text;
          element.match = element.post_match = '';
          var match_at = element.text.search(matcher);
          if (match_at != -1) {
            element.pre_match = element.text.slice(0,match_at);
            element.match = element.text.slice(match_at,match_at + typed.length);
            element.post_match = element.text.slice(match_at + typed.length);
            return true;
          }
          return false;
        },
        insertText: function(obj) { return obj.text; },
        templateText: "<li><%= pre_match %><span class='matching' ><%= match %></span><%= post_match %></li>"
      });

    function sendRequest() {
     // Get the list of selected friends
     var sendUIDs = '';
     for(var i = 0; i < idToDb.length; i++) {
       sendUIDs += idToDb[i] + ',';
     }

       // Use FB.ui to send the Request(s)
       FB.ui({method: 'apprequests',
         to: sendUIDs,
         title: 'SI 694 Invite Test',
         message: 'Welcome to join this vote',
       }, callback);
     }

     function callback(response) {
       console.log(response);
     }

     $('#submitBtn').click(function(e){
      e.preventDefault();
      sendRequest();
    });      
              
  });
</script>
</body>
</html>
