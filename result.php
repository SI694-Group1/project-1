<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Result</title>
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
  <div class="page result-page">
          <div class="navbar navbar-inverse">
            <div class="navbar-header">
              <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target="#nav-collapse-01"></button>
            </div>            
            <div class="navbar-collapse collapse" id="nav-collapse-01">
              <ul class="nav">
                <li>
                  <a href="#fakelink">
                    Step1
                  </a>
                </li>
                <li>
                  <a href="#fakelink">
                    Step2
                  </a>
                </li>
                <li>
                  <a href="#fakelink">
                    Step3
                  </a>
                </li>
                <li  class="active">
                  <a href="#fakelink">
                    Step4
                  </a>
                </li>              
              </ul>
              <ul class="nav pull-right">
                    <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Welcome, User <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="#fakelink"><i class="icon-off"></i> Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div><!--/.nav -->
          </div> <!-- /navbar -->
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
<!--         <div class="row top-plus">
          <div class="col-md-4 col-md-offset-4">
            <div id="pieChartContainer"></div>
          </div>
        </div> -->
      </div>
      <!-- /result-wrapper --> </div>
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
  <script src="js/dx.chartjs.js"></script>
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