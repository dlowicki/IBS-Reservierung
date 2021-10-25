<?php
require_once('class/class.database.php');
require_once('class/class.sidebar.php');
?>
<!DOCTYPE html>
<html>
    <head>
        <title>IBS | Reservierung</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="style/style.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.14.0/css/all.css">
        <script src="js/jquery.min.js"></script>
        <script src="js/component.js"></script>
        <script src="js/component-overview.js"></script>
    </head>
    <body>
        <div class="container">
            <div class="header">
                <h1> IBS </h1>
                <div class="header-user">
                    <h3> dlowicki </h3>
                </div>
            </div>

            <div class="main">
                <div class="main-top-nav">
                    <div class="top-nav-box top-nav-box-current">
                        <h3 id="et-3a">3.OG A</h3>
                    </div>
                    <div class="top-nav-box">
                        <h3 id="et-3b">3.OG B</h3>
                    </div>
                    <div class="top-nav-box">
                        <h3 id="et-eg">EG</h3>
                    </div>
                    <div class="tischplan-svg-header-switch" style="display: none">
                        <h3>Laptop</h3>
                        <label class="switch"><input type="checkbox"><span class="slider round"></span></label>
                        <h3>Stand-PC</h3>
                    </div>
                </div>
                <div class="main-plan" style="background-image: url('img/et-3a.jpg');background-repeat:no-repeat;background-size:100% auto;">
                    <svg height="835" width="100%">
                        <rect class='rs-overview' id="raum-2" height='11.3vw' width='37%' y='2vw' x='1vw' fill='transparent'/>
                        <rect class='rs-overview' id="raum-1" height='20vw' width='37%' y='2vw' x='49vw' fill='transparent'/>
                        <rect class='rs-overview' id="raum-5" height='15.4vw' width='21%' y='26.5vw' x='1vw' fill='transparent'/>
                        <rect height='12vw' width='14%' y='30.5vw' x='1335' fill='transparent'/>
                    </svg>
                </div>
            </div>
        </div>
        <script>

        </script>
    </body>
</html>