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

<!-------------------------------------------------------------------------------------------------------------------------------->

<!--<script type="text/javascript" src="easyslider/js/jquery.js"></script>
	<script type="text/javascript" src="easyslider/js/easySlider1.7.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){	
			$("#slider").easySlider({
				auto: true, 
				continuous: true
			});
		});	
	</script>
	
<link href="easyslider/css/screen.css" rel="stylesheet" type="text/css" media="screen" />-->

</head>

<body>
	<?php
		include 'topo.php';
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
        <div id="centro_faleConosco" style="height: 497px;">
            
            <img src="imagens/sombra_dir.png" border="0" id="sombraDirFaleConosco" />
            <img src="imagens/sombra_esq.png" border="0" id="sombraEsqFaleConosco" />
        	<img src="imagens/enfeito_fundo.png" border="0" id="enfeito_fundoFaleConosco" style="top: 530px;"/>
            
            <div id="tit_faleConosco">
            	<p align="center">PRODUTOS</p>
            </div>
            <div id="barra_faleConosco1"></div>
            
            <?php
				$id = $_GET['linha'];
				
				
					$SQL = "SELECT * FROM `produtos` WHERE id = ".$id;
					$consulta = mysql_query($SQL);
					$resultado = mysql_fetch_array($consulta);
					
					echo '<div id="tituloProduto">
							  <p><strong><font color="#b39f6b">'.$resultado['nome'].'</font></strong></p>
						  </div>
						  
						  <div id="voltar">
						  	  <p><a href="produtos.php?linha='.$resultado['linha'].'">< Voltar</a></p>
						  </div>
						  <div id="imagem_produto_interno">
						  	  <img src="produtos/'.$resultado['linha'].'/'.$resultado['img'].'" border="0" />
						  </div>
						  <div id="bordaDescricoes"></div>
						  <div id="descricoes">
						  	  <p>'.$resultado['descricao'].'</p>
						  </div>';
				
				
			?>
            
        </div>
        <?php
			include 'rodape.php';
		?>
    </div>
</body>
</html>