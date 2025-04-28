<?php
session_start();
require '../../Funcoes/autoload/autoload.php';
$painel = new Painel();
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <link rel="icon" type="image/png" href="assets/img/favicon.ico">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

        <title>Painel Administrativo</title>

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
                        <div class="row">
                            <a href="receita-listar.php" title="Clique para administrar as receitas cadastradas!">
                                <div class="col-md-4">
                                    <div class="card">
                                        <div class="row">
                                            <div class="col-md-8 col-xs-8">
                                                <div class="header">
                                                    <h4 class="title">Receitas Cadastradas</h4>
                                                    <!--<p class="category">Last Campaign Performance</p>-->
                                                </div>
                                                <div class="content">
                                                    <p class="vendas_hoje"><?php echo $painel->qtdReceitas() ?><p>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-xs-4 produtos_cadastrados_icone">
                                                <i class="pe-7s-coffee"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <a href="noticia-listar.php" title="Clique para administrar as notícias cadastradas!">
                                <div class="col-md-4">
                                    <div class="card">
                                        <div class="row">
                                            <div class="col-md-8 col-xs-8">
                                                <div class="header">
                                                    <h4 class="title">Notas Cadastradas</h4>
                                                </div>
                                                <div class="content">
                                                    <p class="vendas_hoje"><?php echo $painel->qtd_noticias() ?><p>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-xs-4 produtos_cadastrados_icone">
                                                <i class="pe-7s-news-paper"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <a href="produto-listar.php" title="Clique para administrar os produtos cadastrados!">
                                <div class="col-md-4">
                                    <div class="card">
                                        <div class="row">
                                            <div class="col-md-8 col-xs-8">
                                                <div class="header">
                                                    <h4 class="title">Produtos Cadastrados</h4>
                                                    <!--<p class="category">Last Campaign Performance</p>-->
                                                </div>
                                                <div class="content">
                                                    <p class="vendas_hoje"><?php echo $painel->qtdProdutos() ?><p>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-xs-4 produtos_cadastrados_icone">
                                                <i class="pe-7s-map-2"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card ">
                                    <?php //echo $painel->oferta_ativa() ?>
                                </div>
                            </div>
                        </div>

                        <!--<div class="row">
                            <div class="col-md-12">
                                <div class="card ">
                                    <div class="header">
                                        <h4 class="title">2014 Sales</h4>
                                        <p class="category">All products including Taxes</p>
                                    </div>
                                    <div class="content">
                                        <div id="chartActivity" class="ct-chart"></div>

                                        <div class="footer">
                                            <div class="legend">
                                                <i class="fa fa-circle text-info"></i> Tesla Model S
                                                <i class="fa fa-circle text-danger"></i> BMW 5 Series
                                            </div>
                                            <hr>
                                            <div class="stats">
                                                <i class="fa fa-check"></i> Data information certified
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>-->
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

        <!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
        <script src="assets/js/light-bootstrap-dashboard.js"></script>

        <!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->
        <script src="assets/js/demo.js"></script>

        <script type="text/javascript">
            $(document).ready(function () {
                demo.initChartist();
            });

        </script>
    </body>
</html>
