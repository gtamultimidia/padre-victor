<?php
session_start();
require '../../Funcoes/autoload/autoload.php';
$painel = new Painel();
$painel->salvar_edicao_noticia();
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <link rel="icon" type="image/png" href="assets/img/favicon.ico">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

        <title>Painel Administrativo - Editar Notícia</title>

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
            <?php require_once "header.php";?>
            <div class="main-panel">
                <?php require_once "topo.php"; ?>
                <div class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <form method="POST" action="noticia-editar.php?id=<?=$_GET['id']?>" enctype="multipart/form-data">
                                <?php $painel->editar_noticia(); ?>
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
                var imagemEnc = document.getElementById('imgEnc');
                var mostra_capa = document.getElementById('divTit');
                
                if(elemento.checked === true){
                    if(imagemEnc.value === ""){
                        imagem.required = true;
                        mostra_capa.style.display = 'block';
                    }else{
                        imagem.required = false;
                        mostra_capa.style.display = 'block';
                    }
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
            
            $(document).ready(function(){
                var imagemEnc = document.getElementById('imgEnc');
                var enderecoImg = 'assets/img/sem-imagem.jpg';
                if(imagemEnc.value !== ""){
                    enderecoImg = imagemEnc.value;
                }
                document.getElementById("uploadPreview").src = enderecoImg;
            });
            
            function PreviewImage(arquivo) {
                if(arquivo){
                    var oFReader = new FileReader(); 
                    oFReader.readAsDataURL(document.getElementById("arquivo").files[0]);

                    oFReader.onload = function (oFREvent) { 
                        document.getElementById("uploadPreview").src = oFREvent.target.result; 
                    };
                }else{
                    var imagemEnc = document.getElementById('imgEnc');
                    var enderecoImg = 'assets/img/sem-imagem.jpg';
                    if(imagemEnc.value !== ""){
                        enderecoImg = imagemEnc.value;
                    }
                    document.getElementById("uploadPreview").src = enderecoImg;
                }
            };
        </script>      
    </body>
</html>