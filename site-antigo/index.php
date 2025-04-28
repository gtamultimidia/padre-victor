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

<!-- POP UP -->

<link rel="stylesheet" media="all" type="text/css" href="popup/interstitial.css" />
<script src="popup/interstitial.js"></script>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.1/jquery.min.js" type="text/javascript"></script>
<script src="toggle.js" type="text/javascript"></script>

<script type="text/javascript">
	$(document).ready(function(){
		//Ocultar o toogle no carregamento da página
		$(".togglebox").hide();
		$(".togglebox2").hide();
		$(".togglebox3").hide();
		$(".togglebox4").hide();
		//Exibir o conteúdo quando passar o mouse sobre o H2
		$("a, #sorriso").hover(function(){
			//Ocultar o conteúdo quando tirar o mouse do H2
			$(".togglebox4").hide();
			$(this).next(".togglebox").slideToggle("slow");
			return true;
		});
		
		$("a, #mirandouro").hover(function(){
			//Ocultar o conteúdo quando tirar o mouse do H2
			$(this).next(".togglebox2").slideToggle("slow");
			return true;
		});
		
		$("a, #marcaPropria").hover(function(){
			//Ocultar o conteúdo quando tirar o mouse do H2
			$(this).next(".togglebox3").slideToggle("slow");
			return true;
		});
		
		$("a, #padreVictor").hover(function(){
			//Ocultar o conteúdo quando tirar o mouse do H2
			$(this).next(".togglebox4").slideToggle("slow");
			return true;
		});
	});
</script> 

<style>
html,#page,body{

min-height:100%;

}
</style>

<script type="text/javascript">
$(document).ready(function() {
	
		var maskHeight = $(document).height();
		var maskWidth = $(window).width();
	
		$('#mask').css({'width':maskWidth,'height':maskHeight});

		$('#mask').fadeIn(1000);	
		$('#mask').fadeTo("slow",0.8);
	
		//Get the window height and width
		var winH = $(window).height();
		var winW = $(window).width();
              
		$('#dialog2').css('top',  winH/2-$('#dialog2').height()/2);
		$('#dialog2').css('left', winW/2-$('#dialog2').width()/2);
	
		$('#dialog2').fadeIn(2000); 
	
	$('.window .close').click(function (e) {
		e.preventDefault();
		
		$('#mask').hide();
		$('.window').hide();
	});		
	
	$('#mask').click(function () {
		$(this).hide();
		$('.window').hide();
	});			
	
});
</script>
</head>

<body>
	<?php
		if ($_REQUEST['alerta']==1){
			echo "<script type='text/javascript'> alert('Cadastrado com sucesso.');</script>"; 
		}
	?>
	
	<?php
		include 'topo.php';
	?>
    <div class="container" style="z-index: 0;">
        <div id="slides">
        	<img src="imagens/banner_1.jpg" border="0" />
            <img src="imagens/banner_2.jpg" border="0" />
            <!--<img src="imagens/banner_padreVitor.png" border="0" />-->
            <img src="imagens/banner_sorriso.jpg" border="0" />
            <img src="imagens/banner_mirandouro.png" border="0" />
            <img src="imagens/banner_marcaPropria.jpg" border="0" />
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
			?>
            </p>
        </div>
        <div id="centro">
        
        <!-- Inicio POP UP -->
    
<!--        
<div id="dialog2" class="window">
	<div id="fechar">
				<input type="image" src='imagens/busca-opcoes-fechar.png' value="Fechar" class="close"/>
	</div>
	<a href="https://www.facebook.com/CafePadreVictor" target="_blank"><img src="imagens/popup_01082014.jpg" width="1236" height="800"></a>
    <!--<a href="https://www.facebook.com/grupofarma" target="_blank"><img src="img/maes.jpg" width="500" height="854"></a> -->
