<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Administração do Site | Padre Victor</title>

<link rel="stylesheet" media="all" type="text/css" href="estilo/admin_style.css" />
<link rel="stylesheet" href="estilo/franklin-gothic-book/stylesheet.css" type="text/css" charset="utf-8" />


</head>

<body>
	<?php
		include 'topo.php';
	?>
    
    <div id="demais" style="position: absolute; top: 129px; width: 100%;">
    	<div id="menu_lateral">
        	<div id="barra_lateral"></div>
        	<div id="links">
            	<ul>
                    <li><a href="#">EDITAR</a>
                        <ul>
                            <li><a href="index.php?adm=inicio">INÍCIO</a>
                            	<ul>
                                	<li><a href="#">TEXTO PADRÃO</a></li>
                                    <li><a href="#">PADRE VICTOR</a></li>
                                    <li><a href="#">SORRISO</a></li>
                                    <li><a href="#">MIRAND'OURO</a></li>
                                    <li><a href="#">MARCA PRÓPRIA</a></li>
                                </ul>
                            </li>
                            <li><a href="index.php?adm=quemSomos">QUEM SOMOS</a></li>
                            <li><a href="index.php?adm=produtosEditar">PRODUTOS</a></li>
                            <li><a href="index.php?adm=receitasEditar">RECEITAS</a></li>
                        </ul>
                    </li>
                    <li><a href="#">INSERIR</a>
                        <ul>
                            <li><a href="index.php?adm=produtosInserir">PRODUTOS</a></li>
                            <li><a href="index.php?adm=receitasInserir">RECEITAS</a></li>
                        </ul>
                    </li>
                    <li><a href="#">ESTATÍSTICAS</a></li>
                    <li><a href="#">E-MAILS</a></li>
                    <li><a href="http://www.padrevictorcafe.com.br/novo/" target="_blank">SITE</a></li>
                    <li><a href="https://www.facebook.com/CafePadreVictor" target="_blank">FACEBOOK</a></li>
                    <li><a href="#">SAIR</a></li>
				</ul>
            </div>
        </div>
        <div id="background_titulo">
            <p align="center" style="position: relative; left: 50%; width: 450px; margin-left: -105px; top: 15px;font-size: 20px;">
            	Bem-vindo à administração do site Café Padre Victor
            </p>
        </div>
        <div id="centroAdmin">
            <?php
				$final = basename($_SERVER['SCRIPT_NAME']);
				if (!isset($adm)){
					echo "SELECIONE ALGUMA OPÇÃO DO MENU À ESQUERDA";
				} else {
					$adm = $_GET['adm'];
					
					if ($adm == 'inicio'){
						include 'inicio.php';
					}
					
					if ($adm == 'quemSomos'){
						include 'quemSomos.php';
					}
					
					if (($adm == 'produtosInserir') || ($adm == 'produtosEditar')){
						include 'produtos.php';
					}
					
					if (($adm == 'receitasInserir') || ($adm == 'receitasEditar')){
						include 'receitas.php';
					}
					
					if ($adm == 'estatistica'){
						include 'estatistica.php';
					}
					
					if ($adm == 'emails'){
						include 'emails.php';
					}
				}
			?>
        </div>
        <?php
			include 'rodape.php';
		?>
    </div>
</body>
</html>