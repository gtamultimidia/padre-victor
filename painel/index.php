<?php
session_start();
require '../Funcoes/autoload/autoload.php';
$login = new Login();
?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <link rel="icon" type="image/png" href="pages/assets/img/favicon.ico">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

        <title>Painel Administrativo - Logar</title>

        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
        <meta name="viewport" content="width=device-width" />


        <!-- Bootstrap core CSS     -->
        <link href="pages/assets/css/bootstrap.min.css" rel="stylesheet" />

        <!-- Animation library for notifications   -->
        <link href="pages/assets/css/animate.min.css" rel="stylesheet"/>

        <!--  Light Bootstrap Table core CSS    -->
        <link href="pages/assets/css/light-bootstrap-dashboard.css" rel="stylesheet"/>

        <link href="pages/assets/css/main.css" rel="stylesheet" type="text/css"/>
        <!--  CSS for Demo Purpose, don't include it in your project     -->
        <link href="pages/assets/css/demo.css" rel="stylesheet" />
        <style>
            .sidebar-background{
                background-image: url(pages/assets/img/sidebar-5.jpg) !Important;
            }
        </style>
        <!--     Fonts and icons     -->
        <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
        <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
        <link href="pages/assets/css/pe-icon-7-stroke.css" rel="stylesheet" />

    </head>
    <body>

        <div class="wrapper">
            <?php require_once "header.php"; ?>
            <div class="main-panel">
                <div class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <form method="POST" action="index.php" id="form_login">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="header">
                                            <h4 class="title">Entre com o E-mail e senha!</h4>
                                        </div>
                                        <div class="content">
                                            <div class="row">
                                                <div class="col-md-10" style="float:none;margin: 0 auto;">
                                                    <div class="form-group">
                                                        <label>E-mail</label>
                                                        <input type="email" class="form-control" placeholder="E-mail" name="email">
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="row">
                                                <div class="col-md-10" style="float:none;margin: 0 auto;">
                                                    <div class="form-group">
                                                        <label>Senha</label>
                                                        <input type="password" class="form-control" placeholder="**********" name="senha">
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-info btn-fill pull-right">Logar</button>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <!--   Core JS Files   -->
    <script src="pages/assets/js/jquery-1.10.2.js" type="text/javascript"></script>
    <script src="pages/assets/js/bootstrap.min.js" type="text/javascript"></script>

    <!--  Checkbox, Radio & Switch Plugins -->
    <script src="pages/assets/js/bootstrap-checkbox-radio-switch.js"></script>

    <!--  Charts Plugin -->
    <script src="pages/assets/js/chartist.min.js"></script>

    <!--  Notifications Plugin    -->
    <script src="pages/assets/js/bootstrap-notify.js"></script>

    <!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
    <script src="pages/assets/js/light-bootstrap-dashboard.js"></script>

    <!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->
    <script src="pages/assets/js/demo.js"></script>
    
    <?php $login->logarAdm();?>
    </body>

    
</html>
