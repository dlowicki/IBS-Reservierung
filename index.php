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
        <link rel="stylesheet" href="style/util.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.14.0/css/all.css">
        <script src="js/jquery.min.js"></script>
        <script src="js/component.js"></script>
        <script src="js/component-overview.js"></script>
    </head>
    <body>
        <div class="container">
            <div class="header">
                <h1 class="m-l-30 text-center p-t-5 hov-pointer"> IBS </h1>
                <div class="header-user">
                    <h3 class="p-t-10 p-r-10 hov-pointer trans-0-5"> dlowicki </h3>
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
                <div class="main-plan" style="background-image: url('img/et-3a.jpg');background-size:100% auto;">
                    <svg height="835" width="100%"></svg>
                </div>
            </div>
        </div>
        <script>

        </script>
    </body>
</html>