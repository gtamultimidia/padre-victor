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
		$id = $_GET['linha'];
		$sql = "SELECT * FROM `produtos` WHERE linha = '".$id."'";
		$n_consultas = mysql_num_rows(mysql_query($sql));
		
		if ($n_consultas <= 2){
			$tam1 = 400;
			$tam2 = 406;
			$tam3 = 80;
		}
		
		if (($n_consultas > 2) && ($n_consultas <= 4)){
			$tam1 = 600;
			$tam2 = 606;
			$tam3 = 180;
		}
		
		if (($n_consultas > 4) && ($n_consultas <= 6)){
			$tam1 = 830;
			$tam2 = 836;
			$tam3 = 270;
		}
		
		if (($n_consultas > 6) && ($n_consultas <= 8)){
			$tam1 = 1000;
			$tam2 = 723;
			$tam3 = 270;
		}
		
		if (($n_consultas > 8) && ($n_consultas <= 10)){
			$tam1 = 1000;
			$tam2 = 723;
			$tam3 = 270;
		}
		
		if (($n_consultas > 10) && ($n_consultas <= 12)){
			$tam1 = 1000;
			$tam2 = 723;
			$tam3 = 270;
		}
		
		if (($n_consultas > 12) && ($n_consultas <= 14)){
			$tam1 = 1200;
			$tam2 = 1020;
			$tam3 = 345;
		}
		
		if (($n_consultas > 14) && ($n_consultas <= 16)){
			$tam1 = 2112;
			$tam2 = 2118;
			$tam3 = 920;
		}
		
		if (($n_consultas > 16) && ($n_consultas <= 18)){
			$tam1 = 2332;
			$tam2 = 2338;
			$tam3 = 1320;
		}
	?>
    
    
    <div id="demais" style="position: absolute; top: 129px; width: 100%;">
        <div id="background_titulo">
            <p align="center" style="position: relative; left: 50%; width: 395px; margin-left: -197.5px; top: 13px;">
            <?php
				$resultado = mysql_fetch_assoc(mysql_query("SELECT * FROM `fraseSite` WHERE id = 1"));
				echo $resultado['titulo'];
			?>
            </p>
        </div>
        <div id="centro_faleConosco" <?php echo 'style="height:'.$tam1.'px;"';?>>
            
            <img src="imagens/sombra_dir.png" border="0" id="sombraDirProdutos" <?php echo 'style="top:'.$tam3.'px;"';?>/>
            <img src="imagens/sombra_esq.png" border="0" id="sombraEsqProdutos" <?php echo 'style="top:'.$tam3.'px;"';?>/>
        	<img src="imagens/enfeito_fundo.png" border="0" id="enfeito_fundoProdutos" <?php echo 'style="top:'.$tam2.'px;"';?>/>
            
            <div id="tit_faleConosco">
            	<p align="center">PRODUTOS</p>
            </div>
            <div id="barra_faleConosco1"></div>
            <div id="produto">
				<?php
                    include 'marcas.php';
                ?>
            </div>
            
        </div>
        <?php
			include 'rodape.php';
		?>
    </div>
</body>
</html>