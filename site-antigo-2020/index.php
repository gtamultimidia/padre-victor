<?php
require 'Funcoes/autoload/autoload.php';
$funcoes = new Funcoes();
$receitas = new Receitas();
$blog = new Blog();
$base = $funcoes->retornaBase();

$todasReceitas = $receitas->listarTodasReceitas();
?>
<!DOCTYPE html>
<html>
    <head>
        <base href="<?php echo $base; ?>"/>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width,minimum-scale=1">
        <title>Café Padre Victor - Sua dose diária de energia</title>

        <link rel="canonical" href="<?php echo $base; ?>" />
        <style><?php echo file_get_contents("css/main.css"); ?></style>
        <link href="css/blog.css" rel="stylesheet" type="text/css"/>

        <?php require 'adicionais.php'; ?>

        <link rel="apple-touch-icon" sizes="57x57" href="img/favicons/apple-icon-57x57.png">
        <link rel="apple-touch-icon" sizes="60x60" href="img/favicons/apple-icon-60x60.png">
        <link rel="apple-touch-icon" sizes="72x72" href="img/favicons/apple-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="76x76" href="img/favicons/apple-icon-76x76.png">
        <link rel="apple-touch-icon" sizes="114x114" href="img/faviconsapple-icon-114x114.png">
        <link rel="apple-touch-icon" sizes="120x120" href="img/favicons/apple-icon-120x120.png">
        <link rel="apple-touch-icon" sizes="144x144" href="img/favicons/apple-icon-144x144.png">
        <link rel="apple-touch-icon" sizes="152x152" href="img/favicons/apple-icon-152x152.png">
        <link rel="apple-touch-icon" sizes="180x180" href="img/favicons/apple-icon-180x180.png">
        <link rel="icon" type="image/png" sizes="192x192"  href="img/favicons/android-icon-192x192.png">
        <link rel="icon" type="image/png" sizes="32x32" href="img/favicons/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="96x96" href="img/favicons/favicon-96x96.png">
        <link rel="icon" type="image/png" sizes="16x16" href="img/favicons/favicon-16x16.png">
        <link rel="manifest" href="img/favicons/manifest.json">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="img/favicons/ms-icon-144x144.png">
        <meta name="theme-color" content="#ffffff">
    </head>
    <body>
        <?php require 'header.php'; ?>

        <div class="banner">
            <div class="relativaImagem">
                <img src="img/banner/sua-dose-diaria-de-saude.jpg" alt="Sua Dose Diária de Saúde!"/>
                <h1>Sua Dose <b>Diária</b><br><span>de <b>Saúde.</b></span></h1>
            </div>
            <div class="textoQuemSomos" id="quem-somos">
                <h2>Quem Somos</h2>
                <p>O Café Padre Victor foi fundado em 1973, sendo a realização do sonho de Urbano Miranda e sua esposa Nilda Vilela Miranda, visionários que almejaram estar presentes em todo o processo da produção do café: do grão à xícara. Desde o início, a empresa é administrada pelas irmãs Mônica, Eliana e Adriene que a conduzem de forma profissional e são exemplos da evolução das mulheres no mundo dos negócios.</p>
                <p>O Café Padre Victor dedica-se à industrialização, empacotamento e comercialização de café torrado e moído. São mais de 45 anos de aperfeiçoamento contínuo buscando satisfazer os clientes com produtos da mais alta qualidade. A indústria está localizada em Três Pontas, no Sul de Minas Gerais, região do Brasil que mais produz cafés finos. Possui a mais moderna tecnologia para torrefação e moagem, utilizando torradores ecológicos e máquinas de empacotar automáticas, além de um rigoroso controle de qualidade da matéria-prima. Com cerca de 40 funcionários, está presente em mais de 192 cidades e 4 mil pontos de vendas.</p>
                <p>Os produtos Padre Victor possuem os Selos de Pureza e Qualidade ABIC e são produzidos seguindo as Normas do Sistema de Qualidade Total, garantindo segurança, higiene e organização. Mais uma prova do compromisso da empresa com a satisfação dos consumidores mais exigentes.</p>
            </div>
        </div>

        <div class="doseDiaria">
            <img src="img/sua-dose-diaria-de-saude-2.jpg" alt="Sua Dose Diária de Saúde!"/>
        </div>

        <div class="produtos" id="produtos">
            <div class="maxPg">
                <div class="partes parte1">
                    <img src="img/os-melhores-produtos-para-todas-as-ocasioes.png" class="imgFaixa" alt="Os melhores produtos para todas as ocasiões. Escolha o seu."/>
                </div>
                <div class="partes parte2">
                    <div class="linhas">
                        <div class="itemLinha">
                            <a href="produtos/linha/padre-victor">
                                <img src="img/selos/cafe-padre-victor-hover.png" alt="Linha Café Padre Victor" class="imgHover"/>
                                <img src="img/selos/cafe-padre-victor.png" alt="Linha Café Padre Victor" class="imgSelo"/>
                            </a>
                        </div>
                        <div class="itemLinha">
                            <a href="produtos/linha/sorriso">
                                <img src="img/selos/cafe-sorriso-hover.png" alt="Linha Café Sorriso" class="imgHover"/>
                                <img src="img/selos/cafe-sorriso.png" alt="Linha Café Sorriso" class="imgSelo"/>
                            </a>
                        </div>
                        <div class="itemLinha">
                            <a href="produtos/linha/mirand-ouro">
                                <img src="img/selos/mirand-ouro-hover.png" alt="Linha Mirand' Ouro" class="imgHover"/>
                                <img src="img/selos/mirand-ouro.png" alt="Linha Mirand' Ouro" class="imgSelo"/>
                            </a>
                        </div>
                        <div class="itemLinha">
                            <a href="produtos/linha/marca-propria">
                                <img src="img/selos/marca-propria-hover.png" alt="Produtos de Marca Própria" class="imgHover"/>
                                <img src="img/selos/marca-propria.png" alt="Produtos de Marca Própria" class="imgSelo"/>
                            </a>
                        </div>
                    </div>
                    <p class="textoLinhas">Produzimos cafés para os paladares mais exigentes. Intensidade, sabor e aroma diferenciados.</p>
                </div>
            </div>
        </div>

        <div class="receitas" id="receitas">
            <div class="tituloPersonalizado">
                <h2>Receitas</h2>
            </div>

            <p class="subtituloReceitas">Aprenda a fazer deliciosas receitas usando o Café Padre Victor.</p>

            <div class="maxPg">
                <div class="itensReceitas">
                    <div class="divReceitas">
                        <?php echo $todasReceitas['corpo'] ?>
                    </div>
                    <?php echo $todasReceitas['paginacao'] ?>
                </div>
            </div>
        </div>

        <div class="blogHome" id="blog">
            <div class="maxPg">
                <h2>Blog</h2>
                <div class="blog_home">
                    <?php echo $blog->blogHome(); ?>
                    <div style="clear:both"></div>
                </div>

                <a href="blog" class="botaoVerTodas">&#10010; ver mais</a>
            </div>
        </div>

        <div class="contato" id="contato">
            <div class="maxPg">
                <h2>Contato</h2>

                <form method="post" action="enviar-contato.php">
                    <div class="gruposForm">
                        <div class="grupo1">
                            <input type="text" class="campoForm" name="nome" placeholder="Nome" required />
                            <input type="text" class="campoForm" name="telefone" placeholder="Telefone" onkeyup="mascara(this, mtelcel)" onchange="mascara(this, mtelcel)" required />
                            <input type="email" class="campoForm" name="email" placeholder="E-mail" required />
                            <input type="text" class="campoForm" name="assunto" placeholder="Assunto" required />
                        </div>
                        <div class="fake"></div>
                        <div class="grupo2">
                            <textarea class="campoForm" name="mensagem" placeholder="Mensagem" required></textarea>
                        </div>
                    </div>
                    <br><br>
                    <div class="newsletter"><button type="submit" class="btnEnvia">Enviar</button></div>
                </form>
            </div>
        </div>

        <?php require 'footer.php'; ?>

        <script src="js/jquery-1.9.1.js" type="text/javascript"></script>
        <script src="js/mascara-validar.js" type="text/javascript"></script>
        <script src="js/main.js" type="text/javascript"></script>
    </body>
</html>