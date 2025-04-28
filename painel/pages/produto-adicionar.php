<?php
session_start();
require '../../Funcoes/autoload/autoload.php';
$painel = new Painel();
$painel->insereProduto();
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <link rel="icon" type="image/png" href="assets/img/favicon.ico">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

        <title>Painel Administrativo - Adicionar Produto</title>

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
        
        <script type="text/javascript" src="assets/tinymce/tinymce.min.js"></script>
        <script type="text/javascript">
            tinymce.init({
                selector: "textarea",
                language: "pt_BR",
                theme: "modern",
                width: 850,
                height: 200
            });
        </script>
    </head>
    <body>
        <div class="wrapper">
            <?php require_once "header.php";?>
            <div class="main-panel">
                <?php require_once "topo.php"; ?>
                <div class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <form method="POST" action="produto-adicionar.php" enctype="multipart/form-data">
                                <div class="col-md-4 campoResponse">
                                    <div class="card card-user">
                                        <div class="image">
                                            <!--<img src="https://ununsplash.imgix.net/photo-1431578500526-4d9613015464?fit=crop&fm=jpg&h=300&q=75&w=400" alt="..."/>-->
                                        </div>
                                        <div class="content">
                                            <div class="form-group">
                                                <label>Imagem da Produto</label>
                                                <input type="file" class="form-control" name="arquivo" id="arquivo"  onchange="PreviewImage2(this.value);">
                                            </div>
                                            <label style="text-align: center;width: 100%;">Preview</label><br>
                                            <div class="preview_foto">
                                                <img id="uploadPreview" src="assets/img/sem-imagem.jpg"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-8 campoResponse">
                                    <div class="card">
                                        <div class="header">
                                            <h4 class="title">Editar Produto</h4>
                                        </div>
                                        <div class="content">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Produto*</label>
                                                        <input type="text" class="form-control" placeholder="Título da Produto" name="titulo" required>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Texto Produto*</label>
                                                        <textarea rows="5" class="form-control" placeholder="Texto Produto" name="textoProduto"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Linha de Produtos*</label>
                                                        <select name="linha" required>
                                                            <option value="">Selecione</option>
                                                            <option value="1">Padre Victor</option>
                                                            <option value="2">Sorriso</option>
                                                            <option value="3">Mirand' Ouro</option>
                                                            <option value="4">Marca Própria</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Data Postagem (OPCIONAL)</label>
                                                        <input type="datetime-local" class="form-control" placeholder="Data Postagem" name="dataPostagem" value="<?=date('Y-m-d\T12:00')?>">
                                                    </div>
                                                </div>
                                            </div>

                                            <button type="submit" class="btn btn-info btn-fill pull-right">Cadastrar Produto</button>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <?php require_once "footer.php"; ?>
            </div>
        </div>

        <!--   Core JS Files   -->
        <script src="assets/js/jquery-1.10.2.js" type="text/javascript"></script>
        <script src="assets/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="../../js/mascara-validar.js" type="text/javascript"></script>
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
        
        <script type="text/javascript">
            function PreviewImage2(arquivo) {
                if (arquivo) {
                    var oFReader = new FileReader();
                    oFReader.readAsDataURL(document.getElementById("arquivo").files[0]);

                    oFReader.onload = function (oFREvent) {
                        document.getElementById("uploadPreview").src = oFREvent.target.result;
                    };


                } else {
                    document.getElementById("uploadPreview").src = "assets/img/sem-imagem.jpg";
                }
            }
        </script>
    </body>
</html>