<!--</div>  
        
        <!-- Fim POP UP -->
        
            <div id="botoes">
                <img src="imagens/background_botoes.png" border="0" />
                
                <a href="produtos.php?linha=padrevictor"><img src="imagens/botao_linha_padreVictor.png" border="0" id="padreVictor" /></a>
                <div class="togglebox" style="position:absolute;width:600px; height: 195px; left:50%;margin-left:-300px;top:180px; background-color:#fdf0d1; z-index:0;">
                <?php
					$resultado = mysql_fetch_array(mysql_query("SELECT * FROM `index` WHERE id = 1"));
				?>
                   <div class="content" >
                   	  <p style="left: -20px; position: relative;"><img src="imagens/padreVictor.png" border="0" /></p>
                      <div id = "xd" style="position: absolute; top: 0px; left: 325px;text-align: left;width: 300px; color:#907531;">
                      <?php
					  	echo '<strong style="font-size:20px;">'.$resultado['titulo'].'</strong><br>'.$resultado['texto'].'';
					  ?>
                      </div>
                   </div>
                </div>
            
                
                <a href="produtos.php?linha=sorriso"><img src="imagens/botao_linha_sorriso.png" border="0" id="sorriso" /></a>
                <div class="togglebox" style="position:absolute;width:600px; height: 195px; left:50%;margin-left:-300px;top:180px; background-color:#fdf0d1; z-index:0;">
                <?php
					$resultado = mysql_fetch_array(mysql_query("SELECT * FROM `index` WHERE id = 2"));
				?>
                   <div class="content" >
                   	  <p style="left: 10px; position: relative;"><img src="imagens/sorriso.png" border="0" /></p>
                      <div id = "xd" style="position: absolute; top: 10px; left: 280px;text-align: left;width: 300px; color:#907531;">
                      <?php
					  	echo '<strong style="font-size:22px;">'.$resultado['titulo'].'</strong><br>'.$resultado['texto'];
					  ?>
                      </div>
                   </div>
                </div>
                
                
                <a href="produtos.php?linha=mirandouro"><img src="imagens/botao_linha_mirandouro.png" border="0" id="mirandouro" /></a>
                <div class="togglebox2" style="position:absolute;width:700px; height: 195px; left:50%;margin-left:-350px;top:180px; background-color:#fdf0d1; z-index:0;">
                <?php
					$resultado = mysql_fetch_array(mysql_query("SELECT * FROM `index` WHERE id = 3"));
				?>
                   <div class="content" >
                   	  <p style="left: 70px; position: relative;"><img src="imagens/mirandouro.png" border="0" /></p>
                      <div id = "xd" style="position: absolute; top: 10px; left: 240px;text-align: left;width: 410px; color:#907531;">
                      <?php
					  	echo '<strong style="font-size:22px;">'.$resultado['titulo'].'</strong><br>'.$resultado['texto'];
					  ?>
                      </div>
                   </div>
                </div>
                
                
                <a href="produtos.php?linha=marcapropria"><img src="imagens/botao_linha_marcaPropria.png" border="0" id="marcaPropria" /></a>
                <div class="togglebox3" style="position:absolute;width:600px; height: 195px; left:50%;margin-left:-300px;top:180px; background-color:#fdf0d1; z-index:0;">
                <?php
					$resultado = mysql_fetch_array(mysql_query("SELECT * FROM `index` WHERE id = 4"));
				?>
                   <div class="content" >
                   	  <p style="left: -35px; position: relative;"><img src="imagens/marcaPropria.png" border="0" /></p>
                      <div id = "xd" style="position: absolute; top: 10px; left: 320px;text-align: left;width: 300px; color:#907531;">
                      <?php
					  	echo '<strong style="font-size:22px;">'.$resultado['titulo'].'</strong><br>'.$resultado['texto'];
					  ?>
                      </div>
                   </div>
                </div>
            </div>    
                
                
            
            <img src="imagens/sombra_dir.png" border="0" id="sombraDir" />
            <img src="imagens/sombra_esq.png" border="0" id="sombraEsq" />
            <img src="imagens/enfeito_fundo.png" border="0" id="enfeito_fundo" />
            <div id="barra_texto"></div>
            <div id="texto_pag" style="z-index: -10;">
            	<?php
					$resultado = mysql_fetch_array(mysql_query("SELECT * FROM `index` WHERE id = 5"));
					echo '<p align="center">'.$resultado['texto'].'</p>';
				?>
                
            </div>
        </div>
        <?php
            include 'rodape.php';
        ?>
    </div>
</body>
</html>