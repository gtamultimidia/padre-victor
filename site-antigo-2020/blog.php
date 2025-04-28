<?php
require 'Funcoes/autoload/autoload.php';
$funcoes = new Funcoes();
$blog = new Blog();
$base = $funcoes->retornaBase();
?>
<!DOCTYPE html>
<html>
    <head>
        <base href="<?php echo $base; ?>"/>
        <link rel="canonical" href="<?php echo $base; ?>" />

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width,minimum-scale=1">
        <?php echo $blog->tagsToticiaDetalhe(); ?>

        <base href="<?php echo $funcoes->retornaBase(); ?>"/>

        <style><?php echo file_get_contents("css/main.css"); ?></style>
        <link href="css/blog.css" rel="stylesheet" type="text/css"/>

        <style>
            .control-nav{position:absolute;display:block;top:-21px;left:29px;display:block;width:30px;padding:5px 0;border:solid #533334;border-top:solid #533334;border-width:3px 0;z-index:99999;cursor:pointer;border-radius:3px}
            .control-nav:before{content:"";display:block;height:3px;background:#533334;min-height:100%;border-radius:3px}
            .control-nav-close{display:none;position:fixed;right:0;top:0;background-color:rgba(0,0,0,0.22);bottom:0;left:0;display:block;z-index:20;-webkit-transition:all 500ms ease;transition:all 500ms ease;-webkit-transform:translate(100%,0);-ms-transform:translate(100%,0);transform:translate(100%,0);height:100%;min-height:100%}
        </style>
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
                <img src="img/faixa-header.png" alt="Faixa"/>
            </div>
        </div>

        <div class="linha">
            <div class="maxPg">
                <?php
                if (isset($_GET['url'])) {
                    echo $blog->exibeBlog();
                } else {
                    echo $blog->listarTodosBlog();
                }
                ?>
            </div>
        </div>

        <?php require 'footer.php'; ?>

        <script src="js/jquery-1.9.1.js" type="text/javascript"></script>
        <script src="js/main.js" type="text/javascript"></script>
    </body>
</html>