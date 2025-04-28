<?php
session_start();
require '../../Funcoes/autoload/autoload.php';
$painel = new Painel();
$painel->insere_noticia();
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <link rel="icon" type="image/png" href="assets/img/favicon.ico">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

        <title>Painel Administrativo - Adicionar Notícia</title>

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
                            <form method="POST" action="noticia-adicionar.php" enctype="multipart/form-data">
                                <div class="col-md-4">
                                    <div class="card card-user">
                                        <div class="image">

                                        </div>
                                        <div class="content">
                                            <div class="form-group">
                                                <label>Imagem da Notícia</label>
                                                <input type="file" class="form-control" name="arquivo" id="arquivo" onchange="PreviewImage2(this.value);">
                                            </div>
                                            <label style="text-align: center;width: 100%;">Preview</label><br>
                                            <div class="preview_foto">
                                                <img id="uploadPreview" src="assets/img/sem-imagem.jpg"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="card">
                                        <div class="header">
                                            <h4 class="title">Inserir Notícia</h4>
                                        </div>
                                        <div class="content">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Título</label>
                                                        <input type="text" class="form-control" placeholder="Título" name="titulo" required/>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Url (Opcional)</label>
                                                        <input type="text" class="form-control" placeholder="Url" name="url"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Descrição (Opcional)</label>
                                                        <textarea rows="5" class="form-control" placeholder="Descrição" name="descricao"/></textarea>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Texto</label>
                                                        <textarea rows="5" class="form-control" placeholder="Texto" name="texto" id="texto"></textarea>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Fonte</label>
                                                        <input type="text" class="form-control" placeholder="Fonte" name="fonte" required/>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Tags para SEO (Opcional, porém importante)</label>
                                                        <input type="text" class="form-control" placeholder="Tags para SEO" name="tags_seo"/>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Exibir notícia:</label>
                                                        <input type="checkbox" class="form-control" name="exibir_not" checked id="exibir_not" style="width:16px;height:16px"/>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row" id="divTit">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Exibir imagem da capa abaixo do título da notícia:</label>
                                                        <input type="checkbox" class="form-control" name="mostra_capa" checked id="mostra_capa" style="width:16px;height:16px"/>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <button type="submit" class="btn btn-info btn-fill pull-right">Inserir Notícia</button>
                                            <div class="clearfix"></div>
                                        </div>
                                        <div class="clearfix"></div>
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
        
        <script src="assets/tinymce/js/tinymce/tinymce.min.js" type="text/javascript"></script>
        <script src="assets/js/tiny.js" type="text/javascript"></script>
        
        <script type="text/javascript">           
            function verificaDestaque(){
                var elemento = document.getElementById('destaque');
                var imagem = document.getElementById('arquivo');
                var mostra_capa = document.getElementById('divTit');
                if(elemento.checked === true){
                    imagem.required = true;
                    mostra_capa.style.display = 'block';
                }else{
                    imagem.required = false;
                    mostra_capa.style.display = 'none';
                }
            }
            
            $(document).ready(function(){
                verificaDestaque();
            });
            
            $(document).on('change','#destaque', function(){
                verificaDestaque();
            });
            
            $(document).on('change','#arquivo', function(){
                $('#uploadPreview').load(function(){
                    var largura = document.getElementById("uploadPreview").naturalWidth;
                    var altura = document.getElementById("uploadPreview").naturalHeight;

                    if(largura < 503 || altura < 309){
                        alert("A dimensão da imagem deve ser de no mínimo 503x309 pixels.");
                        document.getElementById("uploadPreview").src = "assets/img/sem-imagem.jpg";
                        document.getElementById('arquivo').value = '';
                    }
                });
            });

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