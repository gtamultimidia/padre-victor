<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Café Padre Victor</title>

<link rel="stylesheet" href="estilo/franklin-gothic-book/stylesheet.css" type="text/css" charset="utf-8" />
<link rel="stylesheet" media="all" type="text/css" href="estilo/css.css" />

<meta name="viewport" content="width=device-width">
<link rel="stylesheet" href="slide/css/example.css">
<!--<link rel="stylesheet" href="slide/css/font-awesome.min.css">-->
<?php
	include 'estilo/slide.php';
?>

<script src="valida/js/jquery.min.js" type="text/javascript"></script>
<script src="valida/js/jquery.validate.js" type="text/javascript"></script> 
<link href="valida/css/validate.css" type="text/css" media="screen" rel="stylesheet" />
<!--[if lte IE 7]>
<link href="valida/css/validate_ie7.css" type="text/css" media="screen" rel="stylesheet" />
<![endif]-->	

</head>

<body>
	<?php
		include 'topo.php';
	?>
    
    
    <div id="demais" style="position: absolute; top: 129px; width: 100%;">
        <div id="background_titulo">
            <p align="center" style="position: relative; left: 50%; width: 395px; margin-left: -197.5px; top: 13px;">Os melhores produtos para todas as ocasiões. Escolha o seu.</p>
        </div>
        <div id="centro_faleConosco" style="height: 495px;">
            
            <img src="imagens/sombra_dir.png" border="0" id="sombraDirFaleConosco" />
            <img src="imagens/sombra_esq.png" border="0" id="sombraEsqFaleConosco" />
        	<img src="imagens/enfeito_fundo.png" border="0" id="enfeito_fundoFaleConosco" />
            
            <div id="tit_faleConosco">
            	<p align="center">FALE CONOSCO</p>
            </div>
            <div id="barra_faleConosco1"></div>
            <div id="formulario">
            	<form action="envia.php" method="post" id="form" class="validate">
                	<p style="position: relative; left: 36px;">
                    	<label>Nome*:
                        <input type="text" class="required" name="nome" id="nome" />
                        <span style="position: absolute;left: 66px;top: 40px;"></span></label>
                    </p>
                    <p style="position: relative; top: -12px; left: 40px;">
                    	<label>Email*:
                        <input type="text" class="required email" name="email" id="email" />
                        <span style="position: absolute;  left: 62px;  top: 40px;"></span></label>
                    </p>
                    <p style="position: relative; top: -25px; left: 5px;">
                    	<label>Mensagem*:
                        <textarea type="text" class="required" name="mensagem" id="mensagem"></textarea>
                        <span style="position: absolute; top: 122px; left: 480px; width: 100px;"></span></label>
                    </p>
                    <p style="position: relative; left: 105px; top: -50px;">Obs.: Dados marcados com '*' são obrigatórios.</p>
                    <button class="submit" id="enviar">ENVIAR</button>
                </form> 
            </div>
            <div id="barra_faleConosco2"></div>
        </div>
        <?php
			include 'rodape.php';
		?>
    </div>
</body>
</html>