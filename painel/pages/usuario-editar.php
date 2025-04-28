<?php
session_start();
require '../../Funcoes/autoload/autoload.php';
$painel = new Painel();
$usuario = new Usuario();
$painel->salvar_edicao_usuario();
$usuario->alterar_senhaAdm();
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <link rel="icon" type="image/png" href="assets/img/favicon.ico">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

        <title>Painel Administrativo - Editar Meus Dados</title>

        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
        <meta name="viewport" content="width=device-width" />

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
                            <div class="col-md-8 campoResponse" style="float:none;margin:0 auto">
                                <div class="card">
                                    <div class="card card-user"><div class="image"></div></div>
                                    <div class="header">
                                        <h4 class="title">Editar Meus Dados</h4>
                                    </div>
                                    <div class="content">
                                        <form action="usuario-editar.php" method="post">
                                            <?php $painel->form_usuario(); ?>
                                        </form>
                                        
                                        <a href="#" onclick="altera_senha();">Alterar Senha</a>
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
        <script src="../../js/main.js" type="text/javascript"></script>
        <script type="text/javascript">
        function altera_senha(){
            msg = ' <form action="" method="POST" class="form_padrao" name="altera_senha" id="altera_senha" onSubmit="return verifica_senhas(\'nova_senha\', \'confirmar_nova_senha\')">';
            msg +=' <legend style="font-size: 20px;">Alterar Senha</legend>';
            msg +=' <label>Senha Atual: </label>';
            msg +=' <input type="password" id="senha_atual" name="senha_atual" class="form-control" required>';
            msg +=' <br><label>Nova Senha: </label>';
            msg +=' <input type="password" id="nova_senha" name="nova_senha" class="form-control" required>';
            msg +=' <br><label>Confirmar Nova Senha: </label>';
            msg +=' <input type="password" id="confirmar_nova_senha" name="confirmar_nova_senha" class="form-control" required>';
            msg +=' <br><button type="submit" value="Enviar" class="btn btn-success">Alterar</button>';
            msg +=' </form>';
            demo.initChartist();

            $.notify({
            icon: '',
            message: msg

        },{
            type: 'info',
            timer: 10000
        });
        }
	</script>
    </body>

</html>