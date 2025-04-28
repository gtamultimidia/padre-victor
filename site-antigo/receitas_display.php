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
</head>

<body>
	<?php
		include 'topo.php';
	?>
    <div class="container">
        <div id="slides">
        	<img src="imagens/banner_1.jpg" border="0" />
            <img src="imagens/banner_2.jpg" border="0" />
            <img src="imagens/banner_sorriso.png" border="0" />
            <img src="imagens/banner_mirandouro.png" border="0" />
            <!--<img src="imagens/banner_padreVitor.png" border="0" />-->
            <img src="imagens/banner_marcaPropria.png" border="0" />
        </div>
    </div>
    <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
    <script src="slide/js/jquery.slides.min.js"></script>
    <script>
    $(function() {
        $('#slides').slidesjs({
        width: 940,
        height: 528,
        play: {
            active: true,
            auto: true,
            interval: 6000,
            swap: true
        }
        });
    });
    </script>
    <img src="imagens/banner_sorriso.png" border="0" />
    <div id="demais" style="position: relative; height: 0px; width: 100%;">
        <div id="background_titulo">
            <p align="center" style="position: relative; left: 50%; width: 395px; margin-left: -197.5px; top: 13px;">
            	<?php
					$resultado = mysql_fetch_assoc(mysql_query("SELECT * FROM `fraseSite` WHERE id = 1"));
					echo $resultado['titulo'];
				?>
            </p>
        </div>
        <div id="centro" style="height: 550px;">
            <img src="imagens/sombra_dir.png" border="0" id="sombraDir" style="top: 140px;"/>
            <img src="imagens/sombra_esq.png" border="0" id="sombraEsq" style="top: 140px;"/>
        	<img src="imagens/enfeito_fundo.png" border="0" id="enfeito_fundo" style="top: 553px;"/>
            
            <?php 
            	$id = $_GET['id'];
				
				$consulta = mysql_query("SELECT * FROM `receitas` WHERE id = ".$id);
				$resultado = mysql_fetch_assoc($consulta);			
			
      echo '<div id="tit_receitaDisplay">
            	<p>'.$resultado['titulo'].'</p>
            </div>
            <div id="barra_faleConosco1"></div>
            <div id="meio">
				<div style="float:left; width: 220px; height: 150px;">
                	'.$resultado['caminhoImagem'].'
				</div>
                <strong>'.$resultado['tituloIngredientes'].'</strong><br>
				
				'.$resultado['ingredientes'].'<br><br>
				
				<strong>'.$resultado['tituloPreparo'].'</strong><br
				>
				'.$resultado['modoPreparo'].'<br><br>
				
				<strong>'.$resultado['fonte'].'</strong>
                
            </div>';
			
			if ($id <= 6){
				echo '<p style="position: absolute; top: 570px; left: 670px; font-size: 15px;"><a href="receitas.php?rec=1">< Voltar</a></p>';			
			}    
			if (($id > 6) && ($id <= 12)){
				echo '<p style="position: absolute; top: 570px; left: 670px; font-size: 15px;"><a href="receitas.php?rec=2">< Voltar</a></p>';			
			}    
			if (($id > 12) && ($id <= 18)){
				echo '<p style="position: absolute; top: 570px; left: 670px; font-size: 15px;"><a href="receitas.php?rec=3">< Voltar</a></p>';			
			}   
			if (($id > 18) && ($id <= 24)){
				echo '<p style="position: absolute; top: 570px; left: 670px; font-size: 15px;"><a href="receitas.php?rec=4">< Voltar</a></p>';			
			}             
				
			?>
        </div>
        <?php
			include 'rodape.php';
		?>
    </div>
</body>
</html>