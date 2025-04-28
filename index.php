<?php
require 'Funcoes/autoload/autoload.php';
$funcoes = new Funcoes();
$receitas = new Receitas();
$blog = new Blog();
$base = $funcoes->retornaBase();

$ebook = new Ebook();
$ebook->enviaConfirmacao();
$ebook->confereUniqEnviaBook();

$todasReceitas = $receitas->listarTodasReceitas();
?>
<!DOCTYPE html>
<html>
    <head>
        <base href="<?php echo $base; ?>"/>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width,minimum-scale=1">
        <title>Café Padre Victor - No Ponto Certo!</title>

        <meta name="title" content="Café Padre Victor - No Ponto Certo!">
        <meta name="description" content="Produzimos cafés para os paladares mais exigentes, proporcionando intensidade, sabor e aroma diferenciados.">

        <meta property="og:locale" content="pt_BR" />
        <meta property="og:type" content="website" />
        <meta property="og:title" content="Café Padre Victor - No Ponto Certo!" />
        <meta property="og:description" content="Produzimos cafés para os paladares mais exigentes, proporcionando intensidade, sabor e aroma diferenciados." />
        <meta property="og:image" content="http://www.padrevictorcafe.com.br/img/logo.png"/>
        <meta property="og:url" content="http://www.padrevictorcafe.com.br/"/>
        <meta property="og:site_name" content="Café Padre Victor" />
        <meta property="og:street-address" content="Rua Ismael de Souza, 69 - Centro"/>
        <meta property="og:locality" content="Três Pontas"/>
        <meta property="og:region" content="MG"/>
        <meta property="og:country-name" content="Brasil"/>

        <meta name="twitter:title" content="Café Padre Victor - No Ponto Certo!" />
        <meta name="twitter:description" content="Produzimos cafés para os paladares mais exigentes, proporcionando intensidade, sabor e aroma diferenciados." />

        <link rel="canonical" href="<?php echo $base; ?>" />
        <style><?php echo file_get_contents("css/main.css"); ?></style>
        <style><?php echo file_get_contents("css/jquery-ui.css"); ?></style>
        <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
        <link href="css/blog.css" rel="stylesheet" type="text/css"/>

        <?php require 'adicionais.php'; ?>
        <?php
        if (isset($_SESSION['alerta']['titulo'])) {
            if ($_SESSION['alerta']['titulo'] == 'Confirme o seu e-mail') {
                echo "<!-- Event snippet for Inscrição E-book conversion page -->
							<script>
								gtag('event', 'conversion', {'send_to': 'AW-709616547/mGszCI7DhOIBEKPHr9IC'});
							</script>";
            }
        }
        ?>
    </head>
    <body>
        <?php require 'header.php'; ?>

        <div class="banner">
            <div class="relativaImagem">
                <img src="img/banner/bora-experimentar-cafe-padre-victor.jpg" alt="Bora Experimentar? Café Padre Victor"/>
                <!-- <p class="txt50anos"><span>50 anos</span> saboreando histórias.</p> -->
            </div>
            <div class="textoQuemSomos" id="quem-somos">
                <h2>Quem Somos</h2>
                <p>O Café Padre Victor foi fundado em 1973, sendo a realização do sonho de Urbano Miranda e sua esposa Nilda Vilela Miranda, visionários que almejaram estar presentes em todo o processo da produção do café: do grão à xícara. Desde o início, a empresa é administrada pelas irmãs Mônica, Eliana e Adriene que a conduzem de forma profissional e são exemplos da evolução das mulheres no mundo dos negócios.</p>
                <p>O Café Padre Victor dedica-se à industrialização, empacotamento e comercialização de café torrado e moído. São mais de 50 anos de aperfeiçoamento contínuo buscando satisfazer os clientes com produtos da mais alta qualidade. A indústria está localizada em Três Pontas, no Sul de Minas Gerais, região que mais produz cafés finos do Brasil. Possui a mais moderna tecnologia para torrefação e moagem, utilizando torradores ecológicos e máquinas de empacotar automáticas, além de um rigoroso controle de qualidade da matéria-prima. Com cerca de 40 funcionários, está presente em mais de 192 cidades e 4 mil pontos de vendas.</p>
                <p>Os produtos Padre Victor possuem os Selos de Pureza e Qualidade ABIC e são produzidos seguindo as Normas do Sistema de Qualidade Total, garantindo segurança, higiene e organização. Mais uma prova do compromisso da empresa com a satisfação dos consumidores mais exigentes.</p>
            </div>
        </div>

        <div class="produtos" id="produtos">
            <div class="maxPg">
                <h2>Os Melhores Produtos</h2>
                <p class="textoProdutos">para todas as ocasiões.</p>
                <p class="textoLinhas">Produzimos cafés para os paladares mais exigentes, proporcionando intensidade, sabor e aroma diferenciados.</p>
                <div class="linhas">
                    <div class="itemLinha">
                        <a href="produtos/linha/padre-victor">
                            <img src="img/selos/produtos-cafe-padre-victor-hover.png" alt="Linha Café Padre Victor" class="imgHover"/>
                            <img src="img/selos/produtos-cafe-padre-victor.png" alt="Linha Café Padre Victor" class="imgSelo"/>
                        </a>
                    </div>
                    <div class="itemLinha">
                        <a href="produtos/linha/mirand-ouro">
                            <img src="img/selos/produtos-mirand-hover.png" alt="Linha Mirand' Ouro" class="imgHover"/>
                            <img src="img/selos/produtos-mirand.png" alt="Linha Mirand' Ouro" class="imgSelo"/>
                        </a>
                    </div>
                    <div class="itemLinha">
                        <a href="produtos/linha/sorriso">
                            <img src="img/selos/produtos-cafe-padre-sorriso-hover.png" alt="Linha Café Sorriso" class="imgHover"/>
                            <img src="img/selos/produtos-cafe-padre-sorriso.png" alt="Linha Café Sorriso" class="imgSelo"/>
                        </a>
                    </div>
                    <div class="itemLinha">
                        <a href="produtos/linha/marca-propria">
                            <img src="img/selos/produtos-marca-propria-hover.png" alt="Produtos de Marca Própria" class="imgHover"/>
                            <img src="img/selos/produtos-marca-propria.png" alt="Produtos de Marca Própria" class="imgSelo"/>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="receitasEbook clickMenu" id="receitas">
            <img src="img/receitas-ebook.jpg" alt="E-book Receitas de Café"/>
            <p>Quer aprender as receitas mais saborosas usando café? <a href="#fale-conosco" rel="fale-conosco"><b>Clique aqui para receber gratuitamente</b></a> o nosso e-book com as melhores receitas e ficar por dentro das novidades pela nossa newsletter! </p>
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

                <form method="post" action="enviar-contato.php" name="formContato">
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
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script src="js/mascara-validar.js" type="text/javascript"></script>
        <script src="js/main.js" type="text/javascript"></script>

        <!--
        <div id="dialog-message44" title="Sucesso!!!">
                O E-book foi enviado para o seu e-mail.
        </div>

        <script>
                $( function() {
                        $( "#dialog-message44" ).dialog({
                                //dialogClass: "ui-state-error",
                                closeOnEscape: true,
                                modal: true,
                                buttons: {
                                        Ok: function() {
                                                $( this ).dialog( "close" );
                                        }
                                }
                        });
                  } );
        </script>
        -->

        <?php echo $funcoes->exibeAlerta(); ?>

        <?php require 'recaptcha.php'; ?>
    </body>
</html>