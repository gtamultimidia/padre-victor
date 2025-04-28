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

        <title>Painel Administrativo - Listar Receitas</title>

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
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="header">
                                        <h4 class="title">Receitas</h4>
                                        <br>
                                        <p class="category"><input type="text" class="form-control" placeholder="Buscar" onkeyup="busca(this.value)" style="text-align: center"/></p>
                                    </div>
                                    <div class="content table-responsive table-full-width">
                                        <table class="table table-hover table-striped">
                                            <thead>
                                                <th>Código</th>
                                                <th>Img</th>
                                                <th>Receita</th>
                                                <th>Resumo</th>
                                                <th style="text-align: center;">Operações</th>
                                            </thead>
                                            <tbody id="linha_tabela">
                                                <?php $painel->listarReceitas(); ?>
                                            </tbody>
                                        </table>

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
        
        <script>
            function confirma_editar(id){
                var resposta = confirm("Deseja mesmo editar a receita selecionada?");
                if (resposta === true) {
                    window.location.href = "receita-editar.php?id="+id;
                }
            }
            function confirma_excluir(id){
                var resposta = confirm("Deseja mesmo excluir a receita selecionada?");
                if (resposta === true) {
                    window.location.href = "receita-excluir.php?id="+id;
                }
            }
            function busca(palavra_chave){
                $.ajax({
                    type: "POST",
                    url: 'receita-buscar.php',   
                    data: {palavra_chave: palavra_chave},
                    success: function (result) {
                        document.getElementById('linha_tabela').innerHTML = result;
                    }
                });
            }
        </script>
    </body>

</html>