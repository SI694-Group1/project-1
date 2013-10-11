<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Edit</title>
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
