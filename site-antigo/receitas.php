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
       		<!--<img src="imagens/banner_padreVitor.png" border="0" />-->
            <img src="imagens/banner_sorriso.png" border="0" />
            <img src="imagens/banner_mirandouro.png" border="0" />
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
    <img src="imagens/banner_padreVitor.png" border="0" />
    <div id="demais" style="position: relative; height: 0px; width: 100%;">
        <div id="background_titulo">
            <p align="center" style="position: relative; left: 50%; width: 395px; margin-left: -197.5px; top: 13px;">
            	<?php
					$resultado = mysql_fetch_assoc(mysql_query("SELECT * FROM `fraseSite` WHERE id = 1"));
					echo $resultado['titulo'];
					
					$consulta = mysql_query("SELECT * FROM `receitas`");
					$rows = mysql_num_rows($consulta);
				?>
            </p>
        </div>
        
        <?php
			$id = $_GET['rec'];
			if ((($rows < 3) && ($id == 1)) || (($rows < 9) && ($id == 2)) || (($rows < 15) && ($id == 3)) || (($rows < 21) && ($id == 4))){
				$altCentro = 300;
				$topEnfeitoFundo = 303;
				$topSombraEsq = 20; 
				$topSombraDir = 20; 
				$topVoltAvan = 320; 
			} else {
				$altCentro = 600;
				$topEnfeitoFundo = 603;
				$topSombraEsq = 140; 
				$topSombraDir = 140;
				$topVoltAvan = 550;  
			}
		?>
        
        <div id="centro" style="height: <?php echo $altCentro; ?>px;">
            <img src="imagens/sombra_dir.png" border="0" id="sombraDir" style="top: <?php echo $topSombraDir; ?>px;"/>
            <img src="imagens/sombra_esq.png" border="0" id="sombraEsq" style="top: <?php echo $topSombraEsq; ?>px;"/>
        	<img src="imagens/enfeito_fundo.png" border="0" id="enfeito_fundo" style="top: <?php echo $topEnfeitoFundo; ?>px;"/>
            <div id="tit_receitas">
            	<p align="center">
                	<?php
						echo "TOTAL DE RECEITAS: ".$rows;
					?>
                </p>
            </div>
            <div id="barra_faleConosco1"></div>
            <?php
				$id = $_GET['rec'];
				if ($id == 1){
					for ($i = 1; $i <= 6; $i++){
						$resultado = mysql_fetch_array(mysql_query("SELECT * FROM `receitas` WHERE id = ".$i));
						echo 
						   '<div id="img_receita'.$i.'">
								<a href="receitas_display.php?id='.$i.'">'.$resultado['caminhoImagem'].'</a>
								<p align="center" class="cor"><strong><a href="receitas_display.php?id='.$i.'">'.$resultado['titulo'].'</a></strong></p>
							</div>';
						if ($i == $rows){
							break;
						}
					}
					if ($rows > 6){
						echo '<p style="position: absolute; top: '.$topVoltAvan.'px; left: 640px; font-size: 15px;"><a href="receitas.php?rec=2">Mais receitas ></a></p>';
					}
				}
				
				if ($id == 2){
					for ($i = 7; $i <= 12; $i++){
						$resultado = mysql_fetch_array(mysql_query("SELECT * FROM `receitas` WHERE id = ".$i));
						$aux = $i - 6;
						echo 
						   '<div id="img_receita'.$aux.'">
								<a href="receitas_display.php?id='.$i.'">'.$resultado['caminhoImagem'].'</a>
								<p align="center" class="cor"><strong><a href="receitas_display.php?id='.$i.'">'.$resultado['titulo'].'</a></strong></p>
							</div>';
						if ($i == $rows){
							break;
						}
					}
					if ($rows > 12){
						echo '<p style="position: absolute; top: '.$topVoltAvan.'px; left: 560px; font-size: 15px;"><a href="receitas.php?rec=1">< Voltar</a>  |  <a href="receitas.php?rec=3">Mais receitas ></a></p>';
					} else {
						echo '<p style="position: absolute; top: '.$topVoltAvan.'px; left: 640px; font-size: 15px;"><a href="receitas.php?rec=1">< Voltar</a></p>';
					}
				}
				
				if ($id == 3){
					for ($i = 13; $i <= 18; $i++){
						$resultado = mysql_fetch_array(mysql_query("SELECT * FROM `receitas` WHERE id = ".$i));
						$aux = $i - 12;
						echo 
						   '<div id="img_receita'.$aux.'">
								<a href="receitas_display.php?id='.$i.'">'.$resultado['caminhoImagem'].'</a>
								<p align="center" class="cor"><strong><a href="receitas_display.php?id='.$i.'">'.$resultado['titulo'].'</a></strong></p>
							</div>';
						if ($i == $rows){
							break;
						}
					}
					if ($rows > 18){
						echo '<p style="position: absolute; top: '.$topVoltAvan.'px; left: 560px; font-size: 15px;"><a href="receitas.php?rec=2">< Voltar</a>  |  <a href="receitas.php?rec=4">Mais receitas ></a></p>';
					} else {
						echo '<p style="position: absolute; top: '.$topVoltAvan.'px; left: 640px; font-size: 15px;"><a href="receitas.php?rec=2">< Voltar</a></p>';
					}
				}
				
				if ($id == 4){
					for ($i = 19; $i <= 24; $i++){
						$resultado = mysql_fetch_array(mysql_query("SELECT * FROM `receitas` WHERE id = ".$i));
						$aux = $i - 18;
						echo 
						   '<div id="img_receita'.$i.'">
								<a href="receitas_display.php?id='.$aux.'">'.$resultado['caminhoImagem'].'</a>
								<p align="center" class="cor"><strong><a href="receitas_display.php?id='.$i.'">'.$resultado['titulo'].'</a></strong></p>
							</div>';
						if ($i == $rows){
							break;
						}
					}
					echo '<p style="position: absolute; top: '.$topVoltAvan.'px; left: 640px; font-size: 15px;"><a href="receitas.php?rec=3">< Voltar</a></p>';
				}
			?>
        </div>
        <?php
			include 'rodape.php';
		?>
    </div>
</body>
</html>