<?php
session_start();
require '../../classes/autoload/autoload.php';
$painel = new Painel();
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <link rel="icon" type="image/png" href="assets/img/favicon.ico">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

        <title>Painel Administrativo - Notifications</title>

        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
        <meta name="viewport" content="width=device-width" />


        <!-- Bootstrap core CSS     -->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" />

        <!-- Animation library for notifications   -->
        <link href="assets/css/animate.min.css" rel="stylesheet"/>

        <!--  Light Bootstrap Table core CSS    -->
        <link href="assets/css/light-bootstrap-dashboard.css" rel="stylesheet"/>
        <link href="assets/css/main.css" rel="stylesheet" type="text/css"/>

        <!--  CSS for Demo Purpose, don't include it in your project     -->
        <link href="assets/css/demo.css" rel="stylesheet" />


        <!--     Fonts and icons     -->
        <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
        <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
        <link href="assets/css/pe-icon-7-stroke.css" rel="stylesheet" />

    </head>
    <body>

        <div class="wrapper">
            <?php require_once "header.php"; ?>
            <div class="main-panel">
                <?php require_once "topo.php"; ?>
                <div class="content">
                    <div class="container-fluid">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Notifications</h4>
                                <p class="category">Handcrafted by our friend <a target="_blank" href="https://github.com/mouse0270">Robert McIntosh</a>. Please checkout the <a href="http://bootstrap-notify.remabledesigns.com/" target="_blank">full documentation.</a></p>

                            </div>
                            <div class="content">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h5>Notifications Style</h5>
                                        <div class="alert alert-info">
                                            <span>This is a plain notification</span>
                                        </div>
                                        <div class="alert alert-info">
                                            <button type="button" aria-hidden="true" class="close">×</button>
                                            <span>This is a notification with close button.</span>
                                        </div>
                                        <div class="alert alert-info alert-with-icon" data-notify="container">
                                            <button type="button" aria-hidden="true" class="close">×</button>
                                            <span data-notify="icon" class="pe-7s-bell"></span>
                                            <span data-notify="message">This is a notification with close button and icon.</span>
                                        </div>
                                        <div class="alert alert-info alert-with-icon" data-notify="container">
                                            <button type="button" aria-hidden="true" class="close">×</button>
                                            <span data-notify="icon" class="pe-7s-bell"></span>
                                            <span data-notify="message">This is a notification with close button and icon and have many lines. You can see that the icon and the close button are always vertically aligned. This is a beautiful notification. So you don't have to worry about the style.</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <h5>Notification states</h5>
                                        <div class="alert alert-info">
                                            <button type="button" aria-hidden="true" class="close">×</button>
                                            <span><b> Info - </b> This is a regular notification made with ".alert-info"</span>
                                        </div>
                                        <div class="alert alert-success">
                                            <button type="button" aria-hidden="true" class="close">×</button>
                                            <span><b> Success - </b> This is a regular notification made with ".alert-success"</span>
                                        </div>
                                        <div class="alert alert-warning">
                                            <button type="button" aria-hidden="true" class="close">×</button>
                                            <span><b> Warning - </b> This is a regular notification made with ".alert-warning"</span>
                                        </div>
                                        <div class="alert alert-danger">
                                            <button type="button" aria-hidden="true" class="close">×</button>
                                            <span><b> Danger - </b> This is a regular notification made with ".alert-danger"</span>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <br>
                                <div class="places-buttons">
                                    <div class="row">
                                        <div class="col-md-6 col-md-offset-3 text-center">
                                            <h5>Notifications Places
                                                <p class="category">Click to view notifications</p>
                                            </h5>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2 col-md-offset-3">
                                            <button class="btn btn-default btn-block" onclick="demo.showNotification('top', 'left')">Top Left</button>
                                        </div>
                                        <div class="col-md-2">
                                            <button class="btn btn-default btn-block" onclick="demo.showNotification('top', 'center')">Top Center</button>
                                        </div>
                                        <div class="col-md-2">
                                            <button class="btn btn-default btn-block" onclick="demo.showNotification('top', 'right')">Top Right</button>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2 col-md-offset-3">
                                            <button class="btn btn-default btn-block" onclick="demo.showNotification('bottom', 'left')">Bottom Left</button>
                                        </div>
                                        <div class="col-md-2">
                                            <button class="btn btn-default btn-block" onclick="demo.showNotification('bottom', 'center')">Bottom Center</button>
                                        </div>
                                        <div class="col-md-2">
                                            <button class="btn btn-default btn-block" onclick="demo.showNotification('bottom', 'right')">Bottom Right</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <?php require_once "footer.php"; ?>

            </div>
        </div>

        <!--   Core JS Files   -->
        <script src="assets/js/jquery-1.10.2.js" type="text/javascript"></script>
        <script src="assets/js/bootstrap.min.js" type="text/javascript"></script>

        <!--  Checkbox, Radio & Switch Plugins -->
        <script src="assets/js/bootstrap-checkbox-radio-switch.js"></script>

        <!--  Charts Plugin -->
        <script src="assets/js/chartist.min.js"></script>

        <!--  Notifications Plugin    -->
        <script src="assets/js/bootstrap-notify.js"></script>

        <!--  Google Maps Plugin    -->
        <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>

        <!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
        <script src="assets/js/light-bootstrap-dashboard.js"></script>

        <!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->
        <script src="assets/js/demo.js"></script>
    </body>

</html>